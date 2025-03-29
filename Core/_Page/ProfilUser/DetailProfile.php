<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
?>
<div class="card">
    <div class="card-header">
        <h2>Detail Profile</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><b>ID Akses</b></td>
                        <td><?php echo "$SessionIdAkses";?></td>
                    </tr>
                    <tr>
                        <td><b>Nama Lengkap</b></td>
                        <td><?php echo "$SessionNama";?></td>
                    </tr>
                    <tr>
                        <td><b>Kontak</b></td>
                        <td><?php echo "$SessionKontak";?></td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td><?php echo "$SessionEmail";?></td>
                    </tr>
                    <tr>
                        <td><b>Akses Group</b></td>
                        <td><?php echo "$SessionAkses";?></td>
                    </tr>
                    <tr>
                        <td><b>Status</b></td>
                        <td><?php echo "$SessionStatus";?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-md btn-inverse-dark mr-3 mt-2 mb-2" data-toggle="modal" data-target="#ModalEditProfile">
            <i class="mdi mdi-pencil-box"></i> Edit Profile
        </button>
        <button type="button" class="btn btn-md btn-inverse-dark mt-2 mb-2" data-toggle="modal" data-target="#ModalUbahPassword">
            <i class="mdi mdi-pencil-circle"></i> Ubah Password
        </button>
    </div>
</div>