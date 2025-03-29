<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_kunjungan'])){
        echo '<span class="text-danger"">';
        echo '  <i class="mdi mdi-close"></i> ID Kunjungan Tidak Dapat Di Tangkap Oleh Sistem!!';
        echo '</span>';
    }else{
        //Tampilkan Data Kunjungan
        $id_kunjungan = $_POST['id_kunjungan'];
        //Hapus Kunjungan
        $sql = "DELETE FROM kunjungan WHERE id_kunjungan='$id_kunjungan'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<span class="text-success" id="NotifikasiHapusKunjunganBerhasil">Berhasil</span>';
        }else{
            echo '<span class="text-danger"">';
            echo '  <i class="mdi mdi-close"></i> Data Kunjungan Gagal Dihapus!!';
            echo '</span>';
        }
    }
?>