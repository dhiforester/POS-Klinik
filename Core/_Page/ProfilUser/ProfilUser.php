<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Page/ProfilUser/ProfilUserJs.php";
?>
<div class="row">
    <div class="col col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-md btn-primary mt-2 mr-2" id="DetailProfile">
                            Detail Profile
                        </button>
                        <button type="button" class="btn btn-md btn-secondary mt-2 mr-2" id="DetailAkses">
                            Detail Akses
                        </button>
                        <button type="button" class="btn btn-md btn-secondary mt-2 mr-2" id="KartuPasien">
                            Kartu Pasien
                        </button>
                        <button type="button" class="btn btn-md btn-secondary mt-2 mr-2" id="LabelObat">
                            Label Obat
                        </button>
                        <!-- <button type="button" class="btn btn-md btn-secondary mt-2 mr-2" id="LabelResep">
                            Label Resep
                        </button> -->
                        <button type="button" class="btn btn-md btn-secondary mt-2 mr-2" id="CetakNota">
                            Nota
                        </button>
                        <!-- <button type="button" class="btn btn-md btn-secondary mt-2 mr-2" id="CetakLaporan">
                            Laporan
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-12 grid-margin" id="HalamanProfile">
        <!-- Halaman Profile Ditampilkan Disini -->
    </div>
</div>

