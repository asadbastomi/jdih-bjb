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
                @if(isset($tema) && $tema->icon)
                    @if(strpos($tema->icon, '.') !== false)
                        <img src="{{ asset('storage/' . $tema->icon) }}"
                             alt="{{ $tema->nama }}"
                             style="width: 80px; height: 80px; object-fit: contain; margin-right: 1rem;">
                    @else
                        <i class="mdi {{ $tema->icon }} fs-1 mr-3" style="color: {{ $tema->warna ?? '#0acf97' }}; font-size: 80px;"></i>
                    @endif
                @else
                    <i class="mdi mdi-tag-outline fs-1 mr-3" style="color: #0acf97; font-size: 80px;"></i>
                @endif
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
                            <!-- Search and Filter -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="search">Cari</label>
                                        <input type="text" id="search" class="form-control" placeholder="Cari judul atau nomor peraturan...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-kategori">Kategori</label>
                                        <select id="filter-kategori" class="form-control">
                                            <option value="">Semua Kategori</option>
                                            @if(isset($kategoriList))
                                                @foreach($kategoriList as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-tahun">Tahun</label>
                                        <select id="filter-tahun" class="form-control">
                                            <option value="">Semua Tahun</option>
                                            @if(isset($tahunList))
                                                @foreach($tahunList as $tahun)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button id="btn-filter" class="btn btn-primary btn-block">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @if(isset($regulasi) && $regulasi->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-regulasi">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="10%">Kategori</th>
                                                <th width="12%">No Peraturan</th>
                                                <th width="8%">Tahun</th>
                                                <th>Judul</th>
                                                <th width="12%">Pemrakarsa</th>
                                                <th width="8%">Status</th>
                                                <th width="7%">Dilihat</th>
                                                <th width="7%">Diunduh</th>
                                                <th width="8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($regulasi as $key => $reg)
                                                @php
                                                    $nomor = $reg->nomor_peraturan ?? $reg->nomor ?? 'N/A';
                                                    $tahun = $reg->tahun_peraturan ?? $reg->tahun ?? 'N/A';
                                                    $rowNumber = method_exists($regulasi, 'firstItem') ? ((int)$regulasi->firstItem() + (int)$key) : ((int)$key + 1);
                                                @endphp
                                                <tr>
                                                    <td>{{ $rowNumber }}</td>
                                                    <td data-kategori-id="{{ $reg->kategori->id ?? '' }}">{{ $reg->kategori->nama ?? 'N/A' }}</td>
                                                    <td>{{ $nomor }}</td>
                                                    <td data-tahun="{{ $tahun }}">{{ $tahun }}</td>
                                                    <td>
                                                        @if(isset($reg->kategori) && $reg->kategori->nama_singkat)
                                                            <a href="{{ url('/produk-hukum/' . $reg->kategori->nama_singkat . '/' . $reg->id . '/' . Str::slug($reg->judul)) }}" class="text-primary">
                                                                {{ $reg->judul }}
                                                            </a>
                                                        @else
                                                            {{ $reg->judul ?? 'Tanpa Judul' }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $reg->instansi_pemrakarsa ?? $reg->teu_badan ?? 'N/A' }}</td>
                                                    <td>
                                                        @if(isset($reg->ubahCabut) && count($reg->ubahCabut) > 0)
                                                            <span class="badge badge-danger">Tidak Berlaku</span>
                                                        @else
                                                            <span class="badge badge-success">Berlaku</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $hit = optional($reg->popularItem)->hit ?? 0;
                                                        @endphp
                                                        <span class="badge badge-info">{{ $hit }}</span>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $downloaded = optional($reg->popularItem)->downloaded ?? 0;
                                                        @endphp
                                                        <span class="badge badge-warning">{{ $downloaded }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/produk-hukum/' . ($reg->kategori->nama_singkat ?? '') . '/' . $reg->id . '/' . Str::slug($reg->judul ?? '')) }}" 
                                                           class="btn btn-sm btn-primary" 
                                                           title="Lihat Detail">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @if($reg->file)
                                                        <a href="{{ asset('upload/' . ($reg->kategori->nama_singkat ?? '') . '/' . $tahun . '/' . $reg->file) }}" 
                                                           class="btn btn-sm btn-success" 
                                                           download
                                                           title="Unduh Dokumen">
                                                            <i class="mdi mdi-download"></i>
                                                        </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4" id="pagination-container">
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

    <script>
        $(document).ready(function() {
            // Debounce function
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Filter function
            function filterData() {
                const search = $('#search').val().toLowerCase();
                const kategori = $('#filter-kategori').val();
                const tahun = $('#filter-tahun').val();

                $('#table-regulasi tbody tr').each(function() {
                    const row = $(this);
                    const judul = row.find('td:nth-child(5)').text().toLowerCase();
                    const nomor = row.find('td:nth-child(3)').text().toLowerCase();
                    const rowKategori = row.find('td:nth-child(2)').text().trim();
                    const rowTahun = row.find('td:nth-child(4)').text().trim();
                    const kategoriId = row.find('td:nth-child(2)').attr('data-kategori-id') || '';
                    const tahunText = row.find('td:nth-child(4)').attr('data-tahun') || '';

                    const matchesSearch = judul.includes(search) || nomor.includes(search);
                    const matchesKategori = kategori === '' || kategoriId === kategori;
                    const matchesTahun = tahun === '' || tahunText === tahun;

                    if (matchesSearch && matchesKategori && matchesTahun) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });

                // Update empty row display
                const visibleRows = $('#table-regulasi tbody tr:visible').length;
                const emptyRow = $('#table-regulasi tbody tr.empty');
                if (visibleRows === 0 && emptyRow.length === 0) {
                    $('#table-regulasi tbody').append('<tr class="empty"><td colspan="10" class="text-center py-4">Tidak ada data yang sesuai dengan filter</td></tr>');
                } else if (visibleRows > 0 && emptyRow.length > 0) {
                    emptyRow.hide();
                }

                // Hide pagination if filtering
                if (search || kategori || tahun) {
                    $('#pagination-container').hide();
                } else {
                    $('#pagination-container').show();
                }
            }

            // Apply filter on button click
            $('#btn-filter').on('click', function() {
                filterData();
            });

            // Apply filter on search input with debounce
            $('#search').on('input', debounce(function() {
                filterData();
            }, 300));

            // Apply filter on category change
            $('#filter-kategori').on('change', function() {
                filterData();
            });

            // Apply filter on year change
            $('#filter-tahun').on('change', function() {
                filterData();
            });

            // Reset filters
            $('#btn-reset').on('click', function() {
                $('#search').val('');
                $('#filter-kategori').val('');
                $('#filter-tahun').val('');
                filterData();
            });
        });
    </script>
</body>

</html>
