<?php
    include "PasienJs.php";
?>
<div class="row">
    <div class="col col-md-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary"><i class="menu-icon mdi mdi-clipboard-account"></i> Data Pasien</h3>
                <small>Kelola data rekam medis pasien</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center" data-toggle="modal" data-target="#ModalTambahPasien">
        <div class="card card-statistics bg-inverse-dark">
            <div class="card-body">
                <i class="menu-icon mdi mdi-plus-box icon-md"></i><br>
                Tambah
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" id="ReloadPasien">
            <div class="card-body">
                <i class="mdi mdi mdi-reload icon-md"></i><br>
                Reload
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card bg-inverse-dark">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <form class="input-group">
                            <input type="text" class="form-control" id="PencarianPasien" class="form-control" placeholder="Cari.." value="">
                        </form>
                    </div>
                </div>
            </div>
            <div  id="TabelPasien">
                <!----- Tabel Pasien disini ----->
            </div>
        </div>
    </div>
</div>