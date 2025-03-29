<?php
    //Connection
    //Time Zone Indonesia
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";
    //Variabel
    if(empty($_POST['id_pasien'])){
        echo '<span class="text-danger">Maaf, ID Pasien tidak boleh kosong!</span>';
    }else{
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
                        $id_pasien=$_POST['id_pasien'];
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
                        //Update pasien
                        $sql="UPDATE pasien SET 
                            nama='$nama',
                            nik='$nik',
                            gender='$gender',
                            tanggal_lahir='$tanggal_lahir',
                            kontak='$kontak',
                            alamat='$alamat',
                            status='$status',
                            updatetime='$updatetime'
                            WHERE id_pasien='$id_pasien'";
                        $query=mysqli_query($conn,$sql);
                        if($query){
                            echo '<span class="text-success" id="NotifikasiEditPasienBerhasil">Berhasil</span>';
                        }else{
                            echo '<span class="text-danger">Data gagal disimpan!</span>';
                        }
                    }
                }
            }
        }
    }
?>