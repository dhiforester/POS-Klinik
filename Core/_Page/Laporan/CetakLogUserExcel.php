<?php
    //koneksi dan error
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=LaporanLogUser.xls");
    include "../../_Config/Connection.php";
    //KategoriLaporan
    if(!empty($_GET['kategori'])){
        $KategoriLaporan=$_GET['kategori'];
    }else{
        $KategoriLaporan="Harian";
    }
    //mode_laporan
    if(!empty($_GET['mode_laporan'])){
        $mode_laporan=$_GET['mode_laporan'];
    }else{
        $mode_laporan="Rekapitulasi";
    }
    //GetIdAkses
    if(empty($_GET['id_akses'])){
        $GetIdAkses = "id_akses";
    }else{
        $GetIdAkses = $_GET['id_akses'];
    }
    //OrderBy
    if(!empty($_GET['OrderBy'])){
        $OrderBy=$_GET['OrderBy'];
    }else{
        $OrderBy="id_transaksi";
    }
    //ShortBy
    if(!empty($_GET['ShortBy'])){
        $ShortBy=$_GET['ShortBy'];
    }else{
        $ShortBy="ASC";
    }
    //tanggal
    if(!empty($_GET['tanggal'])){
        $tanggal=$_GET['tanggal'];
    }else{
        $tanggal="";
    }
    //tahun
    if(!empty($_GET['tahun'])){
        $tahun=$_GET['tahun'];
    }else{
        $tahun="";
    }
    //bulan
    if(!empty($_GET['bulan'])){
        $bulan=$_GET['bulan'];
    }else{
        $bulan="";
    }
    //periode1
    if(!empty($_GET['periode1'])){
        $periode1=$_GET['periode1'];
    }else{
        $periode1="";
    }
    //periode2
    if(!empty($_GET['periode2'])){
        $periode2=$_GET['periode2'];
    }else{
        $periode2="";
    }
    $bulanan="$tahun-$bulan";
    //explode bulan
    $bulan_explode = explode("-", $bulanan);
    $NamaTahun=$bulan_explode[0];
    $AngkaBulan=$bulan_explode[1];
    if($AngkaBulan=="01"){
        $NamaBulan="Januari";
    }elseif($AngkaBulan=="02"){
        $NamaBulan="Februari";
    }elseif($AngkaBulan=="03"){
        $NamaBulan="Maret";
    }elseif($AngkaBulan=="04"){
        $NamaBulan="April";
    }elseif($AngkaBulan=="05"){
        $NamaBulan="Mei";
    }elseif($AngkaBulan=="06"){
        $NamaBulan="Juni";
    }elseif($AngkaBulan=="07"){
        $NamaBulan="Juli";
    }elseif($AngkaBulan=="08"){
        $NamaBulan="Agustus";
    }elseif($AngkaBulan=="09"){
        $NamaBulan="September";
    }elseif($AngkaBulan=="10"){
        $NamaBulan="Oktober";
    }elseif($AngkaBulan=="11"){
        $NamaBulan="November";
    }elseif($AngkaBulan=="12"){
        $NamaBulan="Desember";
    }
    //Buka Setting percetakan
    $QrySetting = mysqli_query($conn, "SELECT * FROM setting_cetak WHERE kategori_setting='percetakan_laporan'")or die(mysqli_error($conn));
    $DataSetting = mysqli_fetch_array($QrySetting);
    $kategori_setting = $DataSetting['kategori_setting'];
	$margin_atas = $DataSetting['margin_atas'];
	$margin_bawah = $DataSetting['margin_bawah'];
	$margin_kiri = $DataSetting['margin_kiri'];
	$margin_kanan = $DataSetting['margin_kanan'];
	$panjang_x = $DataSetting['panjang_x'];
	$lebar_y = $DataSetting['lebar_y'];
	$jenis_font = $DataSetting['jenis_font'];
	$ukuran_font = $DataSetting['ukuran_font'];
    $warna_font = $DataSetting['warna_font'];
    //Buka data Setting Aplikasi
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
?>
<html>
    <head>
        <style type="text/css">
           body{
                font-size: <?php echo "$ukuran_font";?>px;
                font-family: <?php echo "$jenis_font";?>;
                color: <?php echo "$warna_font";?>;
            }
            table.data tr td{
                border: 1px groove #999;
                padding: 5px;
                font-size: <?php echo "$ukuran_font";?>px;
                font-family: <?php echo "$jenis_font";?>;
                color: <?php echo "$warna_font";?>;
            }
        </style>
    </head>
    <body>
        <table class="data" width="95%" cellspacing="0">
            <tr>
                <td align="center" colspan="5">
                    <?php
                        echo "<h2>$nama_perusahaan</h2>";
                        echo "$alamat $kontak";
                        if($mode_laporan=="Rekapitulasi"){
                            if($KategoriLaporan=="Harian"){
                                echo '<h3>Rekapitulasi Transaksi Tangal '.$tanggal.'</h3>';
                            }elseif($KategoriLaporan=="Bulanan"){
                                echo '<h3>Rekapitulasi Transaksi Bulan  '.$NamaBulan.' '.$NamaTahun.'</h3>';
                            }elseif($KategoriLaporan=="Periode"){
                                echo '<h3>Rekapitulasi Transaksi Periode '.$periode1.' s/d '.$periode2.'</h3>';
                            }elseif($KategoriLaporan=="Tahunan"){
                                echo '<h3>Rekapitulasi Transaksi Tahun '.$tahun.'</h3>';
                            }
                        }else{
                            //Buka data akses
                            $sql_akses = "SELECT * FROM akses WHERE id_akses='$GetIdAkses'";
                            $qry_akses = mysqli_query($conn, $sql_akses);
                            $data_akses = mysqli_fetch_array($qry_akses);
                            $NamaPetugasAkses=$data_akses['nama'];
                            if($KategoriLaporan=="Harian"){
                                echo '<h3>Uraian Transaksi '.$NamaPetugasAkses.' Tangal '.$tanggal.'</h3>';
                            }elseif($KategoriLaporan=="Bulanan"){
                                echo '<h3>Uraian Transaksi '.$NamaPetugasAkses.' Bulan  '.$NamaBulan.' '.$NamaTahun.'</h3>';
                            }elseif($KategoriLaporan=="Periode"){
                                echo '<h3>Uraian Transaksi '.$NamaPetugasAkses.' Periode '.$periode1.' s/d '.$periode2.'</h3>';
                            }elseif($KategoriLaporan=="Tahunan"){
                                echo '<h3>Uraian Transaksi '.$NamaPetugasAkses.' Tahun '.$tahun.'</h3>';
                            }
                        }
                    ?>
                    
                </td>
            </tr>
            <?php
                if($mode_laporan=="Rekapitulasi"){
                    echo '<tr>';
                    echo '  <td><b>No</b></td>';
                    echo '  <td><b>Petugas</b></td>';
                    echo '  <td><b>Transaksi</b></td>';
                    echo '  <td><b>Jumlah</b></td>';
                    echo '  <td><b>Rate</b></td>';
                    echo '</tr>';
                }else{
                    echo '<tr>';
                    echo '  <td><b>No</b></td>';
                    echo '  <td><b>Kode</b></td>';
                    echo '  <td><b>Tanggal</b></td>';
                    echo '  <td><b>Petugas</b></td>';
                    echo '  <td><b>Jumlah</b></td>';
                    echo '</tr>';
                }
                if($mode_laporan=="Rekapitulasi"){
                    $no = 1;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($conn, "SELECT*FROM akses ORDER BY id_akses");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_akses = $data['id_akses'];
                        if($KategoriLaporan=="Harian"){
                            //Jumlah Data Transaksi
                            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$id_akses' AND tanggal like '%$tanggal%'"));
                            //Akumulasi transaksi
                            $QryTransaksi = mysqli_query($conn, "SELECT SUM(total_tagihan) AS total_tagihan FROM transaksi WHERE id_akses='$id_akses' AND tanggal like '%$tanggal%'");
                        }
                        if($KategoriLaporan=="Bulanan"){
                            //Jumlah Data Transaksi
                            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$id_akses' AND tanggal like '%$bulanan%'"));
                            //Akumulasi transaksi
                            $QryTransaksi = mysqli_query($conn, "SELECT SUM(total_tagihan) AS total_tagihan FROM transaksi WHERE id_akses='$id_akses' AND tanggal like '%$bulanan%'");
                        }
                        if($KategoriLaporan=="Tahunan"){
                            //Jumlah Data Transaksi
                            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$id_akses' AND tanggal like '%$tahun%'"));
                            //Akumulasi transaksi
                            $QryTransaksi = mysqli_query($conn, "SELECT SUM(total_tagihan) AS total_tagihan FROM transaksi WHERE id_akses='$id_akses' AND tanggal like '%$tahun%'");
                        }
                        if($KategoriLaporan=="Periode"){
                            //Jumlah Data Transaksi
                            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$id_akses' AND tanggal>='$periode1' AND tanggal<='$periode2'"));
                            //Akumulasi transaksi
                            $QryTransaksi = mysqli_query($conn, "SELECT SUM(total_tagihan) AS total_tagihan FROM transaksi WHERE id_akses='$id_akses' AND tanggal>='$periode1' AND tanggal<='$periode2'");
                        }
                        $dataTransaksi = mysqli_fetch_array($QryTransaksi);
                        $total_tagihan = $dataTransaksi['total_tagihan'];
                        $RpTotalTagihan=number_format($total_tagihan,0,",",".");
                        //Hitung sales rate
                        if(!empty($total_tagihan)){
                            $rate=($total_tagihan/$jml_data);
                            $RpRate=number_format($rate,0,",",".");
                        }else{
                            $rate=0;
                            $RpRate=0;
                        }
                        
                        echo '<tr>';
                        echo '  <td align="center">'.$no.'</td>';
                        echo '  <td align="left">'.$username.'</td>';
                        echo '  <td align="right">'.$jml_data.' Transaksi </td>';
                        echo '  <td align="right">'.$total_tagihan.'</td>';
                        echo '  <td align="right">'.$rate.'</td>';
                        echo '</tr>';
                        $no++;
                    }
                }else{
                    $no = 1;
                    $JumlahTransaksi=0;
                    //KONDISI PENGATURAN MASING FILTER
                    if($KategoriLaporan=="Harian"){
                        $query = mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$GetIdAkses' AND tanggal like '%$tanggal%' ORDER BY id_transaksi DESC");
                    }
                    if($KategoriLaporan=="Bulanan"){
                        $query = mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$GetIdAkses' AND tanggal like '%$bulanan%' ORDER BY id_transaksi DESC");
                    }
                    if($KategoriLaporan=="Tahunan"){
                        $query = mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$GetIdAkses' AND tanggal like '%$tahun%' ORDER BY id_transaksi DESC");
                    }
                    if($KategoriLaporan=="Periode"){
                        $query = mysqli_query($conn, "SELECT*FROM transaksi WHERE id_akses='$GetIdAkses' AND tanggal>='$periode1' AND tanggal<='$periode2' ORDER BY id_transaksi DESC");
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        $id_transaksi = $data['id_transaksi'];
                        $kode_transaksi = $data['kode_transaksi'];
                        $TanggalTransaksi = $data['tanggal'];
                        $NamaPetugas = $data['petugas'];
                        $total_tagihan = $data['total_tagihan'];
                        $JumlahTransaksi=$JumlahTransaksi+$total_tagihan;
                        $Rptotal_tagihan=number_format($total_tagihan,0,",",".");
                        echo '<tr>';
                        echo '  <td align="center">'.$no.'</td>';
                        echo '  <td align="left">'.$kode_transaksi.'</td>';
                        echo '  <td align="left">'.$TanggalTransaksi.' </td>';
                        echo '  <td align="ceter">'.$NamaPetugas.'</td>';
                        echo '  <td align="right">'.$total_tagihan.'</td>';
                        echo '</tr>';
                        $no++;
                    }
                    echo '<tr>';
                    echo '  <td align="right" colspan="4">JUMLAH TRANSAKSI</td>';
                    echo '  <td align="left">'.$JumlahTransaksi.'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </body>
</html>