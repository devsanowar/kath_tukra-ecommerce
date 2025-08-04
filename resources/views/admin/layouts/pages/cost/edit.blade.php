@extends('admin.layouts.app')
@section('title', 'Edit Cost')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset( 'backend') }}/assets/plugins/summernote/summernote.css"/>

@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> Edit Cost <span><a href="{{ route('cost.index') }}" class="btn btn-primary right">All Costs</a></span></h4>
                    </div>

                    <div class="body mx-auto" style="width: 60%;">
                        <form class="form-horizontal" action="{{ route('cost.update', $cost->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="post_title_id" class="mb-0" style="min-width: 100px;"><b>Date*</b></label>
                                    <div class="flex-grow-1">
                                        <input type="date" id="post_title_id" name="date" value="{{ $cost->date }}"
                                               class="form-control @error('date') is-invalid @enderror"
                                               placeholder="Enter post title">
                                        @error('date')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="post_title_id" class="mb-0" style="min-width: 100px;"><b>Showroom</b></label>
                                    <div class="flex-grow-1">
                                        <input type="text" id="post_title_id" name="branch" value="{{ $cost->branch }}"
                                               class="form-control @error('branch') is-invalid @enderror"
                                               placeholder="Enter showroom name">
                                        @error('branch')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="post_title_id" class="mb-0" style="min-width: 100px;"><b>Category</b></label>
                                    <div class="flex-grow-1">
                                        <select name="category_id" class="form-control show-tick">
                                            <option value=""> -- Select Category -- </option>
                                            @foreach ($cost_categories as $cost_category)
                                                <option value="{{ $cost_category->id }}" @selected($cost_category->id == $cost->category_id)>{{ $cost_category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="post_title_id" class="mb-0" style="min-width: 100px;"><b>Field of Cost</b></label>
                                    <div class="flex-grow-1">
                                        <select name="field_of_cost_id" class="form-control show-tick">
                                            <option value=""> -- Select Field -- </option>
                                            @foreach ($fields as $field)
                                                <option value="{{ $field->id }}" @selected($field->id == $cost->field_of_cost_id)>{{ $field->field_of_cost }}</option>
                                            @endforeach
                                        </select>
                                        @error('field_of_cost_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="post_title_id" class="mb-0" style="min-width: 100px;"><b>Description</b></label>
                                    <div class="flex-grow-1">
                                    <textarea name="description" id="" cols="30" rows="4" class="form-control @error('description') is-invalid @enderror"
                                              placeholder="Enter description">{{ $cost->description }}</textarea>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="post_title_id" class="mb-0" style="min-width: 100px;"><b>Amount</b></label>
                                    <div class="flex-grow-1">
                                        <input type="number" id="post_title_id" name="amount" value="{{ $cost->amount }}"
                                               class="form-control @error('amount') is-invalid @enderror"
                                               placeholder="Enter amount (BDT)">
                                        @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="post_title_id" class="mb-0" style="min-width: 100px;"><b>Spend By</b></label>
                                    <div class="flex-grow-1">
                                        <input type="text" id="post_title_id" name="spend_by" value="{{ $cost->spend_by }}"
                                               class="form-control @error('spend_by') is-invalid @enderror"
                                               placeholder="Enter your name">
                                        @error('spend_by')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect right">Update</button>
                            </div>

                        </form>
                    </div>

                    <div class="card-footer"></div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/summernote/summernote.js"></script>

@endpush
