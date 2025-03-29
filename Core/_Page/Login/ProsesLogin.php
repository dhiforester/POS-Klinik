<?php
    //KONEKSI KE DATABASE SQL
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //TANGKAP VARIABEL DARI FORMULIR LOGIN.PHP
    if(empty($_POST["email"])){
        echo '<span>Email Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST["password"])){
            echo '<span class="text-danger">Password Tidak Boleh Kosong!</span>';
        }else{
            $email=$_POST["email"];
            $password=$_POST["password"];
            //MD5 PASSWORD
            $password = md5($password);
            //QUERY MEMANGGIL DATA DARI DATABASE PELANGGAN
            $QueryLogin = mysqli_query($conn, "SELECT * FROM akses WHERE email='$email' AND password='$password'")or die(mysqli_error($conn));
            $DataLogin= mysqli_fetch_array($QueryLogin);
            if(empty($DataLogin['id_akses'])){
                echo '<span class="text-danger">Password Dan Email Yang Anda Masukan Tidak Valid!</span>';
            }else{
                if($DataLogin['status']=='Aktif'){
                    session_start();
                    $_SESSION["id_akses"]=$DataLogin['id_akses'];
                    echo '<div id="notifikasi">Berhasil</div>';
                }else{
                    echo '<span class="text-danger">Maaf! anda tidak bisa melakukan login karena status akun anda tidak aktif.</span>';
                }
            }
        }
    }
?>