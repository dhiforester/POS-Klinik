<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['id_akses'])){
        $GetIdAkses = "";
    }else{
        $GetIdAkses = $_POST['id_akses'];
    }
    if(empty($_POST['mode_laporan'])){
        $mode_laporan = "Rekapitulasi";
    }else{
        $mode_laporan = $_POST['mode_laporan'];
    }
    if(empty($_POST['KategoriLaporan'])){
        $KategoriLaporan = "Harian";
    }else{
        $KategoriLaporan = $_POST['KategoriLaporan'];
    }
    if(empty($_POST['OrderBy'])){
        $OrderBy = "tanggal";
    }else{
        $OrderBy = $_POST['OrderBy'];
    }
    if(empty($_POST['ShortBy'])){
        $ShortBy = "tanggal";
    }else{
        $ShortBy = $_POST['ShortBy'];
    }
    //tanggal
    if(!empty($_POST['tanggal'])){
        $tanggal=$_POST['tanggal'];
    }else{
        $tanggal=date('Y-m-d');
    }
    //tahun
    if(!empty($_POST['tahun'])){
        $tahun=$_POST['tahun'];
    }else{
        $tahun=date('Y');
    }
    //bulan
    if(!empty($_POST['bulan'])){
        $bulan=$_POST['bulan'];
    }else{
        $bulan=date('m');
    }
    //periode1
    if(!empty($_POST['periode1'])){
        $periode1=$_POST['periode1'];
    }else{
        $periode1=date('Y-m-d');
    }
    //periode2
    if(!empty($_POST['periode2'])){
        $periode2=$_POST['periode2'];
    }else{
        $periode2=date('Y-m-d');
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
    
?>
<div class="row">
        <div class="form-group col-sm-12 text-center">
            <h3>LAPORAN LOG TRANSAKSI USER</h3>
            <?php
                if($mode_laporan=="Rekapitulasi"){
                    if($KategoriLaporan=="Harian"){
                        echo '<h5>Rekapitulasi Tangal '.$tanggal.'</h5>';
                    }elseif($KategoriLaporan=="Bulanan"){
                        echo '<h5>Rekapitulasi Bulan  '.$NamaBulan.' '.$NamaTahun.'</h5>';
                    }elseif($KategoriLaporan=="Periode"){
                        echo '<h5>Rekapitulasi Periode '.$periode1.' s/d '.$periode2.'</h5>';
                    }elseif($KategoriLaporan=="Tahunan"){
                        echo '<h5>Rekapitulasi Tahun '.$tahun.'</h5>';
                    }
                }else{
                    //Buka data akses
                    $sql_akses = "SELECT * FROM akses WHERE id_akses='$GetIdAkses'";
                    $qry_akses = mysqli_query($conn, $sql_akses);
                    $data_akses = mysqli_fetch_array($qry_akses);
                    $NamaPetugasAkses=$data_akses['nama'];
                    if($KategoriLaporan=="Harian"){
                        echo '<h5>Uraian Transaksi '.$NamaPetugasAkses.' Tangal '.$tanggal.'</h5>';
                    }elseif($KategoriLaporan=="Bulanan"){
                        echo '<h5>Uraian Transaksi '.$NamaPetugasAkses.' Bulan  '.$NamaBulan.' '.$NamaTahun.'</h5>';
                    }elseif($KategoriLaporan=="Periode"){
                        echo '<h5>Uraian Transaksi '.$NamaPetugasAkses.' Periode '.$periode1.' s/d '.$periode2.'</h5>';
                    }elseif($KategoriLaporan=="Tahunan"){
                        echo '<h5>Uraian Transaksi '.$NamaPetugasAkses.' Tahun '.$tahun.'</h5>';
                    }
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12 text-center">
            <a href="<?php echo '_Page/Laporan/CetakLogUserHtml.php?id_akses='.$GetIdAkses.'&kategori='.$KategoriLaporan.'&mode_laporan='.$mode_laporan.'&ShortBy='.$ShortBy.'&tahun='.$tahun.'&bulan='.$bulan.'&periode1='.$periode1.'&periode2='.$periode2.'&tanggal='.$tanggal.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-web"></i> HTML
            </a>
            <a href="<?php echo '_Page/Laporan/CetakLogUserExcel.php?id_akses='.$GetIdAkses.'&kategori='.$KategoriLaporan.'&mode_laporan='.$mode_laporan.'&ShortBy='.$ShortBy.'&tahun='.$tahun.'&bulan='.$bulan.'&periode1='.$periode1.'&periode2='.$periode2.'&tanggal='.$tanggal.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-file-excel"></i> Excel
            </a>
            <a href="<?php echo '_Page/Laporan/CetakLogUserPdf.php?id_akses='.$GetIdAkses.'&kategori='.$KategoriLaporan.'&mode_laporan='.$mode_laporan.'&ShortBy='.$ShortBy.'&tahun='.$tahun.'&bulan='.$bulan.'&periode1='.$periode1.'&periode2='.$periode2.'&tanggal='.$tanggal.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-file-pdf"></i> PDF
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="table-responsive" style="height: 400px; overflow-y: scroll;">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <?php
                            if($mode_laporan=="Rekapitulasi"){
                                echo '<tr>';
                                echo '  <th><b>No</b></th>';
                                echo '  <th><b>Petugas</b></th>';
                                echo '  <th><b>Transaksi</b></th>';
                                echo '  <th><b>Jumlah</b></th>';
                                echo '  <th><b>Rate</b></th>';
                                echo '</tr>';
                            }else{
                                echo '<tr>';
                                echo '  <th><b>No</b></th>';
                                echo '  <th><b>Kode</b></th>';
                                echo '  <th><b>Tanggal</b></th>';
                                echo '  <th><b>Petugas</b></th>';
                                echo '  <th><b>Jumlah</b></th>';
                                echo '</tr>';
                            }
                        ?>
                    </thead>
                    <tbody>
                        <?php
                            if($mode_laporan=="Rekapitulasi"){
                                $no = 1;
                                //KONDISI PENGATURAN MASING FILTER
                                $query = mysqli_query($conn, "SELECT*FROM akses ORDER BY email");
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_akses = $data['id_akses'];
                                    $username = $data['email'];
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
                                    echo '  <td align="right">Rp '.$RpTotalTagihan.'</td>';
                                    echo '  <td align="right">Rp '.$RpRate.'</td>';
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
                                    echo '  <td align="right">Rp '.$Rptotal_tagihan.'</td>';
                                    echo '</tr>';
                                    $no++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if($mode_laporan=="Uraian"){ ?>
        <div class="row">
            <div class="col-md-6">
                <b>JUMLAH TRANSAKSI</b>
            </div>
            <div class="col-md-6 text-right">
                <?php echo "Rp " . number_format($JumlahTransaksi,0,',','.'); ?>
            </div>
        </div>
    <?php } ?>
</div>