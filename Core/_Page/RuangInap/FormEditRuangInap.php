<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_ruang_inap'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <span class="text-danger">Maaf, ID Ruangan Tidak Dapat Di Tangkap Oleh Sistem!!</span>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-primary">';
        echo '  <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">';
        echo '      <i class="mdi mdi-close"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        //Tampilkan Data ruang inap
        $id_ruang_inap = $_POST['id_ruang_inap'];
        $sql = "SELECT * FROM ruang_inap WHERE id_ruang_inap='$id_ruang_inap'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $ruangan=$row['ruangan'];
        $kelas=$row['kelas'];
        $kuota_l=$row['kuota_l'];
        $kuota_p=$row['kuota_p'];
        $kuota_lp=$row['kuota_lp'];
?>
    <form action="javascript:void(0);" id="ProsesEditRuangInap">
        <input type="hidden" name="id_ruang_inap" id="id_ruang_inap" value="<?php echo "$id_ruang_inap"; ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="ruangan">Nama Ruangan</label>
                    <input type="text" name="ruangan" id="ruangan" class="form-control border-dark" value="<?php echo "$ruangan"; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="kelas">Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control border-dark" value="<?php echo "$kelas"; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="kuota_l">Kuota (L)</label>
                    <input type="number" min="0" name="kuota_l" id="kuota_l" class="form-control border-dark" value="<?php echo "$kuota_l"; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="kuota_p">Kuota (P)</label>
                    <input type="number" min="0" name="kuota_p" id="kuota_p" class="form-control border-dark" value="<?php echo "$kuota_p"; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="kuota_lp">Kuota (LP)</label>
                    <input type="number" min="0" name="kuota_lp" id="kuota_lp" class="form-control border-dark" value="<?php echo "$kuota_lp"; ?>">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" id="NotifikasiEditRuangInap">
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
<?php } ?>