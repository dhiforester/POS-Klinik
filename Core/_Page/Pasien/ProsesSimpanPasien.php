<?php
    //Connection
    //Time Zone Indonesia
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";
    //Variabel
    if(empty($_POST['nama'])){
        echo '<span class="text-danger">Maaf, Nama Pasien tidak boleh kosong!</span>';
    }else{
        if(empty($_POST['gender'])){
            echo '<span class="text-danger">Maaf, gender tidak boleh kosong!</span>';
        }else{
            if(empty($_POST['status'])){
                echo '<span class="text-danger">Maaf, Status Pasien tidak boleh kosong!</span>';
            }else{
                if(empty($_POST['updatetime'])){
                    echo '<span class="text-danger">Maaf, updatetime tidak boleh kosong!</span>';
                }else{
                    $nama=$_POST['nama'];
                    $gender=$_POST['gender'];
                    $status=$_POST['status'];
                    $updatetime=$_POST['updatetime'];
                    if(empty($_POST['nik'])){
                        $nik="0";
                    }else{
                        $nik=$_POST['nik'];
                    }
                    if(empty($_POST['tanggal_lahir'])){
                        $tanggal_lahir="";
                    }else{
                        $tanggal_lahir=$_POST['tanggal_lahir'];
                    }
                    if(empty($_POST['kontak'])){
                        $kontak="";
                    }else{
                        $kontak=$_POST['kontak'];
                    }
                    if(empty($_POST['alamat'])){
                        $alamat="";
                    }else{
                        $alamat=$_POST['alamat'];
                    }
                    //Simpan
                    $sql=mysqli_query($conn, "INSERT INTO pasien (
                        nik, 
                        nama, 
                        gender, 
                        tanggal_lahir,
                        alamat,
                        kontak,
                        status,
                        updatetime
                    ) VALUES(
                        '$nik', 
                        '$nama', 
                        '$gender', 
                        '$tanggal_lahir',
                        '$alamat',
                        '$kontak',
                        '$status',
                        '$updatetime'
                    )");
                    if($sql){
                        echo '<span class="text-success" id="NotifikasiSimpanPasienBerhasil">Berhasil</span>';
                    }else{
                        echo '<span class="text-danger">Data gagal disimpan!</span>';
                    }
                }
            }
        }
    }
?>