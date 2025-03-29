<?php
    include '../../_Config/Connection.php';
    if(empty($_POST['akses'])){
        echo "<span>Akses Group Tidak Boleh Kosong</span>";
    }else{
        $akses=$_POST['akses'];
        if(empty($_POST['acc_profile'])){
            $acc_profile="";
        }else{
            $acc_profile=$_POST['acc_profile'];
        }
        if(empty($_POST['acc_setting'])){
            $acc_setting="";
        }else{
            $acc_setting=$_POST['acc_setting'];
        }
        if(empty($_POST['acc_akses'])){
            $acc_akses="";
        }else{
            $acc_akses=$_POST['acc_akses'];
        }
        if(empty($_POST['acc_dokter'])){
            $acc_dokter="";
        }else{
            $acc_dokter=$_POST['acc_dokter'];
        }
        if(empty($_POST['acc_ruang_inap'])){
            $acc_ruang_inap="";
        }else{
            $acc_ruang_inap=$_POST['acc_ruang_inap'];
        }
        if(empty($_POST['acc_pasien'])){
            $acc_pasien="";
        }else{
            $acc_pasien=$_POST['acc_pasien'];
        }
        if(empty($_POST['acc_kunjungan'])){
            $acc_kunjungan="";
        }else{
            $acc_kunjungan=$_POST['acc_kunjungan'];
        }
        if(empty($_POST['acc_supplier'])){
            $acc_supplier="";
        }else{
            $acc_supplier=$_POST['acc_supplier'];
        }
        if(empty($_POST['acc_inventory'])){
            $acc_inventory="";
        }else{
            $acc_inventory=$_POST['acc_inventory'];
        }
        if(empty($_POST['acc_kasir'])){
            $acc_kasir="";
        }else{
            $acc_kasir=$_POST['acc_kasir'];
        }
        if(empty($_POST['acc_transaksi'])){
            $acc_transaksi="";
        }else{
            $acc_transaksi=$_POST['acc_transaksi'];
        }
        if(empty($_POST['acc_laporan'])){
            $acc_laporan="";
        }else{
            $acc_laporan=$_POST['acc_laporan'];
        }
        if(empty($_POST['acc_backup'])){
            $acc_backup="";
        }else{
            $acc_backup=$_POST['acc_backup'];
        }
        //Cek apakah data akses ada
        $cek=mysqli_query($conn,"SELECT * FROM setting_acc WHERE akses='$akses'");
        if(mysqli_num_rows($cek)>0){
            //Jika data akses ada, maka update data akses
            $update=mysqli_query($conn,"UPDATE setting_acc SET 
                acc_profile='$acc_profile',
                acc_setting='$acc_setting',
                acc_akses='$acc_akses',
                acc_dokter='$acc_dokter',
                acc_ruang_inap='$acc_ruang_inap',
                acc_pasien='$acc_pasien',
                acc_kunjungan='$acc_kunjungan',
                acc_supplier='$acc_supplier',
                acc_inventory='$acc_inventory',
                acc_kasir ='$acc_kasir',
                acc_transaksi='$acc_transaksi',
                acc_laporan='$acc_laporan',
                acc_backup='$acc_backup'
            WHERE akses='$akses'");
            if($update){
                echo "<span id='NotifikasiEditAksesibilitasBerhasil'>Berhasil</span>";
            }else{
                echo "<span>Data Akses Gagal Diperbarui</span>";
            }
        }else{
            //Jika data akses tidak ada, maka insert data akses
            $insert=mysqli_query($conn,"INSERT INTO setting_acc(
                akses,
                acc_profile,
                acc_setting,
                acc_akses,
                acc_dokter,
                acc_ruang_inap,
                acc_pasien,
                acc_kunjungan,
                acc_supplier,
                acc_inventory,
                acc_kasir,
                acc_transaksi,
                acc_laporan,
                acc_backup
            ) VALUES(
                '$akses',
                '$acc_profile',
                '$acc_setting',
                '$acc_akses',
                '$acc_dokter',
                '$acc_ruang_inap',
                '$acc_pasien',
                '$acc_kunjungan',
                '$acc_supplier',
                '$acc_inventory',
                '$acc_kasir',
                '$acc_transaksi',
                '$acc_laporan',
                '$acc_backup'
            )");
            if($insert){
                echo "<span id='NotifikasiEditAksesibilitasBerhasil'>Berhasil</span>";
            }else{
                echo "<span>Data Akses Gagal Disimpan</span>";
            }
        }
    }
?>