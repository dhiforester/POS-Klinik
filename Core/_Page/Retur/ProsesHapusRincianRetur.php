<?php
    //error display
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Menangkap data akses menjadi variabel
    $id_rincian_retur=$_POST['id_rincian_retur'];
    $query = mysqli_query($conn, "DELETE FROM retur_rincian WHERE id_rincian_retur='$id_rincian_retur'") or die(mysqli_error($conn));    
    if($query){
        echo '<div id="NotifikasiRincianReturBerhasil" class="text-success">Proses Hapus Berhasil</div>';
    }else{
        echo '<div id="NotifikasiRincianReturBerhasil" class="text-danger">Proses Hapus Gagal</div>';
    }
?>