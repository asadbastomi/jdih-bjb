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
    @include('public.partials.legal-detail-styles')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fb;
            margin: 0;
            padding: 0;
        }

        .section {
            position: relative;
            padding: 40px 0;
            overflow: visible;
        }

        .page-hero {
            background: linear-gradient(135deg, #0b3b60 0%, #1f5f8b 35%, #0f172a 100%);
            color: #f8fafc;
            padding: 48px 0 38px;
        }

        .page-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 9999px;
            color: #e2e8f0;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.4px;
            margin-bottom: 14px;
        }

        .page-title {
            font-size: 34px;
            line-height: 1.2;
            font-weight: 800;
            margin: 0 0 12px;
            color: #f8fafc;
        }

        .page-subtitle {
            max-width: 760px;
            margin: 0;
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.7;
        }

        .page-hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .page-chip {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: #e2e8f0;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .container-fluid, .card-box {
            position: relative;
            z-index: 10;
        }

        .input-group, .card-box {
            background-color: #fff;
            border-radius: 14px;
            border: 1px solid #e5edf3;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
        }

        .table-card {
            background-color: #fff;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .btn-info {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
            box-shadow: none;
        }

        .btn-info:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
            color: white;
        }

        .pagination .page-link {
            color: #2563eb;
        }

        .pagination .page-item.active .page-link {
            background: #2563eb;
            border-color: #2563eb;
        }

        .badge.bg-success {
            background: #0f9d58 !important;
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

    <section class="page-hero">
        <div class="container-fluid">
            <div class="page-badge">
                <span class="mdi mdi-book-open-page-variant"></span>
                <span>JDIH Kota Banjarbaru</span>
            </div>
            <h3 class="page-title">{{ isset($title) ? (app()->getLocale() == 'id' ? $judul : $title) : $judul }}</h3>
            <p class="page-subtitle">
                Telusuri data hukum dengan tampilan yang bersih, minimalis, dan konsisten seperti Bahari AI.
            </p>
            <div class="page-hero-chips">
                <span class="page-chip">Pencarian cepat</span>
                <span class="page-chip">Data ringkas</span>
                <span class="page-chip">Detail per item</span>
            </div>
        </div> <!-- end container-fluid -->
    </section>

    <section class="legal-main">

        @isset($tahunlist)
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="legal-card mb-3">
                            <div class="legal-card-body">
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
                </div>
            </div>
        @endisset
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box p-0 position-relative legal-card">
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
