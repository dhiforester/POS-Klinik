<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Menangkap data akses menjadi variabel
    if(empty($_POST['nama'])){
        echo '<div class="alert alert-danger" role="alert">Nama Tidak Boleh Kosong!!</div>';
    }else{
        if(empty($_POST['kontak'])){
            echo '<div class="alert alert-danger" role="alert">Kontak Tidak Boleh Kosong!!</div>';
        }else{
            if(empty($_POST['email'])){
                echo '<div class="alert alert-danger" role="alert">Email Tidak Boleh Kosong!!</div>';
            }else{
                if(empty($_POST['akses'])){
                    echo '<div class="alert alert-danger" role="alert">Akses Tidak Boleh Kosong!!</div>';
                }else{
                    if(empty($_POST['password1'])){
                        echo '<div class="alert alert-danger" role="alert">Password Tidak Boleh Kosong!!</div>';
                    }else{
                        if(empty($_POST['password2'])){
                            echo '<div class="alert alert-danger" role="alert">Password Tidak Boleh Kosong!!</div>';
                        }else{
                            if(empty($_POST['status'])){
                                echo '<div class="alert alert-danger" role="alert">Status Tidak Boleh Kosong!!</div>';
                            }else{
                                if($_POST['password1']!==$_POST['password1']){
                                    echo '<div class="alert alert-danger" role="alert">Password Tidak Sama!!</div>';
                                }else{
                                    //Jumlah karakter nama
                                    if(strlen($_POST['nama'])>25){
                                        echo '<div class="alert alert-danger" role="alert">Nama Terlalu Panjang!!</div>';
                                    }else{
                                        //Jumlah karakter kontak
                                        if(strlen($_POST['kontak'])>25){
                                            echo '<div class="alert alert-danger" role="alert">Kontak Terlalu Panjang!!</div>';
                                        }else{
                                            //Jumlah Karakter Akses
                                            if(strlen($_POST['akses'])>25){
                                                echo '<div class="alert alert-danger" role="alert">Nama Akses Group Terlalu Panjang!!</div>';
                                            }else{
                                                //Jumlah karakter password
                                                if(strlen($_POST['password1'])>25){
                                                    echo '<div class="alert alert-danger" role="alert">Password Terlalu Panjang!!</div>';
                                                }else{
                                                    //Validasi email apakah sudah ada?
                                                    $sql = "SELECT * FROM akses WHERE email='$_POST[email]'";
                                                    $query = mysqli_query($conn,$sql);
                                                    $cek = mysqli_num_rows($query);
                                                    if($cek>0){
                                                        echo '<div class="alert alert-danger" role="alert">Email Sudah Terdaftar!!</div>';
                                                    }else{
                                                        $nama=$_POST['nama'];
                                                        $kontak=$_POST['kontak'];
                                                        $email=$_POST['email'];
                                                        $akses=$_POST['akses'];
                                                        $password1=$_POST['password1'];
                                                        $password2=$_POST['password2'];
                                                        $status=$_POST['status'];
                                                        //MD5 Password1
                                                        $password1=md5($password1);
                                                        $entry="INSERT INTO akses (
                                                            nama,
                                                            email,
                                                            kontak,
                                                            password,
                                                            status,
                                                            akses
                                                        ) VALUES (
                                                            '$nama',
                                                            '$email',
                                                            '$kontak',
                                                            '$password1',
                                                            '$status',
                                                            '$akses'
                                                        )";
                                                        $hasil=mysqli_query($conn, $entry);
                                                        if($hasil){
                                                            echo '<div class="alert alert-success" role="alert">';
                                                            echo '  <strong>KETERANGAN INPUT DATA:</strong><div id="NotifikasiProsesTambahUser">Berhasil</div>.';
                                                            echo '</div>';
                                                        }else{
                                                            echo '<div class="alert alert-warning" role="alert">';
                                                            echo '  <strong>KETERANGAN :</strong><br> Input data user gagal, periksa koneksi anda.';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>