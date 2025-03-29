<?php 
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=LaporanAsset.xls");
    //koneksi dan error
    include "../../_Config/Connection.php";
    //koneksi dan error
    include "../../_Config/Connection.php";
    //ShortBy
    if(!empty($_GET['ShortBy'])){
        $ShortBy=$_GET['ShortBy'];
    }else{
        $ShortBy="ASC";
    }
    if(!empty($_GET['harga'])){
        $harga=$_GET['harga'];
    }else{
        $harga="harga_1";
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
?> 
<html>
    <head>
            <style type="text/css">
                table tr td {
                    border: 0.5px solid #666;
                    font-size:11px;
                    color:#333;
                    border-spacing: 0px;
                    padding: 4px;
                }
            </style>
    </head>
    <body>
        <table>
            <tr>
                <td align="center" colspan="7">
                    <h2><?php echo "$nama_perusahaan";?></h2>
                    <?php echo "$alamat $kontak";?>
                </td>
            </tr>
            <tr>
                <td align="center"><b>No</b></td>
                <td align="center"><b>Kode</b></td>
                <td align="center"><b>Nama Barang</b></td>
                <td align="center"><b>Kategori</b></td>
                <td align="center"><b>Qty</b></td>
                <td align="center"><b>Harga</b></td>
                <td align="center"><b>Jumlah</b></td>
            </tr>
            <?php
                $no = 1;
                $JumlahAsset=0;
                //KONDISI PENGATURAN MASING FILTER
                $query = mysqli_query($conn, "SELECT*FROM obat ORDER BY nama $ShortBy");
                while ($data = mysqli_fetch_array($query)) {
                    $id_obat = $data['id_obat'];
                    $kode = $data['kode'];
                    $NamaBarang = $data['nama'];
                    $kategori = $data['kategori'];
                    $satuan = $data['satuan'];
                    $stok = $data['stok'];
                    $harga_acuan = $data[$harga];
                    //Rp Harga
                    $jumlah=$stok*$harga_acuan;
                    $JumlahAsset=$JumlahAsset+$jumlah;
            ?>
            <tr>
                <td align="center"><?php echo "$no";?></td>
                <td align="left"><?php echo "$kode";?></td>
                <td align="left"><?php echo "$NamaBarang";?></td>
                <td align="left"><?php echo "$kategori";?></td>
                <td align="left"><?php echo "$stok $satuan";?></td>
                <td align="right"><?php echo "$harga_acuan";?></td>
                <td align="right"><?php echo "$jumlah";?></td>
            </tr>
            <?php $no++;} ?>
            <tr class="text-white">
                <td colspan="6" align="right"><b>JUMLAH ASSET/NOMINAL</b></td>
                <td align="right"> <?php echo "$JumlahAsset"; ?> </td>
            </tr>
        </table>
    </body>
</html>