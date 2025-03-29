<?php
    //Setting Kartu Pasien
    $QrySettingNota = mysqli_query($conn,"SELECT * FROM setting_nota WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
    $DataSettingNota = mysqli_fetch_array($QrySettingNota);
    if(empty($DataSettingNota['id_setting_nota'])){
        $IdSettingNota="";
        $TanggalSettingNota=date('Y-m-d');
        $NamaFornSettingNota="Times New Roman";
        $UkuranFornSettingNota="12pt";
        $WarnaFornSettingNota="#000";
        $PanjangSettingNota="150mm";
        $LebarSettingNota="80mm";
        $MarginAtasSettingNota="2mm";
        $MarginBawahNota="2mm";
        $MarginKiriNota="2mm";
        $MarginKananNota="2mm";
        $LogoNota="Ya";
        $PanjangLogoNota="30mm";
        $LebarLogoNota="25mm";
        $BarcodeNota="Ya";
        $UkuranBarcodeNota="25";
        $KutipanBawahNota="Ya";
        $IsiKutipanNota="Bawa Kartu ini ke dokter untuk pemeriksaan";
    }else{
        $IdSettingNota=$DataSettingNota['id_setting_nota'];
        $TanggalSettingNota=$DataSettingNota['tanggal_setting'];
        $NamaFornSettingNota=$DataSettingNota['nama_font'];
        $UkuranFornSettingNota=$DataSettingNota['ukuran_font'];
        $WarnaFornSettingNota=$DataSettingNota['warna_font'];
        $PanjangSettingNota=$DataSettingNota['panjang_x'];
        $LebarSettingNota=$DataSettingNota['lebar_y'];
        $MarginAtasSettingNota=$DataSettingNota['margin_atas'];
        $MarginBawahNota=$DataSettingNota['margin_bawah'];
        $MarginKiriNota=$DataSettingNota['margin_kiri'];
        $MarginKananNota=$DataSettingNota['margin_kanan'];
        $LogoNota=$DataSettingNota['tampilkan_logo'];
        $PanjangLogoNota=$DataSettingNota['panjang_logo'];
        $LebarLogoNota=$DataSettingNota['lebar_logo'];
        $BarcodeNota=$DataSettingNota['tampilkan_barcode'];
        $UkuranBarcodeNota=$DataSettingNota['ukuran_barcode'];
        $KutipanBawahNota=$DataSettingNota['kutipan_bawah'];
        $IsiKutipanNota=$DataSettingNota['isi_kutipan'];
    }
?>