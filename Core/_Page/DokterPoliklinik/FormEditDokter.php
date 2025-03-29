<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_dokter'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <span class="text-danger">Maaf, ID Dokter Tidak Dapat Di Tangkap Oleh Sistem!!</span>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-primary">';
        echo '  <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">';
        echo '      <i class="mdi mdi-close"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        //Tampilkan Data Dokter
        $id_dokter = $_POST['id_dokter'];
        $sql = "SELECT * FROM dokter WHERE id_dokter='$id_dokter'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $dokter=$row['dokter'];
        $poliklinik=$row['poliklinik'];
        $status=$row['status'];
?>
    <form action="javascript:void(0);" id="ProsesEditDokterPoliklinik">
        <input type="hidden" name="id_dokter" id="id_dokter" value="<?php echo "$id_dokter"; ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="dokter">Nama Dokter</label>
                    <input type="text" name="dokter" id="dokter" class="form-control border-dark" value="<?php echo "$dokter"; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="poliklinik">Poliklinik</label>
                    <input type="text" name="poliklinik" id="poliklinik" class="form-control border-dark" value="<?php echo "$poliklinik"; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control border-dark">
                        <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($status=="Aktif"){echo "selected";} ?> value="Aktif">Aktif</option>
                        <option <?php if($status=="Non Aktif"){echo "selected";} ?> value="Non Aktif">Non Aktif</option>
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" id="NotifikasiEditPoliklinik">
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