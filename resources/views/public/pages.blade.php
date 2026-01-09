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
            <h3>{{ isset($page->judul) ? translateIt($page->judul) : '' }}
            </h3>
        </div> <!-- end container-fluid -->
    </section>

    <section class="section bg-gradient" id="features">
        <div class="container-fluid clearfix">
            @if ($type == 'post')
                <div class="mb-4 text-right">
                    <a href="/kegiatan" type="button" class="btn btn-info btn-xs waves-effect waves-light ">
                        <span class="btn-label"><i
                                class="mdi mdi-chevron-double-left"></i></span>{{ translateIt('Kembali') }}
                    </a>
                </div>
            @endif
            @isset($page->gambar)
                <div class="mb-4 text-center">
                    <img src="{{ $page->gambar }}" alt="image" class="img-fluid rounded">
                </div>
            @endisset
            @if ($page->id == 7)
                <div class="row">
                    <div class="col-md-5">
                        <h3 class="mt-0">{{ translateIt('Silakan isi Buku Tamu JDIH') }}</h3>
                        <form name="konsul" id="konsul">
                            <div class="form-group">
                                <label for="nama" class="col-form-label">{{ translateIt('Nama') }}</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="asalinstansi"
                                    class="col-form-label">{{ translateIt('Asal Instansi') }}</label>
                                <input type="asalinstansi" class="form-control" id="asalinstansi"
                                    placeholder="Asal instansi anda" required>
                            </div>
                            <div class="form-group">
                                <label for="nomorwa" class="col-form-label">{{ translateIt('Nomor WA') }}</label>
                                <input type="text" class="form-control" id="nomorwa"
                                    placeholder="Nomor kontak anda" required>
                            </div>
                            <div class="form-group">
                                <label for="keperluan" class="col-form-label">{{ translateIt('Keperluan') }}</label>
                                <input type="text" class="form-control" id="keperluan" placeholder="Keperluan anda"
                                    required>
                            </div>
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-light">{{ translateIt('Kirim') }}</button>
                        </form>
                    </div>
                    <div class="col-md-7">
                        {!! isset($page->content) ? translateIt($page->konten) : '' !!}
                    </div>
                </div>
            @else
                @if ($page->tipe == 'pdf' && $page->konten)
                    @php
                        $pdflist = explode(';', $page->konten);
                    @endphp
                    @foreach ($pdflist as $item)
                        <object width="1000" height="500" style="width:100%; height:700px;" type="application/pdf"
                            data="{{ url('upload/halaman/' . $item) }}#zoom=85&scrollbar=0&toolbar=0&navpanes=0">
                            <p>PDF cannot be displayed.</p>
                        </object>
                    @endforeach
                @elseif ($page->tipe == 'gallery' && $page->konten)
                    @php
                        $imglist = explode(';', $page->konten);
                    @endphp
                    <div
                        style="display: flex;flex-direction: row;flex-wrap: wrap;justify-content: flex-start;align-items: stretch;align-content: space-around;gap: 16px;">
                        @foreach ($imglist as $item)
                            <img style="min-width: 400px;flex: 1;justify-content: center;object-fit: contain;"
                                src="{{ url($item) }}">
                        @endforeach
                    </div>
                @else
                    @if ($page->konten)
                        {!! isset($page->konten) ? translateIt($page->konten) : '' !!}
                    @endif
                @endif
            @endif
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
            // $.MorrisCharts.init();
            // encodeURI(uri)
            $(document).on('submit', 'form#konsul', function(event) {
                event.preventDefault();

                var nama = $('#nama').val();
                var asal_instansi = $('#asalinstansi').val();
                var no_wa = $('#nomorwa').val();
                var keperluan = $('#keperluan').val();

                $.ajax({
                    url: "{{ env('JDIH_SVC_BUKU_TAMU_URL') }}",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        nama: nama,
                        asal_instansi: asal_instansi,
                        no_wa: no_wa,
                        keperluan: keperluan
                    }),
                    beforeSend: function() {
                        $('button#submit-btn').attr('disabled', true).text('Mengirim...');
                    },
                    success: function(response) {
                        alert('Pesan berhasil dikirim!');
                        $('form#konsul')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Gagal mengirim pesan. Silakan coba lagi.');
                    },
                    complete: function() {
                        $('button#submit-btn').attr('disabled', false).text('Kirim');
                    }
                });
            });

        }(window.jQuery);
    </script>
</body>

</html>
