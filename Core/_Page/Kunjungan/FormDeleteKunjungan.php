<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_kunjungan'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <span class="text-danger">Maaf, ID Kunjungan Tidak Dapat Di Tangkap Oleh Sistem!!</span>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-primary">';
        echo '  <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">';
        echo '      <i class="mdi mdi-close"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        $id_kunjungan = $_POST['id_kunjungan'];
?>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="images/delete.png" alt="Hapus" width="80%">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center" id="NotifikasiHapusKunjungan">
                <span class="text-danger">Apakah anda yakin akan menghapus data ini?</span>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-12 mt-4 mb-4 text-center">
                <button type="button" class="btn btn-md btn-rounded btn-danger" id="ClickDeleteKunjungan">
                    <i class="mdi mdi-check"></i> Ya
                </button>
                <button class="btn btn-md btn-rounded btn-dark" data-dismiss="modal">
                    <i class="mdi mdi-close"></i> Tidak
                </button>
            </div>
        </div>
    </div>
<?php } ?>