<?php
    //Connection
    //Time Zone Indonesia
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";
    //Variabel
    if(empty($_POST['ruangan'])){
        echo '<span class="text-danger">Maaf, ruangan tidak boleh kosong!</span>';
    }else{
        if(empty($_POST['kelas'])){
            echo '<span class="text-danger">Maaf, kelas tidak boleh kosong!</span>';
        }else{
            $ruangan=$_POST['ruangan'];
            $kelas=$_POST['kelas'];
            if(empty($_POST['kuota_l'])){
                $kuota_l="0";
            }else{
                $kuota_l=$_POST['kuota_l'];
            }
            if(empty($_POST['kuota_p'])){
                $kuota_p="0";
            }else{
                $kuota_p=$_POST['kuota_p'];
            }
            if(empty($_POST['kuota_lp'])){
                $kuota_lp="0";
            }else{
                $kuota_lp=$_POST['kuota_lp'];
            }
            //Simpan
            $sql=mysqli_query($conn, "INSERT INTO ruang_inap (
                ruangan, 
                kelas, 
                kuota_l, 
                kuota_p,
                kuota_lp
            ) VALUES(
                '$ruangan', 
                '$kelas', 
                '$kuota_l', 
                '$kuota_p',
                '$kuota_lp'
            )");
            if($sql){
                echo '<span class="text-success" id="NotifikasiSimpanRuangInapBerhasil">Berhasil</span>';
            }else{
                echo '<span class="text-danger">Data gagal disimpan!</span>';
            }
        }
    }
?>