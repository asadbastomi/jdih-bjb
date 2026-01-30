<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Detail Kelurahan Sadar Hukum' }} - JDIH Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Detail Kelurahan Sadar Hukum dan POSBANKUM di Kota Banjarbaru" name="description" />
    <meta content="Kota Banjarbaru" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />

    <!--Material Icon -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom  Css -->
    <link href="{{ asset('assets/css/landing_copy.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/headline.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    <!-- Lightbox2 for image gallery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
</head>

<body>
    @include('public.header')

    <!-- Page Header -->
    <section class="hero-slider animate-on-scroll fade-in-up" style="height: 40vh; min-height: 300px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="text-center text-white">
                <h1 class="display-4 font-weight-bold mb-3">
                    <i class="fas fa-building me-3"></i>
                    {{ $data->nama_kelurahan }}
                </h1>
                <p class="lead mb-0">
                    Kelurahan Sadar Hukum - {{ $data->nama_kecamatan }}, Kota Banjarbaru
                </p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/kelurahan-sadar-hukum">Kelurahan Sadar Hukum</a></li>
                <li class="breadcrumb-item active">{{ $data->nama_kelurahan }}</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <section class="content-section py-4">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Kelurahan Information Card -->
                    <div class="content-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                Informasi Kelurahan
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Nama Kelurahan</strong></td>
                                            <td>: {{ $data->nama_kelurahan }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kecamatan</strong></td>
                                            <td>: {{ $data->nama_kecamatan }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kota</strong></td>
                                            <td>: {{ $data->kota ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat</strong></td>
                                            <td>: {{ $data->alamat ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status</strong></td>
                                            <td>: <span class="badge {{ $data->status === 'Sadar Hukum' ? 'bg-success' : 'bg-warning' }} fs-6">{{ $data->status }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Latitude</strong></td>
                                            <td>: {{ $data->latitude ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Longitude</strong></td>
                                            <td>: {{ $data->longitude ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Agenda</strong></td>
                                            <td>: {{ count($data->agendas ?? []) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Infografis</strong></td>
                                            <td>: {{ count($data->infografis) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Map Preview -->
                            @if($data->latitude && $data->longitude)
                            <div class="mt-4">
                                <h6 class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>Lokasi di Peta</h6>
                                <div id="detailMap" style="height: 300px; width: 100%; border-radius: 10px;"></div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- SK Walikota Card -->
                    <div class="content-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-file-alt me-2 text-info"></i>
                                Keputusan Walikota/Bupati Tentang Penetapan Kelurahan Binaan
                            </h5>
                            @if($data->sk_walikota_nomor || $data->sk_walikota_tanggal || $data->sk_walikota_detail)
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>SK Walikota / Bupati</strong></td>
                                    <td>: {{ $data->sk_walikota_nomor ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>: {{ $data->sk_walikota_tanggal ? \Carbon\Carbon::parse($data->sk_walikota_tanggal)->translatedFormat('d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Detail</strong></td>
                                    <td>{!! $data->sk_walikota_detail ?? '-' !!}</td>
                                </tr>
                            </table>
                            @else
                            <p class="text-muted">Data SK Walikota/Bupati belum tersedia</p>
                            @endif
                        </div>
                    </div>

                    <!-- SK Gubernur Card -->
                    <div class="content-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-file-alt me-2 text-success"></i>
                                Keputusan Gubernur Tentang Penetapan Kelurahan Sadar Hukum
                            </h5>
                            @if($data->sk_gubernur_nomor || $data->sk_gubernur_tanggal || $data->sk_gubernur_detail)
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>SK Gubernur</strong></td>
                                    <td>: {{ $data->sk_gubernur_nomor ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>: {{ $data->sk_gubernur_tanggal ? \Carbon\Carbon::parse($data->sk_gubernur_tanggal)->translatedFormat('d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Detail</strong></td>
                                    <td>{!! $data->sk_gubernur_detail ?? '-' !!}</td>
                                </tr>
                            </table>
                            @else
                            <p class="text-muted">Data SK Gubernur belum tersedia</p>
                            @endif
                        </div>
                    </div>

                    <!-- Agenda Card -->
                    <div class="content-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-calendar-alt me-2 text-warning"></i>
                                Agenda Kegiatan
                            </h5>
                            @if(count($data->agendas ?? []) > 0)
                                @foreach($data->agendas ?? [] as $agenda)
                                <div class="card mb-3 border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-calendar-day me-2 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('l, d F Y') }}
                                        </h6>
                                        <p class="card-text mt-2">{{ $agenda->judul }}</p>
                                        @if($agenda->deskripsi)
                                        <p class="card-text text-muted small">{{ $agenda->deskripsi }}</p>
                                        @endif
                                        @if($agenda->lokasi)
                                        <p class="card-text small">
                                            <i class="fas fa-map-marker-alt me-1"></i> {{ $agenda->lokasi }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <p class="text-muted text-center py-4">Belum ada agenda kegiatan</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Quick Info -->
                    <div class="content-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Informasi Cepat</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    Status
                                    <span class="badge {{ $data->status === 'Sadar Hukum' ? 'bg-success' : 'bg-warning' }}">{{ $data->status }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    Total Agenda
                                    <span class="badge bg-primary">{{ count($data->agendas ?? []) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    Total Infografis
                                    <span class="badge bg-info">{{ count($data->infografis) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Infografis Gallery -->
                    <div class="content-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="fas fa-images me-2"></i>
                                Infografis
                            </h6>
                            @if(count($data->infografis) > 0)
                                <div class="row g-2">
                                    @foreach($data->infografis as $infografis)
                                    <div class="col-12 mb-3">
                                        <div class="card border-0 shadow-sm">
                                            <a href="{{ asset('storage/' . $infografis->file_path) }}" data-lightbox="infografis" data-title="{{ $infografis->judul }}">
                                                <img src="{{ asset('storage/' . $infografis->file_path) }}" 
                                                     class="card-img-top rounded" 
                                                     alt="{{ $infografis->judul }}"
                                                     style="height: 200px; object-fit: cover; cursor: pointer;"
                                                     onerror="this.src='{{ asset('assets/images/no-image.png') }}'">
                                            </a>
                                            <div class="card-body p-3">
                                                <h6 class="card-text small mb-1">{{ $infografis->judul }}</h6>
                                                @if($infografis->deskripsi)
                                                <p class="card-text text-muted small mb-0">{{ Str::limit($infografis->deskripsi, 100) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                            <p class="text-muted text-center py-4">Belum ada infografis</p>
                            @endif
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="content-card">
                        <div class="card-body">
                            <a href="/kelurahan-sadar-hukum" class="btn btn-outline-primary w-100">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('public.footer')

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Lightbox2 for image gallery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <!-- javascript -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/pact.js') }}"></script>

    <script>
    @if($data->latitude && $data->longitude)
    // Initialize detail map
    document.addEventListener('DOMContentLoaded', function() {
        const lat = {{ $data->latitude }};
        const lng = {{ $data->longitude }};
        
        const detailMap = L.map('detailMap').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(detailMap);

        const markerIcon = L.divIcon({
            className: 'custom-marker',
            html: `<div style="background-color: {{ $data->status === 'Sadar Hukum' ? 'green' : 'orange' }}; width: 30px; height: 30px; border-radius: 50%; border: 4px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><i style="color: white; font-size: 16px;" class="mdi mdi-home"></i></div>`,
            iconSize: [30, 30],
            iconAnchor: [15, 15],
            popupAnchor: [0, -15]
        });

        L.marker([lat, lng], { icon: markerIcon })
            .addTo(detailMap)
            .bindPopup(`<strong>{{ $data->nama_kelurahan }}</strong><br>{{ $data->nama_kecamatan }}`)
            .openPopup();
    });
    @endif
    </script>
</body>

</html>