<?php
    //koneksi dan error
    include "../../_Config/Connection.php";
    //mode_laporan
    if(!empty($_POST['mode_laporan'])){
        $mode_laporan=$_POST['mode_laporan'];
    }else{
        $mode_laporan="Item Barang";
    }
    //ShortBy
    if(!empty($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="ASC";
    }
    //ShortBy
    if(!empty($_POST['harga'])){
        $harga=$_POST['harga'];
    }else{
        $harga="harga_1";
    }
    if($mode_laporan=="Item Barang"){
        include "TabelLaporanAssetItem.php";
    }else{
        include "TabelLaporanAssetKategori.php";
    }
?>
    
