@extends('layouts.detached', ['title' => $title])

@section('css')
    <link href="{{ asset('assets/libs/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ $title }}</h4>
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
                                    <input id="search-data" type="text" placeholder="Search" class="form-control"
                                        autocomplete="off">
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
    <div id="modalform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form id="{{ $form }}" class="async">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tipe Dokumen</label>
                                    <input type="text" class="form-control send" id="tipe_dokumen" placeholder="Contoh: Artikel">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label">Judul</label>
                                    <input type="text" class="form-control send" id="judul"
                                        placeholder="Judul" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">T.E.U. Badan/Pengarang</label>
                                    <input type="text" class="form-control send" id="teu_badan" placeholder="Contoh: Penulis">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nomor Peraturan</label>
                                    <input type="text" class="form-control send" id="nomor_peraturan" placeholder="contoh: 5">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Jenis/Bentuk Peraturan</label>
                                    <input type="text" class="form-control send" id="jenis_peraturan" placeholder="Contoh: Artikel">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Singkatan Jenis/Bentuk</label>
                                    <input type="text" class="form-control send" id="singkatan_jenis_peraturan" placeholder="Contoh: Art">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tempat Penetapan</label>
                                    <input type="text" class="form-control send" id="tempat_penetapan" placeholder="Contoh: Kota Banjarbaru">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tahun Penetapan/Pengundangan</label>
                                    <input type="text" class="form-control send" id="tahun" placeholder="contoh: 2023" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Penetapan</label>
                                    <input type="text" class="form-control send" id="tanggal_penetapan"
                                        placeholder="Tanggal" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tanggal diundangkan</label>
                                    <input type="text" class="form-control send" id="tanggal_diundangkan"
                                        placeholder="Tanggal">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Kategori</label>
                                    <select class="form-control select2 send" name="kategori_id" id="kategori_id"
                                        data-toggle="select2" data-placeholder="Choose ...">
                                        <option value="6">Artikel</option>
                                        <option value="7">Majalah</option>
                                        <option value="8">Jurnal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Status Peraturan</label>
                                    <select class="form-control send" id="status_peraturan">
                                        <option value="berlaku">Berlaku</option>
                                        <option value="tidak_berlaku">Tidak Berlaku</option>
                                        <option value="dicabut">Dicabut</option>
                                        <option value="diubah">Diubah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Bahasa</label>
                                    <input type="text" class="form-control send" id="bahasa" placeholder="Contoh: Indonesia" value="Indonesia">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Lokasi</label>
                                    <input type="text" class="form-control send" id="lokasi" placeholder="Contoh: Kota Banjarbaru">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Sumber</label>
                                    <input type="text" class="form-control send" id="sumber" placeholder="Contoh: Jurnal Hukum" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Subjek</label>
                                    <input type="text" class="form-control send" id="subjek" placeholder="Contoh: Hukum Pidana" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Bidang Hukum</label>
                                    <input type="text" class="form-control send" id="bidang_hukum" placeholder="Contoh: Hukum Tata Negara" required>
                                </div>
                            </div>
                        </div>

                        <!-- Tambahan Tema Dokumen -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tema Dokumen <small>(pilih satu atau lebih)</small></label>
                                    <select class="form-control select2-multiple send" name="tema_dokumen[]"
                                        id="tema_dokumen" data-toggle="select2" multiple="multiple"
                                        data-placeholder="Pilih Tema...">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End Tambahan Tema Dokumen -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">Abstrak <small>(optional)</small></label>
                                    <input type="file" data-plugins="dropify" accept="application/pdf" class="send"
                                        id="abstrak" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">File</label>
                                    <input type="file" data-plugins="dropify" accept="application/pdf" class="send"
                                        id="file" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">Lampiran <small>(optional)</small></label>
                                    <input type="file" data-plugins="dropify" accept="application/pdf" class="send"
                                        id="lampiran" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Keterangan <small>(optional)</small></label>
                                    <textarea class="form-control send" id="keterangan" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start"
                            data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light"
                            dir="ltr" data-style="zoom-in" id="{{ $button }}"><i
                                class="mdi mdi-content-save mr-2"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
    <script src="{{ asset('assets/libs/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>
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
                },
                error: function(error) {
                    console.error('Error updating tema dokumen:', error);
                    notifyMe('Error', 'Gagal memperbarui tema dokumen', 'error');
                }
            });
        }

        $(function($) {
            loadTable('{{ route($fetch) }}', textserach);

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

            $(document).on('submit', 'form.async', function() {
                event.preventDefault();
                // Form Halaman
                if ($(this).attr('id') == '{{ $form }}') {
                    isnew = isNew('{{ $form }}');
                    if (isnew.status) {
                        option = {
                            'module': '{{ $module }}',
                            'success': {
                                'request': 'addtotablefirst',
                                'modal': 'modalform',
                                'table': 'table-main',
                                'textserach': textserach,
                                'fetch': '{{ route($fetch) }}',
                                'after': 300
                            }
                        }

                        // Mendapatkan nilai tema dokumen yang dipilih
                        var selectedTemas = $('#tema_dokumen').val();
                        if (selectedTemas && selectedTemas.length > 0) {
                            // Menambahkan parameter tambahan untuk tema dokumen
                            var formdata = makeForm('{{ $form }}', 'post');
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
                                    btnLoadingStop('btn{{ $module }}');
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
                                    btnLoadingStop('btn{{ $module }}');
                                }
                            });
                        } else {
                            // Jika tidak ada tema yang dipilih, lanjutkan seperti biasa
                            sentData('{{ route($store) }}', option);
                        }
                    } else {
                        option = {
                            'module': '{{ $module }}',
                            'method': 'put',
                            'success': {
                                'request': 'updatetable',
                                'modal': 'modalform',
                                'table': 'table-main',
                                'textserach': textserach,
                                'fetch': '{{ route($fetch) }}',
                                'after': 300
                            }
                        }

                        // Mendapatkan nilai tema dokumen yang dipilih
                        var selectedTemas = $('#tema_dokumen').val();
                        var regulasiId = $('#{{ $form }} input.id').val();

                        if (!regulasiId) {
                            notifyMe('Error', 'ID regulasi tidak ditemukan', 'error');
                            btnLoadingStop('btn{{ $module }}');
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
                                btnLoadingStop('btn{{ $module }}');
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
                                btnLoadingStop('btn{{ $module }}');
                            }
                        });
                    }
                }
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
                            $.each(response.data.tema_dokumen, function(index, tema) {
                                selectedTemasFromResponse.push(tema.id.toString());
                            });
                        }

                        // Muat tema dokumen dan terapkan pilihan
                        $.ajax({
                            url: '/api/tema-dokumen',
                            method: 'GET',
                            dataType: 'json',
                            success: function(temaResponse) {
                                // Kosongkan select2 terlebih dahulu
                                $('#tema_dokumen').empty();

                                // Tambahkan opsi tema
                                $.each(temaResponse.data, function(index, tema) {
                                    if (tema.status) {
                                        var option = new Option(tema.nama, tema.id, false, false);
                                        option.dataset.color = tema.warna;
                                        $('#tema_dokumen').append(option);
                                    }
                                });

                                // Tunggu sebentar untuk memastikan select2 sudah siap
                                setTimeout(function() {
                                // Terapkan pilihan tema
                                if (selectedTemasFromResponse.length > 0) {
                                    $('#tema_dokumen').val(selectedTemasFromResponse).trigger('change');
                                }
                                }, 100);
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

            $(document).on('click', '#btnadddata', function(event) {
                event.preventDefault();
                $('#modalform .modal-title').text('Add New');

                // Muat tema dokumen saat modal dibuka
                $.ajax({
                    url: '/api/tema-dokumen',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
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

            $(document).on('click', '#btnreloaddata', function(event) {
                event.preventDefault();
                clearSearch();
                loadTable('{{ route($fetch) }}', textserach);
            });
            $(document).on('click', '.btneditubahcabut', function(event) {
                event.preventDefault();
                rowid = $(this).parent().attr('data-id');
                option = {
                    'success': {
                        'request': 'appliedtoformuc',
                        'modal': 'modalformubahcabut',
                        'selector': ['cabut', 'ubah'],
                        'form': 'formubahcabut',
                        'field': ['cabut', 'ubah', 'keteranganuc'],
                    }
                }
                getData('{{ url('api') }}/{{ $module }}/' + rowid + '/edituc', option);
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
                }).then(function(result) {
                    if (result.value) {
                        option = {
                            'method': 'delete',
                            'success': {
                                'request': 'removefromtable',
                                'table': 'table-main',
                                'textserach': textserach,
                                'fetch': '{{ route($fetch) }}',
                                'after': 300
                            }
                        }
                        sentData('{{ url('api') }}/{{ $module }}/' + rowid, option);
                    }
                });
            });
            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadTable('{{ route($fetch) }}', textserach, page);
            });
            $(document).on('keyup', '#search-data', delay(function(event) {
                var search = true;
                if (textserach == this.value) {
                    search = false;
                }
                textserach = this.value;
                if (search) {
                    loadTable('{{ route($fetch) }}', textserach);
                }
            }, 500));
            $('#modalformubahcabut').on('hidden.bs.modal', function(e) {
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
                        editor.find('.custom-control-description').addClass('custom-control-label')
                            .parent().removeAttr('for');
                    }
                }
            });
            $('.select2-ajax').select2({
                ajax: {
                    minimumInputLength: 3,
                    url: '/api/{{ $module }}/searchforuc',
                    dataType: 'json',
                    delay: 800,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data, page) {
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
