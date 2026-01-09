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

    <section class="section pt-3 pb-3 " style="background-color: #def0fb;">
        <div class="container-fluid">
            <h4 class="text-muted">{{ ($data->kategori->tipeDokumen->nama=="Monografi Hukum") ? $data->nama : $data->nama . ' Nomor ' . $data->nomor . ' Tahun ' . $data->tahun }}</h4>
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
    </style>
    <section class="section bg-gradient" id="features">
        <div class="container-fluid clearfix">
            <div class="row">
                <div class="col-md-3">
                    <div
                        style="border: 1px solid #f3f3f3; border-radius: 5px; box-shadow: 20px 20px 40px -30px #bebebe5e, -20px -20px 60px #ffffff; ">
                        <table class="table table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td style="font-size: 18px;font-weight: 600;border-top: 0px">
                                        <small class="m-0">Tipe Dokumen</small>
                                        <h4 class="m-0">{{ $data->kategori->tipeDokumen->nama }}</h4>
                                    </td>
                                </tr>
                                @if (array_key_exists($data->id, $regubahcabut))
                                    @php
                                        $hasCabut = false;
                                    @endphp

                                    @foreach ($regubahcabut[$data->id] as $ucrow)
                                        @if ($ucrow['jenis'] == 'cabut')
                                            @php
                                                $hasCabut = true;
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if ($hasCabut)
                                        <tr class="bg-danger text-white">
                                            <td style="font-size: 18px;font-weight: 600;">Tidak Berlaku</td>
                                        </tr>
                                    @else
                                        <tr class="bg-success text-white">
                                            <td style="font-size: 18px;font-weight: 600;">Berlaku</td>
                                        </tr>
                                    @endif
                                @else
                                    @if ($data->kategori->tipeDokumen->nama!="Monografi Hukum")
                                        <tr class="bg-success text-white">
                                            <td style="font-size: 18px;font-weight: 600;">Berlaku</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <td style="font-size: 12px">
                                        <small><strong>Keterangan Status</strong></small>
                                        <p class="m-0">
                                            @php $temp = '' @endphp
                                            @if (array_key_exists($data->id, $regubahcabut))
                                                @foreach ($regubahcabut[$data->id] as $key => $ucrow)
                                                    {!! $key != 0 ? '<br>' : '' !!}
                                                    @if ($temp != $ucrow['jenis'])
                                                        <span
                                                            style="font-weight:bold;width: 75px;display: inline-block;">
                                                            {{ substr($ucrow['jenis'], 0, 2) == 'me' ? $ucrow['jenis'] : 'di' . $ucrow['jenis'] }}
                                                        </span>
                                                    @else
                                                        {{ ',' }}
                                                    @endif

                                                    @php
                                                        $class = '';
                                                        if ($ucrow['jenis'] == 'mengubah') {
                                                            $class = 'ubah';
                                                        } elseif ($ucrow['jenis'] == 'mencabut') {
                                                            $class = 'cabut';
                                                        } else {
                                                            $class = $ucrow['jenis'];
                                                        }
                                                    @endphp

                                                    <span>
                                                        <a class='link_{{ $class }}'
                                                            href='{{ $ucrow['url'] }}'>
                                                            {{ $ucrow['nomor'] }}
                                                        </a>
                                                    </span>

                                                    @php $temp = $ucrow['jenis'] @endphp
                                                @endforeach
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px"><strong>Dilihat</strong> {{ $hit ?? '0' }} kali
                                    </td>
                                </tr>
                                @if ($data->kategori->tipeDokumen->nama!="Monografi Hukum")
                                    <tr>
                                        <td style="font-size: 14px"><strong>Diunduh</strong> {{ $unduhan ?? '0' }} kali
                                        </td>
                                    </tr>
                                @endif
                                @if ($data->cover)
                                <tr>
                                    <td class="text-center">
                                        <div class="mt-2 mb-2">
                                            <div class="mt-2">
                                                <img src="{{ url($data->cover) }}" alt="Cover {{ $data->judul }}"
                                                    class="img-thumbnail" style="max-width: 100%; max-height: 600px;">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
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
                                    <th scope="row" class="field" style="border-top: 0px">Jenis</th>
                                    <td class="spacer" style="border-top: 0px">:</td>
                                    <td style="border-top: 0px">{{ $data->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Nomor</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->nomor ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Tahun</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->tahun ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Judul</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->judul ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">T.E.U. Badan/Pengarang</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->teu_badan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Penandatangan</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->penandatangan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Tanggal Penetapan</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->tanggal_penetapan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Tempat Penetapan/Terbit</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->tempat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Tanggal Pengundangan</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->tanggal_diundangkan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Sumber</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->sumber ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Subjek</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->subjek ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Bahasa</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->bahasa ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Lokasi</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->lokasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Bidang Hukum</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->bidang_hukum ?? '-' }}</td>
                                </tr>
                                @if ($data->kategori->tipeDokumen->id == 2)
                                <!-- Informasi khusus untuk monografi hukum -->
                                <tr>
                                    <th scope="row" class="field">Nomor Panggil</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->nomor_panggil ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Edisi/Cetakan</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->edisi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">ISBN</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->isbn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Deskripsi Fisik</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->deskripsi_fisik ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Nomor Induk Buku</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->nomor_induk_buku ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Jumlah Eksemplar</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->jumlah ?? '0' }} buku</td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row" class="field">Keterangan</th>
                                    <td class="spacer">:</td>
                                    <td>{{ $data->keterangan ?? '-' }} </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="field">Berkas {{ $data->kategori->tipeDokumen->id == 2 ? 'Fulltext' : 'Produk Hukum' }}</th>
                                    <td class="spacer">:</td>
                                    <td>
                                        @if ($data->file)
                                            <a type="button"
                                                onclick="downloading({{ $data->id }},{{ $data->kategori_id }})"
                                                class="btn btn-info btn-sm waves-effect waves-light mb-1"
                                                href="{{ $data->kategori->tipeDokumen->id == 2 ? url($data->file) : '/upload/' . $data->nama_singkat . '/' . $data->tahun . '/' . $data->file }}"
                                                target="_blank">
                                                <span class="btn-label"><i
                                                        class="mdi mdi-cloud-download-outline"></i></span> Download {{ $data->kategori->tipeDokumen->id == 2 ? 'Fulltext' : 'Berkas' }}
                                            </a><br>
                                        @else
                                            <span class="text-muted">{{ $data->kategori->tipeDokumen->id == 2 ? 'Fulltext tidak tersedia' : 'Berkas tidak tersedia' }}</span>
                                        @endif
                                        @if ($data->abstrak)
                                            <a type="button"
                                                class="btn btn-success btn-sm waves-effect waves-light mb-1"
                                                href="/upload/abstrak/{{ $data->nama_singkat }}/{{ $data->tahun }}/{{ $data->abstrak }}"
                                                target="_blank">
                                                <span class="btn-label"><i
                                                        class="mdi mdi-cloud-download-outline"></i></span> Download Abstrak
                                            </a>
                                        @endif
                                    </td>
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
