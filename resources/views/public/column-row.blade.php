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
</head>

<body>
    @include('public.header')

    <section class="section pt-3 pb-3" style=" background-color: #def0fb; ">
        <div class="container-fluid">
            <h3>{{ isset($title) ? (app()->getLocale() == 'id' ? $judul : $title) : $judul }}</h3>
        </div> <!-- end container-fluid -->
    </section>

    <section class="section bg-gradient">
        <div class="container-fluid">
            <div class="row">
                @if (count($data) == 0)
                    <div class="col-12">
                        <div class="text-center">
                            Belum ada Artikel
                        </div>
                    </div>
                @endif
                @foreach ($data as $key => $row)
                    <div class="col-lg-6 col-xl-4">
                        <a href="/kegiatan/{{ $row->id }}/{{ strtolower(str_replace(' ', '-', $row->judul)) }}">
                            <div class="card">
                                <div class="card-img-top img-fluid"
                                    style="background-image:url({{ $row->gambar }});height: 250px;background-position: center;background-size: cover;">
                                </div>
                                <div class="card-body" style=" height: 108px; ">
                                    <span
                                        class="card-text text-muted">{{ strftime('%d %B %Y', strtotime($row->tanggal)) }}</span>
                                    <h4 class="card-title text-blue mb-0">{{ $row->judul }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('public.footer')

    <!-- Back to top -->
    <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

    <!-- javascript -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/headline.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/morris.js06/morris.js06.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <!-- custom js -->
    <script>
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
            $.MorrisCharts.init();
        }(window.jQuery);
    </script>
</body>

</html>
