<?php
    //koneksi dan error
    include "../../_Config/Connection.php";
    date_default_timezone_set('Asia/Jakarta');
    //BUAT TOKEN
    $milliseconds = round(microtime(true) * 1000);
    $WaktuSekarang=date('Y-m-d H:i:s');
    //Cek Apakah Token Sudah ada
    $CekToken=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM validasi_input WHERE token='$milliseconds'"));
    if(!empty($CekToken)){
        echo "Komputer Anda Sibuk, Refresh Halaman Anda!!";
    }else{
        //Input data token
        $entryToken="INSERT INTO validasi_input (
            waktu,
            token
        ) VALUES (
            '$WaktuSekarang',
            '$milliseconds'
        )";
        $hasilToken=mysqli_query($conn, $entryToken);
        if($hasilToken){
            $Qry = mysqli_query($conn, "SELECT * FROM setting_aplikasi")or die(mysqli_error($conn));
            $DataSetting = mysqli_fetch_array($Qry);
            //Nama Perusahaan
            if(!empty($DataSetting['nama_perusahaan'])){
                $nama_perusahaan = $DataSetting['nama_perusahaan'];
            }else{
                $nama_perusahaan = "Business Today";
            }
            //Alamat
            if(!empty($DataSetting['alamat'])){
                $alamat = $DataSetting['alamat'];
            }else{
                $alamat ="";
            }
            //kontak
            if(!empty($DataSetting['kontak'])){
                $kontak = $DataSetting['kontak'];
            }else{
                $kontak ="";
            }
            //logo
            if(!empty($DataSetting['logo'])){
                $logo = $DataSetting['logo'];
            }else{
                $logo ="";
            }
            //logo
            if(!empty($DataSetting['aktif_promo'])){
                $aktif_promo = $DataSetting['aktif_promo'];
            }else{
                $aktif_promo ="Tidak";
            }
            //jumlah_point
            if(!empty($DataSetting['jumlah_point'])){
                $jumlah_point = $DataSetting['jumlah_point'];
            }else{
                $jumlah_point ="0";
            }
            //kelipatan_belanja
            if(!empty($DataSetting['kelipatan_belanja'])){
                $kelipatan_belanja = $DataSetting['kelipatan_belanja'];
            }else{
                $kelipatan_belanja ="0";
            }
            //nama_printer
            if(!empty($DataSetting['nama_printer'])){
                $nama_printer = $DataSetting['nama_printer'];
            }else{
                $nama_printer ="POS";
            }
            //host_printer 
            if(!empty($DataSetting['host_printer '])){
                $host_printer = $DataSetting['host_printer'];
            }else{
                $host_printer="localhost";
            }
            //lebar_nota 
            if(!empty($DataSetting['lebar_nota'])){
                $lebar_nota = $DataSetting['lebar_nota'];
            }else{
                $lebar_nota="1";
            }
            //judul_nota 
            if(!empty($DataSetting['judul_nota'])){
                $judul_nota = $DataSetting['judul_nota'];
            }else{
                $judul_nota="Ya";
            }
            //footer_nota 
            if(!empty($DataSetting['footer_nota'])){
                $footer_nota = $DataSetting['footer_nota'];
            }else{
                $footer_nota="Ya";
            }
            //komen_nota 
            if(!empty($DataSetting['komen_nota'])){
                $komen_nota = $DataSetting['komen_nota'];
            }else{
                $komen_nota="Ya";
            }
            $tmpdir = sys_get_temp_dir();
            $file = tempnam($tmpdir, 'ctk');
            $handle = fopen($file, 'w');
            $condensed = Chr(27) . Chr(33) . Chr(4);
            //Posisi
            $kiri= Chr(27) . Chr(97) . Chr('0');
            $Tengah= Chr(27) . Chr(97) . Chr('1');
            $kanan= Chr(27) . Chr(97) . Chr('2');
            //Ukuran huruf
            $bold0 = Chr(27) . Chr(69) . Chr(0);
            $bold1 = Chr(27) . Chr(69) . Chr(1);
            //FontA
            $FontA1 = Chr(29) . Chr(33) . Chr(0);
            $FontA2 = Chr(29) . Chr(33) . Chr(1);
            $FontA3 = Chr(29) . Chr(33) . Chr(2);
            $FontA4 = Chr(29) . Chr(33) . Chr(3);
            //FONTB
            $FontB1 = Chr(29) . Chr(33) . Chr(4);
            $FontB2 = Chr(29) . Chr(33) . Chr(5) . Chr(0) . Chr(1);
            $FontB3 = Chr(29) . Chr(33) . Chr(6);
            $FontB4 = Chr(29) . Chr(33) . Chr(7);
        

            $Strike = Chr(27) . Chr(87) . Chr(49);
            $subscript= Chr(27) . Chr(83) . Chr(49);
            $Potong =chr(29) . "V" . 0;

            $initialized = chr(27).chr(64);
            $condensed1 = chr(15);
            $condensed0 = chr(18);
            $Data = $initialized;
            $Data .= $condensed1;
            $Data .= "\n";
            //Lakukan perulangan untuk mengethaui lebar
            $a=1;
            $b=$lebar_nota;
            for ( $i =$a; $i<=$b; $i++ ){
                $Data .= "-";
            }
            $Data .= "\n";
            $Data .= "$nama_perusahaan \n";
            $Data .= "$alamat \n";
            $Data .= "\n";
            
            $Data .= $kiri;
            $Data .= "ALIGMENT KIRI \n";
            $Data .= $Tengah;
            $Data .= "ALIGMENT TENGAH \n";
            $Data .= $kanan;
            $Data .= "ALIGMENT KANAN \n";

            $Data .= $bold1;
            $Data .= $kiri;
            $Data .= $FontA1;
            $Data .= "FontA1 ";
            $Data .= $FontA2;
            $Data .= "FontA2 ";
            $Data .= $FontA3;
            $Data .= "FontA3 ";
            $Data .= $FontA4;
            $Data .= "FontA4";
            $Data .= $FontB1;
            $Data .= "FontB1 ";
            $Data .= $FontB2;
            $Data .= "FontB2 ";
            $Data .= $FontB3;
            $Data .= "FontB3 ";
            $Data .= $FontB4;
            $Data .= "FontB4 \n";
            
            $Data .= $bold0;
            $Data .= $FontA1;
            $Data .= "FontA1 ";
            $Data .= $FontA2;
            $Data .= "FontA2 ";
            $Data .= $FontA3;
            $Data .= "FontA3 ";
            $Data .= $FontA4;
            $Data .= "FontA4";
            $Data .= $FontB1;
            $Data .= "FontB1 ";
            $Data .= $FontB2;
            $Data .= "FontB2 ";
            $Data .= $FontB3;
            $Data .= "FontB3 ";
            $Data .= $FontB4;
            $Data .= "FontB4 \n";
            $Data .= "\n";
            $Data .= "\n";
            $Data .= "\n";
            $Data .=$Potong;
            fwrite($handle, $Data);
            fclose($handle);
            copy($file, "//$host_printer/$nama_printer");
            unlink($file);
        }
    }
?>
