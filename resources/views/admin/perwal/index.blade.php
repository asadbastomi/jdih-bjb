@extends('layouts.detached', ['title' => $title])

@section('css')
    <link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$title}}</h4>
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
                <form id="{{$form}}" class="async" >
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nomor</label>
                                    <input type="text" class="form-control send" id="nomor" placeholder="contoh: 5" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Tahun</label>
                                    <input type="text" class="form-control send" id="tahun" placeholder="contoh: 2023" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tempat Penetapan</label>
                                    <input type="text" class="form-control send" id="tempat" placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Penetapan</label>
                                    <input type="text" class="form-control send" id="tanggal_penetapan" placeholder="Tanggal" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Judul</label>
                                    <input type="text" class="form-control send" id="judul" placeholder="Judul Peraturan / tentang peraturan" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tanggal diundangkan</label>
                                    <input type="text" class="form-control send" id="tanggal_diundangkan" placeholder="Tanggal" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">T.E.U Badan</label>
                                    <input type="text" class="form-control send" id="teu_badan" placeholder="T.E.U Badan / Pengarang" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Sumber</label>
                                    <input type="text" class="form-control send" id="sumber" placeholder="Sumber / LD TLD" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Penandatangan</label>
                                    <input type="text" class="form-control send" id="penandatangan" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Bahasa</label>
                                    <input type="text" class="form-control send" id="bahasa" placeholder="Bahasa" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Subjek</label>
                                    <input type="text" class="form-control send" id="subjek" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Lokasi</label>
                                    <input type="text" class="form-control send" id="lokasi" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Bidang Hukum</label>
                                    <input type="text" class="form-control send" id="bidang_hukum" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Berita Daerah <small>(optional)</small></label>
                                    <input type="text" class="form-control send" id="no_reg" placeholder="contoh: 13,109/2019">
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
                            <div class="col-md-3">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">Abstrak <small>(optional)</small></label>
                                    <input type="file" data-plugins="dropify" accept="application/pdf" class="send" id="abstrak"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">File</label>
                                    <input type="file" data-plugins="dropify" accept="application/pdf" class="send" id="file"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Keterangan <small>(optional)</small></label>
                                    <textarea class="form-control send" id="keterangan" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light" dir="ltr" data-style="zoom-in" id="{{$button}}"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->

    <div id="modalformubahcabut" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="formubahcabut" class="async" >
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Cabut Regulasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Diubah</label>
                                    <select class="form-control select2-multiple select2-ajax send" id="ubah" multiple="multiple" data-placeholder="Tulis Nomor atau Tentang Regulasi ..."></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Dicabut</label>
                                    <select class="form-control select2-multiple select2-ajax send" id="cabut" multiple="multiple" data-placeholder="Tulis Nomor atau Tentang Regulasi ..."></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <textarea class="form-control send" id="keteranganuc" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light" dir="ltr" data-style="zoom-in" id="btnubahcabut"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
