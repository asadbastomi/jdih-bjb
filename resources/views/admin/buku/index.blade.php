@extends('layouts.detached', ['title' => 'Monografi Hukum'])

@section('css')
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Monografi Hukum</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Monografi Hukum</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box pb-2 position-relative">
                    <h4 class="header-title mb-3">Data</h4>

                    <div id="index-content">
                        <div class="clearfix">
                            <div class="text-sm-center form-inline float-left">
                                <div class="form-group mr-2">
                                    <button id="btnadddata" class="btn btn-primary waves-effect">
                                        <i class="mdi mdi-plus-circle mr-2"></i> Add New Data
                                    </button>
                                </div>
                                <div class="form-group">
                                    <input id="search-data" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="text-sm-center float-right">
                                <div class="form-group float-right">
                                    <button id="btnreloaddata" class="btn btn-white waves-effect">
                                        <i class="mdi mdi-reload"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" id="table-data">
                            {{-- Data --}}
                        </div> <!-- end .table-responsive-->
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
    </div> <!-- container -->

    <div id="modalform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form id="formbuku" class="async" >
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tipe Dokumen <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control send" id="tipe_dokumen" placeholder="Contoh: Monografi Hukum" value="Monografi Hukum" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Judul <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control send" id="judul" placeholder="Judul buku" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control select2 send" id="kategori_id" name="kategori_id" data-toggle="select2" data-placeholder="Pilih kategori..." required>
                                        @foreach($monograf_kategori as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">T.E.U. Orang/Badan</label>
                                    <input type="text" class="form-control send" id="teu_orang_badan" placeholder="Contoh: Bratakusumah, Deddy Supriadi">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nomor Panggil</label>
                                    <input type="text" class="form-control send" id="nomor_panggil" placeholder="Contoh: 342.25 BRA o">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Cetakan/Edisi</label>
                                    <input type="text" class="form-control send" id="cetakan_edisi" placeholder="Contoh: Cet. 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tempat Terbit</label>
                                    <input type="text" class="form-control send" id="tempat_terbit" placeholder="Contoh: Jakarta">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Pengarang</label>
                                    <input type="text" class="form-control send" id="pengarang" placeholder="Contoh: Bratakusumah, Deddy Supriadi">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Penerbit</label>
                                    <input type="text" class="form-control send" id="penerbit" placeholder="Contoh: Gramedia Pustaka Utama">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tahun Terbit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control send" id="tahun_terbit" placeholder="Contoh: 2022" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi Fisik</label>
                                    <input type="text" class="form-control send" id="deskripsi_fisik" placeholder="Contoh: xvi, 404 hlm.; 21 cm.">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Jumlah Eksemplar</label>
                                    <input type="number" class="form-control send" id="jumlah" placeholder="Jumlah buku tersedia" min="0">
                                    <small class="form-text text-muted">Akan disimpan dalam field jumlah</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Subjek</label>
                                    <input type="text" class="form-control send" id="subjek" placeholder="Contoh: OTONOMI DAERAH">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">ISBN/ISSN</label>
                                    <input type="text" class="form-control send" id="isbn_issn" placeholder="Nomor ISBN">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Bahasa</label>
                                    <input type="text" class="form-control send" id="bahasa" placeholder="Contoh: Indonesia">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Bidang Hukum</label>
                                    <input type="text" class="form-control send" id="bidang_hukum" placeholder="Contoh: Hukum Tata Negara">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nomor Induk Buku</label>
                                    <input type="text" class="form-control send" id="nomor_induk_buku" placeholder="Contoh: 2487">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Lokasi</label>
                                    <input type="text" class="form-control send" id="lokasi" placeholder="Contoh: BPHN">
                                </div>
                            </div>
                        </div>

                        <!-- Tambahan Tema Dokumen -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tema Dokumen <small>(pilih satu atau lebih)</small></label>
                                    <select class="form-control select2-multiple send" name="tema_dokumen[]" id="tema_dokumen" data-toggle="select2" multiple="multiple" data-placeholder="Pilih Tema...">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End Tambahan Tema Dokumen -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <textarea class="form-control send" id="keterangan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">Cover Buku</label>
                                    <input type="file" class="dropify form-control send" id="cover" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">File Fulltext</label>
                                    <input type="file" class="dropify form-control send" id="file" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light" dir="ltr" data-style="zoom-in" id="btnbuku"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/footable/footable.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
    <script>
    var textserach = '';
    $(function($){
        loadTable('{{ route($fetch) }}', textserach);

        // Inisialisasi select2 untuk kategori
        $('#kategori_id').select2({
            width: '100%',
            placeholder: 'Pilih Kategori...',
            allowClear: true
        });

        // Tahun picker
        $("#tahun_terbit").datepicker({
            todayHighlight: true,
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        // Inisialisasi Dropify saat modal dibuka
        $('#modalform').on('shown.bs.modal', function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop file disini atau klik',
                    'replace': 'Drag and drop atau klik untuk mengganti',
                    'remove': 'Hapus',
                    'error': 'Oops, terjadi kesalahan.'
                }
            });
        });

        // Event handler untuk tombol tambah data
        $(document).on('click', '#btnadddata', function(event) {
            event.preventDefault();
            $('#modalform .modal-title').text('Tambah Monografi Hukum');
            $("#modalform").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        // Event handler untuk tombol reload
        $(document).on('click', '#btnreloaddata', function(event) {
            event.preventDefault();
            clearSearch();
            loadTable('{{ route($fetch) }}', textserach);
        });

        // Event handler untuk form submission
        $(document).on('submit','form.async',function(){
            event.preventDefault();
            // Form Buku
            if ($(this).attr('id')=='{{ $form }}') {
                isnew = isNew('{{ $form }}');
                if (isnew.status) {
                    option = {
                        'module' : '{{ $module }}',
                        'success' : {
                            'request' : 'addtotable',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route($fetch) }}',
                            'after' : 300
                        }
                    }

                    // Mendapatkan nilai tema dokumen yang dipilih
                    var selectedTemas = $('#tema_dokumen').val();
                    var formdata = makeForm('{{ $form }}', 'post');
                    
                    // Tambahkan tema dokumen ke form data jika ada
                    if (selectedTemas && selectedTemas.length > 0) {
                        $.each(selectedTemas, function(index, temaId) {
                            formdata.append('tema_dokumen[]', temaId);
                        });
                    }

                    $.ajax({
                        type: 'post',
                        url: '{{ route($store) }}',
                        data: formdata,
                        dataType: 'json',
                        async: true,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            notifyMe('Success', response.message, 'success', 10000);
                            btnLoadingStop('{{ $button }}');
                            clearSearch();
                            $('#modalform').modal('hide');
                            loadTable('{{ route($fetch) }}', null, 'first', {'stat':'addfirst', 'table':'table-main'});
                        },
                        error: function(response) {
                            if (response.responseJSON && response.responseJSON.message == 'Validation Error') {
                                $.each(response.responseJSON.data, function(key, data){
                                    notifyMe(key, data, 'error');
                                });
                            } else {
                                notifyMe('Error', 'Gagal menyimpan data', 'error');
                            }
                            btnLoadingStop('{{ $button }}');
                        }
                    });
                } else {
                    option = {
                        'module' : '{{ $module }}',
                        'method' : 'put',
                        'success' : {
                            'request' : 'updatetable',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route($fetch) }}',
                            'after' : 300
                        }
                    }

                    // Mendapatkan nilai tema dokumen yang dipilih
                    var selectedTemas = $('#tema_dokumen').val();
                    var regulasiId = $('#{{ $form }} input.id').val();

                    if (!regulasiId) {
                        notifyMe('Error', 'ID regulasi tidak ditemukan', 'error');
                        btnLoadingStop('{{ $button }}');
                        return;
                    }

                    // Buat form data termasuk tema_dokumen
                    var formData = makeForm('{{ $form }}', 'put');
                    formData.append('_method', 'PUT');

                    // Tambahkan tema dokumen ke form data
                    if (selectedTemas && selectedTemas.length > 0) {
                        $.each(selectedTemas, function(index, temaId) {
                            formData.append('tema_dokumen[]', temaId);
                        });
                    }

                    // Kirim data ke server
                    $.ajax({
                        type: 'post',
                        url: '{{ url('api') }}/{{ $module }}/' + regulasiId,
                        data: formData,
                        dataType: 'json',
                        async: true,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            notifyMe('Success', response.message, 'success', 10000);
                            btnLoadingStop('{{ $button }}');
                            clearSearch();
                            $('#modalform').modal('hide');
                            loadTable('{{ route($fetch) }}', null, 'first', {'stat':'update', 'id':response.data.id, 'table':'table-main'});
                        },
                        error: function(response) {
                            if (response.responseJSON && response.responseJSON.message == 'Validation Error') {
                                $.each(response.responseJSON.data, function(key, data){
                                    notifyMe(key, data, 'error');
                                });
                            } else {
                                notifyMe('Error', 'Gagal menyimpan data', 'error');
                            }
                            btnLoadingStop('{{ $button }}');
                        }
                    });
                }
            }
        });

        // Event handler untuk edit data
        $(document).on('click', '.btneditdata', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            $('#modalform .modal-title').text('Edit Monografi Hukum');
            
            // Ambil data buku untuk edit
            $.ajax({
                type: 'get',
                url: '{{ url('api') }}/{{ $module }}/'+rowid+'/edit',
                dataType: 'json',
                async: true,
                success: function(response) {
                    // Setup handler untuk menampilkan cover setelah modal dibuka
                    $('#modalform').one('shown.bs.modal', function() {
                        var drEvent = $('.dropify').data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        
                        // Jika ada cover, tampilkan di dropify
                        if (response.data.cover) {
                            var coverPath = response.data.cover;
                            setTimeout(function() {
                                drEvent.settings.defaultFile = coverPath;
                                drEvent.destroy();
                                drEvent.init();
                            }, 300);
                        }

                        // Jika ada file, tampilkan di dropify
                        if (response.data.file) {
                            var filePath = response.data.file;
                            setTimeout(function() {
                                var fileDropify = $('#file').data('dropify');
                                fileDropify.settings.defaultFile = filePath;
                                fileDropify.destroy();
                                fileDropify.init();
                            }, 300);
                        }
                    });

                    // Isi form dengan data
                            option = {
                                'success' : {
                                    'request' : 'appliedtoform',
                                    'modal' : 'modalform',
                                    'form' : '{{ $form }}',
                                    'field' : [
                                        'tipe_dokumen', 'judul', 'penerbit', 'tahun_terbit', 'keterangan', 'cetakan_edisi', 'jumlah', 'teu_orang_badan',
                                        'nomor_panggil', 'cetakan_edisi', 'tempat_terbit', 'deskripsi_fisik',
                                        'pengarang', 'subjek', 'isbn_issn', 'bahasa', 'bidang_hukum', 'nomor_induk_buku',
                                        'lokasi', 'kategori_id'
                                    ]
                                }
                            }
                    getData('{{ url('api') }}/{{ $module }}/'+rowid+'/edit', option);

                    // Set kategori yang dipilih setelah form diisi
                    setTimeout(function() {
                        if (response.data.kategori_id) {
                            $('#kategori_id').val(response.data.kategori_id).trigger('change');
                        }
                    }, 100);

                    // Terapkan tema dokumen yang dipilih
                    if (response.data.tema_dokumen && response.data.tema_dokumen.length > 0) {
                        var selectedTemas = response.data.tema_dokumen.map(function(tema) {
                            return tema.id.toString();
                        });
                        $('#tema_dokumen').val(selectedTemas).trigger('change');
                    }
                }
            });
        });

        // Event handler untuk delete data
        $(document).on('click', '.btndeletedata', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            Swal.fire({
                title: 'Anda yakin?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f1556c',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.value) {
                    option = {
                        'method' : 'delete',
                        'success' : {
                            'request' : 'removefromtable',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route($fetch) }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ url('api') }}/{{ $module }}/'+rowid, option);
                }
            });
        });

        // Event handler untuk pagination
        $(document).on('click', '.page-link', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadTable('{{ route($fetch) }}', textserach, page);
        });

        // Event handler untuk pencarian
        $(document).on('keyup', '#search-data', delay(function (event) {
            var search = true;
            if (textserach==this.value) {
                search = false;
            }
            textserach = this.value;
            if (search) {
                loadTable('{{ route($fetch) }}', textserach);
            }
        }, 500));

        // Inisialisasi select2 untuk tema dokumen
        $('#tema_dokumen').select2({
            templateResult: formatTema,
            templateSelection: formatTema,
            width: '100%',
            placeholder: 'Pilih Tema...',
            allowClear: true
        });

        // Memuat tema dokumen saat halaman dimuat
        loadTemaDokumen();

        // Fungsi untuk memuat tema dokumen
        function loadTemaDokumen() {
            $.ajax({
                url: '/api/tema-dokumen',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '';
                    $.each(response.data, function(index, tema) {
                        if (tema.status) {
                            options += '<option value="' + tema.id + '" data-color="' + tema.warna + '">' + tema.nama + '</option>';
                        }
                    });
                    $('#tema_dokumen').html(options);

                    // Reinisialisasi select2 setelah memuat tema
                    $('#tema_dokumen').select2({
                        templateResult: formatTema,
                        templateSelection: formatTema,
                        width: '100%',
                        placeholder: 'Pilih Tema...',
                        allowClear: true
                    });
                },
                error: function(error) {
                    console.error('Error loading tema:', error);
                }
            });
        }

        // Fungsi untuk memformat tampilan tema
        function formatTema(tema) {
            if (!tema.id) {
                return tema.text;
            }

            var $tema = $(
                '<span><i class="mdi mdi-checkbox-blank-circle mr-1" style="color:' + $(tema.element).data('color') + '"></i> ' + tema.text + '</span>'
            );

            return $tema;
        }

        // Reset select2 ketika menutup modal
        $('#modalform').on('hidden.bs.modal', function (e) {
            // Reset form
            var formname = $(this).find('form').attr('id');
            $(this).find('input.additional').remove();
            fieldClear(formname);
            fieldIndcator('clear', formname);
            
            // Reset tema dokumen select2
            $('#tema_dokumen').val(null).trigger('change');
        });
    });
    </script>
@endsection
