@extends('layouts.detached', ['title' => 'Kelurahan'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelurahan</li>
                    </ol>
                </div>
                <h4 class="page-title">Kelurahan</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box pb-2 position-relative">
                <h4 class="header-title mb-3">Data Kelurahan</h4>
                <div id="index-content">
                    <div class="clearfix">
                        <div class="text-sm-center form-inline float-left">
                            <div class="form-group mr-2">
                                <button id="btnadddata" class="btn btn-primary waves-effect"><i class="mdi mdi-plus-circle mr-2"></i> Add New Data</button>
                            </div>
                            <div class="form-group">
                                <input id="search-data" type="text" placeholder="Search" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-sm-center float-right">
                            <div class="form-group float-right">
                                <button id="btnreloaddata" class="btn btn-white waves-effect"><i class="mdi mdi-reload"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" id="table-data"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalform" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formkelurahan" class="async">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select class="form-control send" id="kecamatan_id" required></select>
                    </div>
                    <div class="form-group">
                        <label>Nama Kelurahan</label>
                        <input type="text" class="form-control send" id="nama_kelurahan" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control send" id="alamat" rows="2"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Latitude</label>
                            <input type="text" class="form-control send" id="latitude">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Longitude</label>
                            <input type="text" class="form-control send" id="longitude">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control send" id="is_active">
                            <option value="true">Aktif</option>
                            <option value="false">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                    <button type="submit" class="ladda-button btn btn-primary" data-style="zoom-in" id="btnkelurahan"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/footable/footable.min.js') }}"></script>
<script>
var textserach = '';

function loadKecamatanOptions(selectedId) {
    $.get('{{ route('api.kecamatan.index') }}', function (response) {
        var options = '<option value="">Pilih Kecamatan</option>';
        $.each(response.data || [], function (_, row) {
            var selected = selectedId && String(selectedId) === String(row.id) ? 'selected' : '';
            options += '<option value="' + row.id + '" ' + selected + '>' + row.nama_kecamatan + '</option>';
        });
        $('#kecamatan_id').html(options);
    });
}

$(function () {
    loadTable('{{ route('api.kelurahan.fetch') }}', textserach);

    $(document).on('submit', 'form.async', function (event) {
        event.preventDefault();
        if ($(this).attr('id') == 'formkelurahan') {
            var isnew = isNew('formkelurahan');
            if (isnew.status) {
                sentData('{{ route('api.kelurahan.store') }}', {
                    module: 'kelurahan',
                    success: { request: 'addtotable', modal: 'modalform', table: 'table-main', fetch: '{{ route('api.kelurahan.fetch') }}', after: 300 }
                });
            } else {
                sentData('{{ url('api/kelurahan') }}/' + isnew.id, {
                    module: 'kelurahan',
                    method: 'put',
                    success: { request: 'updatetable', modal: 'modalform', table: 'table-main', fetch: '{{ route('api.kelurahan.fetch') }}', after: 300 }
                });
            }
        }
    });

    $(document).on('click', '#btnadddata', function (event) {
        event.preventDefault();
        $('#modalform .modal-title').text('Add New Kelurahan');
        $('#formkelurahan .id').remove();
        fieldClear('formkelurahan');
        $('#is_active').val('true');
        loadKecamatanOptions(null);
        $('#modalform').modal({ backdrop: 'static', keyboard: false });
    });

    $(document).on('click', '.btneditdata', function (event) {
        event.preventDefault();
        var rowid = $(this).parent().attr('data-id');
        $('#modalform .modal-title').text('Update Kelurahan');
        getData('{{ url('api/kelurahan') }}/' + rowid + '/edit', {
            success: {
                request: 'appliedtoform',
                modal: 'modalform',
                form: 'formkelurahan',
                field: ['kecamatan_id', 'nama_kelurahan', 'alamat', 'latitude', 'longitude', 'is_active'],
                callback: function (response) {
                    loadKecamatanOptions(response.data.kecamatan_id);
                }
            }
        });
    });

    $(document).on('click', '.btndeletedata', function (event) {
        event.preventDefault();
        var rowid = $(this).parent().attr('data-id');
        Swal.fire({ title: 'Are you sure?', text: 'You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#f1556c', confirmButtonText: 'Yes, delete it!' })
            .then(function (result) {
                if (result.value) {
                    sentData('{{ url('api/kelurahan') }}/' + rowid, {
                        method: 'delete',
                        success: { request: 'removefromtable', table: 'table-main', fetch: '{{ route('api.kelurahan.fetch') }}', after: 300 }
                    });
                }
            });
    });

    $(document).on('click', '#btnreloaddata', function (event) {
        event.preventDefault();
        clearSearch();
        loadTable('{{ route('api.kelurahan.fetch') }}', textserach);
    });

    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        loadTable('{{ route('api.kelurahan.fetch') }}', textserach, page);
    });

    $(document).on('keyup', '#search-data', delay(function () {
        var search = textserach != this.value;
        textserach = this.value;
        if (search) {
            loadTable('{{ route('api.kelurahan.fetch') }}', textserach);
        }
    }, 500));
});
</script>
@endsection
