<?php
    //error display
    ini_set("display_errors","off");
    date_default_timezone_set('Asia/Jakarta');
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
    $Qry = mysqli_query($conn, "SELECT * FROM setting_aplikasi")or die(mysqli_error($conn));
    $DataSetting = mysqli_fetch_array($Qry);
    //Nama Perusahaan
    if(!empty($DataSetting['nama_perusahaan'])){
        $nama_perusahaan = $DataSetting['nama_perusahaan'];
    }else{
        $nama_perusahaan = "Parasilva Technology";
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
    //Buka data setting
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
    

    $FileName= "LaporanAsset";
    //Config Plugin MPDF
    define('_MPDF_PATH','../../vendors/mpdf60/');
    include(_MPDF_PATH . "mpdf.php");
    $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y));
    $html='<style>@page *{margin-top: 0px;}</style>'; 
    //Beginning Buffer to save PHP variables and HTML tags
    ob_start(); 
?>
<html>
    <head>
        <title>Laporan asset</title>
        <style type="text/css">
            @page {
                margin-top: <?php echo "$margin_atas"; ?>mm;
                margin-bottom: <?php echo "$margin_bawah"; ?>mm;
                margin-left: <?php echo "$margin_kiri"; ?>mm;
                margin-right: <?php echo "$margin_kanan"; ?>mm;
            }
            body{
                font-size: <?php echo "$ukuran_font";?>px;
                font-family: <?php echo "$jenis_font";?>;
                color: <?php echo "$warna_font";?>;
            }
            table tr td{
                border: 1px groove #000000;
                padding: 2px;
                font-size: <?php echo "$ukuran_font";?>px;
                font-family: <?php echo "$jenis_font";?>;
                color: <?php echo "$warna_font";?>;
            }
            table.rincian tr td{
                border: 1px groove #000000;
                padding: 5px;
                font-size: <?php echo "$ukuran_font";?>px;
                font-family: <?php echo "$jenis_font";?>;
                color: <?php echo "$warna_font";?>;
            }
        </style>
    </head>
    <body>
        <table class="rincian" cellspacing="0">
            <tr>
                <td align="center" colspan="3">
                    <h2><?php echo "$nama_perusahaan";?></h2>
                    <?php echo "$alamat $kontak";?>
                </td>
            </tr>
            <tr>
                <td align="center"><b>No</b></td>
                <td align="center"><b>Kategori</b></td>
                <td align="center"><b>Jumlah</b></td>
            </tr>
            <?php
                $no = 1;
                $JumlahAsset=0;
                $QryKategori = mysqli_query($conn, "SELECT DISTINCT kategori FROM obat ORDER BY kategori $ShortBy");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $kategori= $DataKategori['kategori'];
                    $JumlahAssetByategori=0;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($conn, "SELECT*FROM obat WHERE kategori='$kategori' ORDER BY nama $ShortBy");
                    while ($data = mysqli_fetch_array($query)) {
                        $stok = $data['stok'];
                        $harga_acuan = $data[$harga];
                        $jumlah=$stok*$harga_acuan;
                        $JumlahAssetByategori=$JumlahAssetByategori+$jumlah;
                    }
                    $JumlahAsset=$JumlahAsset+$JumlahAssetByategori;
            ?>
                <tr>
                    <td align="center"><?php echo "$no";?></td>
                    <td><?php echo "$kategori";?></td>
                    <td align="right"><?php echo "Rp " . number_format($JumlahAssetByategori,0,',','.'); ?></td>
                </tr>
            <?php 
                $no++;} 
            ?>
            <tr>
                <td align="right" colspan="2">JUMLAH TOTAL AKUMULASI</td>
                <td align="right"><?php echo "Rp " . number_format($JumlahAsset,0,',','.'); ?></td>
            </tr>
        </table>
    </body>
</html>
<?php
    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($FileName.".pdf" ,'I');
    exit;
?>