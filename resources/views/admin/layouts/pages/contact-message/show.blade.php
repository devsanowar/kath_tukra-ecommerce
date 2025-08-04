@extends('admin.layouts.app')
@section('title', 'Show Message')

@push('styles')

<style>
    .email-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 100%;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .email-header {
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .email-content {
            margin-top: 20px;
            line-height: 1.6;
            font-size: 16px;
        }
        .email-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

</style>

@endpush


@section('admin_content')


<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-12 mt-4">
            <div class="email-container">
                <div class="email-header">
                    <h4>Contact Message Detail</h4>
                </div>

                <div class="email-content">

                    <p><strong>Name : </strong> {{ $message->name }}</p>
                    <p><strong>Email : </strong> {{ $message->email }}</p>
                    <p><strong>Subject : </strong> {{ $message->subject }}</p>
                    <p><strong>Message :</strong> {!! $message->message !!}</p>

                </div>

                <div class="email-footer">
                    .<p>Email Send Date : {{ $message->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')



@endpush
