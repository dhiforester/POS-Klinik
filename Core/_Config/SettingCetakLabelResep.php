<?php
    //Setting Kartu Pasien
    $QrySettingLabelResep = mysqli_query($conn,"SELECT * FROM setting_label_resep WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
    $DataSettingLabelResep = mysqli_fetch_array($QrySettingLabelResep);
    if(empty($DataSettingLabelResep['id_setting_label_resep'])){
        $IdSettingLabelResep="";
        $TanggalSettingLabelResep=date('Y-m-d');
        $NamaFornSettingLabelResep="Times New Roman";
        $UkuranFornSettingLabelResep="12pt";
        $WarnaFornSettingLabelResep="#000";
        $PanjangSettingLabelResep="150mm";
        $LebarSettingLabelResep="80mm";
        $MarginAtasSettingLabelResep="2mm";
        $MarginBawahLabelResep="2mm";
        $MarginKiriLabelResep="2mm";
        $MarginKananLabelResep="2mm";
        $LogoLabelResep="Ya";
        $PanjangLogoLabelResep="30mm";
        $LebarLogoLabelResep="25mm";
        $BarcodeLabelResep="Ya";
        $UkuranBarcodeLabelResep="25";
        $KutipanBawahLabelResep="Ya";
        $IsiKutipanLabelResep="Bawa Kartu ini ke dokter untuk pemeriksaan";
    }else{
        $IdSettingLabelResep=$DataSettingLabelResep['id_setting_label_resep'];
        $TanggalSettingLabelResep=$DataSettingLabelResep['tanggal_setting'];
        $NamaFornSettingLabelResep=$DataSettingLabelResep['nama_font'];
        $UkuranFornSettingLabelResep=$DataSettingLabelResep['ukuran_font'];
        $WarnaFornSettingLabelResep=$DataSettingLabelResep['warna_font'];
        $PanjangSettingLabelResep=$DataSettingLabelResep['panjang_x'];
        $LebarSettingLabelResep=$DataSettingLabelResep['lebar_y'];
        $MarginAtasSettingLabelResep=$DataSettingLabelResep['margin_atas'];
        $MarginBawahLabelResep=$DataSettingLabelResep['margin_bawah'];
        $MarginKiriLabelResep=$DataSettingLabelResep['margin_kiri'];
        $MarginKananLabelResep=$DataSettingLabelResep['margin_kanan'];
        $LogoLabelResep=$DataSettingLabelResep['tampilkan_logo'];
        $PanjangLogoLabelResep=$DataSettingLabelResep['panjang_logo'];
        $LebarLogoLabelResep=$DataSettingLabelResep['lebar_logo'];
        $BarcodeLabelResep=$DataSettingLabelResep['tampilkan_barcode'];
        $UkuranBarcodeLabelResep=$DataSettingLabelResep['ukuran_barcode'];
        $KutipanBawahLabelResep=$DataSettingLabelResep['kutipan_bawah'];
        $IsiKutipanLabelResep=$DataSettingLabelResep['isi_kutipan'];
    }
?>