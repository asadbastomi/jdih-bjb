<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $data->judul ?? 'Detail Monografi Hukum' }} - JDIH Kota Banjarbaru</title>
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
        .page-title-box {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            color: white;
        }
        .page-title {
            color: white;
            margin: 0;
        }
        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.9);
        }
        .breadcrumb-item.active {
            color: white;
        }
    </style>
</head>
<body>
    @include('public.header')

    <section class="section pt-3 pb-3" style="background-color: #def0fb;">
        <div class="container-fluid">
            <h4 class="text-muted">Monografi Hukum</h4>
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
                            <div class="row">
                                <div class="col-md-3">
                                    @if($data->cover)
                                        <img src="{{ url($data->cover) }}" alt="{{ $data->judul }}" class="img-fluid rounded mb-3">
                                    @else
                                        <div class="text-center bg-light p-5 rounded mb-3">
                                            <i class="mdi mdi-book-open-page-variant display-4 text-muted"></i>
                                            <p class="text-muted mt-2">Tidak Ada Cover</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h3 class="mb-3">{{ $data->judul }}</h3>
                                    
                                    <!-- Metadata Table -->
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            @if($data->tipe_dokumen)
                                                <tr>
                                                    <th width="200">Tipe Dokumen</th>
                                                    <td>{{ $data->tipe_dokumen }}</td>
                                                </tr>
                                            @endif

                                            @if($data->kategori)
                                                <tr>
                                                    <th>Kategori</th>
                                                    <td>{{ $data->kategori->nama }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->teu_orang_badan)
                                                <tr>
                                                    <th>T.E.U. Orang/Badan</th>
                                                    <td>{{ $data->teu_orang_badan }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->pengarang)
                                                <tr>
                                                    <th>Pengarang</th>
                                                    <td>{{ $data->pengarang }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->penerbit)
                                                <tr>
                                                    <th>Penerbit</th>
                                                    <td>{{ $data->penerbit }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->tahun_terbit)
                                                <tr>
                                                    <th>Tahun Terbit</th>
                                                    <td>{{ $data->tahun_terbit }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->tempat_terbit)
                                                <tr>
                                                    <th>Tempat Terbit</th>
                                                    <td>{{ $data->tempat_terbit }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->cetakan_edisi)
                                                <tr>
                                                    <th>Cetakan/Edisi</th>
                                                    <td>{{ $data->cetakan_edisi }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->nomor_panggil)
                                                <tr>
                                                    <th>Nomor Panggil</th>
                                                    <td>{{ $data->nomor_panggil }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->deskripsi_fisik)
                                                <tr>
                                                    <th>Deskripsi Fisik</th>
                                                    <td>{{ $data->deskripsi_fisik }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->isbn_issn)
                                                <tr>
                                                    <th>ISBN/ISSN</th>
                                                    <td>{{ $data->isbn_issn }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->bahasa)
                                                <tr>
                                                    <th>Bahasa</th>
                                                    <td>{{ $data->bahasa }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->bidang_hukum)
                                                <tr>
                                                    <th>Bidang Hukum</th>
                                                    <td>{{ $data->bidang_hukum }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->subjek)
                                                <tr>
                                                    <th>Subjek</th>
                                                    <td>{{ $data->subjek }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->nomor_induk_buku)
                                                <tr>
                                                    <th>Nomor Induk Buku</th>
                                                    <td>{{ $data->nomor_induk_buku }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->lokasi)
                                                <tr>
                                                    <th>Lokasi</th>
                                                    <td>{{ $data->lokasi }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->jumlah)
                                                <tr>
                                                    <th>Jumlah Eksemplar</th>
                                                    <td>{{ $data->jumlah }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($data->lampiran)
                                                <tr>
                                                    <th>Lampiran</th>
                                                    <td>{{ $data->lampiran }}</td>
                                                </tr>
                                            @endif

                                            @if($data->keterangan)
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <td>{{ $data->keterangan }}</td>
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
                                               onclick="incrementDownload({{ $data->id }}, {{ $data->kategori_id ?? 9 }})">
                                                <i class="mdi mdi-download mr-2"></i>Unduh PDF
                                            </a>
                                        @endif
                                        
                                        <a href="{{ route('monograf-hukum') }}" class="btn btn-secondary waves-effect waves-light">
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
            </div>
        </div>
    </section>
</div>

    

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
