@extends('admin.layouts.app')
@section('title', 'Custom SMS')
@push('styles')

    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />



@endpush
@section('admin_content')

    @php
        use App\Models\SmsLog;

        $totalSms = config('sms.total_sms_limit'); // Get limit from config
        $totalSendSms = SmsLog::sum('total_message'); // Total sent SMS (all)
        $totalSentSms = SmsLog::where('delivery_report', 'success')->sum('total_message'); // Successfully sent SMS
        $remainingSms = max(0, $totalSms - $totalSentSms); // Ensure remaining SMS is never negative
    @endphp


    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

                <div class="card">
                    <div class="card-header">
                        <h4 style="display: inline-block"> Custom SMS</h4>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-body">

                        <blockquote class="form-head">

                            <ol style="font-size: 14px; margin-bottom: 0;">
                                <li>Total SMS:  <strong>2500</strong> &nbsp; Total Send SMS: <strong>{{ $totalSendSms }}</strong> &nbsp;
                                    {{-- Remaining SMS: <strong>{{ $remainingSms }}</strong> --}}
                                </li>
                            </ol>

                        </blockquote>
                        <hr>

                        <form action="{{ route('send.message') }}" method="POST">
                            @csrf

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 form-control-label">
                                    <label for="mobile_numbers"><b>Mobile Number <span style="color:red">*</span></b></label>
                                </div>
                                <div class="col-lg-9 col-md-4">
                                    <div class="form-group">
                                        <div class="form-line access_info">
                                        <textarea id="mobile_numbers" class="form-control" rows="4" name="mobile_numbers"
                                                  placeholder="Without +88 And use Comma(,) Separator"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 form-control-label">
                                    <label for="message"><b>Message <span style="color:red">*</span></b></label>
                                </div>
                                <div class="col-lg-9 col-md-4">
                                    <div class="form-group">
                                        <div class="form-line access_info">
                                        <textarea id="message" class="form-control" rows="4" name="message"
                                                  placeholder="Type your message, Maximum Characters Length 1080"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Character Count and Total Numbers -->
                            <div class="clearfix">
                                <p style="float: right" class="mb-3">
                                <span>
                                    <strong>Total Characters:</strong>
                                    <input id="total_characters" name="total_characters" class="sms" type="text" value="0" readonly>
                                </span>
                                    &nbsp;

                                    <span>
                                    <strong>Total Numbers:</strong>
                                    <input id="total_numbers" name="total_numbers" class="sms" type="text" value="0" readonly>
                                </span>
                                </p>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-8">
                                    <button type="submit"
                                            class="btn btn-primary btn-lg custom_btn text-white text-uppercase text-bold right">
                                        SEND SMS
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function() {
            function updateCharacterCount() {
                let message = $("#message").val();
                let totalCharacters = message.length;
                let totalMessages;

                // Check if the message contains non-ASCII characters (indicating UCS2 encoding)
                let isUCS2 = /[^\x00-\x7F]/.test(message);  // Checks for non-ASCII characters

                if (isUCS2) {
                    // UCS2 Encoding (63 characters per SMS)
                    totalMessages = Math.ceil(totalCharacters / 63);
                } else {
                    // GSM-7 Encoding (160 characters per SMS)
                    totalMessages = Math.ceil(totalCharacters / 160);
                }

                // Limit the message length to 1080 characters
                if (totalCharacters > 1080) {
                    alert("Maximum character limit exceeded!");
                    $("#message").val(message.substring(0, 1080)); // Trim characters to 1080
                    totalCharacters = 1080;

                    // Recalculate the message parts based on UCS2 encoding (63 characters per part)
                    if (isUCS2) {
                        totalMessages = Math.ceil(totalCharacters / 63);
                    } else {
                        totalMessages = Math.ceil(totalCharacters / 160);
                    }
                }

                // Update character and message count in the UI
                $("#total_characters").val(totalCharacters);
                $("#total_messages").val(totalMessages);
            }

            function updateTotalNumbers() {
                let numbers = $("#mobile_numbers").val();
                let cleanNumbers = numbers.replace(/\s+/g, ''); // Remove spaces
                let numberList = cleanNumbers.split(',').filter(num => num.trim() !== ""); // Convert to array, remove empty
                $("#total_numbers").val(numberList.length);
            }

            // Run on input for message
            $("#message").on("input", updateCharacterCount);

            // Run on input for mobile numbers
            $("#mobile_numbers").on("input", updateTotalNumbers);

            // Run when page loads (if fields have pre-filled values)
            updateCharacterCount();
            updateTotalNumbers();
        });
    </script>
@endpush
