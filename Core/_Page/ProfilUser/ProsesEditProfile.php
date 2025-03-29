<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    //Tangkap variabel
    if(empty($_POST['nama'])){
        echo '<div class="alert alert-danger" role="alert">';
        echo '  Nama Tidak Boleh Kosong!';
        echo '</div>';
    }else{
        if(empty($_POST['kontak'])){
            echo '<div class="alert alert-danger" role="alert">';
            echo '  Kontak HP Tidak Boleh Kosong!';
            echo '</div>';
        }else{
            if(empty($_POST['email'])){
                echo '<div class="alert alert-danger" role="alert">';
                echo '  Alamat Email Tidak Boleh Kosong!';
                echo '</div>';
            }else{
                $nama=$_POST['nama'];
                $kontak=$_POST['kontak'];
                $email=$_POST['email'];
                //Update data
                $QueryUpdateProfile = mysqli_query($conn, "UPDATE akses SET nama='$nama', kontak='$kontak', email='$email' WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($conn));
                if($QueryUpdateProfile){
                    echo '<div class="alert alert-success" role="alert">';
                    echo '  Data <span id="NotifikasiEditProfileBerhasil">Berhasil</span> Diperbarui!';
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