<?php
    //Setting Kartu Pasien
    $QrySettingLaporan = mysqli_query($conn,"SELECT * FROM setting_laporan WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
    $DataSettingLaporan = mysqli_fetch_array($QrySettingLaporan);
    if(empty($DataSettingLaporan['id_setting_laporan'])){
        $IdSettingLaporan="";
        $TanggalSettingLaporan=date('Y-m-d');
        $NamaFornSettingLaporan="Times New Roman";
        $UkuranFornSettingLaporan="12pt";
        $WarnaFornSettingLaporan="#000";
        $PanjangSettingLaporan="150mm";
        $LebarSettingLaporan="80mm";
        $MarginAtasSettingLaporan="2mm";
        $MarginBawahLaporan="2mm";
        $MarginKiriLaporan="2mm";
        $MarginKananLaporan="2mm";
        $LogoLaporan="Ya";
        $PanjangLogoLaporan="30mm";
        $LebarLogoLaporan="25mm";
    }else{
        $IdSettingLaporan=$DataSettingLaporan['id_setting_laporan'];
        $TanggalSettingLaporan=$DataSettingLaporan['tanggal_setting'];
        $NamaFornSettingLaporan=$DataSettingLaporan['nama_font'];
        $UkuranFornSettingLaporan=$DataSettingLaporan['ukuran_font'];
        $WarnaFornSettingLaporan=$DataSettingLaporan['warna_font'];
        $PanjangSettingLaporan=$DataSettingLaporan['panjang_x'];
        $LebarSettingLaporan=$DataSettingLaporan['lebar_y'];
        $MarginAtasSettingLaporan=$DataSettingLaporan['margin_atas'];
        $MarginBawahLaporan=$DataSettingLaporan['margin_bawah'];
        $MarginKiriLaporan=$DataSettingLaporan['margin_kiri'];
        $MarginKananLaporan=$DataSettingLaporan['margin_kanan'];
        $LogoLaporan=$DataSettingLaporan['tampilkan_logo'];
        $PanjangLogoLaporan=$DataSettingLaporan['panjang_logo'];
        $LebarLogoLaporan=$DataSettingLaporan['lebar_logo'];
    }
?>