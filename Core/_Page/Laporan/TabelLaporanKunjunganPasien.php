<?php
    //koneksi dan error
    include "../../_Config/Connection.php";
    //KategoriLaporan
    if(!empty($_POST['kategori'])){
        $KategoriLaporan=$_POST['kategori'];
    }else{
        $KategoriLaporan="Harian";
    }
    //OrderBy
    if(!empty($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="id_kunjungan";
    }
    //ShortBy
    if(!empty($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="ASC";
    }
    //tanggal
    if(!empty($_POST['tanggal'])){
        $tanggal=$_POST['tanggal'];
    }else{
        $tanggal="";
    }
    //tahun
    if(!empty($_POST['tahun'])){
        $tahun=$_POST['tahun'];
    }else{
        $tahun="";
    }
    //bulan
    if(!empty($_POST['bulan'])){
        $bulan=$_POST['bulan'];
    }else{
        $bulan="";
    }
    //periode1
    if(!empty($_POST['periode1'])){
        $periode1=$_POST['periode1'];
    }else{
        $periode1="";
    }
    //periode2
    if(!empty($_POST['periode2'])){
        $periode2=$_POST['periode2'];
    }else{
        $periode2="";
    }
    $bulanan="$tahun-$bulan";
    if($KategoriLaporan=="Harian"){
        $JumlahRajal=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Rajal') AND (tanggal like '%$tanggal%')"));
        $JumlahRanap=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Ranap') AND (tanggal like '%$tanggal%')"));
    }
    if($KategoriLaporan=="Bulanan"){
        $JumlahRajal=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Rajal') AND (tanggal like '%$bulanan%')"));
        $JumlahRanap=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Ranap') AND (tanggal like '%$bulanan%')"));
    }
    if($KategoriLaporan=="Tahunan"){
        $JumlahRajal=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Rajal') AND (tanggal like '%$tahun%')"));
        $JumlahRanap=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Ranap') AND (tanggal like '%$tahun%')"));
    }
    if($KategoriLaporan=="Periode"){
        $JumlahRajal=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Rajal') AND (tanggal>='$periode1' AND tanggal<='$periode2')"));
        $JumlahRanap=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE (tujuan='Ranap') AND (tanggal>='$periode1' AND tanggal<='$periode2')"));
    }
    $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan"));
?>
    <div class="row">
        <div class="form-group col-sm-12 text-center">
            <h3>LAPORAN KUNJUNGAN PASIEN</h3>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12 text-center">
            <a href="<?php echo '_Page/Laporan/CetakKunjunganPasienHtml.php?kategori='.$KategoriLaporan.'&OrderBy='.$OrderBy.'&ShortBy='.$ShortBy.'&tahun='.$tahun.'&bulan='.$bulan.'&periode1='.$periode1.'&periode2='.$periode2.'&tanggal='.$tanggal.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-web"></i> Html
            </a>
            <a href="<?php echo '_Page/Laporan/CetakKunjunganPasienExcel.php?kategori='.$KategoriLaporan.'&OrderBy='.$OrderBy.'&ShortBy='.$ShortBy.'&tahun='.$tahun.'&bulan='.$bulan.'&periode1='.$periode1.'&periode2='.$periode2.'&tanggal='.$tanggal.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-file-excel"></i> Excel
            </a>
            <a href="<?php echo '_Page/Laporan/CetakKunjunganPasienPdf.php?kategori='.$KategoriLaporan.'&OrderBy='.$OrderBy.'&ShortBy='.$ShortBy.'&tahun='.$tahun.'&bulan='.$bulan.'&periode1='.$periode1.'&periode2='.$periode2.'&tanggal='.$tanggal.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-file-pdf"></i> PDF
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="table-responsive" style="height: 400px; overflow-y: scroll;">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th><b>No</b></th>
                            <th><b>No.RM</b></th>
                            <th><b>Tanggal</b></th>
                            <th><b>Nama</b></th>
                            <th><b>Tujuan</b></th>
                            <th><b>Status</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            //KONDISI PENGATURAN MASING FILTER
                            if($KategoriLaporan=="Harian"){
                                $query = mysqli_query($conn, "SELECT*FROM kunjungan WHERE tanggal like '%$tanggal%' ORDER BY $OrderBy $ShortBy");
                            }
                            if($KategoriLaporan=="Bulanan"){
                                $query = mysqli_query($conn, "SELECT*FROM kunjungan WHERE tanggal like '%$bulanan%' ORDER BY $OrderBy $ShortBy");
                            }
                            if($KategoriLaporan=="Tahunan"){
                                $query = mysqli_query($conn, "SELECT*FROM kunjungan WHERE tanggal like '%$tahun%' ORDER BY $OrderBy $ShortBy");
                            }
                            if($KategoriLaporan=="Periode"){
                                $query = mysqli_query($conn, "SELECT*FROM kunjungan WHERE tanggal>='$periode1' AND tanggal<='$periode2' ORDER BY $OrderBy $ShortBy");
                            }
                            while ($data = mysqli_fetch_array($query)) {
                                $id_kunjungan = $data['id_kunjungan'];
                                $id_pasien = $data['id_pasien'];
                                $nama = $data['nama'];
                                $tanggal= $data['tanggal'];
                                $tujuan= $data['tujuan'];
                                $status= $data['status'];
                        ?>
                        <tr class="">
                            <td><?php echo "$no";?></td>
                            <td><?php echo "$id_pasien";?></td>
                            <td><?php echo "$tanggal";?></td>
                            <td><?php echo "$nama";?></td>
                            <td><?php echo "$tujuan";?></td>
                            <td><?php echo "$status";?></td>
                        </tr>
                        <?php $no++;} ?>
                    </tbody>
                    <tfoot class="bg-dark">
                        <tr class="text-white">
                            <td colspan="4" align="right"><b>JUMLAH PASIEN RAJAL</b></td>
                            <td align="right"> <?php echo "$JumlahRajal"; ?> </td>
                            <td align="right"> </td>
                        </tr>
                        <tr class="text-white">
                            <td colspan="4" align="right"><b>JUMLAH PASIEN RANAP</b></td>
                            <td align="right"> <?php echo "$JumlahRanap"; ?> </td>
                            <td align="right">  </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
