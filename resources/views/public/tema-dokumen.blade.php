<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Tema Dokumen - JDIH Kota Banjarbaru' }}</title>
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

    <!-- Page Title -->
    <section class="section pt-3 pb-3 " style="background-color: #def0fb;">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img src="{{ isset($tema) && $tema->icon ? asset($tema->icon) : asset('assets/images/default-tema.png') }}"
                    onerror="this.src='{{ asset('assets/images/default-tema.png') }}'"
                    alt="{{ isset($tema) ? $tema->nama : 'Tema Dokumen' }}"
                    width="80"
                    class="mr-3">
                <div>
                    <h2 class="mb-0">{{ isset($tema) ? $tema->nama : 'Tema Dokumen' }}</h2>
                    <p class="text-muted mb-0">{{ isset($tema) ? $tema->deskripsi : 'Dokumen hukum berdasarkan tema' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Regulasi List -->
    <section class="section bg-gradient" id="features">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Regulasi Berdasarkan Tema: {{ isset($tema) ? $tema->nama : 'Tema Dokumen' }}</h4>
                        </div>
                        <div class="card-body">
                            @if(isset($regulasi) && $regulasi->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="15%">Jenis</th>
                                                <th width="15%">Nomor</th>
                                                <th width="15%">Tahun</th>
                                                <th>Judul</th>
                                                <th width="10%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($regulasi as $key => $reg)
                                                <tr>
                                                    <td>{{ $regulasi->firstItem() + $key }}</td>
                                                    <td>{{ $reg->kategori->nama ?? 'N/A' }}</td>
                                                    <td>{{ $reg->nomor ?? 'N/A' }}</td>
                                                    <td>{{ $reg->tahun ?? 'N/A' }}</td>
                                                    <td>
                                                        @if(isset($reg->kategori) && $reg->kategori->nama_singkat)
                                                            <a href="{{ url('/produk-hukum/' . $reg->kategori->nama_singkat . '/' . $reg->id . '/' . Str::slug($reg->judul)) }}" class="text-primary">
                                                                {{ $reg->judul }}
                                                            </a>
                                                        @else
                                                            {{ $reg->judul ?? 'Tanpa Judul' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($reg->ubahCabut) && count($reg->ubahCabut) > 0)
                                                            <span class="badge badge-danger">Tidak Berlaku</span>
                                                        @else
                                                            <span class="badge badge-success">Berlaku</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $regulasi->links() }}
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <p class="mb-0">Tidak ada regulasi yang terkait dengan tema ini.</p>
                                    <p class="mb-0 mt-2">Silahkan kembali ke <a href="{{ url('/') }}" class="font-weight-bold">halaman utama</a> untuk mencari tema lainnya.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('public.footer')

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspy.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.toast.js') }}"></script>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
