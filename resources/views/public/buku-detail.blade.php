@extends('layouts.public-detail')

@section('title', ($data->judul ?? 'Detail Monografi Hukum') . ' - JDIH Kota Banjarbaru')
@section('meta_description', 'Detail monografi hukum JDIH Kota Banjarbaru')

@section('content')
    @php
        $rows = [
            ['Tipe Dokumen', $data->tipe_dokumen ?? '-'],
            ['Kategori', optional($data->kategori)->nama ?? '-'],
            ['Judul', $data->judul ?? '-'],
            ['T.E.U. Orang/Badan', $data->teu_orang_badan ?? '-'],
            ['Penerbit', $data->penerbit ?? '-'],
            ['Tahun Terbit', $data->tahun_terbit ?? '-'],
            ['Tempat Terbit', $data->tempat_terbit ?? '-'],
            ['Cetakan/Edisi', $data->cetakan_edisi ?? '-'],
            ['Nomor Panggil', $data->nomor_panggil ?? '-'],
            ['Deskripsi Fisik', $data->deskripsi_fisik ?? '-'],
            ['ISBN/ISSN', $data->isbn_issn ?? '-'],
            ['Bahasa', $data->bahasa ?? '-'],
            ['Bidang Hukum', $data->bidang_hukum ?? '-'],
            ['Subjek', $data->subjek ?? '-'],
            ['Nomor Induk Buku', $data->nomor_induk_buku ?? '-'],
            ['Lokasi', $data->lokasi ?? '-'],
            ['Jumlah Eksemplar', $data->jumlah ?? '-'],
            ['Keterangan', $data->keterangan ?? '-'],
        ];
    @endphp

    <section class="legal-hero">
        <div class="container-fluid">
            <span class="legal-eyebrow">
                <i class="mdi mdi-book-open-page-variant"></i>
                Detail Monografi Hukum
            </span>

            <h1 class="legal-title">{{ $data->judul ?? '-' }}</h1>
            <p class="legal-subtitle">{{ optional($data->kategori)->nama ?? 'Monografi Hukum' }}</p>

            <div class="legal-chip-wrap">
                <span class="legal-chip">Kategori: {{ strtoupper(optional($data->kategori)->nama_singkat ?? 'buku') }}</span>
                <span class="legal-chip">Tahun: {{ $data->tahun_terbit ?? '-' }}</span>
                <span class="legal-chip">Bahasa: {{ $data->bahasa ?? '-' }}</span>
            </div>
        </div>
    </section>

    <section class="legal-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="legal-card">
                        <div class="legal-card-header">Statistik</div>
                        <div class="legal-card-body">
                            <div class="metric-grid">
                                <div class="metric-box">
                                    <span class="metric-label">Dilihat</span>
                                    <span class="metric-value">{{ $hit ?? 0 }}</span>
                                </div>
                                <div class="metric-box">
                                    <span class="metric-label">Diunduh</span>
                                    <span class="metric-value">{{ $unduhan ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($data->cover_url)
                        <div class="legal-card">
                            <div class="legal-card-header">Sampul Buku</div>
                            <div class="legal-card-body">
                                <div class="cover-wrapper">
                                    <img src="{{ $data->cover_url }}" alt="Cover {{ $data->judul }}" loading="lazy" decoding="async">
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($data->temaDokumen && $data->temaDokumen->count() > 0)
                        <div class="legal-card">
                            <div class="legal-card-header">Tema Dokumen</div>
                            <div class="legal-card-body">
                                @foreach ($data->temaDokumen as $tema)
                                    <span class="theme-badge" style="background-color: {{ $tema->warna ?? '#6c757d' }};">
                                        {{ $tema->nama }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-8 col-xl-9">
                    <div class="legal-card">
                        <div class="legal-card-header">Informasi Buku</div>
                        <div class="legal-card-body">
                            <table class="meta-table">
                                <tbody>
                                    @foreach ($rows as $meta)
                                        <tr>
                                            <th>{{ $meta[0] }}</th>
                                            <td>{{ $meta[1] ?: '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="legal-card">
                        <div class="legal-card-header">Unduhan Berkas</div>
                        <div class="legal-card-body">
                            <div class="doc-actions">
                                @if ($data->file_url)
                                    <a href="{{ $data->file_url }}" class="btn btn-outline-primary waves-effect waves-light" data-pdf-view="1">
                                        <i class="mdi mdi-eye-outline mr-1"></i>
                                        Lihat PDF
                                    </a>
                                    <a href="{{ $data->file_url }}" class="btn btn-primary waves-effect waves-light" target="_blank" download onclick="incrementDownload({{ $data->id }}, {{ $data->kategori_id ?? 9 }})">
                                        <i class="mdi mdi-download mr-1"></i>
                                        Unduh PDF
                                    </a>
                                @endif

                                <a href="{{ route('monograf-hukum') }}" class="btn btn-secondary waves-effect waves-light">
                                    <i class="mdi mdi-arrow-left mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-scripts')
    @include('public.partials.legal-detail-download-script')
@endsection
