<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Menangkap data akses menjadi variabel
    if(empty($_POST['nama'])){
        echo '<div class="alert alert-danger" role="alert">';
        echo '  Nama Supplier Tidak Boleh Kosong!!';
        echo '</div>';
    }else{
        if(empty($_POST['nik'])){
            echo '<div class="alert alert-danger" role="alert">';
            echo '  NIK Supplier Tidak Boleh Kosong!!';
            echo '</div>';
        }else{
            if(empty($_POST['kontak'])){
                echo '<div class="alert alert-danger" role="alert">';
                echo '  Kontak Supplier Tidak Boleh Kosong!!';
                echo '</div>';
            }else{
                if(empty($_POST['alamat'])){
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '  Alamat Supplier Tidak Boleh Kosong!!';
                    echo '</div>';
                }else{
                    if(empty($_POST['perusahaan'])){
                        echo '<div class="alert alert-danger" role="alert">';
                        echo '  Nama Perusahaan Supplier Tidak Boleh Kosong!!';
                        echo '</div>';
                    }else{
                        if(empty($_POST['id_member'])){
                            echo '<div class="alert alert-danger" role="alert">';
                            echo '  ID Supplier Tidak Boleh Kosong!!';
                            echo '</div>';
                        }else{
                            $id_member=$_POST['id_member'];
                            $nik=$_POST['nik'];
                            $nik=$_POST['nik'];
                            $nama=$_POST['nama'];
                            $kontak=$_POST['kontak'];
                            $alamat=$_POST['alamat'];
                            $perusahaan=$_POST['perusahaan'];
                            //Update member
                            $sql = "UPDATE member SET 
                                nik='$nik', 
                                nama='$nama', 
                                kontak='$kontak', 
                                alamat='$alamat', 
                                perusahaan='$perusahaan' 
                            WHERE id_member='$id_member'";
                            if(mysqli_query($conn, $sql)){
                                echo '<div class="alert alert-success" role="alert">';
                                echo '  <span id="NotifikasiEditMemberBerhasil">Berhasil</span>';
                                echo '</div>';
                            }else{
                                echo '<div class="alert alert-danger" role="alert">';
                                echo '  Data Supplier Gagal Ditambahkan!!';
                                echo '</div>';
                            }
                        }
                    }
                }
            }
        }
    }
?>