<script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>
<script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- Page js-->
<script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
    <script>
    var flatpickrtanggal_penetapan = flatpickr('#tanggal_penetapan', {
        altInput: true,
        altFormat: "j F Y",
        dateFormat: "Y-m-d",
    });
    var flatpickrtanggal_diundangkan = flatpickr('#tanggal_diundangkan', {
        altInput: true,
        altFormat: "j F Y",
        dateFormat: "Y-m-d",
    });
    $("#tahun").datepicker({
        todayHighlight: true,
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
    var textserach = '';

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
                        options += '<option value="' + tema.id + '" data-icon="' + tema.icon + '" data-color="' + tema.warna + '">' + tema.nama + '</option>';
                    }
                });
                $('#tema_dokumen').html(options);

                // Reinisialisasi select2 setelah memuat tema
                $('#tema_dokumen').select2({
                    templateResult: formatTema,
                    templateSelection: formatTema
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

    // Fungsi untuk memperbarui tema dokumen
    function updateTemaDokumen(regulasiId, selectedTemas) {
        if (!regulasiId || !selectedTemas) {
            return;
        }

        $.ajax({
            url: '/api/regulasi/' + regulasiId + '/tema',
            method: 'POST',
            data: {
                tema_ids: selectedTemas
            },
            success: function(response) {
                console.log('Tema dokumen berhasil diperbarui');
            },
            error: function(error) {
                console.error('Error updating tema dokumen:', error);
                notifyMe('Error', 'Gagal memperbarui tema dokumen', 'error');
            }
        });
    }

    $(function($){
        loadTable('{{ route($fetch) }}', textserach);

        // Memuat tema dokumen saat halaman dimuat
        loadTemaDokumen();

        $(document).on('submit','form.async',function(){
            event.preventDefault();
            // Form Halaman
            if ($(this).attr('id')=='{{$form}}') {
                isnew = isNew('{{$form}}');
                if (isnew.status) {
                    option = {
                        'module' : '{{$module}}',
                        'success' : {
                            'request' : 'addtotablefirst',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route($fetch) }}',
                            'after' : 300
                        }
                    }

                    // Mendapatkan nilai tema dokumen yang dipilih
                    var selectedTemas = $('#tema_dokumen').val();
                    if (selectedTemas && selectedTemas.length > 0) {
                        // Menambahkan parameter tambahan untuk tema dokumen
                        var formdata = makeForm('{{$form}}', 'post');
                        $.each(selectedTemas, function(index, temaId) {
                            formdata.append('tema_dokumen[]', temaId);
                        });

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

                                // Jika berhasil disimpan, perbarui tema dokumen
                                if (response.data && response.data.id) {
                                    updateTemaDokumen(response.data.id, selectedTemas);
                                }

                                btnLoadingStop('btn{{$module}}');
                                clearSearch();
                                $('#modalform').modal('hide');
                                loadTable('{{ route($fetch) }}', null, 'first', {'stat':'addfirst', 'table':'table-main'});
                            },
                            error: function(response) {
                                if (response.responseJSON.message == 'Validation Error') {
                                    $.each(response.responseJSON.data, function(key, data){
                                        notifyMe(key, data, 'error');
                                    });
                                }
                                btnLoadingStop('btn{{$module}}');
                            }
                        });
                    } else {
                        // Jika tidak ada tema yang dipilih, lanjutkan seperti biasa
                        sentData('{{ route($store) }}', option);
                    }
                } else {
                    option = {
                        'module' : '{{$module}}',
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

                    // Dapatkan ID dari input hidden
                    var regulasiId = $('#{{$form}} input.id').val();
                    console.log('ID Regulasi yang akan diupdate:', regulasiId);
                    console.log('Tema dokumen yang dipilih:', selectedTemas);

                    if (!regulasiId) {
                        notifyMe('Error', 'ID regulasi tidak ditemukan', 'error');
                        btnLoadingStop('btn{{$module}}');
                        return;
                    }

                    // Buat form data termasuk tema_dokumen
                    var formData = makeForm('{{$form}}', 'put');
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
                        url: '{{ url('api') }}/{{$module}}/' + regulasiId,
                        data: formData,
                        dataType: 'json',
                        async: true,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            notifyMe('Success', response.message, 'success', 10000);
                            btnLoadingStop('btn{{$module}}');
                            clearSearch();
                            $('#modalform').modal('hide');

                            var crrentPage = $('.pagination li.page-item.active a.page-link').text();
                            if (textserach) {
                                crrentPage = 'findme';
                            }
                            loadTable('{{ route($fetch) }}', null, crrentPage, {'stat':'update', 'id':response.data.id, 'table':'table-main'}, response.data.id);
                        },
                        error: function(response) {
                            if (response.responseJSON && response.responseJSON.message == 'Validation Error') {
                                $.each(response.responseJSON.data, function(key, data){
                                    notifyMe(key, data, 'error');
                                });
                            } else {
                                notifyMe('Error', 'Gagal menyimpan data', 'error');
                                console.error('Error response:', response);
                            }
                            btnLoadingStop('btn{{$module}}');
                        }
                    });
                }
            }
            if ($(this).attr('id')=='formubahcabut') {
                option = {
                    'module' : 'ubahcabut',
                    'method' : 'put',
                    'success' : {
                        'request' : 'updatetable',
                        'modal' : 'modalformubahcabut',
                        'table' : 'table-main',
                        'textserach' : textserach,
                        'fetch' : '{{ route($fetch) }}',
                        'after' : 300
                    }
                }
                sentData('{{ url('api') }}/{{$module}}/updateuc', option);
            }
        });
        $(document).on('click', '#btnreloaddata', function(event) {
            event.preventDefault();
            clearSearch();
            loadTable('{{ route($fetch) }}', textserach);
        });
        $(document).on('click', '#btnadddata', function(event) {
            event.preventDefault();
            $('#modalform .modal-title').text('Add New');

            // Muat tema dokumen saat modal dibuka
            $.ajax({
                url: '/api/tema-dokumen',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Memuat tema dokumen untuk form baru');

                    // Kosongkan select2 terlebih dahulu
                    $('#tema_dokumen').empty();

                    // Tambahkan opsi tema
                    $.each(response.data, function(index, tema) {
                        if (tema.status) {
                            var option = new Option(tema.nama, tema.id, false, false);
                            option.dataset.icon = tema.icon;
                            option.dataset.color = tema.warna;
                            $('#tema_dokumen').append(option);
                        }
                    });

                    // Reinisialisasi select2
                    $('#tema_dokumen').select2({
                        templateResult: formatTema,
                        templateSelection: formatTema,
                        width: '100%'
                    });
                },
                error: function(error) {
                    console.error('Error loading tema:', error);
                }
            });

            $("#modalform").modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $(document).on('click', '.btneditdata', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            $('#modalform .modal-title').text('Edit {{$title}}');

            // Pertama, ambil data regulasi
            $.ajax({
                url: '{{ url('api') }}/{{$module}}/' + rowid + '/edit',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Data regulasi berhasil diambil:', response.data.id);

                    // Isi form dengan data regulasi
                    option = {
                        'success' : {
                            'request' : 'appliedtoform',
                            'modal' : 'modalform',
                            'form' : '{{$form}}',
                            'field' : {!! $field !!},
                        }
                    }
                    getData('{{ url('api') }}/{{$module}}/'+rowid+'/edit', option);

                    // Ambil tema dokumen yang terkait
                    var selectedTemasFromResponse = [];
                    if (response.data.tema_dokumen && response.data.tema_dokumen.length > 0) {
                        console.log('Tema dokumen yang terkait:', response.data.tema_dokumen);
                        $.each(response.data.tema_dokumen, function(index, tema) {
                            selectedTemasFromResponse.push(tema.id.toString());
                        });
                        console.log('ID tema yang akan dipilih:', selectedTemasFromResponse);
                    }

                    // Muat tema dokumen dan terapkan pilihan
                    $.ajax({
                        url: '/api/tema-dokumen',
                        method: 'GET',
                        dataType: 'json',
                        success: function(temaResponse) {
                            console.log('Tema dokumen berhasil dimuat, jumlah tema:', temaResponse.data.length);

                            // Kosongkan select2 terlebih dahulu
                            $('#tema_dokumen').empty();

                            // Tambahkan opsi tema
                            $.each(temaResponse.data, function(index, tema) {
                                if (tema.status) {
                                    var option = new Option(tema.nama, tema.id, false, false);
                                    option.dataset.icon = tema.icon;
                                    option.dataset.color = tema.warna;
                                    $('#tema_dokumen').append(option);
                                }
                            });

                            // Reinisialisasi select2
                            $('#tema_dokumen').select2({
                                templateResult: formatTema,
                                templateSelection: formatTema,
                                width: '100%'
                            });

                            // Terapkan pilihan tema setelah select2 diinisialisasi
                            if (selectedTemasFromResponse.length > 0) {
                                console.log('Menerapkan pilihan tema:', selectedTemasFromResponse);

                                // Pastikan select2 sudah diinisialisasi
                                if ($('#tema_dokumen').data('select2')) {
                                    $('#tema_dokumen').val(selectedTemasFromResponse).trigger('change');
                                    console.log('Pilihan tema diterapkan');
                                } else {
                                    // Jika select2 belum siap, tunggu sebentar
                                    var checkSelect2 = setInterval(function() {
                                        if ($('#tema_dokumen').data('select2')) {
                                            $('#tema_dokumen').val(selectedTemasFromResponse).trigger('change');
                                            console.log('Pilihan tema diterapkan setelah menunggu');
                                            clearInterval(checkSelect2);
                                        }
                                    }, 100);
                                }
                            }
                        },
                        error: function(error) {
                            console.error('Error loading tema:', error);
                        }
                    });
                },
                error: function(error) {
                    console.error('Error loading regulasi:', error);
                }
            });
        });
        $(document).on('click', '.btneditubahcabut', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            option = {
                'success' : {
                    'request' : 'appliedtoformuc',
                    'modal' : 'modalformubahcabut',
                    'selector' : ['cabut', 'ubah'],
                    'form' : 'formubahcabut',
                    'field' : ['cabut', 'ubah', 'keteranganuc'],
                }
            }
            getData('{{ url('api') }}/{{$module}}/'+rowid+'/edituc', option);
        });
        $(document).on('click', '.btndeletedata', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f1556c',
                confirmButtonText: 'Yes, delete it!'
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
                    sentData('{{ url('api') }}/{{$module}}/'+rowid, option);
                }
            });
        });
        $(document).on('click', '.page-link', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadTable('{{ route($fetch) }}', textserach, page);
        });
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
        $('#modalformubahcabut').on('hidden.bs.modal', function (e) {
            formname = $(this).find('form').attr('id');
            $(this).find('input.additional').remove();
            fieldClear(formname);
            fieldIndcator('clear', formname);
            $('.select2-search__field').css('width', '406px');
        })
        $('#konten').summernote({
            placeholder: 'Write something...',
            height: 230,
            dialogsInBody: true,
            callbacks: {
                // fix broken checkbox on link modal
                onInit: function onInit(e) {
                    var editor = $(e.editor);
                    editor.find('.custom-control-description').addClass('custom-control-label').parent().removeAttr('for');
                }
            }
        });
        $('.select2-ajax').select2({
            ajax: {
                minimumInputLength: 3,
                url: '/api/{{$module}}/searchforuc',
                dataType: 'json',
                delay: 800,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                }
            }
        });
        $('.select2-search__field').css('width', '406px');
    });
    </script>
@endsection
