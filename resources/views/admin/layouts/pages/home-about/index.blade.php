@extends('admin.layouts.app')
@section('title', 'Home About')
@push('styles')
    <style>
        .form-control {
            border: 1px solid #ccc !important;
            padding-left: 10px !important;
        }
    </style>
@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> About Information Update </h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('home.about.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="title"><b>About Title</b></label>
                                <div class="form-group">
                                    <div class="">
                                        <input type="text" id="title" name="title" class="form-control"
                                            placeholder="Enter about title " value="{{ $homeAbout->title }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="description"><b>Short Description</b></label>
                                <div class="form-group">
                                    <div class="">
                                        <textarea type="text" id="description" name="description" class="form-control">{!! $homeAbout->description ?? 'N/A' !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="features"><b>Add Features</b></label>
                                <div id="inputContainer">
                                    @php
                                        $features = json_decode($homeAbout->features ?? '[]', true);
                                    @endphp

                                    @foreach ($features as $feature)
                                        <div class="input-group mb-2">
                                            <input type="text" name="features[]" class="form-control"
                                                value="{{ $feature }}">
                                            <button type="button" class="btn btn-danger"
                                                onclick="removeInput(this)">Remove</button>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-primary" onclick="addInput()">Add</button>
                            </div>



                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="image_one"><b>Image One (Max size 200kb)</b></label>
                                <div class="form-group mb-2">
                                    <div class="">
                                        <input type="file" class="form-control" name="image_one" id="image_one">
                                    </div>
                                </div>
                                <img src="{{ asset($homeAbout->image_one) }}" alt="" width="100px">
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="image_two"><b>Image Two (Max size 200kb)</b></label>
                                <div class="form-group mb-2">
                                    <div class="">
                                        <input type="file" class="form-control" name="image_two" id="image_two">
                                    </div>
                                </div>
                                <img src="{{ asset($homeAbout->image_two) }}" alt="" width="100px">
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect">UPDATE</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')

    <script>
        function addInput() {
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-2';

            inputGroup.innerHTML = `
            <input type="text" name="features[]" class="form-control" placeholder="Enter a feature">
            <button type="button" class="btn btn-danger" onclick="removeInput(this)">Remove</button>
        `;

            document.getElementById('inputContainer').appendChild(inputGroup);
        }

        function removeInput(button) {
            button.parentElement.remove();
        }
    </script>
@endpush
