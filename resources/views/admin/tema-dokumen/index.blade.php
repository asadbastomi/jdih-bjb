@extends('layouts.detached', ['title' => $title])

@section('css')
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="{{$form}}" class="async">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Nama Tema <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control send" id="nama" name="nama"
                                        placeholder="Nama Tema Dokumen" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control send" id="status" name="status" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <textarea class="form-control send" id="deskripsi" name="deskripsi" rows="3"
                                        placeholder="Deskripsi tema dokumen"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Icon (PNG)</label>
                                    <input type="file" class="form-control send" id="icon" name="icon" accept="image/png">
                                    <small class="form-text text-muted">Upload file PNG untuk icon tema (Maksimal 2MB)</small>
                                    <div id="icon-preview" class="mt-2" style="display: none;">
                                        <img src="" id="icon-preview-img" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; border-radius: 4px;" alt="Icon Preview">
                                        <button type="button" id="remove-icon" class="btn btn-sm btn-danger ml-2">
                                            <i class="mdi mdi-delete"></i> Hapus
                                        </button>
                                    </div>
                                    <div id="current-icon" class="mt-2" style="display: none;">
                                        <small class="text-muted">Icon saat ini:</small><br>
                                        <img src="" id="current-icon-img" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; border-radius: 4px; margin-top: 5px;" alt="Current Icon">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Warna</label>
                                    <input type="color" class="form-control send" id="warna" name="warna"
                                        placeholder="#000000" value="#0acf97">
                                    <small class="form-text text-muted">Pilih warna untuk tema</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect justify-start" data-dismiss="modal"><i
                                class="mdi mdi-close-thick mr-2"></i> Close</button>
                        <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light" dir="ltr"
                            data-style="zoom-in" id="{{$button}}"><i class="mdi mdi-content-save mr-2"></i> Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
    <script>
        var textserach = '';
        $(function ($) {
            loadTable('{{ route($fetch) }}', textserach);

            // Icon file preview
            $('#icon').on('change', function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#icon-preview-img').attr('src', e.target.result);
                        $('#icon-preview').show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Remove icon preview
            $('#remove-icon').on('click', function() {
                $('#icon').val('');
                $('#icon-preview').hide();
                $('#icon-preview-img').attr('src', '');
                // Show current icon again
                if ($('#current-icon-img').attr('src') !== '') {
                    $('#current-icon').show();
                }
            });

            // Handle form submission with file upload
            $(document).on('submit', 'form.async', function() {
                event.preventDefault();
                var form = this;
                var formId = $(form).attr('id');
                
                if (formId == '{{$form}}') {
                    isnew = isNew(formId);
                    
                    // Create FormData to handle file upload
                    var formData = new FormData(form);
                    
                    if (isnew.status) {
                        $.ajax({
                            url: '{{ route($store) }}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    loadTable('{{ route($fetch) }}', textserach);
                                    $('#modalform').modal('hide');
                                    fieldClear(formId);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(xhr) {
                                var errors = xhr.responseJSON;
                                var errorMessage = 'Terjadi kesalahan';
                                if (errors && errors.message) {
                                    errorMessage = errors.message;
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: errorMessage
                                });
                            }
                        });
                    } else {
                        var id = $(form).find('input.id').val();
                        formData.append('_method', 'PUT');
                        
                        $.ajax({
                            url: '{{ url('api') }}/{{$module}}/' + id,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    loadTable('{{ route($fetch) }}', textserach);
                                    $('#modalform').modal('hide');
                                    fieldClear(formId);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(xhr) {
                                var errors = xhr.responseJSON;
                                var errorMessage = 'Terjadi kesalahan';
                                if (errors && errors.message) {
                                    errorMessage = errors.message;
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: errorMessage
                                });
                            }
                        });
                    }
                }
            });

            $(document).on('click', '#btnreloaddata', function (event) {
                event.preventDefault();
                clearSearch();
                loadTable('{{ route($fetch) }}', textserach);
            });

            $(document).on('click', '#btnadddata', function (event) {
                event.preventDefault();
                $('#modalform .modal-title').text('Add New');
                $("#modalform").modal({
                    backdrop: 'static',
                    keyboard: false
                });
                makeButtonLoading();
            });

            $(document).on('click', '.btneditdata', function (event) {
                event.preventDefault();
                rowid = $(this).parent().attr('data-id');
                $('#modalform .modal-title').text('Edit {{$title}}');
                option = {
                    'success': {
                        'request': 'appliedtoform',
                        'modal': 'modalform',
                        'form': '{{$form}}',
                        'field': {!! $field !!},
                        'callback': function(response) {
                            // Handle icon preview for edit
                            if (response.data.icon) {
                                var iconUrl = window.location.origin + '/storage/' + response.data.icon;
                                if (response.data.icon.includes('.')) {
                                    // File icon
                                    $('#current-icon-img').attr('src', iconUrl);
                                    $('#current-icon').show();
                                } else {
                                    // MDI icon class
                                    $('#current-icon').hide();
                                }
                            } else {
                                $('#current-icon').hide();
                            }
                        }
                    }
                }
                getData('{{ url('api') }}/{{$module}}/' + rowid + '/edit', option);
                makeButtonLoading();
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
                                'fetch': '{{ route($fetch) }}',
                                'after': 300
                            }
                        }
                        sentData('{{ url('api') }}/{{$module}}/' + rowid, option);
                    }
                });
            });

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadTable('{{ route($fetch) }}', textserach, page);
            });

            $(document).on('keyup', '#search-data', delay(function (event) {
                var search = true;
                if (textserach == this.value) {
                    search = false;
                }
                textserach = this.value;
                if (search) {
                    loadTable('{{ route($fetch) }}', textserach);
                }
            }, 500));

            $('#modalform').on('hidden.bs.modal', function (e) {
                formname = $(this).find('form').attr('id');
                $(this).find('input.additional').remove();
                fieldClear(formname);
                fieldIndcator('clear', formname);
                // Reset icon previews
                $('#icon-preview').hide();
                $('#icon-preview-img').attr('src', '');
                $('#current-icon').hide();
                $('#current-icon-img').attr('src', '');
            });
        });
    </script>
@endsection