<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $data->judul ?? 'Detail Putusan' }} - JDIH Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Material Icon -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Custom Css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background-color: #f5f6fa;
            font-family: 'Nunito', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex: 1 0 auto;
        }
        .footer {
            flex-shrink: 0;
        }
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            border: none;
        }
        .card-body {
            padding: 2rem;
        }
        .table th {
            background-color: #6366f1;
            color: white;
            font-weight: 600;
            width: 200px;
        }
    </style>
</head>
<body>
    @include('public.header')

    <section class="section pt-3 pb-3" style="background-color: #def0fb;">
        <div class="container-fluid">
            <h4 class="text-muted">{{ $data->kategori->nama ?? 'Putusan Pengadilan' }}</h4>
            <h2>{{ $data->judul }}</h2>
        </div>
    </section>

    <div class="content-wrapper">
    <section class="section" style="background-color: #f5f6fa;">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-3">{{ $data->judul }}</h3>
                            
                            <!-- Metadata Table -->
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="200">Judul</th>
                                        <td>{{ $data->judul ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>T.E.U. Badan</th>
                                        <td>{{ $data->tingkat_peradilan ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Nomor Putusan</th>
                                        <td>{{ $data->nomor_putusan ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Jenis Peradilan</th>
                                        <td>{{ $data->pengadilan ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Tipe Dokumen</th>
                                        <td>{{ $data->tipe_dokumen ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Tempat Peradilan</th>
                                        <td>{{ $data->tempat_sidang ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Tanggal Dibacakan</th>
                                        <td>{{ $data->tanggal_putusan ? strftime('%d %B %Y', strtotime($data->tanggal_putusan)) : '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Sumber</th>
                                        <td>{{ $data->sumber ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Subjek</th>
                                        <td>{{ $data->subjek ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Status Putusan</th>
                                        <td>{{ $data->status_hukum ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Bahasa</th>
                                        <td>{{ $data->bahasa ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Bidang Hukum/Jenis Perkara</th>
                                        <td>{{ $data->bidang_hukum ?? '-' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>{{ $data->wilayah_yurisdiksi ?? '-' }}</td>
                                    </tr>
                                    
                                    @if($data->para_pihak)
                                        <tr>
                                            <th>Para Pihak</th>
                                            <td>{{ $data->para_pihak }}</td>
                                        </tr>
                                    @endif
                                    
                                    @if($data->majelis_hakim)
                                        <tr>
                                            <th>Majelis Hakim</th>
                                            <td>{{ $data->majelis_hakim }}</td>
                                        </tr>
                                    @endif
                                    
                                    @if($data->amar_putusan)
                                        <tr>
                                            <th>Amar Putusan</th>
                                            <td>{{ $data->amar_putusan }}</td>
                                        </tr>
                                    @endif
                                    
                                    @if($data->ringkasan_putusan)
                                        <tr>
                                            <th>Ringkasan Putusan</th>
                                            <td>{{ $data->ringkasan_putusan }}</td>
                                        </tr>
                                    @endif
                                    
                                    @if($data->dasar_hukum)
                                        <tr>
                                            <th>Dasar Hukum</th>
                                            <td>{{ $data->dasar_hukum }}</td>
                                        </tr>
                                    @endif
                                    
                                    @if($data->pertimbangan_hukum)
                                        <tr>
                                            <th>Pertimbangan Hukum</th>
                                            <td>{{ $data->pertimbangan_hukum }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <!-- Tema Dokumen -->
                            @if($data->temaDokumen && $data->temaDokumen->count() > 0)
                                <div class="mt-3">
                                    <h5>Tema Dokumen</h5>
                                    <div class="mb-3">
                                        @foreach($data->temaDokumen as $tema)
                                            <span class="badge mr-1 mb-1" style="background-color: {{ $tema->warna ?? '#6c757d' }}; color: white;">
                                                {{ $tema->nama }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="mt-3">
                                @if($data->file)
                                    <a href="{{ url($data->file) }}" 
                                       class="btn btn-primary waves-effect waves-light" 
                                       target="_blank"
                                       onclick="incrementDownload({{ $data->id }}, {{ $data->kategori_id }})">
                                        <i class="mdi mdi-download mr-2"></i>Unduh PDF
                                    </a>
                                @endif
                                
                                <a href="{{ $data->kategori_id == 5 ? route('putusan-tu') : route('putusan-negeri') }}" 
                                   class="btn btn-secondary waves-effect waves-light">
                                    <i class="mdi mdi-arrow-left mr-2"></i>Kembali
                                </a>
                            </div>

                            <!-- Statistics -->
                            <div class="mt-3">
                                <small class="text-muted">
                                    <i class="mdi mdi-eye mr-1"></i>Dilihat: {{ $hit ?? 0 }} kali
                                    @if($data->file)
                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                        <i class="mdi mdi-download mr-1"></i>Diunduh: {{ $unduhan ?? 0 }} kali
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

    @include('public.footer')

    <!-- Back to top -->
    <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
    function incrementDownload(id, kategori) {
        if (typeof $ !== 'undefined') {
            $.ajax({
                type: 'POST',
                url: '{{ route('client-download') }}',
                data: {
                    id: id,
                    kategori: kategori,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Download count incremented');
                },
                error: function(xhr, status, error) {
                    console.error('Error incrementing download count:', error);
                }
            });
        }
    }
    </script>
   
</body>
</html>
