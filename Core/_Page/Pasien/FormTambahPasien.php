<form action="javascript:void(0);" id="ProsesSimpanPasien">
    <input type="hidden" name="updatetime" id="updatetime" value="<?php echo date('Y-m-d H:i:s'); ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4 mt-3">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control border-dark">
            </div>
            <div class="col-md-4 mt-3">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control border-dark" required>
            </div>
            <div class="col-md-4 mt-3">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control border-dark" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control border-dark">
            </div>
            <div class="col-md-4 mt-3">
                <label for="kontak">Kontak</label>
                <input type="text" name="kontak" id="kontak" class="form-control border-dark">
            </div>
            <div class="col-md-4 mt-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control border-dark" required>
                    <option value="">Pilih</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non Aktif">Non Aktif</option>
                    <option value="Meninggal">Meninggal</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control border-dark"></textarea>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12" id="NotifikasiSimpanPasien">
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