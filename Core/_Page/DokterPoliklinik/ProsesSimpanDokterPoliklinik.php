<?php
    //Connection
    //Time Zone Indonesia
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";
    //Variabel
    if(empty($_POST['dokter'])){
        echo '<span class="text-danger">Maaf, dokter tidak boleh kosong!</span>';
    }else{
        if(empty($_POST['poliklinik'])){
            echo '<span class="text-danger">Maaf, poliklinik tidak boleh kosong!</span>';
        }else{
            if(empty($_POST['status'])){
                echo '<span class="text-danger">Maaf, status tidak boleh kosong!</span>';
            }else{
                $dokter=$_POST['dokter'];
                $poliklinik=$_POST['poliklinik'];
                $status=$_POST['status'];
                $tanggal=date("Y-m-d H:i:s");
                //Simpan
                $sql=mysqli_query($conn, "INSERT INTO dokter (dokter, poliklinik, status, updatetime) VALUES('$dokter', '$poliklinik', '$status', '$tanggal')");
                if($sql){
                    echo '<span class="text-success" id="NotifikasiSimpanPoliklinikBerhasil">Berhasil</span>';
                }else{
                    echo '<span class="text-danger">Data gagal disimpan!</span>';
                }
            }
        }
    }
?>