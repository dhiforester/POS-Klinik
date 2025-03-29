<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Menangkap data akses menjadi variabel
    if(empty($_POST['id_akses'])){
        echo '<div class="alert alert-danger" role="alert">ID Akses Tidak Boleh Kosong!!</div>';
    }else{
        //Buka data pelanggan berdasarkan IdPelanggan
        $QryUser = mysqli_query($conn, "SELECT * FROM akses WHERE id_akses='$_POST[id_akses]'")or die(mysqli_error($conn));
        $DataUser = mysqli_fetch_array($QryUser);
        $EmailLama = $DataUser['email'];
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
                                                        if($EmailLama!==$_POST['email']){
                                                            $sql = "SELECT * FROM akses WHERE email='$_POST[email]'";
                                                            $query = mysqli_query($conn,$sql);
                                                            $cek = mysqli_num_rows($query);
                                                        }else{
                                                            $cek = 0;
                                                        }
                                                        if($cek>0){
                                                            echo '<div class="alert alert-danger" role="alert">Email Sudah Terdaftar!!</div>';
                                                        }else{
                                                            $id_akses=$_POST['id_akses'];
                                                            $nama=$_POST['nama'];
                                                            $kontak=$_POST['kontak'];
                                                            $email=$_POST['email'];
                                                            $akses=$_POST['akses'];
                                                            $password1=$_POST['password1'];
                                                            $password2=$_POST['password2'];
                                                            $status=$_POST['status'];
                                                            if(!empty($_POST['page'])){
                                                                $page=$_POST['page'];
                                                            }else{
                                                                $page="";
                                                            }
                                                            if(!empty($_POST['BatasData'])){
                                                                $BatasData=$_POST['BatasData'];
                                                            }else{
                                                                $BatasData="";
                                                            }
                                                            //Update akses
                                                            //MD5 Password1
                                                            $password1=md5($password1);
                                                            $sql = "UPDATE akses SET 
                                                                nama='$nama', 
                                                                kontak='$kontak', 
                                                                email='$email', 
                                                                akses='$akses', 
                                                                password='$password1', 
                                                                status='$status' 
                                                            WHERE id_akses='$id_akses'";
                                                            $query = mysqli_query($conn,$sql);
                                                            if($query){
                                                                echo '<div class="alert alert-success" role="alert">';
                                                                echo '  <strong>KETERANGAN INPUT DATA:</strong><div id="NotifikasiProsesEditUser">Berhasil</div>.';
                                                                echo '  <div id="page">'.$page.'</div>.';
                                                                echo '  <div id="BatasData">'.$BatasData.'</div>.';
                                                                echo '</div>';
                                                            }else{
                                                                echo '<div class="alert alert-warning" role="alert">';
                                                                echo '  <strong>KETERANGAN :</strong><br> Update akses gagal, periksa koneksi anda.';
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
    }
?>