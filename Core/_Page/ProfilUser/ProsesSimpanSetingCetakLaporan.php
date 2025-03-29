<?php
    //connection
    include "../../_Config/connection.php";
    include "../../_Config/SessionLogin.php";
    //Variabel
    if(empty($_POST['tanggal_setting'])){
        $tanggal_setting = date("Y-m-d");
    }else{
        $tanggal_setting = $_POST['tanggal_setting'];
    }
    if(empty($_POST['nama_font'])){
        $nama_font ="";
    }else{
        $nama_font = $_POST['nama_font'];
    }
    if(empty($_POST['ukuran_font'])){
        $ukuran_font ="";
    }else{
        $ukuran_font = $_POST['ukuran_font'];
    }
    if(empty($_POST['warna_font'])){
        $warna_font ="";
    }else{
        $warna_font = $_POST['warna_font'];
    }
    if(empty($_POST['panjang_x'])){
        $panjang_x ="";
    }else{
        $panjang_x = $_POST['panjang_x'];
    }
    if(empty($_POST['lebar_y'])){
        $lebar_y ="";
    }else{
        $lebar_y = $_POST['lebar_y'];
    }
    if(empty($_POST['margin_atas'])){
        $margin_atas ="";
    }else{
        $margin_atas = $_POST['margin_atas'];
    }
    if(empty($_POST['margin_bawah'])){
        $margin_bawah ="";
    }else{
        $margin_bawah = $_POST['margin_bawah'];
    }
    if(empty($_POST['margin_kiri'])){
        $margin_kiri ="";
    }else{
        $margin_kiri = $_POST['margin_kiri'];
    }
    if(empty($_POST['margin_kanan'])){
        $margin_kanan ="";
    }else{
        $margin_kanan = $_POST['margin_kanan'];
    }
    if(empty($_POST['tampilkan_logo'])){
        $tampilkan_logo ="";
    }else{
        $tampilkan_logo = $_POST['tampilkan_logo'];
    }
    if(empty($_POST['tampilkan_barcode'])){
        $tampilkan_barcode ="";
    }else{
        $tampilkan_barcode = $_POST['tampilkan_barcode'];
    }
    if(empty($_POST['kutipan_bawah'])){
        $kutipan_bawah ="";
    }else{
        $kutipan_bawah = $_POST['kutipan_bawah'];
    }
    if(empty($_POST['panjang_logo'])){
        $panjang_logo ="";
    }else{
        $panjang_logo = $_POST['panjang_logo'];
    }
    if(empty($_POST['lebar_logo'])){
        $lebar_logo ="";
    }else{
        $lebar_logo = $_POST['lebar_logo'];
    }
    if(empty($_POST['ukuran_barcode'])){
        $ukuran_barcode ="";
    }else{
        $ukuran_barcode = $_POST['ukuran_barcode'];
    }
    if(empty($_POST['isi_kutipan'])){
        $isi_kutipan ="";
    }else{
        $isi_kutipan = $_POST['isi_kutipan'];
    }
    //apakah setting sudah ada
    $query_hapus_setting = mysqli_query($conn, "DELETE FROM setting_laporan WHERE id_akses='$SessionIdAkses'");
    if($query_hapus_setting){
        //Simpan Setting
        $query_simpan_setting = mysqli_query($conn, "INSERT INTO setting_laporan (
            id_akses, 
            tanggal_setting, 
            nama_font, 
            ukuran_font, 
            warna_font, 
            panjang_x, 
            lebar_y, 
            margin_atas, 
            margin_bawah, 
            margin_kiri, 
            margin_kanan, 
            tampilkan_logo, 
            panjang_logo, 
            lebar_logo
        ) VALUES (
            '$SessionIdAkses', 
            '$tanggal_setting', 
            '$nama_font', 
            '$ukuran_font', 
            '$warna_font', 
            '$panjang_x', 
            '$lebar_y', 
            '$margin_atas', 
            '$margin_bawah', 
            '$margin_kiri', 
            '$margin_kanan', 
            '$tampilkan_logo',
            '$panjang_logo', 
            '$lebar_logo'
        )");
        if($query_simpan_setting){
            echo "<span class='text-success' id='NotifikasiSimpanSettingLaporanBerhasil'>Berhasil</span>";
        }else{
            echo "<span class='text-danger'>Simpan Pengaturan Gagal!!</span>";
        }
    }
?>