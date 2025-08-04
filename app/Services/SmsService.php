<?php

namespace App\Services;

use App\Models\SmsSetting;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function sendOrderConfirmationSMS($mobile, $order)
    {
        $setting = SmsSetting::where('is_active', true)->first();

        if (!$setting) {
            Log::error("No active SMS setting found.");
            return false;
        }

        $message = $setting->default_message;

        $data = [
            'api_key'      => $setting->api_key,
            'api_secret'   => $setting->api_secret,
            'request_type' => $setting->request_type,
            'message_type' => $setting->message_type,
            'mobile'       => $mobile,
            'message_body' => $message,
        ];

        // যদি sender_id সেট করা থাকে, তাহলে সেটাও পাঠাও
        if (!empty($setting->sender_id)) {
            $data['sender_id'] = $setting->sender_id;
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $setting->api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $response = json_decode(curl_exec($curl), true);
        // info($response);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode == 200 && isset($response['api_response_code']) && $response['api_response_code'] == 200) {
            Log::info("SMS sent successfully: " . json_encode($response));
            return true;
        } else {
            Log::error("SMS sending failed: " . json_encode($response));
            return false;
        }
    }


}
