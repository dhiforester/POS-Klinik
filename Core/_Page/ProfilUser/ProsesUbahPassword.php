<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    //Tangkap variabel
    if(empty($_POST['password1'])){
        echo '<div class="alert alert-danger" role="alert">';
        echo '  Password Tidak Boleh Kosong!';
        echo '</div>';
    }else{
        if(empty($_POST['password2'])){
            echo '<div class="alert alert-danger" role="alert">';
            echo '  Password Harus Sama!';
            echo '</div>';
        }else{
            if($_POST['password1']!==$_POST['password2']){
                echo '<div class="alert alert-danger" role="alert">';
                echo '  Password Harus Sama!';
                echo '</div>';
            }else{
                $password1=$_POST['password1'];
                $password2=$_POST['password2'];
                //MD5 password
                $password=md5($password1);
                //Update data
                $QueryUpdateProfile = mysqli_query($conn, "UPDATE akses SET password='$password' WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($conn));
                if($QueryUpdateProfile){
                    echo '<div class="alert alert-success" role="alert">';
                    echo '  Data <span id="NotifikasiUbahPasswordBerhasil">Berhasil</span> Diperbarui!';
                    echo '</div>';
                }else{
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '  Data Gagal Diperbarui!';
                    echo '</div>';
                }
            }
        }
    }
?>