@extends('layouts.detached', ['title' => 'Tema Dokumen'])

@section('css')
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">Tema Dokumen</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Tema Dokumen</h4>
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
                                        <i class="mdi mdi-plus-circle mr-2"></i> Tambah Tema Baru
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="formtemadokumen" class="async" >
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Nama Tema <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control send" id="nama" placeholder="Nama tema dokumen" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Warna Tema <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control colorpicker send" id="warna" value="#3498DB" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <textarea class="form-control send" id="deskripsi" rows="3" placeholder="Deskripsi tema dokumen"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">Icon Tema <small>(optional)</small></label>
                                    <input type="file" class="dropify form-control send" id="icon" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input send" id="status" checked>
                                        <label class="custom-control-label" for="status">Aktif</label>
                                    </div>
                                    <small class="text-muted">Tema yang tidak aktif tidak akan ditampilkan pada form</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light" dir="ltr" data-style="zoom-in" id="btntemadokumen"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
    <script>
    var textserach = '';
    $(function($){
        loadTable('{{ route('api.tema-dokumen.fetch') }}', textserach);

        // Inisialisasi colorpicker
        $('.colorpicker').spectrum({
            type: "component",
            showInput: true,
            showInitial: true,
            showAlpha: false,
            showPalette: true,
            palette: [
                ["#3498DB", "#2ECC71", "#9B59B6", "#F39C12", "#E74C3C"],
                ["#1ABC9C", "#2980B9", "#8E44AD", "#F1C40F", "#E67E22"]
            ]
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

        $(document).on('submit','form.async',function(){
            event.preventDefault();
            // Form Tema Dokumen
            if ($(this).attr('id')=='formtemadokumen') {
                isnew = isNew('formtemadokumen');
                if (isnew.status) {
                    option = {
                        'module' : 'tema-dokumen',
                        'success' : {
                            'request' : 'addtotable',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route('api.tema-dokumen.fetch') }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ route('api.tema-dokumen.store') }}', option);
                } else {
                    option = {
                        'module' : 'tema-dokumen',
                        'method' : 'put',
                        'success' : {
                            'request' : 'updatetable',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route('api.tema-dokumen.fetch') }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ url('api/tema-dokumen') }}/'+isnew.id, option);
                }
            }
        });
        $(document).on('click', '#btnreloaddata', function(event) {
            event.preventDefault();
            clearSearch();
            loadTable('{{ route('api.tema-dokumen.fetch') }}', textserach);
        });
        $(document).on('click', '#btnadddata', function(event) {
            event.preventDefault();
            $('#modalform .modal-title').text('Tambah Tema Dokumen');
            $("#modalform").modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $(document).on('click', '.btneditdata', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            $('#modalform .modal-title').text('Edit Tema Dokumen');
            option = {
                'success' : {
                    'request' : 'appliedtoform',
                    'modal' : 'modalform',
                    'form' : 'formtemadokumen',
                    'field' : ['nama', 'deskripsi', 'warna', 'status'],
                }
            }
            getData('{{ url('api/tema-dokumen') }}/'+rowid+'/edit', option);

            // Setup handler untuk menampilkan icon setelah modal dibuka
            $('#modalform').one('shown.bs.modal', function() {
                $.ajax({
                    type: 'get',
                    url: '{{ url('api/tema-dokumen') }}/'+rowid+'/edit',
                    dataType: 'json',
                    async: true,
                    success: function(response) {
                        // Jika ada icon, tampilkan di dropify
                        if (response.data.icon) {
                            var iconPath = response.data.icon;
                            setTimeout(function() {
                                var drEvent = $('.dropify').data('dropify');
                                drEvent.settings.defaultFile = iconPath;
                                drEvent.destroy();
                                drEvent.init();
                            }, 300);
                        }

                        // Set warna di colorpicker
                        if (response.data.warna) {
                            setTimeout(function() {
                                $('.colorpicker').spectrum('set', response.data.warna);
                            }, 300);
                        }

                        // Set status checkbox
                        if (response.data.status !== undefined) {
                            $('#status').prop('checked', response.data.status);
                        }
                    }
                });
            });
        });
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
                            'fetch' : '{{ route('api.tema-dokumen.fetch') }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ url('api/tema-dokumen') }}/'+rowid, option);
                }
            });
        });
        $(document).on('click', '.page-link', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadTable('{{ route('api.tema-dokumen.fetch') }}', textserach, page);
        });
        $(document).on('keyup', '#search-data', delay(function (event) {
            var search = true;
            if (textserach==this.value) {
                search = false;
            }
            textserach = this.value;
            if (search) {
                loadTable('{{ route('api.tema-dokumen.fetch') }}', textserach);
            }
        }, 500));
    });
    </script>
@endsection
