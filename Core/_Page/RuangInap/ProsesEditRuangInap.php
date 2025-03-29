<?php
    //Connection
    //Time Zone Indonesia
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";
    //Variabel
    if(empty($_POST['id_ruang_inap'])){
        echo '<span class="text-danger">Maaf, ID Ruang Inap tidak boleh kosong!</span>';
    }else{
        if(empty($_POST['ruangan'])){
            echo '<span class="text-danger">Maaf, ruangan tidak boleh kosong!</span>';
        }else{
            if(empty($_POST['kelas'])){
                echo '<span class="text-danger">Maaf, kelas tidak boleh kosong!</span>';
            }else{
                $id_ruang_inap=$_POST['id_ruang_inap'];
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
                //Simpan Ruang Inap
                $sql_simpan_ruang_inap="UPDATE ruang_inap SET 
                    ruangan='$ruangan', 
                    kelas='$kelas', 
                    kuota_l='$kuota_l', 
                    kuota_p='$kuota_p', 
                    kuota_lp='$kuota_lp' 
                WHERE id_ruang_inap='$id_ruang_inap'";
                if($sql_simpan_ruang_inap){
                    echo '<span class="text-success" id="NotifikasiEditRuangInapBerhasil">Berhasil</span>';
                }else{
                    echo '<span class="text-danger">Data gagal disimpan!</span>';
                }
            }
        }
    }
?>