@extends('layouts.public-detail')

@section('title', 'Detail Produk Hukum - JDIH Kota Banjarbaru')
@section('meta_description', 'Detail produk hukum JDIH Kota Banjarbaru')

@section('content')
    @php
        $nomorText = $data->nomor_peraturan ?? $data->nomor ?? '-';
        $tahunText = $data->tahun ?? '-';
        $kategoriText = strtoupper($data->nama_singkat ?? '-');
        $isArtikelLike = in_array((int) ($data->kategori_id ?? 0), [6, 7, 8], true);

        $isCabut = false;
        if (array_key_exists($data->id, $regubahcabut ?? [])) {
            foreach ($regubahcabut[$data->id] as $ucrow) {
                if (($ucrow['jenis'] ?? '') == 'cabut') {
                    $isCabut = true;
                    break;
                }
            }
        }

        $statusLabel = $isCabut ? 'Tidak Berlaku' : 'Berlaku';
        $statusClass = $isCabut ? 'inactive' : 'active';

        $resolveRegulasiFile = function ($filename, $type = 'file') use ($data, $isArtikelLike) {
            if (!$filename) {
                return null;
            }

            $base = trim(explode(';', $filename)[0]);
            if ($base === '') {
                return null;
            }

            $namaSingkat = $data->nama_singkat ?? '';
            $tahun = $data->tahun ?? '';
            if ($type === 'file') {
                if (!$isArtikelLike && $namaSingkat && $tahun) {
                    return '/upload/' . $namaSingkat . '/' . $tahun . '/' . $base;
                }
                return '/upload/artikel/' . $base;
            }

            if ($type === 'abstrak') {
                if (!$isArtikelLike && $namaSingkat && $tahun) {
                    return '/upload/abstrak/' . $namaSingkat . '/' . $tahun . '/' . $base;
                }
                return '/upload/abstrak/artikel/' . $base;
            }

            if ($type === 'lampiran') {
                if (!$isArtikelLike && $namaSingkat && $tahun) {
                    return '/upload/lampiran/' . $namaSingkat . '/' . $tahun . '/' . $base;
                }
                return '/upload/lampiran/artikel/' . $base;
            }

            return '/upload/artikel/' . $base;
        };

        $fileUrl = $resolveRegulasiFile($data->file ?? null, 'file');
        $abstrakUrl = $resolveRegulasiFile($data->abstrak ?? null, 'abstrak');
        $lampiranUrl = $resolveRegulasiFile($data->lampiran ?? null, 'lampiran');

        $rows = [
            ['Tipe Dokumen', $data->tipe_dokumen ?? $data->nama ?? '-'],
            ['Judul', $data->judul ?? '-'],
            ['Nomor', $nomorText],
            ['Tahun', $tahunText],
            ['Jenis/Bentuk Peraturan', $data->jenis_peraturan ?? '-'],
            ['Singkatan Jenis/Bentuk', $data->singkatan_jenis_peraturan ?? '-'],
            ['T.E.U. Badan/Pengarang', $data->teu_badan ?? '-'],
            ['Penandatangan', $data->penandatangan ?? '-'],
            ['Tempat Penetapan', $data->tempat_penetapan ?? '-'],
            ['Tanggal Penetapan', $data->tanggal_penetapan ?? '-'],
            ['Tanggal Pengundangan', $data->tanggal_diundangkan ?? '-'],
            ['Sumber', $data->sumber ?? '-'],
            ['Subjek', $data->subjek ?? '-'],
            ['Bahasa', $data->bahasa ?? '-'],
            ['Lokasi', $data->lokasi ?? '-'],
            ['Bidang Hukum', $data->bidang_hukum ?? '-'],
            ['Status Peraturan', $data->status_peraturan ?? '-'],
            ['Keterangan', $data->keterangan ?? '-'],
        ];

        if ($isArtikelLike) {
            $rows = [
                ['Tipe Dokumen', 'Artikel'],
                ['Judul', $data->judul ?? '-'],
                ['T.E.U. Orang/Badan', $data->teu_badan ?? '-'],
                ['Tempat Terbit', $data->tempat_penetapan ?? $data->tempat ?? '-'],
                ['Tahun', $tahunText],
                ['Sumber', $data->sumber ?? '-'],
                ['Subjek', $data->subjek ?? '-'],
                ['Bahasa', $data->bahasa ?? '-'],
                ['Bidang Hukum', $data->bidang_hukum ?? '-'],
                ['Lokasi', $data->lokasi ?? '-'],
                ['Lampiran', $data->lampiran ?? '-'],
            ];
        }
    @endphp

    <section class="legal-hero">
        <div class="container-fluid">
            <span class="legal-eyebrow">
                <i class="mdi mdi-book-open-page-variant"></i>
                Detail Produk Hukum
            </span>

            <h1 class="legal-title">{{ $data->judul ?? '-' }}</h1>
            <p class="legal-subtitle">{{ $data->nama ?? 'Produk Hukum' }} Nomor {{ $nomorText }} Tahun {{ $tahunText }}</p>

            <div class="legal-chip-wrap">
                <span class="legal-chip">Kategori: {{ $kategoriText }}</span>
                <span class="legal-chip">Nomor: {{ $nomorText }}</span>
                <span class="legal-chip">Tahun: {{ $tahunText }}</span>
            </div>
        </div>
    </section>

    <section class="legal-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="legal-card">
                        <div class="legal-card-header">Status dan Statistik</div>
                        <div class="legal-card-body">
                            <div class="status-badge {{ $statusClass }}">
                                <i class="mdi mdi-shield-check"></i>
                                {{ $statusLabel }}
                            </div>

                            <div class="metric-grid mt-3">
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

                    @if (array_key_exists($data->id, $regubahcabut ?? []) && count($regubahcabut[$data->id]) > 0)
                        <div class="legal-card">
                            <div class="legal-card-header">Relasi Regulasi</div>
                            <div class="legal-card-body">
                                <ul class="relation-list">
                                    @foreach ($regubahcabut[$data->id] as $ucrow)
                                        <li>
                                            {{ ucfirst($ucrow['jenis'] ?? '-') }}:
                                            <a href="{{ $ucrow['url'] ?? '#' }}">{{ $ucrow['nomor'] ?? '-' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($data->cover)
                        <div class="legal-card">
                            <div class="legal-card-header">Sampul Dokumen</div>
                            <div class="legal-card-body">
                                <div class="cover-wrapper">
                                    <img src="{{ url($data->cover) }}" alt="Cover {{ $data->judul }}" loading="lazy" decoding="async">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-8 col-xl-9">
                    <div class="legal-card">
                        <div class="legal-card-header">Informasi Dokumen</div>
                        <div class="legal-card-body">
                            <table class="meta-table">
                                <tbody>
                                    @foreach ($rows as $meta)
                                        <tr>
                                            <th>{{ $meta[0] }}</th>
                                            @if ($isArtikelLike && $meta[0] === 'Lampiran')
                                                <td>
                                                    @if ($lampiranUrl)
                                                        <a class="btn btn-warning btn-sm waves-effect waves-light" href="{{ $lampiranUrl }}" target="_blank">
                                                            <i class="mdi mdi-paperclip mr-1"></i>
                                                            Download Lampiran (PDF)
                                                        </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @else
                                                <td>{{ $meta[1] ?: '-' }}</td>
                                            @endif
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
                                @if ($fileUrl)
                                    <a class="btn btn-outline-info btn-sm waves-effect waves-light"
                                        href="{{ $fileUrl }}" data-pdf-view="1">
                                        <i class="mdi mdi-eye-outline mr-1"></i>
                                        Lihat Berkas
                                    </a>
                                    <a class="btn btn-info btn-sm waves-effect waves-light"
                                        onclick="downloading({{ $data->id }},{{ $data->kategori_id }})"
                                        href="{{ $fileUrl }}" target="_blank" download>
                                        <i class="mdi mdi-cloud-download-outline mr-1"></i>
                                        Download Berkas
                                    </a>
                                @endif

                                @if ($abstrakUrl)
                                    <a class="btn btn-outline-success btn-sm waves-effect waves-light" href="{{ $abstrakUrl }}" data-pdf-view="1">
                                        <i class="mdi mdi-eye-outline mr-1"></i>
                                        Lihat Abstrak
                                    </a>
                                    <a class="btn btn-success btn-sm waves-effect waves-light" href="{{ $abstrakUrl }}" target="_blank" download>
                                        <i class="mdi mdi-file-document-outline mr-1"></i>
                                        Download Abstrak
                                    </a>
                                @endif

                                @if ($lampiranUrl)
                                    <a class="btn btn-outline-warning btn-sm waves-effect waves-light" href="{{ $lampiranUrl }}" data-pdf-view="1">
                                        <i class="mdi mdi-eye-outline mr-1"></i>
                                        Lihat Lampiran
                                    </a>
                                    <a class="btn btn-warning btn-sm waves-effect waves-light" href="{{ $lampiranUrl }}" target="_blank" download>
                                        <i class="mdi mdi-paperclip mr-1"></i>
                                        Download Lampiran
                                    </a>
                                @endif

                                @if (!$fileUrl && !$abstrakUrl && !$lampiranUrl)
                                    <span class="text-muted">Berkas belum tersedia.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
