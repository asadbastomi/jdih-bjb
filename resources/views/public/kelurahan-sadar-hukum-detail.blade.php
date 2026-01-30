@extends('layouts.app')

@section('title', $title ?? 'Detail Kelurahan Sadar Hukum')

@section('content')
<div class="container-fluid py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kelurahan-sadar-hukum') }}">Kelurahan Sadar Hukum</a></li>
            <li class="breadcrumb-item active">{{ $data->nama_kelurahan }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Kelurahan Information Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-building me-2"></i>
                        {{ $data->nama_kelurahan }}
                    </h4>
                </div>
                <div class="card-body">
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
                                    <td>: {{ count($data->agenda) }}</td>
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
                    <div class="mt-3">
                        <h6>Lokasi di Peta</h6>
                        <div id="detailMap" style="height: 250px; width: 100%; border-radius: 8px;"></div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- SK Walikota Card -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Keputusan Walikota/Bupati Tentang Penetapan Kelurahan Binaan
                    </h5>
                </div>
                <div class="card-body">
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
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Keputusan Gubernur Tentang Penetapan Kelurahan Sadar Hukum
                    </h5>
                </div>
                <div class="card-body">
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
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Agenda Kegiatan
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($data->agenda) > 0)
                        @foreach($data->agenda as $agenda)
                        <div class="card mb-3">
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
                    <p class="text-muted">Belum ada agenda kegiatan</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Info -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0">Informasi Cepat</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status
                            <span class="badge {{ $data->status === 'Sadar Hukum' ? 'bg-success' : 'bg-warning' }}">{{ $data->status }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Agenda
                            <span class="badge bg-primary">{{ count($data->agenda) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Infografis
                            <span class="badge bg-info">{{ count($data->infografis) }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Infografis Gallery -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-images me-2"></i>
                        Infografis
                    </h6>
                </div>
                <div class="card-body">
                    @if(count($data->infografis) > 0)
                        <div class="row g-2">
                            @foreach($data->infografis as $infografis)
                            <div class="col-12 mb-3">
                                <div class="card">
                                    <a href="{{ asset('storage/' . $infografis->file_path) }}" data-lightbox="infografis" data-title="{{ $infografis->judul }}">
                                        <img src="{{ asset('storage/' . $infografis->file_path) }}" 
                                             class="card-img-top" 
                                             alt="{{ $infografis->judul }}"
                                             style="height: 200px; object-fit: cover; cursor: pointer;"
                                             onerror="this.src='{{ asset('assets/images/no-image.png') }}'">
                                    </a>
                                    <div class="card-body p-2">
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
                    <p class="text-muted text-center">Belum ada infografis</p>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('kelurahan-sadar-hukum') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Lightbox2 for image gallery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

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
        html: `<div style="background-color: {{ $data->status === 'Sadar Hukum' ? 'green' : 'orange' }}; width: 30px; height: 30px; border-radius: 50%; border: 4px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });

    L.marker([lat, lng], { icon: markerIcon })
        .addTo(detailMap)
        .bindPopup(`<strong>{{ $data->nama_kelurahan }}</strong><br>{{ $data->nama_kecamatan }}`)
        .openPopup();
});
@endif
</script>

<style>
.custom-marker {
    background: transparent;
}
.card-img-top {
    transition: transform 0.3s;
}
.card-img-top:hover {
    transform: scale(1.05);
}
</style>
@endsection