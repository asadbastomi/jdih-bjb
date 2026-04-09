@extends('layouts.detached', ['title' => 'Jawaban Kustom Bahari AI'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jawaban Kustom Bahari AI</li>
                    </ol>
                </div>
                <h4 class="page-title">Jawaban Kustom Bahari AI</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box pb-2 position-relative">
                <h4 class="header-title mb-3">Data Jawaban</h4>
                <div class="alert alert-info mb-3" role="alert">
                    Gunakan field <strong>Kata Kunci Pemicu</strong> dipisah koma. Contoh: <em>jam pelayanan, jam operasional, buka kantor</em>.
                    <br>Pilih <strong>Contains</strong> agar jawaban muncul saat pesan user mengandung salah satu kata kunci.
                </div>
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
            <form id="formbahariaicustomanswer" class="async">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Judul Admin</label>
                            <input type="text" class="form-control send" id="judul_admin" placeholder="Contoh: Informasi Jam Pelayanan">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Contoh Pertanyaan User</label>
                            <input type="text" class="form-control send" id="contoh_pertanyaan" placeholder="Contoh: Jam layanan JDIH berapa?">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kata Kunci Pemicu</label>
                        <textarea class="form-control send" id="kata_kunci" rows="3" placeholder="Pisahkan dengan koma, misal: jam pelayanan, jam operasional, buka kantor"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label>Tipe Pencocokan</label>
                            <select class="form-control send" id="tipe_pencocokan">
                                <option value="contains">Contains (direkomendasikan)</option>
                                <option value="exact">Exact (harus persis sama)</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Prioritas</label>
                            <input type="number" class="form-control send" id="prioritas" value="0" min="0">
                            <small class="text-muted">Semakin besar, semakin diprioritaskan.</small>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Status</label>
                            <select class="form-control send" id="is_active">
                                <option value="true">Aktif</option>
                                <option value="false">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jawaban Bahari AI</label>
                        <textarea class="form-control send" id="jawaban" rows="6" placeholder="Tulis jawaban yang akan dikirim ke user."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mdi mdi-close-thick mr-2"></i> Close</button>
                    <button type="submit" class="ladda-button btn btn-primary" data-style="zoom-in" id="btnbahariaicustomanswer"><i class="mdi mdi-content-save mr-2"></i> Save changes</button>
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
$(function () {
    loadTable('{{ route('api.bahari-ai-custom-answer.fetch') }}', textserach);

    $(document).on('submit', 'form.async', function (event) {
        event.preventDefault();
        if ($(this).attr('id') == 'formbahariaicustomanswer') {
            var isnew = isNew('formbahariaicustomanswer');
            if (isnew.status) {
                sentData('{{ route('api.bahari-ai-custom-answer.store') }}', {
                    module: 'bahari-ai-custom-answer',
                    success: { request: 'addtotable', modal: 'modalform', table: 'table-main', fetch: '{{ route('api.bahari-ai-custom-answer.fetch') }}', after: 300 }
                });
            } else {
                sentData('{{ url('api/bahari-ai-custom-answer') }}/' + isnew.id, {
                    module: 'bahari-ai-custom-answer',
                    method: 'put',
                    success: { request: 'updatetable', modal: 'modalform', table: 'table-main', fetch: '{{ route('api.bahari-ai-custom-answer.fetch') }}', after: 300 }
                });
            }
        }
    });

    $(document).on('click', '#btnadddata', function (event) {
        event.preventDefault();
        $('#modalform .modal-title').text('Add New Jawaban Kustom');
        $('#formbahariaicustomanswer .id').remove();
        fieldClear('formbahariaicustomanswer');
        $('#tipe_pencocokan').val('contains');
        $('#prioritas').val('0');
        $('#is_active').val('true');
        $('#modalform').modal({ backdrop: 'static', keyboard: false });
    });

    $(document).on('click', '.btneditdata', function (event) {
        event.preventDefault();
        var rowid = $(this).parent().attr('data-id');
        $('#modalform .modal-title').text('Update Jawaban Kustom');
        getData('{{ url('api/bahari-ai-custom-answer') }}/' + rowid + '/edit', {
            success: {
                request: 'appliedtoform',
                modal: 'modalform',
                form: 'formbahariaicustomanswer',
                field: ['judul_admin', 'contoh_pertanyaan', 'kata_kunci', 'tipe_pencocokan', 'jawaban', 'prioritas', 'is_active']
            }
        });
    });

    $(document).on('click', '.btndeletedata', function (event) {
        event.preventDefault();
        var rowid = $(this).parent().attr('data-id');
        Swal.fire({ title: 'Are you sure?', text: 'You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#f1556c', confirmButtonText: 'Yes, delete it!' })
            .then(function (result) {
                if (result.value) {
                    sentData('{{ url('api/bahari-ai-custom-answer') }}/' + rowid, {
                        method: 'delete',
                        success: { request: 'removefromtable', table: 'table-main', fetch: '{{ route('api.bahari-ai-custom-answer.fetch') }}', after: 300 }
                    });
                }
            });
    });

    $(document).on('click', '#btnreloaddata', function (event) {
        event.preventDefault();
        clearSearch();
        loadTable('{{ route('api.bahari-ai-custom-answer.fetch') }}', textserach);
    });

    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        loadTable('{{ route('api.bahari-ai-custom-answer.fetch') }}', textserach, page);
    });

    $(document).on('keyup', '#search-data', delay(function () {
        var search = textserach != this.value;
        textserach = this.value;
        if (search) {
            loadTable('{{ route('api.bahari-ai-custom-answer.fetch') }}', textserach);
        }
    }, 500));
});
</script>
@endsection
