<form action="javascript:void(0);" id="ProsesSimpanDokterPoliklinik">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label for="dokter">Nama Dokter</label>
                <input type="text" name="dokter" id="dokter" class="form-control border-dark">
            </div>
            <div class="col-md-6 mt-3">
                <label for="poliklinik">Poliklinik</label>
                <input type="text" name="poliklinik" id="poliklinik" class="form-control border-dark">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control border-dark">
                    <option value="">Pilih</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non Aktif">Non Aktif</option>
                </select>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12" id="NotifikasiSimpanPoliklinik">
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