@extends('layouts.public-detail')

@section('title', ($data->judul ?? 'Detail Putusan') . ' - JDIH Kota Banjarbaru')
@section('meta_description', 'Detail putusan pengadilan JDIH Kota Banjarbaru')

@section('content')
    @php
        $jenisPerkara = $data->kategori->nama ?? 'Putusan Pengadilan';
        $nomorPutusan = $data->nomor_putusan ?? '-';
        $tahunPutusan = $data->tahun ?? '-';

        $rows = [
            ['Judul', $data->judul ?? '-'],
            ['Nomor Putusan', $nomorPutusan],
            ['Jenis Peradilan', $data->pengadilan ?? '-'],
            ['Tingkat Peradilan', $data->tingkat_peradilan ?? '-'],
            ['Singkatan Jenis Peradilan', $data->singkatan_jenis_peradilan ?? '-'],
            ['Tipe Dokumen', $data->tipe_dokumen ?? '-'],
            ['Tempat Peradilan', $data->tempat_sidang ?? '-'],
            ['Tanggal Dibacakan', $data->tanggal_putusan ? strftime('%d %B %Y', strtotime($data->tanggal_putusan)) : '-'],
            ['Sumber', $data->sumber ?? '-'],
            ['Subjek', $data->subjek ?? '-'],
            ['Bahasa', $data->bahasa ?? '-'],
            ['Bidang Hukum/Jenis Perkara', $data->bidang_hukum ?? '-'],
            ['Para Pihak', $data->para_pihak ?? '-'],
            ['Majelis Hakim', $data->majelis_hakim ?? '-'],
            ['Amar Putusan', $data->amar_putusan ?? '-'],
            ['Ringkasan Putusan', $data->ringkasan_putusan ?? '-'],
            ['Dasar Hukum', $data->dasar_hukum ?? '-'],
            ['Pertimbangan Hukum', $data->pertimbangan_hukum ?? '-'],
        ];
    @endphp

    <section class="legal-hero">
        <div class="container-fluid">
            <span class="legal-eyebrow">
                <i class="mdi mdi-scale-balance"></i>
                Detail Putusan
            </span>

            <h1 class="legal-title">{{ $data->judul ?? '-' }}</h1>
            <p class="legal-subtitle">{{ $jenisPerkara }} • Nomor {{ $nomorPutusan }}</p>

            <div class="legal-chip-wrap">
                <span class="legal-chip">Kategori: {{ strtoupper($data->kategori->nama_singkat ?? 'putusan') }}</span>
                <span class="legal-chip">Nomor: {{ $nomorPutusan }}</span>
                <span class="legal-chip">Tahun: {{ $tahunPutusan }}</span>
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
                        <div class="legal-card-header">Informasi Putusan</div>
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
                                @if ($data->file)
                                    <a href="{{ url($data->file) }}" class="btn btn-outline-primary waves-effect waves-light" data-pdf-view="1">
                                        <i class="mdi mdi-eye-outline mr-1"></i>
                                        Lihat PDF
                                    </a>
                                    <a href="{{ url($data->file) }}" class="btn btn-primary waves-effect waves-light" target="_blank" download onclick="incrementDownload({{ $data->id }}, {{ $data->kategori_id }})">
                                        <i class="mdi mdi-download mr-1"></i>
                                        Unduh PDF
                                    </a>
                                @endif

                                @if ($data->lampiran)
                                    <a href="{{ url($data->lampiran) }}" class="btn btn-outline-warning waves-effect waves-light" data-pdf-view="1">
                                        <i class="mdi mdi-eye-outline mr-1"></i>
                                        Lihat Lampiran
                                    </a>
                                    <a href="{{ url($data->lampiran) }}" class="btn btn-warning waves-effect waves-light" target="_blank" download onclick="incrementDownload({{ $data->id }}, {{ $data->kategori_id }})">
                                        <i class="mdi mdi-paperclip mr-1"></i>
                                        Unduh Lampiran
                                    </a>
                                @endif

                                <a href="{{ $data->kategori_id == 5 ? route('putusan-tu') : route('putusan-negeri') }}" class="btn btn-secondary waves-effect waves-light">
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
