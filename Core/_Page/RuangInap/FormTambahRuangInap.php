<form action="javascript:void(0);" id="ProsesSimpanRuangInap">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label for="ruangan">Nama Ruangan</label>
                <input type="text" name="ruangan" id="ruangan" class="form-control border-dark">
            </div>
            <div class="col-md-6 mt-3">
                <label for="kelas">Kelas</label>
                <input type="text" name="kelas" id="kelas" class="form-control border-dark">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <label for="kuota_l">Kuota (L)</label>
                <input type="number" min="0" name="kuota_l" id="kuota_l" class="form-control border-dark">
            </div>
            <div class="col-md-6 mt-3">
                <label for="kuota_p">Kuota (P)</label>
                <input type="number" min="0" name="kuota_p" id="kuota_p" class="form-control border-dark">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <label for="kuota_lp">Kuota (LP)</label>
                <input type="number" min="0" name="kuota_lp" id="kuota_lp" class="form-control border-dark">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12" id="NotifikasiSimpanRuangInap">
                <span class="text-primary">Pastikan data yang input sudah sesuai</span>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-primary">
        <div class="row">
            <div class="form-group col-md-12 text-center">
                <button type="submit" class="btn btn-lg btn-rounded btn-dark mr-3">
                    <i class="mdi mdi-floppy"></i> Simpan
                </button>
                <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">
                    <i class="mdi mdi-close"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</form>