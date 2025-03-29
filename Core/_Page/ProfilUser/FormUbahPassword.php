<?php
    //koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
?>
<form action="javascript:void(0);" id="ProsesUbahPassword" autocomplete="off">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="password1">Password Baru</label>
                <input type="password" name="password1" id="password1" class="form-control border-dark" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="password2">Ulangi Password</label>
                <input type="password" name="password2" id="password2" class="form-control border-dark" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md col-12 mt-3" id="NotifikasiUbahPassword">
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