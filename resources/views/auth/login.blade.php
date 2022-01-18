<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots" content="noindex">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="{{asset('assets/vendor/perfect-scrollbar.css')}}" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="{{asset('assets/css/style.css')}}" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="{{asset('assets/css/vendor-material-icons.css')}}" rel="stylesheet">

        <!-- Font Awesome FREE Icons -->
        <link type="text/css" href="{{asset('assets/css/vendor-fontawesome-free.css')}}" rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133433427-1"></script>

    </head>

    <body class="layout-login">

        <div class="layout-login__overlay"></div>
        <div class="layout-login__form bg-white" data-perfect-scrollbar>
            <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
                <a href="" class="navbar-brand" style="min-width: 0">
                    <img class="navbar-brand-icon" src="" width="25" alt="">
                    <span>CRM</span>
                </a>
            </div>

            <h4 class="m-0">Welcome back!</h4>
            <p class="mb-5">Login to CRM Account </p>

            <form action="{{ route('login') }}" method="Post">
                @csrf
                <div class="form-group">
                    <label class="text-label" for="email">Email Address:</label>
                    <div class="input-group input-group-merge">
                        <input id="email" type="email" required="" class="form-control form-control-prepended @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label" for="password">Password:</label>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" name="password" placeholder="Enter your password">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-key"></span>
                            </div>
                        </div>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                        <label class="custom-control-label form-check-label" for="remember">Remember me</label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary mb-5" type="submit">Login</button>
                </div>
            </form>
        </div>

        <!-- jQuery -->
        <script src="{{asset('assets/vendor/jquery.min.js')}}"></script>

        <!-- Bootstrap -->
        <script src="{{asset('assets/vendor/popper.min.js')}}"></script>
        <script src="{{asset('assets/vendor/bootstrap.min.js')}}"></script>

        <!-- Perfect Scrollbar -->
        <script src="{{asset('assets/vendor/perfect-scrollbar.min.js')}}"></script>

        <!-- DOM Factory -->
        <script src="{{asset('assets/vendor/dom-factory.js')}}"></script>

        <!-- MDK -->
        <script src="{{asset('assets/vendor/material-design-kit.js')}}"></script>

        <!-- App -->
        <script src="{{asset('assets/js/script.js')}}"></script>

        <!-- App Settings (safe to remove) -->
        <script src="{{asset('assets/js/app-settings.js')}}"></script>

    </body>

</html>