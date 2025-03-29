<?php
    //connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_kunjungan'])){
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
        $id_kunjungan = $_POST['id_kunjungan'];
        $sql = "SELECT * FROM kunjungan WHERE id_kunjungan='$id_kunjungan'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id_pasien=$row['id_pasien'];
        $nama=$row['nama'];
        $tanggal=$row['tanggal'];
        $keluhan=$row['keluhan'];
        $tujuan=$row['tujuan'];
        $id_dokter=$row['id_dokter'];
        $dokter=$row['dokter'];
        $id_ruang_inap=$row['id_ruang_inap'];
        $kelas=$row['kelas'];
        $ruangan=$row['ruangan'];
        $id_diagnosa=$row['id_diagnosa'];
        $tanggal_keluar=$row['tanggal_keluar'];
        $id_akses=$row['id_akses'];
        $nama_petugas=$row['nama_petugas'];
        $status=$row['status'];
        //Buka diagnosa
        $sql = "SELECT * FROM diagnosa WHERE id_diagnosa='$id_diagnosa'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $kode_diagnosa=$row['kode'];
        $short_des=$row['short_des'];
?>
    <div class="modal-body bg-white">
        <div class="row">
            <div class="col-md-12 table table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><b>No.RM</b></td>
                            <td><?php echo "$id_pasien"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama Lengkap</b></td>
                            <td><?php echo "$nama"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Kunjungan</b></td>
                            <td><?php echo "$tanggal"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Tujuan</b></td>
                            <td>
                                <?php 
                                    echo "$tujuan"; 
                                    if($tujuan=="Ranap"){
                                        echo "<p> <small>$kelas - $ruangan</small></p>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Keluhan</b></td>
                            <td><?php echo "$keluhan"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Dokter</b></td>
                            <td><?php echo "$dokter"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Diagnosa</b></td>
                            <td><?php echo "$kode_diagnosa ($short_des)"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal/Waktu Pulang</b></td>
                            <td><?php echo "$tanggal_keluar"; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-primary">
        <button class="btn btn-md btn-rounded btn-secondary" data-dismiss="modal">
            <i class="mdi mdi-close"></i> Tutup
        </button>
    </div>
<?php } ?>