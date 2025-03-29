<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_member'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <span class="text-danger">Maaf, ID Member Tidak Dapat Di Tangkap Oleh Sistem!!</span>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-primary">';
        echo '  <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">';
        echo '      <i class="mdi mdi-close"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        //Buka data member
        $id_member = $_POST['id_member'];
        $sql = "SELECT * FROM member WHERE id_member = '$id_member'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nik = $row['nik'];
        $nama= $row['nama'];
        $kontak= $row['kontak'];
        $alamat= $row['alamat'];
        $perusahaan= $row['perusahaan'];
?>
    <form action="javascript:void(0);" id="ProsesEditMember">
        <input type="hidden" name="id_member" id="id_member" value="<?php echo "$id_member"; ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label  for="nama"><b>Nama</b></label>
                    <input type="text" required id="nama" name="nama" class="form-control border-primary" value="<?php echo "$nama"; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label  for="nik"><b>NIK/No Identitas</b></label>
                    <input type="text" required id="nik" name="nik" class="form-control border-primary" value="<?php echo "$nik"; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label  for="kontak"><b>No.Kontak</b></label>
                    <input type="text" required id="kontak" name="kontak" class="form-control border-primary" value="<?php echo "$kontak"; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="perusahaan"><b>Perusahaan</b></label>
                    <input type="text" required id="perusahaan" name="perusahaan" class="form-control border-primary" value="<?php echo "$perusahaan"; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label  for="alamat"><b>Alamat Perusahaan</b></label>
                    <textarea class="form-control border-primary" rows="3" name="alamat"><?php echo "$alamat"; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md col-12 mt-3" id="NotifikasiEditMember">
                    <div class="alert alert-primary" role="alert">
                        Pastikan data yang anda input sudah benar dan lengkap!
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-primary">
            <button type="submit" class="btn btn-lg btn-dark btn-rounded btn-fw mr-3">
                <i class="menu-icon mdi mdi-check"></i> Simpan
            </button>
            <button type="button" class="btn btn-lg btn-scodary btn-rounded btn-fw" data-dismiss="modal">
                <i class="menu-icon mdi mdi-close"></i> Tutup
            </button>
        </div>
    </form>
<?php } ?>