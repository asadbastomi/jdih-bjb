@extends('layouts.detached', ['title' => 'Kelurahan Sadar Hukum'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelurahan Sadar Hukum</li>
                    </ol>
                </div>
                <h4 class="page-title">Kelurahan Sadar Hukum</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box pb-2 position-relative">
                <h4 class="header-title mb-3">Data Kelurahan Sadar Hukum</h4>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="formksh" class="async">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Kecamatan</label>
                            <select class="form-control send" id="kecamatan_id" required></select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Kelurahan</label>
                            <select class="form-control send" id="kelurahan_id" required></select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Status Program</label>
                            <select class="form-control send" id="status" required>
                                <option value="Binaan">Binaan</option>
                                <option value="Sadar Hukum">Sadar Hukum</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Status Aktif</label>
                            <select class="form-control send" id="is_active">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>SK Wali Kota Nomor</label>
                            <input type="text" class="form-control send" id="sk_walikota_nomor">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tanggal SK Wali Kota</label>
                            <input type="date" class="form-control send" id="sk_walikota_tanggal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Detail SK Wali Kota</label>
                        <textarea class="form-control send" id="sk_walikota_detail" rows="2"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>SK Gubernur Nomor</label>
                            <input type="text" class="form-control send" id="sk_gubernur_nomor">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tanggal SK Gubernur</label>
                            <input type="date" class="form-control send" id="sk_gubernur_tanggal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Detail SK Gubernur</label>
                        <textarea class="form-control send" id="sk_gubernur_detail" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Alamat POSBANKUM</label>
                        <textarea class="form-control send" id="posbankum_alamat" rows="2"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Jadwal POSBANKUM</label>
                            <input type="text" class="form-control send" id="posbankum_jadwal">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Telepon POSBANKUM</label>
                            <input type="text" class="form-control send" id="posbankum_telepon">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan POSBANKUM</label>
                        <textarea class="form-control send" id="posbankum_keterangan" rows="2"></textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                    <button type="submit" class="ladda-button btn btn-primary" data-style="zoom-in" id="btnksh"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
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
var masterKecamatan = [];
var masterKelurahan = [];

function loadMasterWilayah(selectedKecamatanId, selectedKelurahanId) {
    $.when(
        $.get('{{ route('api.kecamatan.index') }}'),
        $.get('{{ route('api.kelurahan.index') }}')
    ).done(function (resKecamatan, resKelurahan) {
        masterKecamatan = (resKecamatan[0] && resKecamatan[0].data) ? resKecamatan[0].data : [];
        masterKelurahan = (resKelurahan[0] && resKelurahan[0].data) ? resKelurahan[0].data : [];

        var kecOptions = '<option value="">Pilih Kecamatan</option>';
        $.each(masterKecamatan, function (_, row) {
            var selected = selectedKecamatanId && String(selectedKecamatanId) === String(row.id) ? 'selected' : '';
            kecOptions += '<option value="' + row.id + '" ' + selected + '>' + row.nama_kecamatan + '</option>';
        });
        $('#kecamatan_id').html(kecOptions);

        renderKelurahanOptions(selectedKecamatanId, selectedKelurahanId);
    });
}

function renderKelurahanOptions(kecamatanId, selectedKelurahanId) {
    var options = '<option value="">Pilih Kelurahan</option>';
    var filtered = masterKelurahan;

    if (kecamatanId) {
        filtered = $.grep(masterKelurahan, function (row) {
            return String(row.kecamatan_id) === String(kecamatanId);
        });
    }

    $.each(filtered, function (_, row) {
        var selected = selectedKelurahanId && String(selectedKelurahanId) === String(row.id) ? 'selected' : '';
        options += '<option value="' + row.id + '" ' + selected + '>' + row.nama_kelurahan + '</option>';
    });

    $('#kelurahan_id').html(options);
}

$(function () {
    loadTable('{{ route('api.kelurahan-sadar-hukum.fetch') }}', textserach);

    $(document).on('change', '#kecamatan_id', function () {
        renderKelurahanOptions($(this).val(), null);
    });

    $(document).on('submit', 'form.async', function (event) {
        event.preventDefault();
        if ($(this).attr('id') == 'formksh') {
            var isnew = isNew('formksh');
            if (isnew.status) {
                sentData('{{ route('api.kelurahan-sadar-hukum.store') }}', {
                    module: 'kelurahan-sadar-hukum',
                    success: { request: 'addtotable', modal: 'modalform', table: 'table-main', fetch: '{{ route('api.kelurahan-sadar-hukum.fetch') }}', after: 300 }
                });
            } else {
                sentData('{{ url('api/kelurahan-sadar-hukum') }}/' + isnew.id, {
                    module: 'kelurahan-sadar-hukum',
                    method: 'put',
                    success: { request: 'updatetable', modal: 'modalform', table: 'table-main', fetch: '{{ route('api.kelurahan-sadar-hukum.fetch') }}', after: 300 }
                });
            }
        }
    });

    $(document).on('click', '#btnadddata', function (event) {
        event.preventDefault();
        $('#modalform .modal-title').text('Add New Kelurahan Sadar Hukum');
        $('#formksh .id').remove();
        fieldClear('formksh');
        $('#status').val('Binaan');
        $('#is_active').val('1');
        loadMasterWilayah(null, null);
        $('#modalform').modal({ backdrop: 'static', keyboard: false });
    });

    $(document).on('click', '.btneditdata', function (event) {
        event.preventDefault();
        var rowid = $(this).parent().attr('data-id');
        $('#modalform .modal-title').text('Update Kelurahan Sadar Hukum');
        getData('{{ url('api/kelurahan-sadar-hukum') }}/' + rowid + '/edit', {
            success: {
                request: 'appliedtoform',
                modal: 'modalform',
                form: 'formksh',
                field: [
                    'kecamatan_id',
                    'kelurahan_id',
                    'status',
                    'is_active',
                    'sk_walikota_nomor',
                    'sk_walikota_tanggal',
                    'sk_walikota_detail',
                    'sk_gubernur_nomor',
                    'sk_gubernur_tanggal',
                    'sk_gubernur_detail',
                    'posbankum_alamat',
                    'posbankum_jadwal',
                    'posbankum_telepon',
                    'posbankum_keterangan',
                    'latitude',
                    'longitude'
                ],
                callback: function (response) {
                    loadMasterWilayah(response.data.kecamatan_id, response.data.kelurahan_id);
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
                    sentData('{{ url('api/kelurahan-sadar-hukum') }}/' + rowid, {
                        method: 'delete',
                        success: { request: 'removefromtable', table: 'table-main', fetch: '{{ route('api.kelurahan-sadar-hukum.fetch') }}', after: 300 }
                    });
                }
            });
    });

    $(document).on('click', '#btnreloaddata', function (event) {
        event.preventDefault();
        clearSearch();
        loadTable('{{ route('api.kelurahan-sadar-hukum.fetch') }}', textserach);
    });

    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        loadTable('{{ route('api.kelurahan-sadar-hukum.fetch') }}', textserach, page);
    });

    $(document).on('keyup', '#search-data', delay(function () {
        var search = textserach != this.value;
        textserach = this.value;
        if (search) {
            loadTable('{{ route('api.kelurahan-sadar-hukum.fetch') }}', textserach);
        }
    }, 500));
});
</script>
@endsection
