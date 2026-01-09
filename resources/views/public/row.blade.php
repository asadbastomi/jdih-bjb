<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru" name="description" />
    <meta content="Kota Banjarbaru" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />

    <!--Material Icon -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom  Css -->
    <link href="{{ asset('assets/css/landing.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/headline.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/splide-core.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/splide.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/splide-sea-green.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"
        type="text/css" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .section {
            position: relative;
            padding: 40px 0;
            overflow: hidden;
        }

        .bg-gradient {
            background: linear-gradient(135deg, #7A332B 0%, #A54439 25%, #B8544A 50%, #C9645B 75%, #D9746C 100%);
            position: relative;
        }

        .bg-gradient::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 15% 25%, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 25%),
                radial-gradient(circle at 85% 75%, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 25%);
            z-index: 1;
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(30deg, rgba(255, 255, 255, 0.1) 12%, transparent 12.5%, transparent 87%, rgba(255, 255, 255, 0.1) 87.5%, rgba(255, 255, 255, 0.1)),
                linear-gradient(150deg, rgba(255, 255, 255, 0.1) 12%, transparent 12.5%, transparent 87%, rgba(255, 255, 255, 0.1) 87.5%, rgba(255, 255, 255, 0.1)),
                linear-gradient(30deg, rgba(255, 255, 255, 0.1) 12%, transparent 12.5%, transparent 87%, rgba(255, 255, 255, 0.1) 87.5%, rgba(255, 255, 255, 0.1)),
                linear-gradient(150deg, rgba(255, 255, 255, 0.1) 12%, transparent 12.5%, transparent 87%, rgba(255, 255, 255, 0.1) 87.5%, rgba(255, 255, 255, 0.1)),
                linear-gradient(60deg, rgba(255, 255, 255, 0.1) 25%, transparent 25.5%, transparent 75%, rgba(255, 255, 255, 0.1) 75%, rgba(255, 255, 255, 0.1)),
                linear-gradient(60deg, rgba(255, 255, 255, 0.1) 25%, transparent 25.5%, transparent 75%, rgba(255, 255, 255, 0.1) 75%, rgba(255, 255, 255, 0.1));
            background-size: 80px 140px;
            z-index: 2;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 3;
        }

        .shape {
            position: absolute;
            opacity: 0.2;
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            background-color: #fff;
            border-radius: 50%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            background-color: #fff;
            border-radius: 50%;
            top: 70%;
            left: 80%;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
            }
            25% {
                transform: translateY(-15px) rotate(90deg) scale(1.05);
            }
            50% {
                transform: translateY(0) rotate(180deg) scale(1);
            }
            75% {
                transform: translateY(15px) rotate(270deg) scale(0.95);
            }
        }

        .container-fluid, .card-box {
            position: relative;
            z-index: 10;
        }

        .input-group, .card-box {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }

        .table-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }

        .btn-info {
            background-color: #A54439;
            border-color: #A54439;
            color: white;
        }

        .btn-info:hover {
            background-color: #8A362D;
            border-color: #8A362D;
            color: white;
        }

        .pagination .page-link {
            color: #A54439;
        }

        .pagination .page-item.active .page-link {
            background-color: #A54439;
            border-color: #A54439;
        }

        .badge.bg-success {
            background-color: #A54439 !important;
        }

        @media (max-width: 768px) {
            .section {
                padding: 20px 0;
            }
        }
    </style>
</head>

