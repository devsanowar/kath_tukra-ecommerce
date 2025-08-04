<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;

class AdminPanelController extends Controller
{
    public function adminPanelSetting()
    {
        $admin_panel = WebsiteSetting::first();
        return view('admin.layouts.pages.website.addmin_panel_setting', compact('admin_panel'));
    }

    public function adminPanelSettingUpdate(Request $request)
    {
        $request->validate([
            'login_page_bg' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:500',
            'login_page_bg_color' => 'nullable|string',
        ]);

        $adminPanelSetting = WebsiteSetting::first();

        // যদি ইমেজ থাকে
        if ($request->hasFile('login_page_bg')) {
            $loginBgImage = $this->loginBgImage($request);

            // পুরাতন ইমেজ থাকলে ডিলিট করুন
            if (!empty($adminPanelSetting->login_page_bg)) {
                $oldImagePath = public_path($adminPanelSetting->login_page_bg);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // নতুন ইমেজ সেট করুন এবং কালার null করুন
            $adminPanelSetting->login_page_bg = $loginBgImage;
            $adminPanelSetting->login_page_bg_color = null;
        }
        // যদি কালার দেওয়া হয়
        elseif ($request->filled('login_page_bg_color')) {
            // পুরাতন ইমেজ থাকলে ডিলিট করুন
            if (!empty($adminPanelSetting->login_page_bg)) {
                $oldImagePath = public_path($adminPanelSetting->login_page_bg);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // ইমেজ null করে দিন এবং কালার সেট করুন
            $adminPanelSetting->login_page_bg = null;
            $adminPanelSetting->login_page_bg_color = $request->login_page_bg_color;
        }

        $adminPanelSetting->save();

        Toastr::success('Login Page Background updated successfully.');
        return redirect()->back();
    }

    private function loginBgImage(Request $request)
    {
        if ($request->hasFile('login_page_bg')) {
            $image = Image::read($request->file('login_page_bg'));
            $imageName = time() . '-' . $request->file('login_page_bg')->getClientOriginalName();
            $destinationPath = public_path('uploads/website_settings/');
            $image->save($destinationPath . $imageName);
            return 'uploads/website_settings/' . $imageName;
        }
        return null;
    }
}
