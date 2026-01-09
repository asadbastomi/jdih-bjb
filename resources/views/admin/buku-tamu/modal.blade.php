<div id="modalForm" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formBukuTamu">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Buku Tamu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="bukuTamuId">

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="asal_instansi">Asal Instansi</label>
                        <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" required>
                    </div>

                    <div class="form-group">
                        <label for="no_wa">Nomor WA</label>
                        <input type="text" class="form-control" id="no_wa" name="no_wa" required>
                    </div>

                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <textarea class="form-control" id="keperluan" name="keperluan" required></textarea>
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
