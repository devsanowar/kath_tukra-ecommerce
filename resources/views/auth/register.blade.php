{{-- <!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Nexa :: Sign Up</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/authentication.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/color_skins.css">
</head>

<body class="theme-orange">
<div class="authentication">
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header slideDown">
                        <div class="logo"><img src="{{ asset('backend') }}/assets/images/logo.png" alt="Nexa"></div>
                        <h1>Nexa Admin</h1>
                        <ul class="list-unstyled l-social">
                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-facebook-box"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-linkedin-box"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <form {{ route('register') }} class="col-lg-12" id="sign_in" method="POST">
                    @csrf

                        <h5 class="title">Register a new membership</h5>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input id="name" type="text" class="form-control" name="name" required autofocus autocomplete="name">
                                <label for="name" class="form-label">Name Surname</label>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <input id="email" type="email" name="email" class="form-control" required autocomplete="username">
                                <label class="form-label">Email Address</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" >
                                <label for="password" class="form-label">Password</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" >
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    <div>
                         <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-raised btn-primary waves-effect">SIGN UP</button>
                    </div>
                </form>

                <div class="col-lg-12 m-t-20">
                    <a href="{{ route('login') }}">You already have a membership?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="{{ asset('backend') }}/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('backend') }}/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('backend') }}/assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
</body>
</html> --}}


<h2>Page Not Found! :)</h2>
