@extends('admin.layouts.app')
@section('title','User profile')
@push('style')

@endpush
@section('admin_content')


<div class="container-fluid content profile-page">
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="card overflowhidden m-t-20">
                <div class="profile-header">
                    <div class="profile_info row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="profile-image float-md-right"> <img src="{{ asset(Auth::user()->image) }}" alt=""> </div>
                        </div>
                        <div class="col-lg-6 col-md-8 col-12">
                            <h4 class="m-t-5 m-b-0"><strong>{{ Auth::user()->name }}</strong></h4>
                            <p>{{ Auth::user()->phone }}</p>
                            <p>{{ Auth::user()->email }}</p>
                            <p>Welcome to our {{ Auth::user()->name }} user profile!</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="profile-sub-header">
                    <div class="box-list">
                        <ul class="text-center">
                            <li><a href="mail-inbox.html" class=""><i class="zmdi zmdi-email"></i><p>My Inbox</p></a></li>
                            <li><a href="image-gallery.html" class=""><i class="zmdi zmdi-camera"></i><p>Gallery</p></a></li>
                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-attachment"></i><p>Collections</p></a></li>
                            <li><a href="events.html"><i class="zmdi zmdi-format-subject"></i><p>Events</p></a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


    <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Change Password</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('update.password', Auth::user()->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password" name="old_password">

                            </div>

                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                             @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" placeholder="New Password">
                            </div>

                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="new_password_confirmation" placeholder="Confirm Password">

                            </div>

                            @error('new_password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <button class="btn btn-raised btn-primary">password update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Image update</h4>
                </div>
                <div class="body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="imageUpdate">
                            <form class="mypost-form" action="{{ route('update.profile.image',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="image" value="{{ Auth::user()->image }}">

                                    </div>
                                </div>
                                <div class="post-toolbar-b">
                                    <button type="submit" class="btn btn-raised btn-primary">Update</button>
                                </div>
                            </form>
                            <div class="mypost-list m-t-30">
                                <div class="post-box">
                                    <span class="date"><i class="zmdi zmdi-alarm"></i> {{ Auth::user()->updated_at->diffForHumans() }}</span>
                                    <div class="post-img mt-2"><img src="{{ asset(Auth::user()->image) }}" class="img-fluid" alt /></div>
                                </div>
                                <hr>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


