<?php
    //koneksi dan error
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SettingCetakNota.php";
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
            //TANGKAP KODE TRANSAKSI
            if(!empty($_POST['kode_transaksi'])){
                $kode_transaksi=$_POST['kode_transaksi'];
            }else{
                $kode_transaksi="";
            }
            //Buka rincian transaksi
            $QryTransaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'")or die(mysqli_error($conn));
            $DataTransaksi = mysqli_fetch_array($QryTransaksi);
            $id_transaksi=$DataTransaksi['id_transaksi'];
            $id_akses=$DataTransaksi['id_akses'];
            $id_pasien=$DataTransaksi['id_pasien'];
            $id_kunjungan=$DataTransaksi['id_kunjungan'];
            $id_supplier=$DataTransaksi['id_supplier'];
            $tanggal=$DataTransaksi['tanggal'];
            $trans=$DataTransaksi['jenis_transaksi'];
            $subtotal = $DataTransaksi['subtotal'];
            $RpPpn = $DataTransaksi['ppn'];
            $RpBiaya = $DataTransaksi['biaya'];
            $RpDiskon = $DataTransaksi['diskon'];
            $total_tagihan = $DataTransaksi['total_tagihan'];
            $pembayaran = $DataTransaksi['pembayaran'];
            $selisih = $DataTransaksi['selisih'];
            $keterangan = $DataTransaksi['keterangan'];
            $petugas = $DataTransaksi['petugas'];
            //Buka Data Kembalian
            $QryKembalian = mysqli_query($conn, "SELECT * FROM transaksi_kembalian WHERE id_transaksi='$id_transaksi'")or die(mysqli_error($conn));
            $DataKembalian = mysqli_fetch_array($QryKembalian);
            $JumlahUang=$DataKembalian['uang'];
            $JumlahKembalian=$DataKembalian['kembalian'];
            //Buka nama member
            $QryMember = mysqli_query($conn, "SELECT * FROM member WHERE id_member='$id_supplier'")or die(mysqli_error($conn));
            $DataMember = mysqli_fetch_array($QryMember);
            $NamaMember=$DataMember['nama'];
            if(empty($DataMember['id_member'])){
                $NamaMember="Tidak Ada";
            }else{
                $NamaMember=$DataMember['nama'];
            }
            //Buka data kunjungan
            $QryKunjungan = mysqli_query($conn, "SELECT * FROM kunjungan WHERE id_kunjungan='$id_kunjungan'")or die(mysqli_error($conn));
            $DataKunjungan = mysqli_fetch_array($QryKunjungan);
            if(empty($DataKunjungan['nama'])){
                $nama_pasien="Tidak Ada";
                $id_pasien="Tidak Ada";
            }else{
                $nama_pasien=$DataKunjungan['nama'];
                $id_pasien=$DataKunjungan['id_pasien'];
            }
            //Menghiutng persen ppn dan diskon
            $ppn=($RpPpn/$subtotal)*100;
            $diskon=($RpDiskon/$subtotal)*100;
            //Mulai Inisiasi Cetak
            $tmpdir = sys_get_temp_dir();
            $file = tempnam($tmpdir, 'ctk');
            $handle = fopen($file, 'w');
            $condensed = Chr(27) . Chr(33) . Chr(4);
            $bold1 = Chr(27) . Chr(69);
            $bold0 = Chr(27) . Chr(70);
            $Large = Chr(29) . Chr(33) . Chr(1) . Chr(0);
            $Strike = Chr(27) . Chr(87) . Chr(49);
            $Elite1 = Chr(29) . Chr(33) . Chr(0) . Chr(0);
            $Elite2 = Chr(29) . Chr(33) . Chr(1) . Chr(19);
            $subscript= Chr(27) . Chr(83) . Chr(49);
            $Tengah= Chr(27) . Chr(97) . Chr('1');
            $kiri= Chr(27) . Chr(97) . Chr('0');
            $initialized = chr(27).chr(64);
            $condensed1 = chr(15);
            $condensed0 = chr(18);
            $Potong =chr(29) . "V" . 0;

            $Data = $initialized;
            $Data .= $condensed1;
            $Data .= "\n";
            $Data .= "\n";
            $Data .= $Tengah;
            $Data .= $Large;
            $Data .= "$nama_perusahaan \n";
            $Data .= $Elite1;
            $Data .= "$alamat \n";
            $Data .= $kiri;
            $Data .= "\n";
            $Data .= "Kode     : $kode_transaksi \n";
            $Data .= "Tgl      : $tanggal \n";
            if(!empty($DataKunjungan['nama'])){
                $Data .= "Pasien   : $nama_pasien \n";
            }
            if(!empty($DataMember['id_member'])){
                $Data .= "Supplier : $NamaMember \n";
            }
            $Data .= "Petugas  : $petugas \n";
            $a=1;
            $b=$lebar_nota;
            for ( $i =$a; $i<=$b; $i++ ){
                $Data .= "-";
            }
            $Data .= "\n";
            $Data .= $Tengah;
            $Data .= "BARANG       HARGA    JMLH\n";
            $Data .= $kiri;
            $query = mysqli_query($conn, "SELECT*FROM rincian_transaksi WHERE kode_transaksi='$kode_transaksi' ORDER BY id_rincian DESC");
            while ($data = mysqli_fetch_array($query)) {
                $id_rincian = $data['id_rincian'];
                $id_obat = $data['id_obat'];
                $nama = $data['nama'];
                $qty= $data['qty'];
                $harga = $data['harga'];
                $jumlah= $data['jumlah'];
                $id_multi= $data['id_multi'];
                //Buka data Obat
                if(empty($id_multi)){
                    $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                    $DataObat = mysqli_fetch_array($QryObat);
                    $satuan = $DataObat['satuan'];
                }else{
                    $QryObat = mysqli_query($conn, "SELECT * FROM muti_harga WHERE id_multi='$id_multi'")or die(mysqli_error($conn));
                    $DataObat = mysqli_fetch_array($QryObat);
                    $satuan = $DataObat['satuan'];
                }
            $Data .= "$nama $qty X $harga $jumlah\n"; 
            }
            $a=1;
            $b=$lebar_nota;
            for ( $i =$a; $i<=$b; $i++ ){
                $Data .= "-";
            }
            $Data .= "\n";
            $Data .= "Subtotal  : $subtotal \n";
            if(!empty($RpPpn)){
            $Data .= "PPN       : $RpPpn \n";
            }
            if(!empty($RpDiskon)){
            $Data .= "DISKON    : $RpDiskon \n";
            }
            $Data .= "TOTAL     : $total_tagihan \n";
            $Data .= "KETERANGAN: $keterangan \n";
            $Data .= "UANG      : $JumlahUang \n";
            $Data .= "KEMBALIAN : $JumlahKembalian\n";
            $a=1;
            $b=$lebar_nota;
            for ( $i =$a; $i<=$b; $i++ ){
                $Data .= "-";
            }
            $Data .= "\n";
            if($KutipanBawahNota=="Ya"){
                $Data .= $Elite2;
                $Data .= $Tengah;
                $Data .= "$IsiKutipanNota \n";
            }
            $Data .= "\n";
            $Data .= "\n";
            $Data .= "\n";
            $Data .= $Potong;
            fwrite($handle, $Data);
            fclose($handle);
            copy($file, "//$host_printer/$nama_printer");
            unlink($file);
        }else{
            echo "Token Tidak Bisa Di Input";
        }
    }
?>
