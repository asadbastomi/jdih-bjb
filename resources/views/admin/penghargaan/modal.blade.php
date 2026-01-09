<div id="modalForm" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formPenghargaan">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Penghargaan</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="penghargaanId">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label>Detail</label>
                        <textarea class="form-control" id="detail" name="detail"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Gambar</label>
                        <input type="file" data-plugins="dropify" accept="image/png,image/gif,image/jpeg"
                            id="image" name="image" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
