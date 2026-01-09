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

    <section class="section pt-3 pb-3" style=" margin-top: 105px; background-color: #def0fb; ">
        <div class="container-fluid">
            <h3>{{ isset($title) ? (app()->getLocale() == 'id' ? $judul : $title) : $judul }}</h3>
        </div> <!-- end container-fluid -->
    </section>

    <section class="section bg-gradient">
        @isset($tahunlist)
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group" style=" box-shadow: 20px 20px 40px #bebebe5e, -20px -20px 60px #ffffff; ">
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
                    <div class="card-box p-0 position-relative"
                        style=" box-shadow: 20px 20px 40px #bebebe5e, -20px -20px 60px #ffffff; ">
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
