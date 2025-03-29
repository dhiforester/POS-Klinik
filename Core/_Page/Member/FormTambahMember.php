<form action="javascript:void(0);" autocomplete="off" id="ProsesTambahMember">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label  for="nama"><b>Nama</b></label>
                <input type="text" required id="nama" name="nama" class="form-control border-primary">
            </div>
            <div class="col-md-6 mt-3">
                <label  for="nik"><b>NIK/No Identitas</b></label>
                <input type="text" required id="nik" name="nik" class="form-control border-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <label  for="kontak"><b>No.Kontak</b></label>
                <input type="text" required id="kontak" name="kontak" class="form-control border-primary">
            </div>
            <div class="col-md-6 mt-3">
                <label for="perusahaan"><b>Perusahaan</b></label>
                <input type="text" required id="perusahaan" name="perusahaan" class="form-control border-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <label  for="alamat"><b>Alamat Perusahaan</b></label>
                <textarea class="form-control border-primary" rows="3" name="alamat"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md col-12 mt-3" id="NotifikasiTambahMember">
                <div class="alert alert-primary" role="alert">
                    Pastikan data yang anda input sudah benar dan lengkap!
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-dark">
        <button type="submit" class="btn btn-lg btn-primary btn-rounded btn-fw mr-3">
            <i class="menu-icon mdi mdi-check"></i> Simpan
        </button>
        <button type="button" class="btn btn-lg btn-scodary btn-rounded btn-fw" data-dismiss="modal">
            <i class="menu-icon mdi mdi-close"></i> Tutup
        </button>
    </div>
</form>