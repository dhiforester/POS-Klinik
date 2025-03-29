<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_ruang_inap'])){
        echo '<span class="text-danger"">';
        echo '  <i class="mdi mdi-close"></i> ID Ruang Inap Tidak Dapat Di Tangkap Oleh Sistem!!';
        echo '</span>';
    }else{
        //Tampilkan Data Ruang Inap
        $id_ruang_inap = $_POST['id_ruang_inap'];
        //Hapus ruang_inap
        $sql = "DELETE FROM ruang_inap WHERE id_ruang_inap='$id_ruang_inap'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<span class="text-success" id="NotifikasiHapusRuangInapBerhasil">Berhasil</span>';
        }else{
            echo '<span class="text-danger"">';
            echo '  <i class="mdi mdi-close"></i> Data Ruang Inap Gagal Dihapus!!';
            echo '</span>';
        }
    }
?>