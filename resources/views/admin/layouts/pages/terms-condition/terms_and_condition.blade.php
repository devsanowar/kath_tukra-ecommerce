@extends('admin.layouts.app')
@section('title', 'Terms And Conditions')

@section('admin_content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block">Create Tearm And Condition</h4>

                </div>
                <div class="body">
                    <form action="{{ route('terms_and_conditon.update',$termsAndCondtion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row clearfix">

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for=""><b>Page content</b></label>
                                <textarea id="ckeditor" name="content">{!! $termsAndCondtion->content !!}</textarea>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-raised btn-warning text-white m-t-15 waves-effect mb-3" style="font-weight: 500">UPDATE</button>
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

<script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->

<script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>

@endpush
