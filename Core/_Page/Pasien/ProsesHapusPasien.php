<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_pasien'])){
        echo '<span class="text-danger"">';
        echo '  <i class="mdi mdi-close"></i> ID Ruang Inap Tidak Dapat Di Tangkap Oleh Sistem!!';
        echo '</span>';
    }else{
        //Tampilkan Data Ruang Inap
        $id_pasien = $_POST['id_pasien'];
        //Hapus pasien
        $sql = "DELETE FROM pasien WHERE id_pasien='$id_pasien'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<span class="text-success" id="NotifikasiHapusPasienBerhasil">Berhasil</span>';
        }else{
            echo '<span class="text-danger"">';
            echo '  <i class="mdi mdi-close"></i> Data Pasien Gagal Dihapus!!';
            echo '</span>';
        }
    }
?>