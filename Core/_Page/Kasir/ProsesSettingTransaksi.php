<?php
    //KONEKSI DAN ERROR
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    $WaktuSekarang=date('Y-m-d H:i:s');
    $milliseconds = round(microtime(true) * 1000);
    //Cek Token
    //Cek Apakah Token Sudah ada
    $CekToken=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM validasi_input WHERE token='$milliseconds'"));
    if(!empty($CekToken)){
        echo "Komputer Anda Sibuk, Refresh Halaman Anda!!";
    }else{
        //TANGKAP DATA
        //id_kunjungan
        if(!empty($_POST['id_kunjungan'])){
            $id_kunjungan=$_POST['id_kunjungan'];
            //buka data pasien
            $BukaPasien=mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_kunjungan='$id_kunjungan'");
            $DataPasien=mysqli_fetch_array($BukaPasien);
            $id_pasien=$DataPasien['id_pasien'];
        }else{
            $id_kunjungan="0";
            $id_pasien="0";
        }
        //id_member
        if(!empty($_POST['id_member'])){
            $id_member=$_POST['id_member'];
        }else{
            $id_member="0";
        }
        //jumlah uang
        if(!empty($_POST['uang'])){
            $uang=$_POST['uang'];
        }else{
            $uang="0";
        }
        //NewOrEdit
        if(!empty($_POST['NewOrEdit'])){
            $NewOrEdit=$_POST['NewOrEdit'];
        }else{
            $NewOrEdit="New";
        }
        //jenis_transaksi
        if(!empty($_POST['jenis_transaksi'])){
            $jenis_transaksi=$_POST['jenis_transaksi'];
        }else{
            $jenis_transaksi="penjualan";
        }
        //kode_transaksi
        if(!empty($_POST['kode_transaksi'])){
            $kode_transaksi=$_POST['kode_transaksi'];
        }else{
            $kode_transaksi="";
        }
        //tanggal
        if(!empty($_POST['tanggal'])){
            $tanggal=$_POST['tanggal'];
        }else{
            $tanggal=date('Y-m-d H:i:s');
        }
        //subtotal
        if(!empty($_POST['subtotal'])){
            $subtotal=$_POST['subtotal'];
        }else{
            $subtotal="";
        }
        //ppn
        if(!empty($_POST['ppn'])){
            $ppn=$_POST['ppn'];
        }else{
            $ppn="0";
        }
        //RpPPN
        if(!empty($_POST['RpPPN'])){
            $RpPPN=$_POST['RpPPN'];
        }else{
            $RpPPN="0";
        }
        //diskon
        if(!empty($_POST['diskon'])){
            $diskon=$_POST['diskon'];
        }else{
            $diskon="0";
        }
        //RpDiskon
        if(!empty($_POST['RpDiskon'])){
            $RpDiskon=$_POST['RpDiskon'];
        }else{
            $RpDiskon="0";
        }
        //total
        if(!empty($_POST['total'])){
            $total=$_POST['total'];
        }else{
            $total="0";
        }
        //pembayaran
        if(!empty($_POST['pembayaran'])){
            $pembayaran=$_POST['pembayaran'];
        }else{
            $pembayaran="0";
        }
        //selisih
        $selisih=$total-$pembayaran;
        if($selisih<0){
            $selisih=$selisih*-1;
        }else{
            $selisih=$selisih;
        }
        //UpdateHarga
        if(!empty($_POST['UpdateHarga'])){
            $UpdateHarga=$_POST['UpdateHarga'];
        }else{
            $UpdateHarga="Tidak";
        }
        //keterangan
        if($jenis_transaksi=="penjualan"){
            if($total==$pembayaran){
                $keterangan="Lunas";
            }else{
                if($total>$pembayaran){
                    $keterangan="Piutang";
                }else{
                    $keterangan="Utang";
                }
            }
        }else{
            if($total==$pembayaran){
                $keterangan="Lunas";
            }else{
                if($total>$pembayaran){
                    $keterangan="Utang";
                }else{
                    $keterangan="Piutang";
                }
            }
        }
        //Id Member
        if(!empty($_POST['id_member'])){
            $id_member=$_POST['id_member'];
        }else{
            $id_member="";
        }
        //BUKA DATA SETTING APLIKASI
        $Qry = mysqli_query($conn, "SELECT * FROM setting_aplikasi")or die(mysqli_error($conn));
        $DataSetting = mysqli_fetch_array($Qry);
        //aktif_promo
        if(!empty($DataSetting['aktif_promo'])){
            $aktif_promo = $DataSetting['aktif_promo'];
        }else{
            $aktif_promo ="Tidak";
        }
        //Apabila data baru maka input pada data transaksi
        if($NewOrEdit=="New"){
            //Input ke transaksi
            $entry="INSERT INTO transaksi (
                id_akses,
                id_pasien,
                id_kunjungan,
                id_supplier,
                kode_transaksi,
                tanggal,
                jenis_transaksi,
                subtotal,
                ppn,
                biaya,
                diskon,
                total_tagihan,
                pembayaran,
                selisih,
                keterangan,
                petugas
            ) VALUES (
                '$SessionIdAkses',
                '$id_pasien',
                '$id_kunjungan',
                '$id_member',
                '$kode_transaksi',
                '$tanggal',
                '$jenis_transaksi',
                '$subtotal',
                '$RpPPN',
                '0',
                '$RpDiskon',
                '$total',
                '$pembayaran',
                '$selisih',
                '$keterangan',
                '$SessionNama'
            )";
            $hasil=mysqli_query($conn, $entry);
            //Apabila input transaksi berhasil
            if($hasil){
                if($jenis_transaksi=="penjualan"){
                    //Arraykan rincian transaksi
                    $QryRincianTrans = mysqli_query($conn, "SELECT*FROM rincian_transaksi WHERE kode_transaksi='$kode_transaksi'");
                    while ($DataRincianTrans = mysqli_fetch_array($QryRincianTrans)) {
                        $id_obat = $DataRincianTrans['id_obat'];
                        $qty= $DataRincianTrans['qty'];
                        $id_multi= $DataRincianTrans['id_multi'];
                        //Buka Data barang
                        $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                        $DataObat = mysqli_fetch_array($QryObat);
                        $stok = $DataObat['stok'];
                        $konversiBarang = $DataObat['konversi'];
                        //Jika rincian tidak mengandung multi harga
                        if(empty($id_multi)){
                            //Stok Baru
                            if($jenis_transaksi=="penjualan"){
                                $StokBaru=$stok-$qty;
                            }else{
                                $StokBaru=$stok+$qty;
                            }
                            //Update Stok Obat
                            $EditObat = mysqli_query($conn, "UPDATE obat SET stok='$StokBaru' WHERE id_obat='$id_obat'") or die(mysqli_error($conn));
                            //Buka Data Obat Lagi
                            $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                            $DataObat = mysqli_fetch_array($QryObat);
                            $stok = $DataObat['stok'];
                            $konversiBarang = $DataObat['konversi'];
                            //Araykan data multi sesuai id barang
                            $QryMutiList = mysqli_query($conn, "SELECT*FROM muti_harga WHERE id_barang='$id_obat'");
                            while ($DataMutiList = mysqli_fetch_array($QryMutiList)) {
                                $id_multiList = $DataMutiList['id_multi'];
                                $KonversiList = $DataMutiList['konversi'];
                                $StokList = $DataMutiList['stok'];
                                $StokBaruList=($konversiBarang/$KonversiList)*$stok;
                                //lakukan Update pada setiap data muti harga
                                $UpdateMutiHarga = mysqli_query($conn, "UPDATE muti_harga SET stok='$StokBaruList' WHERE id_multi='$id_multiList'") or die(mysqli_error($conn));
                            }
                        }else{
                            //Sebaliknya Jika rincian mengandung multi harga
                            //Buka data multi untuk mengetahui konversi multi
                            $QryMulti = mysqli_query($conn, "SELECT * FROM muti_harga WHERE id_multi='$id_multi'")or die(mysqli_error($conn));
                            $DataMulti = mysqli_fetch_array($QryMulti);
                            $konversiMulti = $DataMulti['konversi'];
                            //konversikan qty rincian pada satuan utama
                            $qty=($konversiMulti/$konversiBarang)*$qty;
                            //Stok Baru
                            if($jenis_transaksi=="penjualan"){
                                $StokBaru=$stok-$qty;
                            }else{
                                $StokBaru=$stok+$qty;
                            }
                            //Updatekan ke data barang
                            $EditObat = mysqli_query($conn, "UPDATE obat SET stok='$StokBaru' WHERE id_obat='$id_obat'") or die(mysqli_error($conn));
                            //Buka Data Obat Lagi
                            $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                            $DataObat = mysqli_fetch_array($QryObat);
                            $stok = $DataObat['stok'];
                            $konversiBarang = $DataObat['konversi'];
                            //Araykan data multi sesuai id barang
                            $QryMutiList = mysqli_query($conn, "SELECT*FROM muti_harga WHERE id_barang='$id_obat'");
                            while ($DataMutiList = mysqli_fetch_array($QryMutiList)) {
                                $id_multiList = $DataMutiList['id_multi'];
                                $KonversiList = $DataMutiList['konversi'];
                                $StokList = $DataMutiList['stok'];
                                $StokBaruList=($konversiBarang/$KonversiList)*$stok;
                                //lakukan Update pada setiap data muti harga
                                $UpdateMutiHarga = mysqli_query($conn, "UPDATE muti_harga SET stok='$StokBaruList' WHERE id_multi='$id_multiList'") or die(mysqli_error($conn));
                            }
                        }
                        
                    }
                    $entryToken="INSERT INTO validasi_input (
                        waktu,
                        token
                    ) VALUES (
                        '$WaktuSekarang',
                        '$milliseconds'
                    )";
                    $hasilToken=mysqli_query($conn, $entryToken);
                    if($hasilToken){
                        if($UpdateHarga=="Ya"){
                            //Lakukan Update Harga Berdasarkan rincian transaksi
                            $QryRincianTrans_update_harga = mysqli_query($conn, "SELECT*FROM rincian_transaksi WHERE kode_transaksi='$kode_transaksi'");
                            while ($DataRincianTrans_update_harga = mysqli_fetch_array($QryRincianTrans_update_harga)) {
                                $id_obat_update_harga = $DataRincianTrans_update_harga['id_obat'];
                                $standar_harga_update_harga= $DataRincianTrans_update_harga['standar_harga'];
                                $id_multi_update_harga= $DataRincianTrans_update_harga['id_multi'];
                                $harga_update_harga= $DataRincianTrans_update_harga['harga'];
                                if($standar_harga_update_harga=="harga_1"){
                                    $StandarHargaUpdateMulti="harga1";
                                }else{
                                    if($standar_harga_update_harga=="harga_2"){
                                        $StandarHargaUpdateMulti="harga2";
                                    }else{
                                        if($standar_harga_update_harga=="harga_3"){
                                            $StandarHargaUpdateMulti="harga3";
                                        }else{
                                            if($standar_harga_update_harga=="harga_4"){
                                                $StandarHargaUpdateMulti="harga4";
                                            }else{
                                                if($standar_harga_update_harga==""){
                                                    $standar_harga_update_harga="harga_3";
                                                    $StandarHargaUpdateMulti="harga3";
                                                }
                                            }
                                        }
                                    }
                                }
                                if(empty($id_multi_update_harga)){
                                    $EditObat_update_harga = mysqli_query($conn, "UPDATE obat SET $standar_harga_update_harga='$harga_update_harga' WHERE id_obat='$id_obat_update_harga'") or die(mysqli_error($conn));
                                }else{
                                    $UpdateMutiHarga_update_harga = mysqli_query($conn, "UPDATE muti_harga SET $StandarHargaUpdateMulti='$harga_update_harga' WHERE id_multi='$id_multi_update_harga'") or die(mysqli_error($conn));
                                }
                            }
                            echo '<i id="NotifikasiSettingTransaksiBerhasil">Berhasil</i>';
                        }else{
                            echo '<i id="NotifikasiSettingTransaksiBerhasil">Berhasil</i>';
                        }
                    }else{
                        echo '<i id="NotifikasiSettingTransaksiBerhasil">Gagal Input Token</i>';
                    }
                }else{
                   //Arraykan rincian transaksi
                    $QryRincianTrans = mysqli_query($conn, "SELECT*FROM rincian_transaksi WHERE kode_transaksi='$kode_transaksi'");
                    while ($DataRincianTrans = mysqli_fetch_array($QryRincianTrans)) {
                        $id_obat = $DataRincianTrans['id_obat'];
                        $qty= $DataRincianTrans['qty'];
                        $id_multi= $DataRincianTrans['id_multi'];
                        //Buka Data Obat
                        $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                        $DataObat = mysqli_fetch_array($QryObat);
                        $stok = $DataObat['stok'];
                        $konversiBarang = $DataObat['konversi'];
                        //Jika rincian tidak mengandung multi harga
                        if(empty($id_multi)){
                            //Stok Baru
                            if($jenis_transaksi=="penjualan"){
                                $StokBaru=$stok-$qty;
                            }else{
                                $StokBaru=$stok+$qty;
                            }
                            //Update Stok Obat
                            $EditObat = mysqli_query($conn, "UPDATE obat SET stok='$StokBaru' WHERE id_obat='$id_obat'") or die(mysqli_error($conn));
                            //Buka Data Obat Lagi
                            $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                            $DataObat = mysqli_fetch_array($QryObat);
                            $stok = $DataObat['stok'];
                            $konversiBarang = $DataObat['konversi'];
                            //Araykan data multi sesuai id barang
                            $QryMutiList = mysqli_query($conn, "SELECT*FROM muti_harga WHERE id_barang='$id_obat'");
                            while ($DataMutiList = mysqli_fetch_array($QryMutiList)) {
                                $id_multiList = $DataMutiList['id_multi'];
                                $KonversiList = $DataMutiList['konversi'];
                                $StokList = $DataMutiList['stok'];
                                $StokBaruList=($konversiBarang/$KonversiList)*$stok;
                                //lakukan Update pada setiap data muti harga
                                $UpdateMutiHarga = mysqli_query($conn, "UPDATE muti_harga SET stok='$StokBaruList' WHERE id_multi='$id_multiList'") or die(mysqli_error($conn));
                            }
                        }else{
                            //Sebaliknya Jika rincian mengandung multi harga
                            //Buka data multi untuk mengetahui konversi multi
                            $QryMulti = mysqli_query($conn, "SELECT * FROM muti_harga WHERE id_multi='$id_multi'")or die(mysqli_error($conn));
                            $DataMulti = mysqli_fetch_array($QryMulti);
                            $konversiMulti = $DataMulti['konversi'];
                            //konversikan qty rincian pada satuan utama
                            $qty=($konversiMulti/$konversiBarang)*$qty;
                            //Stok Baru
                            if($jenis_transaksi=="penjualan"){
                                $StokBaru=$stok-$qty;
                            }else{
                                $StokBaru=$stok+$qty;
                            }
                            //Updatekan ke data barang
                            $EditObat = mysqli_query($conn, "UPDATE obat SET stok='$StokBaru' WHERE id_obat='$id_obat'") or die(mysqli_error($conn));
                            //Buka Data Obat Lagi
                            $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                            $DataObat = mysqli_fetch_array($QryObat);
                            $stok = $DataObat['stok'];
                            $konversiBarang = $DataObat['konversi'];
                            //Araykan data multi sesuai id barang
                            $QryMutiList = mysqli_query($conn, "SELECT*FROM muti_harga WHERE id_barang='$id_obat'");
                            while ($DataMutiList = mysqli_fetch_array($QryMutiList)) {
                                $id_multiList = $DataMutiList['id_multi'];
                                $KonversiList = $DataMutiList['konversi'];
                                $StokList = $DataMutiList['stok'];
                                $StokBaruList=($konversiBarang/$KonversiList)*$stok;
                                //lakukan Update pada setiap data muti harga
                                $UpdateMutiHarga = mysqli_query($conn, "UPDATE muti_harga SET stok='$StokBaruList' WHERE id_multi='$id_multiList'") or die(mysqli_error($conn));
                            }
                        }
                        
                    }
                    $entryToken="INSERT INTO validasi_input (
                        waktu,
                        token
                    ) VALUES (
                        '$WaktuSekarang',
                        '$milliseconds'
                    )";
                    $hasilToken=mysqli_query($conn, $entryToken);
                    if($hasilToken){
                        if($UpdateHarga=="Ya"){
                            //Lakukan Update Harga Berdasarkan rincian transaksi
                            $QryRincianTrans_update_harga = mysqli_query($conn, "SELECT*FROM rincian_transaksi WHERE kode_transaksi='$kode_transaksi'");
                            while ($DataRincianTrans_update_harga = mysqli_fetch_array($QryRincianTrans_update_harga)) {
                                $id_obat_update_harga = $DataRincianTrans_update_harga['id_obat'];
                                $standar_harga_update_harga= $DataRincianTrans_update_harga['standar_harga'];
                                $id_multi_update_harga= $DataRincianTrans_update_harga['id_multi'];
                                $harga_update_harga= $DataRincianTrans_update_harga['harga'];
                                if($standar_harga_update_harga=="harga_1"){
                                    $StandarHargaUpdateMulti="harga1";
                                }else{
                                    if($standar_harga_update_harga=="harga_2"){
                                        $StandarHargaUpdateMulti="harga2";
                                    }else{
                                        if($standar_harga_update_harga=="harga_3"){
                                            $StandarHargaUpdateMulti="harga3";
                                        }else{
                                            if($standar_harga_update_harga=="harga_4"){
                                                $StandarHargaUpdateMulti="harga4";
                                            }else{
                                                if($standar_harga_update_harga==""){
                                                    $standar_harga_update_harga="harga_3";
                                                    $StandarHargaUpdateMulti="harga3";
                                                }
                                            }
                                        }
                                    }
                                }
                                if(empty($id_multi_update_harga)){
                                    $EditObat_update_harga = mysqli_query($conn, "UPDATE obat SET $standar_harga_update_harga='$harga_update_harga' WHERE id_obat='$id_obat_update_harga'") or die(mysqli_error($conn));
                                }else{
                                    $UpdateMutiHarga_update_harga = mysqli_query($conn, "UPDATE muti_harga SET $StandarHargaUpdateMulti='$harga_update_harga' WHERE id_multi='$id_multi_update_harga'") or die(mysqli_error($conn));
                                }
                            }
                            echo '<i id="NotifikasiSettingTransaksiBerhasil">Berhasil</i>';
                        }else{
                            echo '<i id="NotifikasiSettingTransaksiBerhasil">Berhasil</i>';
                        }
                    }else{
                        echo '<i id="NotifikasiSettingTransaksiBerhasil">Gagal Input Token</i>';
                    }
                }
            }else{
                echo '<i id="NotifikasiSettingTransaksiBerhasil">Tambah Data Transaksi Gagal!</i>';
            }
        }else{
        //Apabila Edit Transaksi
            $EditTransaksi = mysqli_query($conn, "UPDATE transaksi SET 
                subtotal='$subtotal', 
                ppn='$RpPPN', 
                diskon='$RpDiskon',
                total_tagihan='$total',
                pembayaran='$pembayaran',
                selisih='$selisih',
                keterangan='$keterangan'
            WHERE kode_transaksi='$kode_transaksi'") or die(mysqli_error($conn));
            if($EditTransaksi){
                //Lakukan Update Harga Berdasarkan rincian transaksi
                $QryRincianTrans_update_harga = mysqli_query($conn, "SELECT*FROM rincian_transaksi WHERE kode_transaksi='$kode_transaksi'");
                while ($DataRincianTrans_update_harga = mysqli_fetch_array($QryRincianTrans_update_harga)) {
                    $id_obat_update_harga = $DataRincianTrans_update_harga['id_obat'];
                    $standar_harga_update_harga= $DataRincianTrans_update_harga['standar_harga'];
                    $id_multi_update_harga= $DataRincianTrans_update_harga['id_multi'];
                    $harga_update_harga= $DataRincianTrans_update_harga['harga'];
                    if($standar_harga_update_harga=="harga_1"){
                        $StandarHargaUpdateMulti="harga1";
                    }else{
                        if($standar_harga_update_harga=="harga_2"){
                            $StandarHargaUpdateMulti="harga2";
                        }else{
                            if($standar_harga_update_harga=="harga_3"){
                                $StandarHargaUpdateMulti="harga3";
                            }else{
                                if($standar_harga_update_harga=="harga_4"){
                                    $StandarHargaUpdateMulti="harga4";
                                }else{
                                    if($standar_harga_update_harga==""){
                                        $standar_harga_update_harga="harga_3";
                                        $StandarHargaUpdateMulti="harga3";
                                    }
                                }
                            }
                        }
                    }
                    if(empty($id_multi_update_harga)){
                        $EditObat_update_harga = mysqli_query($conn, "UPDATE obat SET $standar_harga_update_harga='$harga_update_harga' WHERE id_obat='$id_obat_update_harga'") or die(mysqli_error($conn));
                    }else{
                        $UpdateMutiHarga_update_harga = mysqli_query($conn, "UPDATE muti_harga SET $StandarHargaUpdateMulti='$harga_update_harga' WHERE id_multi='$id_multi_update_harga'") or die(mysqli_error($conn));
                    }
                }
                echo '<i id="NotifikasiSettingTransaksiBerhasil">Berhasil</i>';
            }else{
                echo '<i id="NotifikasiSettingTransaksiBerhasil">Edit Data Transaksi Gagal!</i>';
            }
        }
    }
?>