@extends('layouts.detached', ['title' => 'Relaas'])

@section('css')
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <style>
        .tempus-dominus-widget {
            width: 100%;
        }
    </style>
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Relaas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Relaas</h4>
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
                                    <input id="search-data" type="text" placeholder="Search" class="form-control send"
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formrelaas" class="async">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="nomor">Nomor</label>
                                    <input type="text" class="form-control send" id="nomor" name="nomor" placeholder="Nomor">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">jenis</label>
                                    <select class="form-control send" id="jenis" data-toggle="select2">
                                        <option value="" disabled>---Pilih Jenis---</option>
                                        <option value="panggilan">Panggilan</option>
                                        <option value="pemberitahuan">Pemberitahuan</option>
                                        <option value="eksekusi">Eksekusi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tanggal</label>
                                    <input type="text" class="form-control send mb-1" id="tanggal" readonly>
                                    <div class="log-event" id="tanggal_picker"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="status_input">Status</label>

                                    <select class="form-control send" id="status_input" data-toggle="select2">
                                        <option value="" disabled>---Pilih Status---</option>
                                        <option value="berlaku" selected>Berlaku</option>
                                        <option value="tidak-berlaku">Tidak Berlaku</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="pihak_terkait">Pihak Terkait</label>
                                    <input type="text" class="form-control send" id="pihak_terkait" name="pihak_terkait" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="konten">Konten</label>
                                    <div class="wysiwyg send" id="konten" name="konten" data-type="send"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="dokumen">Dokumen</label>
                                    <input type="file" data-plugins="dropify"
                                        data-allowed-file-extensions="pdf"
                                        accept="application/pdf" class="dropify send" id="dokumen" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start" data-dismiss="modal"><i
                                class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light" dir="ltr"
                            data-style="zoom-in" id="btnrelaas"><i class="mdi mdi-content-save mr-2"></i>
                            Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/footable/footable.min.js') }}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>
    <script>
        var textserach = '';
        $('.dropify').dropify();
        $(function ($) {
            loadTable('{{ route('api.relaasV2.fetch') }}', textserach);
            var waktu = $('#tanggal_picker').tempusDominus({
                display: {
                    inline: true,
                    components: {
                        useTwentyfourHour: true,
                    }
                }
            });
            $(document).on('change.td', '#tanggal_picker', (e) => {
                $('#tanggal').val(moment(e.date).format('YYYY-MM-DD HH:mm'));
            });
            $(document).on('submit', 'form.async', function () {
                event.preventDefault();
                const data = new FormData(event.target);
                for (const pair of data.entries()) {
                    console.log(pair[0] + ": " + pair[1]);
                }
                // Form Role
                if ($(this).attr('id') == 'formrelaas') {
                    isnew = isNew('formrelaas');
                    if (isnew.status) {
                        option = {
                            'module': 'relaas',
                            'success': {
                                'request': 'addtotable',
                                'modal': 'modalform',
                                'table': 'table-main',
                                'textserach': textserach,
                                'fetch': '{{ route('api.relaasV2.fetch') }}',
                                'after': 300
                            }
                        }
                        sentData('{{ route('api.relaasV2.store') }}', option);
                    } else {
                        option = {
                            'module': 'relaas',
                            'method': 'put',
                            'success': {
                                'request': 'updatetable',
                                'modal': 'modalform',
                                'table': 'table-main',
                                'textserach': textserach,
                                'fetch': '{{ route('api.relaasV2.fetch') }}',
                                'after': 300
                            }
                        }
                        sentData('{{ url('api/relaasV2') }}/' + isnew.id, option);
                    }
                }
            });
            $(document).on('click', '#btnreloaddata', function (event) {
                event.preventDefault();
                clearSearch();
                loadTable('{{ route('api.relaasV2.fetch') }}', textserach);
            });
            $(document).on('click', '#btnadddata', function (event) {
                event.preventDefault();
                $('#modalform .modal-title').text('Add New');
                $("#modalform").modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
            $(document).on('click', '.btneditdata', function (event) {
                event.preventDefault();
                rowid = $(this).parent().attr('data-id');
                $('#modalform .modal-title').text('Update Data');
                option = {
                    'success': {
                        'request': 'appliedtoform',
                        'modal': 'modalform',
                        'form': 'formrelaas',
                        'field': ['nomor', 'jenis', 'tanggal', 'pihak_terkait', 'status_input', 'konten', 'dokumen'],
                    }
                }
                getData('{{ url('api/relaasV2') }}/' + rowid + '/edit', option);
            });
            $(document).on('click', '.btndeletedata', function (event) {
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
                            'method': 'delete',
                            'success': {
                                'request': 'removefromtable',
                                'table': 'table-main',
                                'textserach': textserach,
                                'fetch': '{{ route('api.relaasV2.fetch') }}',
                                'after': 300
                            }
                        }
                        sentData('{{ url('api/relaasV2') }}/' + rowid, option);
                    }
                });
            });
            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadTable('{{ route('api.relaasV2.fetch') }}', textserach, page);
            });
            $(document).on('keyup', '#search-data', delay(function (event) {
                var search = true;
                if (textserach == this.value) {
                    search = false;
                }
                textserach = this.value;
                if (search) {
                    loadTable('{{ route('api.relaasV2.fetch') }}', textserach);
                }
            }, 500));
            $('#konten').summernote({
                placeholder: 'Konten relaas...',
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
        });
    </script>
@endsection
