<?php
    //error display
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SettingCetakNota.php";
    //Tangkap Kode Transaksi
    if(!empty($_GET['kode_transaksi'])){
        $kode_transaksi=$_GET['kode_transaksi'];
    }else{
        $kode_transaksi="";
    }
    $FileName= "Nota  $kode_transaksi";
    //Config Plugin MPDF
    define('_MPDF_PATH','../../vendors/mpdf60/');
    include(_MPDF_PATH . "mpdf.php");
    $mpdf=new mPDF('utf-8', array($PanjangSettingNota,$LebarSettingNota));
    $html='<style>@page *{margin-top: 0px;}</style>'; 
    //Beginning Buffer to save PHP variables and HTML tags
    ob_start(); 
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
    if(empty($DataTransaksi['pembayaran'])){
        $pembayaran="0";
    }else{
        $pembayaran = $DataTransaksi['pembayaran'];
    }
    $selisih = $DataTransaksi['selisih'];
    $keterangan = $DataTransaksi['keterangan'];
    $petugas = $DataTransaksi['petugas'];
    //Menghiutng persen ppn dan diskon
    $ppn=($RpPpn/$subtotal)*100;
    $diskon=($RpDiskon/$subtotal)*100;
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
?>
<html>
    <head>
        <title>Cetak Nota <?php echo "$kode_transaksi"; ?></title>
        <style type="text/css">
            @page {
                margin-top: <?php echo "$MarginAtasSettingNota"; ?>mm;
                margin-bottom: <?php echo "$MarginBawahNota"; ?>mm;
                margin-left: <?php echo "$MarginKiriNota"; ?>mm;
                margin-right: <?php echo "$MarginKananNota"; ?>mm;
            }
            body{
                font-size: <?php echo "$UkuranFornSettingNota";?>px;
                font-family: <?php echo "$NamaFornSettingNota";?>;
                color: <?php echo "$WarnaFornSettingNota";?>;
            }
            table tr td{
                border: none;
                padding: 0px;
                font-size: <?php echo "$UkuranFornSettingNota";?>px;
                font-family: <?php echo "$NamaFornSettingNota";?>;
                color: <?php echo "$WarnaFornSettingNota";?>;
            }
            table.rincian tr td{
                border-bottom: 1px dotted #999;
                padding: 0px;
                font-size: <?php echo "$UkuranFornSettingNota";?>px;
                font-family: <?php echo "$NamaFornSettingNota";?>;
                color: <?php echo "$WarnaFornSettingNota";?>;
            }
            table tr td.title{
                font-size: <?php echo "$UkuranFornSettingNota";?>;
                font-weight: bolder;
            }
        </style>
    </head>
    <body>
        <table width="100%">
            <tr>
                <td colspan="3" align="center" class="title">
                    <?php 
                        if(!empty($nama_perusahaan)){
                            echo "<b>$nama_perusahaan</b>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center" class="">
                    <?php 
                        if(!empty($alamat)){
                            echo "$alamat";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td><b>Kode Transaksi</b></td>
                <td><b>:</b></td>
                <td><?php echo "$kode_transaksi";?></td>
            </tr>
            <tr>
                <td><b>Tanggal</b></td>
                <td><b>:</b></td>
                <td><?php echo "$tanggal";?></td>
            </tr>
            <tr>
                <td><b>Transaksi</b></td>
                <td><b>:</b></td>
                <td><?php echo "$trans";?></td>
            </tr>
            <?php
                if(!empty($DataKunjungan['nama'])){
                    echo '<tr>';
                    echo '  <td><b>Pasien</b></td>';
                    echo '  <td><b>:</b></td>';
                    echo '  <td>'.$nama_pasien.'</td>';
                    echo '</tr>';
                }
                if(!empty($DataMember['id_member'])){
                    echo '<tr>';
                    echo '  <td><b>Supplier</b></td>';
                    echo '  <td><b>:</b></td>';
                    echo '  <td>'.$NamaMember.'</td>';
                    echo '</tr>';
                }
            ?>
            <tr>
                <td><b>Petugas Kasir</b></td>
                <td><b>:</b></td>
                <td><?php echo "$petugas";?></td>
            </tr>
        </table>
        <table width="100%" class="rincian" cellspacing="0">
            <tr>
                <td align="center"><b>No</b></td>
                <td align="center"><b>Nama/Merek Barang</b></td>
                <td align="center"><b>QTY</b></th>
                <td align="center"><b>Harga</b></td>
                <td align="center"><b>Jumlah</b></td>
            </tr>
            <?php
                $no = 1;
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
            ?>
            <tr>
                <td><?php echo "$no";?></td>
                <td><?php echo "$nama";?></td>
                <td><?php echo "$qty";?></td>
                <td align="right"><?php echo "" . number_format($harga,0,',','.');?></td>
                <td align="right"><?php echo "" . number_format($jumlah,0,',','.');?></td>
            </tr>
            <?php 
                $no++;} 
            ?>
            <tr>
                <td colspan="4" align="right">SUBTOTAL</td>
                <td align="right"><?php echo "" . number_format($subtotal,0,',','.');?></td>
            </tr>
            <?php if(!empty($RpPpn)){ ?>
                <tr>
                    <td colspan="4" align="right">PPN <?php echo "($ppn %)";?></td>
                    <td align="right"><?php echo "" . number_format($RpPpn,0,',','.');?></td>
                </tr>
            <?php }if(!empty($RpDiskon)){ ?>
                <tr>
                    <td colspan="4" align="right">DISKON <?php echo "($diskon %)";?></td>
                    <td align="right"><?php echo "" . number_format($RpDiskon,0,',','.');?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4" align="right">TOTAL</td>
                <td align="right"><?php echo "" . number_format($total_tagihan,0,',','.');?></td>
            </tr>
            <tr>
                <td colspan="4" align="right">PEMBAYARAN</td>
                <td align="right"><?php echo "" . number_format($pembayaran,0,',','.');?></td>
            </tr>
            <?php if(!empty($selisih)){ ?>
                <tr>
                    <td colspan="4" align="right">SELISIH</td>
                    <td align="right"><?php echo "" . number_format($selisih,0,',','.');?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4" align="right">KETERANGAN</td>
                <td align="right"><?php echo "$keterangan";?></td>
            </tr>
            <tr>
                <td colspan="4" align="right">UANG</td>
                <td align="right"><?php echo "" . number_format($JumlahUang,0,',','.');?></td>
            </tr>
            <tr>
                <td colspan="4" align="right">KEMBALIAN</td>
                <td align="right"><?php echo "" . number_format($JumlahKembalian,0,',','.');?></td>
            </tr>
            <?php
                if($KutipanBawahNota=="Ya"){
                    echo '<tr>';
                    echo '  <td colspan="5" align="center">'.$IsiKutipanNota.'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
        <br>
    </body>
</html>
<?php
    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($FileName.".pdf" ,'I');
    exit;
?>