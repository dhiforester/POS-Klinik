<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_pasien'])){
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
        $id_pasien = $_POST['id_pasien'];
        $sql = "SELECT * FROM pasien WHERE id_pasien='$id_pasien'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nik=$row['nik'];
        $nama=$row['nama'];
        $gender=$row['gender'];
        $tanggal_lahir=$row['tanggal_lahir'];
        $alamat=$row['alamat'];
        $kontak=$row['kontak'];
        $status=$row['status'];
        $updatetime=$row['updatetime'];
?>
    <form action="javascript:void(0);" id="ProsesEditPasien">
        <input type="hidden" name="updatetime" id="updatetime" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <input type="hidden" name="id_pasien" id="id_pasien" value="<?php echo "$id_pasien"; ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4 mt-3">
                    <label for="nik">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control border-dark" value="<?php echo "$nik"; ?>">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control border-dark" value="<?php echo "$nama"; ?>" required>
                </div>
                <div class="col-md-4 mt-3">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control border-dark" value="<?php echo "$gender"; ?>" required>
                        <option <?php if($gender==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($gender=="Laki-laki"){echo "selected";} ?> value="Laki-laki">Laki-laki</option>
                        <option <?php if($gender=="Perempuan"){echo "selected";} ?> value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control border-dark" value="<?php echo "$tanggal_lahir"; ?>">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="kontak">Kontak</label>
                    <input type="text" name="kontak" id="kontak" class="form-control border-dark" value="<?php echo "$kontak"; ?>">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control border-dark" required>
                        <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($status=="Aktif"){echo "selected";} ?> value="Aktif">Aktif</option>
                        <option <?php if($status=="Non Aktif"){echo "selected";} ?> value="Non Aktif">Non Aktif</option>
                        <option <?php if($status=="Meninggal"){echo "selected";} ?> value="Meninggal">Meninggal</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control border-dark"><?php echo "$alamat"; ?></textarea>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" id="NotifikasiEditPasien">
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