<body>
    @include('public.header')

    <section class="section pt-3 pb-3" style=" background-color: #def0fb; ">
        <div class="container-fluid">
            <h3>{{ isset($title) ? (app()->getLocale() == 'id' ? $judul : $title) : $judul }}</h3>
        </div> <!-- end container-fluid -->
    </section>

    <section class="section bg-gradient">
        <div class="bg-pattern"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        @isset($tahunlist)
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{ __('public.ketiksesuatu') }}"
                                id="textserach" value="{{ isset($s) ? str_replace('-', ' ', $s) : '' }}">
                            @if ($judul != 'Propemperda' && $judul != 'Monograf Hukum' && $judul != 'Artikel Hukum')
                                <select class="form-control col-2" name="status" id="status">
                                    <option value="ALL">Semua Status</option>
                                    <option value="berlaku"
                                        {{ isset($status) ? ($status == 'berlaku' ? 'selected' : '') : '' }}>Berlaku
                                    </option>
                                    <option value="tidak_berlaku"
                                        {{ isset($status) ? ($status == 'tidak-berlaku' ? 'selected' : '') : '' }}>Tidak
                                        Berlaku</option>
                                </select>
                            @endif
                            <select class="form-control col-2" name="tahun" id="tahun">
                                <option value="ALL">{{ __('public.seluruhtahun') }}</option>
                                @foreach ($tahunlist as $key => $value)
                                    <option value="{{ $value->tahun }}"
                                        {{ isset($tahun) ? ($tahun == $value->tahun ? 'selected' : '') : '' }}>
                                        {{ $value->tahun }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-info waves-effect waves-light" type="button"
                                    id="btncari">{{ __('public.cari') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box p-0 position-relative">
                        <div id="index-content">
                            <div class="table-responsive" id="table-data">
                                {{-- Data --}}
                            </div> <!-- end .table-responsive-->
                        </div>
                    </div> <!-- end card-box -->
                </div>
            </div>
        </div>
    </section>

    @include('public.footer')

    <!-- Back to top -->
    <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

    <!-- javascript -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/headline.js') }}"></script>
    <script src="{{ asset('assets/js/pubmisc.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/morris.js06/morris.js06.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/footable/footable.min.js') }}"></script>
    <!-- custom js -->
    <script>
        var opentop = {{ isset($det) ? ($det == true ? 'true' : 'false') : 'false' }};
        var textserach = '{{ isset($s) ? str_replace(' - ', ' ', $s) : '' }}';
        var texttahun = '{{ isset($tahun) ? $tahun : 'ALL' }}';
        var textstatus = '{{ isset($status) ? $status : 'ALL' }}';
        $(function($) {
            loadTable('{{ route($fetch) }}', textserach, texttahun, 1, {
                status: textstatus
            });
        });
        $(document).on('click', '#btncari', function(event) {
            var search = true;
            if ((textserach == $('#textserach').val()) && (texttahun == $('#tahun').val()) && (textstatus == $(
                    '#status').val())) {
                search = false;
            }
            textserach = $('#textserach').val();
            texttahun = $('#tahun').val();
            textstatus = $('#status').val();
            if (search) {
                loadTable('{{ route($fetch) }}', textserach, texttahun, 1, {
                    status: textstatus
                });
            }
        });
        $(document).on('click', '.page-link', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadTable('{{ route($fetch) }}', textserach, texttahun, page, {
                status: textstatus
            });
        });
        ! function($) {
            "use strict";

            var Ubold = function() {};

            Ubold.prototype.initStickyMenu = function() {
                    $(window).scroll(function() {
                        var scroll = $(window).scrollTop();

                        if (scroll >= 50) {
                            $(".sticky").addClass("nav-sticky");
                        } else {
                            $(".sticky").removeClass("nav-sticky");
                        }
                    });
                },

                Ubold.prototype.initSmoothLink = function() {
                    $('.navbar-nav a').on('click', function(event) {
                        var $anchor = $(this);
                        $('html, body').stop().animate({
                            scrollTop: $($anchor.attr('href')).offset().top - 50
                        }, 1500);
                        event.preventDefault();
                    });

                    // general
                    $("a.smooth-scroll").on('click', function(e) {
                        e.preventDefault();
                        var dest = $(this).attr('href');
                        $('html,body').animate({
                            scrollTop: $(dest).offset().top
                        }, 'slow');
                    });
                },


                Ubold.prototype.initBacktoTop = function() {
                    $(window).scroll(function() {
                        if ($(this).scrollTop() > 100) {
                            $('.back-to-top').fadeIn();
                        } else {
                            $('.back-to-top').fadeOut();
                        }
                    });
                    $('.back-to-top').click(function() {
                        $("html, body").animate({
                            scrollTop: 0
                        }, 1000);
                        return false;
                    });
                },


                Ubold.prototype.init = function() {
                    this.initStickyMenu();
                    this.initSmoothLink();
                    this.initBacktoTop();
                },
                //init
                $.Ubold = new Ubold, $.Ubold.Constructor = Ubold
        }(window.jQuery),
        //initializing
        function($) {
            "use strict";
            Waves.init();
            $.Ubold.init();
        }(window.jQuery);
    </script>
</body>

</html>
