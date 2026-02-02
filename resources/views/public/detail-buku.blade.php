<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Detail Buku - Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru</title>
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

    <section class="section pt-3 pb-3 " style="background-color: #def0fb;">
        <div class="container-fluid">
            <h2>{{ $data->judul }}</h2>
        </div> <!-- end container-fluid -->
    </section>

    <style>
        .field {
            width: 1px;
            white-space: nowrap;
            text-align: right
        }

        .spacer {
            width: 1px
        }

        .cover-img {
            max-height: 300px;
            margin: 0 auto;
            display: block;
        }
    </style>
    <section class="section bg-gradient" id="features">
        <div class="container-fluid clearfix">
            <div class="row">
                <div class="col-md-3">
                    <div
                        style="border: 1px solid #f3f3f3; border-radius: 5px; box-shadow: 20px 20px 40px -30px #bebebe5e, -20px -20px 60px #ffffff; ">
                        <div class="text-center p-3">
                            @if($data->cover_url)
                                <img src="{{ $data->cover_url }}" alt="Cover Buku" class="img-fluid cover-img">
                            @else
                                <img src="{{ asset('assets/images/no-cover.png') }}" alt="No Cover" class="img-fluid cover-img">
                            @endif
                        </div>
                        <table class="table table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td style="font-size: 14px"><strong>Dilihat</strong> {{ $hit ?? '0' }} kali
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="table-responsive"
                        style="border-radius: 5px; box-shadow: 20px 20px 40px #bebebe5e, -20px -20px 60px #ffffff; ">
                        <table class="table table-hover mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" class="field" style="border-top: 0px">Judul</th>
                                    <td class="spacer" style="border-top: 0px">:</td>
                                    <td style="border-top: 0px">{{ $data->judul ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Penerbit</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->penerbit ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Tahun Terbit</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->tahun_terbit ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Jumlah Halaman</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->halaman ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">ISBN</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->isbn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Bahasa</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->bahasa ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Deskripsi</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->deskripsi ?? '-' }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
        }(window.jQuery)
        //initializing
    </script>
</body>

</html>
