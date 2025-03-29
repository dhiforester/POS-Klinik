<?php
    //koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
?>
<form action="javascript:void(0);" id="ProsesEditProfile" autocomplete="off">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control border-dark" value="<?php echo "$SessionNama"; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="kontak">No.Kontak</label>
                <input type="text" name="kontak" id="kontak" class="form-control border-dark" value="<?php echo "$SessionKontak"; ?>" placeholder="+62" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control border-dark" placeholder="youremail@domain.com" value="<?php echo "$SessionEmail"; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md col-12 mt-3" id="NotifikasiEditProfile">
                <div class="alert alert-primary" role="alert">
                    Pastikan data yang anda input sudah lengkap!
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-primary">
        <button type="submit" class="btn btn-dark btn-lg mr-3">
                <i class="menu-icon mdi mdi-floppy"></i> Simpan
            </button>
            <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">
                <i class="menu-icon mdi mdi-close"></i> Tutup
            </button>
    </div>
</form>