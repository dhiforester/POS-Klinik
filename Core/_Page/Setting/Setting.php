<?php
    //koneksi dan error
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
?>

<script>
    $(document).ready(function(){
        $('#FormSetting').load("_Page/Setting/FormSettingAplikasi.php");
        $('#MenuSetting').load("_Page/Setting/MenuSetting.php");
    });
</script>
<div class="row">
    <div class="col col-md-8 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary"><i class="menu-icon mdi mdi-settings"></i> Setting Sistem</h3>
                <small>
                    Atur profil perusahaan, ukuran dan jenis huruf, logo, ukuran kertas label, draft laporan dan lain-lain.
                </small>
            </div>
        </div>
    </div>
    <div class="col col-md-4" id="MenuSetting">
        <!----- Menu atas setting disini ----->
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card">
            <div  id="FormSetting">
                <!----- Tabel disini ----->
            </div>
        </div>
    </div>
</div>