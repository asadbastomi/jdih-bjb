
@extends('layouts.detached', ['title' => $title])

@section('css')
    <link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="{{$form}}" class="async" >
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Nomor Keputusan DPRD</label>
                                    <input type="text" class="form-control send" id="nomor" placeholder="188.4.43/39/XII/DPRD/2016">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tanggal diundangkan</label>
                                    <input type="text" class="form-control send" id="tanggal_diundangkan" placeholder="Tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">RAPERDA</label>
                                    <input type="text" class="form-control send" id="raperda" placeholder="Rancangan Peraturan Daerah">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Tahun</label>
                                            <select class="form-control send"  id="tahun">
                                                <option></option>
                                                @for ($i=$yearstart; $i <= (date("Y")+1); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Usulan</label>
                                            <input type="text" class="form-control send" id="usulan" placeholder="Usulan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group dropifyheightforce119">
                                    <label class="control-label">File</label>
                                    <input type="file" data-plugins="dropify" accept="application/pdf" class="send" id="file"/>
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
@endsection

@section('script')
<script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>
<script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<!-- Page js-->
<script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
    <script>
    var flatpickrtanggal_diundangkan = flatpickr('#tanggal_diundangkan', {
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
        });
    $("#tahun").select2({
        placeholder: "Select..."
    });
    var textserach = '';
    $(function($){
        loadTable('{{ route($fetch) }}', textserach);

        $(document).on('submit','form.async',function(){
            event.preventDefault();
            // Form Halaman
            if ($(this).attr('id')=='{{$form}}') {
                isnew = isNew('{{$form}}');
                if (isnew.status) {
                    option = {
                        'module' : '{{$module}}',
                        'success' : {
                            'request' : 'addtotable',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route($fetch) }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ route($store) }}', option);
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
                    sentData('{{ url('api') }}/{{$module}}/'+isnew.id, option);
                }
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
            $("#modalform").modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $(document).on('click', '.btneditdata', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            $('#modalform .modal-title').text('Update Data');
            option = {
                'success' : {
                    'request' : 'appliedtoform',
                    'modal' : 'modalform',
                    'form' : '{{$form}}',
                    'field' : {!! $field !!},
                }
            }
            getData('{{ url('api') }}/{{$module}}/'+rowid+'/edit', option);
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
    });
    </script>
@endsection
