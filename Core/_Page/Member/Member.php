<?php
    include "../../_Page/Member/MemberJs.php";
?>
<div class="row">
    <div class="col col-md-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary"><i class="menu-icon mdi mdi-account-multiple"></i> Data Supplier</h3>
                <small>Kelola data supplier barang</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" data-toggle="modal" data-target="#ModalTambahMember">
            <div class="card-body">
                <i class="menu-icon mdi mdi-account-plus icon-md"></i><br>
                Tambah
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" id="ReloadMember">
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
                        <div class="input-group">
                            <input type="text" class="form-control" id="PencarianMember" class="form-control" placeholder="Cari.." value="">
                            <div class="input-group-append border-primary">
                                <span class="input-group-text bg-transparent">
                                    <i class="mdi mdi-menu mdi-search-web"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  id="TabelMember">
                <!----- Tabel disini ----->
            </div>
        </div>
    </div>
</div>