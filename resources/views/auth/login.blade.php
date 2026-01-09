<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.shared.title-meta', ['title' => "Log In"])
    @include('layouts.shared.head-css')
    <style>
        #captcha-container img {
            max-height: 40px;
        }
        #reload-captcha {
            padding: 4px 8px;
        }

    </style>
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
                    <h4 class="mt-0">Login</h4>
                    <p class="text-muted mb-4">Enter your Username and password to access admin panel</p>

                    <!-- form -->
                    <form id="formlogin" class="async">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control send" type="text" name="username" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" id="password" class="form-control send" placeholder="Enter your password" required>
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input send" id="remember_me"  name="remember_me">
                                <label class="custom-control-label" for="remember_me">Remember me</label>
                            </div>
                        </div>
                        
                        <div class="form-group" id="captcha-container" style="display: none;">
                            <div class="d-flex align-items-center mb-2">
                                <img id="captcha-image" src="" alt="captcha" class="border rounded mr-2" style="height: 40px;">
                                <button type="button" id="reload-captcha" class="btn btn-outline-secondary btn-sm" title="Reload Captcha">
                                    <i class="mdi mdi-refresh"></i>
                                </button>
                            </div>
                            <input type="text" name="captcha" id="captcha" class="form-control send" placeholder="Enter the text above">
                        </div>



                        
                        <div class="form-group mb-0 text-center">
                            <button class="ladda-button btn btn-primary waves-effect waves-light btn-block" dir="ltr" data-style="zoom-in" id="btnlogin" type="submit">Log In</button>
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        @include('layouts.shared.copyright')
                        {{-- <p class="text-muted">Don't have an account? <a href="{{route('second', ['auth', 'register-2'])}}" class="text-muted ml-1"><b>Sign Up</b></a></p> --}}
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3 text-white">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                </p>
                <h5 class="text-white">
                    - Fadlisaad (Ubold Admin User)
                </h5>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    @include('layouts.shared.footer-script')
    <script>
        var attempts = localStorage.getItem('loginAttempts') || 0;
        function loadCaptcha() {
            $('#captcha-image').attr('src', 'https://jdih-staging.banjarbarukota.go.id/captcha?rand=' + Math.random());
        }
        
        // Panggil saat halaman dimuat
        $(document).ready(function() {
            loadCaptcha();
        });
        
        $(document).ready(function() {
            if (attempts >= 5) {
                $('#captcha-container').show();
                loadCaptcha();
            }
        });
        
        // Tombol reload
        $('#reload-captcha').on('click', function() {
            loadCaptcha();
        });
    
        $(document).on('submit','form.async',function(){
            event.preventDefault();
            // Form Login
            if ($(this).attr('id')=='formlogin') {
                option = {
                    'module' : 'login',
                    'success' : {
                        'request' : 'redirect',
                        'url' : '{!! route('admin.dashboard') !!}',
                        'after' : 3000
                    }
                }
                sentData('{{ route('api.login') }}', option);
                loadCaptcha();
                attempts++;
                if (attempts >= 5) {
                    $('#captcha-container').show();
                    loadCaptcha();
                }
            }
        });
    </script>
</body>
</html>
