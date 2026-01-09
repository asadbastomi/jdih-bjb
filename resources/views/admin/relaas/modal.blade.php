<div id="modalForm" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formRelaas">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Relaas</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="relaasId">

                    <div class="form-group">
                        <label>Nomor</label>
                        <input type="text" class="form-control" id="nomor" name="nomor" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="">Pilih Jenis</option>
                            <option value="panggilan">Panggilan</option>
                            <option value="pemberitahuan">Pemberitahuan</option>
                            <option value="eksekusi">Eksekusi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label>Pihak Terkait</label>
                        <input type="text" class="form-control" id="pihak_terkait" name="pihak_terkait" required>
                    </div>

                    <div class="form-group">
                        {{-- <label>Status</label> --}}
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="berlaku" selected>Berlaku</option>
                            <option value="tidak-berlaku">Tidak Berlaku</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Konten</label>
                        <textarea class="form-control" id="konten" name="konten" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Dokumen</label>
                        <input type="file" data-plugins="dropify" accept="application/pdf" id="dokumen"
                            name="dokumen" />
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
