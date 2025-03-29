<?php
    session_start();
    if (isset($_SESSION['id_akses']) || !empty($_SESSION['id_akses'])){
        $SessionIdAkses=$_SESSION['id_akses'];
        //panggil dari database
        $QuerySessionAkses = mysqli_query($conn, "SELECT * FROM akses WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($conn));
        $DataSessionAkses = mysqli_fetch_array($QuerySessionAkses);
        if(!empty($DataSessionAkses['id_akses'])){
            //rincian profile user
            $SessionIdAkses = $DataSessionAkses['id_akses'];
            $SessionNama = $DataSessionAkses['nama'];
            $SessionKontak = $DataSessionAkses['kontak'];
            $SessionEmail= $DataSessionAkses['email'];
            $SessionStatus= $DataSessionAkses['status'];
            $SessionAkses= $DataSessionAkses['akses'];
        }else{
            $SessionIdAkses ="";
            $SessionNama ="";
            $SessionKontak ="";
            $SessionEmail="";
            $SessionStatus="";
            $SessionAkses="";
        }
    }else{
        $SessionIdAkses ="";
        $SessionNama ="";
        $SessionKontak ="";
        $SessionEmail="";
        $SessionStatus="";
        $SessionAkses="";
    }
?>