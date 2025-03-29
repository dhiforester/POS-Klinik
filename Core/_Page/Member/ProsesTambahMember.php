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
                        $nik=$_POST['nik'];
                        $nama=$_POST['nama'];
                        $kontak=$_POST['kontak'];
                        $alamat=$_POST['alamat'];
                        $perusahaan=$_POST['perusahaan'];
                        //Simpan data member
                        $sql = "INSERT INTO member (
                            nik, 
                            nama, 
                            alamat, 
                            kontak, 
                            perusahaan
                        ) VALUES (
                            '$nik', 
                            '$nama', 
                            '$alamat', 
                            '$kontak', 
                            '$perusahaan'
                        )";
                        $query = mysqli_query($conn, $sql);
                        if($query){
                            echo '<div class="alert alert-success" role="alert">';
                            echo '  <span id="NotifikasiTambahMemberBerhasil">Berhasil</span>';
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
?>