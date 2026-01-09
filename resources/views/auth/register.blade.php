<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.shared.title-meta', ['title' => "Register & Signup"])
        @include('layouts.shared.head-css')
    </head>

    <body class="auth-fluid-pages pb-0">

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <a href="{{route('index')}}" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="22">
                                    </span>
                                </a>

                                <a href="{{route('index')}}" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- title-->
                        <h4 class="mt-0">Register</h4>
                        <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute</p>

                        <!-- form -->
                        <form id="formregister" class="async">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input class="form-control send" type="text" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input class="form-control send" type="email" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control send" type="text" id="username" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control send" placeholder="Enter your password" required>
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input send" id="term" name="term" required>
                                    <label class="custom-control-label" for="term">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="ladda-button btn btn-primary waves-effect waves-light btn-block" dir="ltr" data-style="zoom-in" id="btnregister" type="submit">Register</button>
                            </div>
                        </form>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            @include('layouts.shared.copyright')
                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3 text-white">ありがとうございます!</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> Thanks ya. <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <h5 class="text-white">
                        - regards (Ghost Fleet Admiral)
                    </h5>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        @include('layouts.shared.footer-script')
        <script>
        $(document).on('submit','form.async',function(){
            event.preventDefault();
            // Form Register
            if ($(this).attr('id')=='formregister') {
                option = {
                    'module' : 'register',
                    'success' : {
                        'request' : 'redirect',
                        'url' : '{!! route('login') !!}',
                        'after' : 3000
                    }
                }
                sentData('{{ route('api.register') }}', option);
            }
        });
        </script>
    </body>
</html>
