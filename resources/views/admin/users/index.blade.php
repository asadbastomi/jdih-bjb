
@extends('layouts.detached', ['title' => 'Users'])

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
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Users</h4>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formuser" class="async" >
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" class="form-control send" id="name" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control send" id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" class="form-control send" id="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control send" placeholder="Enter your password" required>
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="position:relative">
                                    <label class="control-label">Role</label>
                                    <select class="form-control select2-multiple send" name="role" id="role"  data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                        @foreach ($roles as $key => $role)
                                            <option value="{{$role->id}}">{{$role->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light" dir="ltr" data-style="zoom-in" id="btnuser"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
    <script>
    var textserach = '';
    $(function($){
        loadTable('{{ route('api.users.fetch') }}', textserach);

        $(document).on('submit','form.async',function(){
            event.preventDefault();
            // Form User
            if ($(this).attr('id')=='formuser') {
                isnew = isNew('formuser');
                if (isnew.status) {
                    option = {
                        'module' : 'user',
                        'success' : {
                            'request' : 'addtotable',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route('api.users.fetch') }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ route('api.users.store') }}', option);
                } else {
                    option = {
                        'module' : 'user',
                        'method' : 'put',
                        'success' : {
                            'request' : 'updatetable',
                            'modal' : 'modalform',
                            'table' : 'table-main',
                            'textserach' : textserach,
                            'fetch' : '{{ route('api.users.fetch') }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ url('api/users') }}/'+isnew.id, option);
                }
            }
        });
        $(document).on('click', '#btnreloaddata', function(event) {
            event.preventDefault();
            clearSearch();
            loadTable('{{ route('api.users.fetch') }}', textserach);
        });
        $(document).on('click', '#btnadddata', function(event) {
            event.preventDefault();
            $('#modalform .modal-title').text('Add New');
            $("#modalform").modal({
                backdrop: 'static',
                keyboard: false
            });
            $('.select2-search__field').css('width', '406px');
        });
        $(document).on('click', '.btneditdata', function(event) {
            event.preventDefault();
            rowid = $(this).parent().attr('data-id');
            $('#modalform .modal-title').text('Update Data');
            option = {
                'success' : {
                    'request' : 'appliedtoform',
                    'modal' : 'modalform',
                    'form' : 'formuser',
                    'field' : ['name','email','username','role'],
                }
            }
            optionalField('password');
            getData('{{ url('api/users') }}/'+rowid+'/edit', option);
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
                            'fetch' : '{{ route('api.users.fetch') }}',
                            'after' : 300
                        }
                    }
                    sentData('{{ url('api/users') }}/'+rowid, option);
                }
            });
        });
        $(document).on('click', '.page-link', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadTable('{{ route('api.users.fetch') }}', textserach, page);
        });
        $(document).on('keyup', '#search-data', delay(function (event) {
            var search = true;
            if (textserach==this.value) {
                search = false;
            }
            textserach = this.value;
            if (search) {
                loadTable('{{ route('api.users.fetch') }}', textserach);
            }
        }, 500));
    });
    </script>
@endsection
