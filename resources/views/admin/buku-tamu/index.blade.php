@extends('layouts.detached', ['title' => $title])

@section('css')
    <link href="{{ asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
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

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box pb-2 position-relative">
                    <h4 class="header-title mb-3">Data</h4>

                    <div class="clearfix">
                        <div class="text-sm-center form-inline float-left">
                            <button id="btnAddData" class="btn btn-primary waves-effect">
                                <i class="mdi mdi-plus-circle mr-2"></i> Add New Data
                            </button>
                        </div>
                        <div class="text-sm-center float-right">
                            <button id="btnReloadData" class="btn btn-white waves-effect">
                                <i class="mdi mdi-reload"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive mt-3" id="table-data">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Asal Instansi</th>
                                    <th>No WA</th>
                                    <th>Keperluan</th>
                                    <th style="width: 0px"></th>
                                </tr>
                            </thead>
                            <tbody id="buku-tamu-list">
                                <!-- Data dari API akan dimuat di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.buku-tamu.modal')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropify/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadData();
            $('[data-plugins=\"dropify\"]').dropify();

            // Tampilkan Form Tambah Data
            $('#btnAddData').click(function() {
                clearFields();
                $('#modalForm .modal-title').text('Tambah Buku Tamu');
                $('#modalForm').modal('show');
            });

            // Submit Form (Tambah/Edit)
            $('#formBukuTamu').submit(function(e) {
                e.preventDefault();
                submitForm();
            });

            // Edit Data
            $(document).on('click', '.btnedit', function() {
                editButton = $(this);
                originalTextEdit = editButton.html();
                editData($(this).data('id'));
            });

            // Hapus Data
            $(document).on('click', '.btndelete', function() {
                deleteData($(this).data('id'));
            });

            // Reload Data
            $(document).on('click', '#btnReloadData', function() {
                loadData();
            });
        });

        function clearFields() {
            $('#formBukuTamu')[0].reset();
            $(".dropify-clear").trigger("click");
        }

        function addBtnLoading(btn = submitButton, text = 'Menyimpan...') {
            // Tampilkan loading di tombol
            btn.html('<i class="mdi mdi-loading mdi-spin"></i> ' + text).prop('disabled', true);
        }

        function removeBtnLoading(btn = submitButton, originalText = originalText) {
            btn.html(originalText).prop('disabled', false);
        }

        function apiRequest(url, method, data = {}, onSuccess, onError) {
            $.ajax({
                url: url,
                headers: {
                    'Authorization': 'Bearer JDIHsir17rnYPkva7p4c8GtEnLBUWwFJq4ADsEVDQOqjCWKH8zvE055P4x6sYdKb'
                },
                method: method,
                data: data,
                processData: false,
                contentType: false,
                success: onSuccess,
                error: onError
            });
        }

        function loadData() {
            apiRequest('{{ env('JDIH_SVC_BUKU_TAMU_URL') }}', 'GET', {}, function(response) {
                let rows = response.data.map(tamu => `
            <tr>
                <td>${tamu.nama}</td>
                <td>${tamu.asal_instansi}</td>
                <td>${tamu.no_wa}</td>
                <td>${tamu.keperluan}</td>
                <td>
                    <div class="button-list" style="white-space: nowrap;">
                        <button class="btn btn-xs btn-success btnedit" data-id="${tamu.id}">
                            <i class="mdi mdi-pencil-outline"></i>
                        </button>
                        <button class="btn btn-xs btn-danger btndelete" data-id="${tamu.id}">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
                $('#buku-tamu-list').html(rows);
            });
        }

        function submitForm() {
            let id = $('#bukuTamuId').val();
            let formData = new FormData($('#formBukuTamu')[0]);
            if (id) formData.append('_method', 'PUT');
            let url = id ? `{{ env('JDIH_SVC_BUKU_TAMU_URL') }}/${id}` : `{{ env('JDIH_SVC_BUKU_TAMU_URL') }}`;

            let submitButton = $('#btnSubmit');
            let originalText = submitButton.html();
            addBtnLoading(submitButton, 'Menyimpan...'); // Tambahkan loading ke tombol
            apiRequest(url, 'POST', formData, function() {
                $('#modalForm').modal('hide');
                loadData();
                removeBtnLoading(submitButton, originalText);
            }, function(response) {
                if (response.responseJSON?.status == 30) {
                    $.each(response.responseJSON.errors, (key, data) => notifyMe(key, data, 'error'));
                }
                removeBtnLoading(submitButton, originalText);
            });
        }

        function editData(id) {
            addBtnLoading(editButton, ''); // Tambahkan loading ke tombol

            apiRequest(`{{ env('JDIH_SVC_BUKU_TAMU_URL') }}/${id}`, 'GET', {}, function(response) {
                let data = response.data;
                $('#bukuTamuId').val(data.id);
                $('#nama').val(data.nama);
                $('#asal_instansi').val(data.asal_instansi);
                $('#no_wa').val(data.no_wa);
                $('#keperluan').val(data.keperluan);
                $('#modalForm .modal-title').text('Edit Buku Tamu');
                $('#modalForm').modal('show');
                removeBtnLoading(editButton, originalTextEdit);
            }, function() {
                removeBtnLoading(editButton, originalTextEdit);
            });
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Yakin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result) {
                    apiRequest(`{{ env('JDIH_SVC_BUKU_TAMU_URL') }}/${id}`, 'DELETE', {}, function() {
                        Swal.fire('Terhapus!', 'Data telah dihapus.', 'success');
                        loadData();
                    });
                }
            });
        }
    </script>
@endsection
