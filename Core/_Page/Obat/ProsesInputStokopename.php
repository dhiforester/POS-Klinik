<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Apabila no_batch kosong
    if(empty($_POST['id_obat'])){
        echo '<span  class="text-danger">ID Obat Tidak Boleh Kosong</span>';
    }else{
        //Apabila Nama Kosong
        if(empty($_POST['periode'])){
            echo '<span  class="text-danger">Periode Data Tidak Boleh Kosong</span>';
        }else{
            if(empty($_POST['id_so'])){
                $id_obat=$_POST['id_obat'];
                $periode=$_POST['periode'];
                $satuan=$_POST['satuan'];
                if(empty($_POST['stok_nyata'])){
                    $stok_nyata=0;
                }else{
                    $stok_nyata=$_POST['stok_nyata'];
                }
                if(empty($_POST['selisih'])){
                    $selisih=0;
                }else{
                    $selisih=$_POST['selisih'];
                }
                if(empty($_POST['stok_data'])){
                    $stok_data=0;
                }else{
                    $stok_data=$_POST['stok_data'];
                }
                if(empty($_POST['keterangan'])){
                    $stketeranganok_data="";
                }else{
                    $keterangan=$_POST['keterangan'];
                }
                if(empty($_POST['keterangan'])){
                    $satuan="";
                }else{
                    $satuan=$_POST['satuan'];
                }
                $entry="INSERT INTO stok_opename (
                    id_barang,
                    tanggal,
                    stok_data,
                    stok_nyata,
                    selisih,
                    keterangan
                ) VALUES (
                    '$id_obat',
                    '$periode',
                    '$stok_data',
                    '$stok_nyata',
                    '$selisih',
                    '$keterangan'
                )";
                $hasil=mysqli_query($conn, $entry);
                if($hasil){
                    echo '<span id="NotifikasiInputSoBerhasil" class="text-success">Input Stok Opename Berhasil</span>';
                    $UpdateBarang = mysqli_query($conn, "UPDATE obat SET stok='$stok_nyata' WHERE id_obat='$id_obat'") or die(mysqli_error($conn));
                }else{
                    echo '<span  class="text-danger">Input Stok Opename Gagal</span>';
                }
            }else{
                $id_so=$_POST['id_so'];
                $id_obat=$_POST['id_obat'];
                $periode=$_POST['periode'];
                $stok_data=$_POST['stok_data'];
                $satuan=$_POST['satuan'];
                $stok_nyata=$_POST['stok_nyata'];
                $selisih=$_POST['selisih'];
                $keterangan=$_POST['keterangan'];
                $UpdateSo = mysqli_query($conn, "UPDATE stok_opename SET 
                    tanggal='$periode',
                    stok_data='$stok_data',
                    stok_nyata='$stok_nyata',
                    selisih='$selisih',
                    keterangan='$keterangan'
                WHERE id_so='$id_so'") or die(mysqli_error($conn));
                if($UpdateSo){
                    $UpdateBarang = mysqli_query($conn, "UPDATE obat SET stok='$stok_nyata' WHERE id_obat='$id_obat'") or die(mysqli_error($conn));
                    echo '<span id="NotifikasiInputSoBerhasil" class="text-success">Input Stok Opename Berhasil</span>';
                }else{
                    echo '<span  class="text-danger">Update Stok Opename Gagal</span>';
                }
            }
        }
    }
?>