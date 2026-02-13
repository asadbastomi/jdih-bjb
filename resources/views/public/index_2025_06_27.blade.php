<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content="Dalam pelaksanaan Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kota Banjarbaru yang dikelola oleh Bagian Hukum dan Perundang-undangan."
        name="description" />
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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css'>
    <link href="{{ asset('assets/css/headline.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/splide-core.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/splide.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/splide-sea-green.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/chartist/chartist.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/ladda/ladda.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Rajdhani&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .penghargaan-item {
            width: 200px;
            height: auto;
            /* Ubah dari height: 250px ke auto agar fleksibel */
            background: rgba(255, 255, 255, 0.8);
            border-radius: 7px;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .penghargaan-img-wrapper {
            width: 100%;
            max-height: 170px;
            /* Maksimal tinggi gambar */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 5px;
        }

        .penghargaan-img-wrapper img {
            width: 100%;
            height: auto;
            /* Biarkan gambar tetap proporsional */
            max-height: 170px;
            /* Batasi tinggi maksimum */
            object-fit: contain;
            /* Gambar tetap penuh tanpa dipotong */
        }

        .penghargaan-text {
            display: block;
            color: #000;
            font-weight: 700;
            margin-top: 10px;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    @include('public.header')
    <!-- start of hero -->
    <section class="hero-slider hero-style translate undernav">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($slide as $item)
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" data-background="{{ url($item->foto) }}">
                            <div class="containerme">
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>{{ translateIt($item->judul) }}</h2>
                                </div>
                                @if ($item->subjudul)
                                    <div data-swiper-parallax="400" class="slide-text">
                                        <p>{{ translateIt($item->subjudul) }}</p>
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- end slide-inner -->
                    </div>
                    <!-- end swiper-slide -->
                @endforeach
            </div>
            <!-- end swiper-wrapper -->

            <!-- swipper controls -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- end of hero slider -->

    <!-- home start -->
    {{-- <section class="bg-home" id="home">
        <div class="container-fluid widthslider">
            <div id="image-slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($kegiatan as $key => $k)
                        <li class="splide__slide slide_link"
                            data-url="{{ $k->id }}/{{ strtolower(str_replace(' ', '-', $k->judul)) }}">
                            <img src="{{ $k->gambar }}">
                            <h4 class="translate">{{ translateIt($k->judul) }}</h4>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- home end -->

    {{-- Feature New Start --}}
    <section class="bg-home py-5" id="home" style="background: #0089dd;">
        <div class="container-fluid widthslider py-5">
            <div class="row py-3 pb-5">
                <div class="offset-md-2 col-lg-8">
                    <div class="text-center">
                        <h1 class="text-white" style="font-size: 50px;">{{ translateIt('Cari Produk Hukum') }}</h1>
                        <div class="form-group mt-4 mb-2">
                            <div class="form-group">
                                <input type="text" class="form-control" style="font-size: 30px;"
                                    placeholder="{{ translateIt('Ketikkan Sesuatu') }}" id="textsearch">
                            </div>
                            <div class="input-group" style="font-size: 20px;">
                                <select id="tipe" class="form-control" data-style="btn-normal">
                                    <option value="">{{ translateIt('Pilih Jenis Dokumen') }}</option>
                                    <option value="perda">PERDA</option>
                                    <option value="perwal">PERWAL</option>
                                    <option value="keputusan-wali-kota">KEPUTUSAN WALI KOTA</option>
                                    <option value="propemperda">PROPEMPERDA</option>
                                </select>
                                <select id="status" class="form-control" data-style="btn-normal">
                                    <option value="">{{ translateIt('Seluruh Status Dokumen') }}</option>
                                    <option value="berlaku">Berlaku</option>
                                    <option value="tidak-berlaku">Tidak Berlaku</option>
                                </select>
                                <select id="tahun" class="form-control" data-style="btn-normal">
                                    <option value="ALL">{{ translateIt('Seluruh Tahun') }}</option>
                                    @for ($i = $mintahun; $i <= $maxtahun; $i++)
                                        <option value="{{ $i }}">{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-danger waves-effect waves-light" type="button"
                                        id="btnsearch">
                                        <i class="fas fa-search mr-1"></i> {{ translateIt('Cari') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </section>
    <section class="py-5">
        <div class="">
            <h3 class="mb-3 text-center">{{ translateIt('Telusur Tema Peraturan') }}</h3>
            <div class="pt-2">
                <div class="slider-container" id="tema-dokumen-container"
                    style="overflow-x: auto;white-space: nowrap;display: flex;justify-content: center;gap: 15px;flex-direction: row;">
                    <!-- Tema dokumen akan dimuat melalui AJAX -->
                </div>
            </div>
        </div>
    </section>
    <section class="section p-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center font-22 mb-3">Produk Hukum Terbaru</h4>
                            <ul style="padding-left: 18px;" class="slider-terbaru">
                                @foreach ($regulasi as $r)
                                    <li class="p-1"
                                        style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                        <a href="/produk-hukum/{{ $r->nama_singkat }}/{{ $r->id }}/{{ Str::slug($r->judul) }}"
                                            class="card-link">
                                            <span class="badge badge-primary mb-0"
                                                style="text-transform: uppercase">{{ $r->nama_singkat }}</span>
                                            <small
                                                class="text-muted">{{ $r->tanggal_diundangkan ? strftime('%d %B %Y', strtotime($r->tanggal_diundangkan)) : '' }}</small>
                                            <h4 class="mb-0">Nomor {{ $r->nomor }} Tahun {{ $r->tahun }}
                                            </h4>
                                            <p class="text-muted font-14">{{ $r->judul }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-soft-info" style=" box-shadow: 0px 2px 17px -4px #b3bdc191; ">
                        <div class="card-body">
                            <h4 class="text-center font-22 mb-3">Produk Hukum yang sering dicari</h4>
                            <ul style="padding-left: 18px;" class="slider-sering">
                                @foreach ($popular_item as $p)
                                    <li class="p-1"
                                        style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                        <a href="/produk-hukum/{{ $p->kategori->nama_singkat }}/{{ $p->regulasi->id }}/{{ Str::slug($p->regulasi->judul) }}"
                                            class="card-link">
                                            <span class="badge badge-primary mb-0"
                                                style="text-transform: uppercase">{{ $p->kategori->nama_singkat }}</span>
                                            <small
                                                class="text-muted">{{ $p->regulasi->tanggal_diundangkan ? strftime('%d %B %Y', strtotime($p->regulasi->tanggal_diundangkan)) : '' }}</small>
                                            <h4 class="mb-0">Nomor {{ $p->regulasi->nomor }} Tahun
                                                {{ $p->regulasi->tahun }}
                                            </h4>
                                            <p class="text-secondary font-14">{{ $p->regulasi->judul }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Feature New End --}}
    <section class="section p-3">
        <div class="container-fluid">
            <h3 class="mb-3 text-center">{{ translateIt('STATISTIK PRODUK HUKUM') }}</h3>
            <div class="row pt-2">
                <div class="col-md-6 col-xl-3">
                    <div class="card-box" style="background-color: #3498DB">
                        <div class="row">
                            <div class="col-3">
                                <div class="avatar-xl">
                                    <i class="mdi mdi-book-open-page-variant avatar-title text-white"
                                        style="font-size: 40px"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="text-right">
                                    <h3 class="text-white my-1 font-bold"><span
                                            data-plugin="counterup">{{ $totalperda }}</span></h3>
                                    <p class="text-white mb-1 text-truncate">{{ translateIt('Total') }} Perda</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card-box" style="background-color: #2ECC71">
                        <div class="row">
                            <div class="col-3">
                                <div class="avatar-xl">
                                    <i class="mdi mdi-book-open-page-variant avatar-title text-white"
                                        style="font-size: 40px"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="text-right">
                                    <h3 class="text-white my-1 font-bold"><span
                                            data-plugin="counterup">{{ $totalperwal }}</span></h3>
                                    <p class="text-white mb-1 text-truncate">{{ translateIt('Total') }} Perwal</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card-box" style="background-color: #F39C12">
                        <div class="row">
                            <div class="col-3">
                                <div class="avatar-xl">
                                    <i class="mdi mdi-bookshelf avatar-title text-white" style="font-size: 40px"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="text-right">
                                    <h3 class="text-white my-1 font-bold"><span
                                            data-plugin="counterup">{{ $totalkepwal }}</span></h3>
                                    <p class="text-white mb-1 text-truncate">
                                        {{ translateIt('Total Keputusan Wali Kota') }}</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card-box" style="background-color: #9B59B6">
                        <div class="row">
                            <div class="col-3">
                                <div class="avatar-xl">
                                    <i class="mdi mdi-book-open-variant avatar-title text-white"
                                        style="font-size: 40px"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="text-right">
                                    <h3 class="text-white my-1 font-bold"><span
                                            data-plugin="counterup">{{ $totalpropemperda }}</span></h3>
                                    <p class="text-white mb-1 text-truncate">{{ translateIt('Total') }} Propemperda
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
            </div>
            <div class="row pt-3">
                <div class="col-lg-12 text-center translate">
                    <div class="text-center">
                        <p class="text-muted font-15 font-family-secondary mb-0">
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #3498DB"></i>
                                Perda</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #2ECC71"></i>
                                Perwal</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #F39C12"></i>
                                Keputusan Wali Kota</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #9B59B6"></i>
                                Propemperda</span>
                        </p>
                    </div>
                    <div id="morris-bar-stacked" style="height: 250px;" class="morris-chart"
                        data-colors="#3498DB,#2ECC71,#F39C12,#9B59B6"></div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-4 text-center translate">
                    <div style=" background: #fafdff; padding: 10px; border-radius: 5px; border: 1px solid #f0f0f0; ">
                        <div class="text-center">
                            <h4>{{ translateIt('Status Berlaku') }}</h4>
                        </div>
                        <div id="pie-chart-status" class="ct-chart" style="height: 250px"></div>
                    </div>
                </div>
                <div class="col-lg-4 text-center translate">
                    <div style=" background: #fafdff; padding: 10px; border-radius: 5px; border: 1px solid #f0f0f0; ">
                        <div class="text-center">
                            <h4>{{ translateIt('Paling Banyak dicari') }}</h4>
                        </div>
                        <div id="pie-chart-pencarian" class="ct-chart" style="height: 250px"></div>
                    </div>
                </div>
                <div class="col-lg-4 text-center translate">
                    <div style=" background: #fafdff; padding: 10px; border-radius: 5px; border: 1px solid #f0f0f0; ">
                        <div class="text-center">
                            <h4>{{ translateIt('Paling Banyak diunduh') }}</h4>
                        </div>
                        <div id="pie-chart-unduhan" class="ct-chart" style="height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gradient" id="features">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 translate">
                    <h4 class="header-title mb-3 translate">
                        {{ translateIt(strtoupper($pagedasarhukum->judul)) }}
                    </h4>
                    {!! translateIt($pagedasarhukum->konten) !!}
                </div>
                <div class="col-lg-5">
                    <div class="text-center">
                        <h4 class="header-title mb-3 translate">
                            {{ translateIt(strtoupper('Jadwal Harian Bagian Hukum')) }}
                        </h4>
                        <h5 class="header-title mb-3 text-primary">
                            {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                        </h5>
                        <table class="table table-striped table-hover"
                            style="border-radius: 5px; box-shadow: 20px 20px 40px #bebebe5e, -20px -20px 60px #ffffff; ">
                            <thead>
                                <tr>
                                    <th style="font-size: 15px;padding-right: 4px;padding-left: 4px;">No</th>
                                    <th style="font-size: 15px;padding-right: 4px;padding-left: 4px;">Acara</th>
                                    <th style="font-size: 15px;padding-right: 4px;padding-left: 4px;">Waktu</th>
                                    <th style="font-size: 15px;padding-right: 4px;padding-left: 4px;">Tempat</th>
                                    <th style="font-size: 15px;padding-right: 4px;padding-left: 4px;">Penyelengggara
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->judul }}</td>
                                        <td> {{ strftime('%H:%M', strtotime($value->waktu)) }}
                                        </td>
                                        <td>{{ $value->tempat }}</td>
                                        <td>{{ $value->penyelenggara }}</td>
                                    </tr>
                                @endforeach
                                @if (!$jadwal->count())
                                    <tr>
                                        <td colspan="5">Belum ada Jadwal hari ini</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- faqs start -->
    {{-- <section class="section">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-5">
                        <h3 class="mb-1">
                            {{ app()->getLocale() == 'id' ? $pagesejarah->judul : $pagesejarah->title }}
                        </h3>
                    </div>
                </div>
            </div>
            <!-- end row -->
            {!! app()->getLocale() == 'id' ? $pagesejarah->konten : $pagesejarah->content !!}
            <!-- end row -->

        </div> <!-- end container-fluid -->
    </section> --}}
    <!-- faqs end -->

    <!-- section link -->
    <section class="section" style="background-image: url('assets/images/bg/bg-15.png');">
        <div class="container pb-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center pb-3">
                        <h3>{{ translateIt('Link Terkait') }}</h3>
                    </div>
                </div>
            </div>

            <div class="row link-terkait">
                @foreach ($linkTerkait as $item)
                    <div
                        style="width: 200px;background:rgba(255,255,255,0.8);border-radius: 7px;padding: 10px;margin-left: 10px;margin-right: 10px">
                        <a href="{{ $item['link'] }}" target="_blank">
                            <img src="{{ $item['logo'] }}" alt="demo-img" class="img-fluid rounded animate">
                            <span
                                style="display: block; width: 100%; text-align: -webkit-center; color: #000000; font-weight: 700; margin-top: 10px;">{{ $item['nama'] }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- link end -->

    <!-- Feature New Start -->
    <section class="section" style="background: #0089dd;">
        <div class="container pb-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center pb-3 text-white">
                        <h3 style="color:#fff!important">Berita Terbaru</h3>
                    </div>
                </div>
            </div>

            <div class=""
                style="align-items: center;justify-content: center;flex-direction: row;align-content: center;flex-wrap: wrap;">
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    @foreach ($kegiatan as $k)
                        <div class="col">
                            <a
                                href="/kegiatan/{{ $k->id }}/{{ strtolower(str_replace(' ', '-', $k->judul)) }}">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{ $k->gambar }}"
                                        alt="JDIH BANJARBARU" style=" height: 250px; object-fit: cover; ">
                                    <div class="card-body" style=" height: 150px; ">
                                        <span
                                            class="card-text text-muted">{{ strftime('%d %B %Y', strtotime($k->tanggal)) }}</span>
                                        <h4 class="card-title text-blue mb-0">{{ translateIt($k->judul) }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div style=" display: flex; justify-content: center; ">
                    <a href="/kegiatan" class="btn btn-light waves-effect">Berita Lainnya</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Feature New Start --}}

    <!-- section link -->
    <section class="section" style="background-image: url('assets/images/bg/bg-15.png');">
        <div class="container pb-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center pb-3">
                        <h3>{{ translateIt('Penghargaan') }}</h3>
                    </div>
                </div>
            </div>

            <div class="row penghargaan-list" id="penghargaan-list">
                <!-- Data dari API akan dimuat di sini -->
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-fluid">
            <div class="text-center pb-3">
                <h3>Kontak Kami</h3>
            </div>
        </div>
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d995.6587315491789!2d114.83101809766961!3d-3.4386747501951818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6817491bf1bfd%3A0x598d17189e3fd73d!2sPemerintah%20Kota%20Banjarbaru%20Balaikota!5e0!3m2!1sid!2sid!4v1636334355960!5m2!1sid!2sid"
                width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="container-fluid">
            <div class="contact-section col-lg-9 mx-auto">
                <div class="contact-info">
                    <h3>Kontak Kami</h3>
                    <ul style=" list-style: none; padding: 0; ">
                        <li><i class="mdi mdi-phone"></i> (0511) 4772569</li>
                        <li><i class="mdi mdi-email-outline"></i> jdih@banjarbarukota.go.id</li>
                        <li><i class="mdi mdi-calendar-range"></i> Senin - Jum'at | 07.30 - 15.30</li>
                        <li><i class="mdi mdi-fax"></i> (0511) 4774269</li>
                        <li><i class="mdi mdi-map-marker-outline"></i> Jl. Panglima Batur No. 1 Banjarbaru. Kalimantan
                            Selatan</li>
                    </ul>
                </div>
                <div class="contact-form">
                    <h3>Kirim Pesan Anda</h3>

                    <form id="konsul" name="konsul" method="post">
                        <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required>
                        <input type="email" name="email" id="email" placeholder="Alamat Email" required>
                        <input type="text" name="subjek" id="subjek" placeholder="Subjek Pertanyaan anda"
                            required>
                        <textarea name="pesan" id="pesan" rows="5" placeholder="Pesan Anda" required></textarea>
                        <button type="submit">KIRIM PESAN</button>
                        <small>* Pesan ini akan diteruskan menggunakan applikasi Whatsapp</small>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- section link -->
    <section class=" section" style="background-image: url('assets/images/bg/bg-15.png');">
        <div class="container pb-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center pb-3">
                        <h3>{{ translateIt('Indeks Kepuasan Masyarakat') }}</h3>
                    </div>
                </div>
            </div>

            <div class="row"
                style="align-items: center;justify-content: center;flex-direction: row;align-content: center;flex-wrap: wrap;">
                <div id="pie-chart" class="ct-chart" style="height: 250px"></div>
                <div class="text-center">
                    <p class="text-muted font-15 font-family-secondary mb-0"
                        style="display: flex;flex-direction: column;align-items: flex-start;">
                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #d70206"></i>
                            {{ translateIt('Sangat Baik') }}</span>
                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #f05b4f"></i>
                            {{ translateIt('Baik') }}</span>
                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #f4c63d"></i>
                            {{ translateIt('Cukup Baik') }}</span>
                        <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle" style="color: #d17905"></i>
                            {{ translateIt('Kurang Baik') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- link end -->

    <!-- cta start -->
    <!-- <section class="section-sm bg-gradient">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <h3 class="mb-0 mo-mb-20">
                        {{ translateIt('Jika anda memiliki saran, kritik maupun pertanyaan, bisa langsung menghubungi kami melalui link berikut') }}
                    </h3>
                </div>
                <div class="col-md-3">
                    <div class="text-md-right">
                        <a href="/kontak" class="btn btn-primary btn-lg"><i class="mdi mdi-email-outline mr-1"></i>
                            {{ translateIt('Kontak Kami') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- cta end -->
    <div class="skm">
        <div class="panel">
            <div class="toast-header" style="height: 32px;">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="brand-logo" height="12"
                    class="mr-1" />
                <strong class="mr-auto">{{ translateIt('Survey Kepuasan Masyarakat') }} </strong>
            </div>
            <div class="toast-body" id="body-q">
                <div class="thanksvote">
                    <h1>{{ translateIt('Terima kasih atas voting') }}</h1>
                </div>
                <p class="mb-0">
                    {{ translateIt('Bagaimana pendapat anda judul pelayanan aplikasi JDIH Bagian Hukum Kota Banjarbaru ?') }}
                </p>
                <form action="" class="async" id="formskm">
                    <div class="mt-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="opsi1" name="jawab" class="custom-control-input send"
                                value="Sangat Baik">
                            <label class="custom-control-label"
                                for="opsi1">{{ translateIt('Sangat Baik') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="opsi2" name="jawab" class="custom-control-input send"
                                value="Baik">
                            <label class="custom-control-label" for="opsi2">{{ translateIt('Baik') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="opsi3" name="jawab" class="custom-control-input send"
                                value="Cukup Baik">
                            <label class="custom-control-label"
                                for="opsi3">{{ translateIt('Cukup Baik') }}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="opsi4" name="jawab" class="custom-control-input send"
                                value="Kurang Baik">
                            <label class="custom-control-label"
                                for="opsi4">{{ translateIt('Kurang Baik') }}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light mt-1" id="btnskm">
                        <i class="fas fa-paper-plane mr-1"></i> {{ translateIt('Kirim') }}
                    </button>
                </form>
            </div>
        </div>
        <button type="button" class="ml-2 mb-1 slider-arrow show" data-dismiss="toast">
            <i class="fas fa-angle-double-right"></i>
        </button>
    </div>

    @include('public.footer')

    <!-- Back to top -->
    <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

    <!-- javascript -->

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/headline.js') }}"></script>
    {{--
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script> --}}
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js06/morris.js06.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltips.min.js') }}"></script>
    <script src="{{ asset('assets/libs/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('assets/libs/cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('assets/js/pact.js') }}"></script>
    <script async src="https://analytics.app.bjb.city/script.js" data-website-id="e3f566da-d0e7-4e5a-8f95-40963342afbe">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Page js-->
    {{--
    <script src="{{asset('assets/js/pages/chartist.init.js')}}"></script> --}}
    <!-- custom js -->
    <script>
        $(document).ready(function() {
            $('.slider-sering').slick({
                dots: false,
                swipeToSlide: true,
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                adaptiveHeight: true,
                vertical: true,
                autoplay: true,
                arrows: false
            });
            $('.slider-terbaru').slick({
                dots: false,
                swipeToSlide: true,
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                adaptiveHeight: true,
                vertical: true,
                autoplay: true,
                arrows: false
            });
            $('.link-terkait').slick({
                dots: false,
                swipeToSlide: true,
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                adaptiveHeight: true,
                autoplay: true,
                arrows: false
            });
        });
        $(document).ready(function() {
            loadPenghargaan();

            function loadPenghargaan() {
                $.ajax({
                    url: `{{ env('JDIH_SVC_PENGHARGAAN_URL') }}`, // Sesuaikan dengan endpoint API
                    method: 'GET',
                    success: function(response) {
                        let penghargaanHTML = '';
                        $.each(response.data, function(index, penghargaan) {
                            penghargaanHTML += `
                                <div class="penghargaan-item">
                                    <a href="${penghargaan.image || '/assets/images/piagam.png'}" target="_blank">
                                        <div class="penghargaan-img-wrapper">
                                            <img src="${penghargaan.image || '/assets/images/piagam.png'}" alt="Penghargaan">
                                        </div>
                                        <span class="penghargaan-text">${penghargaan.nama}</span>
                                    </a>
                                </div>`;
                        });

                        $('#penghargaan-list').html(penghargaanHTML);

                        $('.penghargaan-list').slick({
                            dots: false,
                            swipeToSlide: true,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 5,
                            adaptiveHeight: true,
                            autoplay: true,
                            arrows: false
                        });
                    },
                    error: function() {
                        $('#penghargaan-list').html(
                            '<p class="text-center text-danger">Gagal memuat data penghargaan.</p>');
                    }
                });

            }
        });
        $(document).on('submit', 'form.async', function(event) {
            event.preventDefault();
            // Form SKM
            if ($(this).attr('id') == 'formskm') {
                option = {
                    'module': 'skm',
                    'success': {
                        'request': 'thanksskm',
                        'target': 'body-q'
                    }
                }
                sentData('/api/skm', option);
            }
        });
        $(document).on('click', '#btnsearch', function() {
            var status = $('#status').val() ?? 'ALL';
            if ($('#tipe').val() != '') {
                var link = "/" + $('#tipe').val();
                if (($('#textsearch').val() != '') || ($('#tahun').val() != 'ALL')) {
                    link += '?';
                    if ($('#textsearch').val() != '') {
                        link += 's=' + $('#textsearch').val() + '&';
                    }
                    if ($('#tahun').val() != '') {
                        link += 'tahun=' + $('#tahun').val() + '&';
                    }
                    link = link.slice(0, -1);
                    link += '&status=' + status;
                }
                window.location.href = link;
            }

        });
        $(document).on('click', '.slide_link', function() {
            url = $(this).attr('data-url');
            window.open(window.location.origin + '/kegiatan/' + url, '_blank');
        });

        function setDounatChart(el, data, colors) {
            new Morris.Donut({
                element: el,
                data: data,
                labelColor: '#34495E',
                colors: colors,
            });
        }
        $(function() {
            $.get("/api/skm", function(data, status) {
                var sangat_baik = 0;
                var baik = 0;
                var cukup_baik = 0;
                var kurang_baik = 0;
                $.each(data, function(i, v) {
                    if (v.jawab == 'Sangat Baik') {
                        sangat_baik = parseFloat(v.jumlah);
                    }
                    if (v.jawab == 'Baik') {
                        baik = parseFloat(v.jumlah);
                    }
                    if (v.jawab == 'Cukup Baik') {
                        cukup_baik = parseFloat(v.jumlah);
                    }
                    if (v.jawab == 'Kurang Baik') {
                        kurang_baik = parseFloat(v.jumlah);
                    }
                    var data = {
                        series: [sangat_baik, baik, cukup_baik, kurang_baik]
                    };
                    var sum = function(a, b) {
                        return a + b
                    };
                    var options = {
                        // labelInterpolationFnc: function (value) {
                        //     return value[0]
                        // }
                    };
                    var responsiveOptions = [
                        ['screen and (min-width: 640px)', {
                            chartPadding: 30,
                            labelOffset: 100,
                            labelDirection: 'explode',
                            showLabel: true,
                            labelInterpolationFnc: function(value) {
                                return Math.round(value / data.series.reduce(sum) *
                                    100) + '%';
                            }
                        }],
                        ['screen and (min-width: 1024px)', {
                            showLabel: true,
                            labelOffset: 60,
                            chartPadding: 20
                        }]
                    ];
                    new Chartist.Pie('#pie-chart', data, options, responsiveOptions);
                })
            });
            $('.slider-arrow').click(function() {
                if ($(this).hasClass('show')) {
                    $(".slider-arrow, .panel").animate({
                        left: "+=500"
                    }, 700, function() {
                        $(".slider-arrow, .panel, .skm").addClass('opened');
                        // Animation complete.
                    });
                    $(this).html('<i class="fas fa-angle-double-left"></i>').removeClass('show')
                        .addClass(
                            'hide');
                } else {
                    $(".slider-arrow, .panel, .skm").removeClass('opened');
                    $(".slider-arrow, .panel").animate({
                        left: "-=500"
                    }, 700, function() {
                        // Animation complete.
                    });
                    $(this).html('<i class="fas fa-angle-double-right"></i>').removeClass('hide')
                        .addClass(
                            'show');
                }
            });
            if (!Cookies.get('vote')) {
                setTimeout(function() {
                    if (!$(".slider-arrow, .panel").hasClass('opened')) {
                        $('.slider-arrow').click()
                    }
                }, 20000);
            } else {
                $('#body-q').addClass('hasvote');
            }
            setDounatChart('pie-chart-status', [{
                    value: {{ $berlakudantidak->berlaku }},
                    label: "Berlaku"
                },
                {
                    value: {{ $berlakudantidak->tidak_berkalu }},
                    label: "Tidak Berlaku"
                }
            ], [
                '#3498db',
                '#E74C3C'
            ]);
            setDounatChart('pie-chart-pencarian', {!! $palingDicari !!}, [
                '#3498db',
                '#2ecc71',
                '#f39c12',
                '#9b59b6'
            ]);
            setDounatChart('pie-chart-unduhan', {!! $palingDiunduh !!}, [
                '#3498db',
                '#2ecc71',
                '#f39c12',
                '#9b59b6'
            ]);
        });
        (function($) {
            $.fn.clickToggle = function(func1, func2) {
                var funcs = [func1, func2];
                this.data('toggleclicked', 0);
                this.click(function() {
                    var data = $(this).data();
                    var tc = data.toggleclicked;
                    $.proxy(funcs[tc], this)();
                    data.toggleclicked = (tc + 1) % 2;
                });
                return this;
            };
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            };
        }(jQuery));
        $(".intTextBox").inputFilter(function(value) {
            return /^-?d*$/.test(value);
        });
        $(".uintTextBox").inputFilter(function(value) {
            return /^d*$/.test(value);
        });
        $(".intLimitTextBox").inputFilter(function(value) {
            return /^d*$/.test(value) && (value === "" || parseInt(value) <= 500);
        });
        $(".floatTextBox").inputFilter(function(value) {
            return /^-?d*[.,]?d*$/.test(value);
        });
        $(".currencyTextBox").inputFilter(function(value) {
            return /^-?d*[.,]?d{0,2}$/.test(value);
        });
        $(".latinTextBox").inputFilter(function(value) {
            return /^[a-z]*$/i.test(value);
        });
        $(".hexTextBox").inputFilter(function(value) {
            return /^[0-9a-f]*$/i.test(value);
        });
        if ($(window).width() <= 425) {
            document.addEventListener('DOMContentLoaded', function() {
                new Splide('#image-slider', {
                    width: '100vw',
                    type: 'loop',
                    autoplay: true,
                    cover: true,
                    heightRatio: 0.5,
                }).mount();
            });
        } else {
            document.addEventListener('DOMContentLoaded', function() {
                new Splide('#image-slider', {
                    width: '100vw',
                    type: 'loop',
                    autoplay: true,
                    padding: {
                        right: '170px',
                        left: '170px',
                    },
                    cover: true,
                    heightRatio: 0.5,
                }).mount();
            });
        }
        $('#btnadvsearch').clickToggle(function() {
                $('.advancesearch').addClass('open');
                $(this).find('i').attr('class', 'fas fa-angle-double-up ml-2');
            },
            function() {
                $('.advancesearch.open').removeClass('open');
                $(this).find('i').attr('class', 'fas fa-angle-double-down ml-2');
                $('#nomor').val('');
                $('#tipe').val('all').trigger('change');
                $('#tahun').val('all').trigger('change');
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

            // Morris
            var MorrisCharts = function() {};

            //creates Stacked chart
            MorrisCharts.prototype.createStackedChart = function(element, data, xkey, ykeys, labels, lineColors) {
                    Morris.Bar({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        stacked: true,
                        labels: labels,
                        hideHover: 'auto',
                        dataLabels: false,
                        resize: true, //defaulted to true
                        gridLineColor: 'rgba(65, 80, 95, 0.07)',
                        barColors: lineColors
                    });
                },
                MorrisCharts.prototype.init = function() {

                    //creating Stacked chart
                    var $stckedData = [
                        @for ($i = $mintahun; $i <= $maxtahun; $i++)
                            {
                                y: '{{ $i }}',
                                a: '{{ isset($tahunanperda[$i]) ? $tahunanperda[$i] : 0 }}',
                                b: '{{ isset($tahunanperwal[$i]) ? $tahunanperwal[$i] : 0 }}',
                                c: '{{ isset($tahunankepwal[$i]) ? $tahunankepwal[$i] : 0 }}',
                                d: '{{ isset($tahunanpropemperda[$i]) ? $tahunanpropemperda[$i] : 0 }}'
                            },
                        @endfor
                    ];
                    var colors = ['#3498DB', '#2ECC71', '#F39C12', '#9B59B'];
                    var dataColors = $("#morris-bar-stacked").data('colors');
                    if (dataColors) {
                        colors = dataColors.split(",");
                    }
                    this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b', 'c', 'd'], ["Perda",
                        "Perwal", "Kepwal",
                        "Propemperda"
                    ], colors);

                },
                //init
                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts

            var NotificationApp = function() {};
            NotificationApp.prototype.send = function(heading, body, position, loaderBgColor, icon, hideAfter, stack,
                    showHideTransition) {
                    // default
                    if (!hideAfter)
                        hideAfter = 3000;
                    if (!stack)
                        stack = 1;

                    var options = {
                        heading: heading,
                        text: body,
                        position: position,
                        loaderBg: loaderBgColor,
                        icon: icon,
                        hideAfter: hideAfter,
                        stack: stack
                    };

                    if (showHideTransition)
                        options.showHideTransition = showHideTransition;

                    console.log(options);
                    $.toast().reset('all');
                    $.toast(options);
                },

                $.NotificationApp = new NotificationApp, $.NotificationApp.Constructor = NotificationApp
        }(window.jQuery),
        //initializing
        function($) {
            "use strict";
            Waves.init();
            $.Ubold.init();
            $.MorrisCharts.init();
            // HERO SLIDER
            var menu = [];
            $(".swiper-slide").each(function(index) {
                menu.push($(this).find(".slide-inner").attr("data-text"));
            });
            var interleaveOffset = 0.5;
            var swiperOptions = {
                loop: true,
                speed: 1000,
                parallax: true,
                autoplay: {
                    delay: 6500,
                    disableOnInteraction: false
                },
                watchSlidesProgress: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },

                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },

                on: {
                    progress: function() {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            var slideProgress = swiper.slides[i].progress;
                            var innerOffset = swiper.width * interleaveOffset;
                            var innerTranslate = slideProgress * innerOffset;
                            swiper.slides[i].querySelector(".slide-inner").style.transform =
                                "translate3d(" + innerTranslate + "px, 0, 0)";
                        }
                    },

                    touchStart: function() {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            swiper.slides[i].style.transition = "";
                        }
                    },

                    setTransition: function(speed) {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            swiper.slides[i].style.transition = speed + "ms";
                            swiper.slides[i].querySelector(".slide-inner").style.transition =
                                speed + "ms";
                        }
                    }
                }
            };

            var swiper = new Swiper(".swiper-container", swiperOptions);

            // DATA BACKGROUND IMAGE
            var sliderBgSetting = $(".slide-bg-image");
            sliderBgSetting.each(function(indx) {
                if ($(this).attr("data-background")) {
                    $(this).css("background-image", "url(" + $(this).data("background") + ")");
                }
            });

            $(document).on('submit', 'form#konsul', function(event) {
                event.preventDefault();
                var nama = $('form#konsul #nama').val();
                var email = $('form#konsul #email').val();
                var subjek = $('form#konsul #subjek').val();
                var pesan = $('form#konsul #pesan').val();
                var send = '*Nama :* ' + nama + '\n' + '*Email :* ' + email + '\n' + '*Subjek :* ' + subjek +
                    '\n\n' + '*Pesan :*' + '\n' + pesan;
                var nom = '6282155720388';
                var url = 'https://api.whatsapp.com/send/?phone=' + nom + '&text=' + encodeURIComponent(send) +
                    '&app_absent=0'
                window.open(url, '_blank').focus();
            });
        }(window.jQuery);

        $(document).ready(function() {
            // Memuat tema dokumen untuk homepage
            loadTemaDokumenHomepage();

            function loadTemaDokumenHomepage() {
                $.ajax({
                    url: '/api/tema-dokumen',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var temaContainer = $('#tema-dokumen-container');
                        temaContainer.empty();

                        if (response.data && response.data.length > 0) {
                            $.each(response.data, function(index, tema) {
                                if (tema.status) {
                                    var jumlahPeraturan = tema.jumlah_peraturan || 0;
                                    var iconSrc = tema.icon ? tema.icon : '/assets/images/'+tema.slug+'.png';
                                    var temaHtml = `
                                        <a href="/tema-dokumen/${tema.id}"
                                            style="display: flex; width: 120px; text-align: center; font-size: 15px; flex-direction: column; justify-content: center; margin-right: 10px;">
                                            <img src="${iconSrc}" width="110" onerror="this.src='/assets/images/default-tema.png'" />
                                            <span style="color: #292929; font-weight: bold; font-size: 13pt; margin-top: 10px;">${tema.nama}</span>
                                            <small>${jumlahPeraturan} Peraturan</small>
                                        </a>
                                    `;
                                    temaContainer.append(temaHtml);
                                }
                            });
                        } else {
                            temaContainer.html('<p class="text-center">Belum ada tema dokumen yang tersedia</p>');
                        }
                    },
                    error: function(error) {
                        console.error('Error loading tema dokumen:', error);
                        $('#tema-dokumen-container').html('<p class="text-center">Gagal memuat data tema dokumen</p>');
                    }
                });
            }
        });
    </script>
    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
</body>

</html>
