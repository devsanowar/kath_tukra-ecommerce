@extends('admin.layouts.app')
@section('title', 'Update SMS Settings')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> SMS Settings </h4>

                    </div>
                    <div class="body">
                        <form method="POST" action="{{ route('sms-settings.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>API URL</label>
                                <input type="text" name="api_url" class="form-control" value="{{ $setting->api_url }}">
                            </div>

                            <div class="mb-3">
                                <label>API Key</label>
                                <input type="text" name="api_key" class="form-control" value="{{ $setting->api_key }}">
                            </div>

                            <div class="mb-3">
                                <label>API Secret</label>
                                <input type="text" name="api_secret" class="form-control"
                                    value="{{ $setting->api_secret }}">
                            </div>

                            <div class="mb-3">
                                <label>Request Type</label>
                                <input type="text" name="request_type" class="form-control"
                                    value="{{ $setting->request_type }}">
                            </div>

                            <div class="mb-3">
                                <label>Message Type</label>
                                <input type="text" name="message_type" class="form-control"
                                    value="{{ $setting->message_type }}">
                            </div>

                            <div class="mb-3">
                                <label>Default Message</label>
                                <textarea name="default_message" id="" rows="10" class="form-control">{{ $setting->default_message }}</textarea>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                    {{ $setting->is_active == 1 ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Settings</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
    <script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>
@endpush
