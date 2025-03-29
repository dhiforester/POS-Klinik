<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_dokter'])){
        echo '<span class="text-danger"">';
        echo '  <i class="mdi mdi-close"></i> ID Dokter Tidak Dapat Di Tangkap Oleh Sistem!!';
        echo '</span>';
    }else{
        //Tampilkan Data Dokter
        $id_dokter = $_POST['id_dokter'];
        //Hapus dokter
        $sql = "DELETE FROM dokter WHERE id_dokter='$id_dokter'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<span class="text-success" id="NotifikasiHapusPoliklinikBerhasil">Berhasil</span>';
        }else{
            echo '<span class="text-danger"">';
            echo '  <i class="mdi mdi-close"></i> Data Dokter Gagal Dihapus!!';
            echo '</span>';
        }
    }
?>