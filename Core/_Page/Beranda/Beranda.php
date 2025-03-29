<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/Setting.php";
    //inisiasi hari ini
    $BulaniIni=date('Y-m');
    //Menghitung transaksi penjualan
    $QryPenjualan = mysqli_query($conn, "SELECT*FROM transaksi WHERE tanggal like '%$BulaniIni%' AND jenis_transaksi='penjualan'");
    while ($DataPenjualan = mysqli_fetch_array($QryPenjualan)) {
        if(!empty($DataPenjualan['total_tagihan'])){
            $TotalPenjualan[] = $DataPenjualan['total_tagihan'];
        }else{
            $TotalPenjualan[] ="0";
        }
    }
    if(!empty($TotalPenjualan)){
        $TotalPenjualanRp=array_sum($TotalPenjualan);
    }else{
        $TotalPenjualanRp="0";
    }
    
    $JumlahPenjualan = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM transaksi WHERE tanggal like '%$BulaniIni%' AND jenis_transaksi='penjualan'"));
    //Menghitung transaksi pembelian
    $QryPembelian = mysqli_query($conn, "SELECT*FROM transaksi WHERE tanggal like '%$BulaniIni%' AND jenis_transaksi='pembelian'");
    while ($DataPembelian = mysqli_fetch_array($QryPembelian)) {
        if(!empty($DataPembelian['total_tagihan'])){
            $TotalPembelian[] = $DataPembelian['total_tagihan'];
        }else{
            $TotalPembelian[] = "0";
        }
    }
    if(!empty($TotalPembelian)){
        $TotalPembelianRp=array_sum($TotalPembelian);
    }else{
        $TotalPembelianRp="0";
    }
    $JumlahPembelian = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM transaksi WHERE tanggal like '%$BulaniIni%' AND jenis_transaksi='pembelian'"));
    $ItemObat = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM obat"));
    $Petugas = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM akses"));
    //Menghitung transaksi Utang
    $QryUtang = mysqli_query($conn, "SELECT*FROM transaksi WHERE tanggal like '%$BulaniIni%' AND keterangan='Utang'");
    while ($DataUtang = mysqli_fetch_array($QryUtang)) {
        if(!empty($DataUtang['selisih'])){
            $selisih[] = $DataUtang['selisih'];
        }else{
            $selisih[] ="0";
        }
    }
    if(!empty($selisih)){
        $SelisihUtang=array_sum($selisih);
    }else{
        $SelisihUtang="0";
    }
    //JUMLAH HADIAH, KLAIM, PEMBERIAN POINT DAN SUPPLIER
    $JumlahHadiah = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM hadiah"));
    $JumlahKlaim = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM klaim"));
    $JumlahPasien = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM pasien"));
    $JumlahKunjunganRajal = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE tujuan='Rajal'"));
    $JumlahKunjunganRanap = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE tujuan='Ranap'"));
    $JumlahMember = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM member"));

?>
<script>
    //ketika Modal obat hampir habis muncul
    $('#ModalObatHampirHabis').on('show.bs.modal', function (e) {
        $('#DataObatHampirHabis').html('Loading..');
        var StokMin = $(e.relatedTarget).data('id');
        $.ajax({
            url     : "_Page/Beranda/DataObatHampirHabis.php",
            method  : "POST",
            data    : { StokMin: StokMin },
            success: function (data) {
                $('#DataObatHampirHabis').html(data);
            }
        })
    });
    //ketika Modal grafik muncul muncul
    $('#ModalgrafikPenjualan').on('show.bs.modal', function (e) {
        $('#DataGrafikPenjualan').html('Loading..');
        var tahun ="";
        $.ajax({
            url     : "_Page/Beranda/DataGrafikPenjualan.php",
            method  : "POST",
            data    : { tahun: tahun },
            success: function (data) {
                $('#DataGrafikPenjualan').html(data);
            }
        })
    });
</script>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1><i class="mdi mdi-home"></i> Beranda</h1>
                        Selamat Datang Di Aplikasi <?php echo "<i class='text-info'>$nama_perusahaan</i>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="card bg-inverse-dark" data-toggle="modal" data-target="#ModalgrafikPenjualan">
            <div class="card-body text-center text-light">
                <i class="mdi  mdi-chart-bar icon-lg"></i><br>
                Grafik
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card" data-toggle="modal" data-target="#ModalObatHampirHabis" data-id="100">
        <div class="card bg-inverse-dark">
            <div class="card-body text-center text-light">
                <i class="mdi mdi-box-shadow icon-lg"></i><br>
                Barang Hampir Habis
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-star-circle text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Penjualan Bulan Ini</p>
                        <div class="fluid-container">
                            <h5 class="font-weight-medium text-right mb-0"><?php echo "$JumlahPenjualan Kali";?></h5>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
        <div class="card-body">
            <div class="clearfix">
            <div class="float-left">
                <i class="mdi mdi-receipt text-danger icon-lg"></i>
            </div>
            <div class="float-right">
                <p class="mb-0 text-right">Pembelian Bulan Ini</p>
                <div class="fluid-container">
                <h5 class="font-weight-medium text-right mb-0"><?php echo "$JumlahPembelian Kali";?></h5>
                </div>
            </div>
            </div>
            <p class="text-muted mt-3 mb-0">
            </p>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
        <div class="card-body">
            <div class="clearfix">
            <div class="float-left">
                <i class="mdi mdi-plus-box-outline text-success icon-lg"></i>
            </div>
            <div class="float-right">
                <p class="mb-0 text-right">Pendapatan</p>
                <div class="fluid-container">
                <h5 class="font-weight-medium text-right mb-0"><?php echo "Rp " . number_format($TotalPenjualanRp,0,',','.');?></h5>
                </div>
            </div>
            </div>
            <p class="text-muted mt-3 mb-0">
            
            </p>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
        <div class="card-body">
            <div class="clearfix">
            <div class="float-left">
                <i class="mdi mdi-minus-box-outline text-danger icon-lg"></i>
            </div>
            <div class="float-right">
                <p class="mb-0 text-right">Pengeluaran</p>
                <div class="fluid-container">
                <h5 class="font-weight-medium text-right mb-0"><?php echo "Rp " . number_format($TotalPembelianRp,0,',','.');?></h5>
                </div>
            </div>
            </div>
            <p class="text-muted mt-3 mb-0">
            </p>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-box-shadow text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Inventory</p>
                        <div class="fluid-container">
                            <h5 class="font-weight-medium text-right mb-0"><?php echo "" . number_format($ItemObat,0,',','.');?> <?php echo "Item";?></h5>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
        <div class="card-body">
            <div class="clearfix">
            <div class="float-left">
                <i class="mdi mdi-account-settings-variant text-info icon-lg"></i>
            </div>
            <div class="float-right">
                <p class="mb-0 text-right">User Akses</p>
                <div class="fluid-container">
                <h5 class="font-weight-medium text-right mb-0"><?php echo "$Petugas Orang";?></h5>
                </div>
            </div>
            </div>
            <p class="text-muted mt-3 mb-0">
            </p>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
        <div class="card-body">
            <div class="clearfix">
            <div class="float-left">
                <i class="mdi mdi-traffic-light text-warning icon-lg"></i>
            </div>
            <div class="float-right">
                <p class="mb-0 text-right">Utang Usaha</p>
                <div class="fluid-container">
                <h5 class="font-weight-medium text-right mb-0"><?php echo "Rp " . number_format($SelisihUtang,0,',','.');?></h5>
                </div>
            </div>
            </div>
            <p class="text-muted mt-3 mb-0">
            
            </p>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
        <div class="card-body">
            <div class="clearfix">
            <div class="float-left">
                <i class="mdi mdi-transfer text-info icon-lg"></i>
            </div>
            <div class="float-right">
                <p class="mb-0 text-right">Piutang Usaha</p>
                <div class="fluid-container">
                <h5 class="font-weight-medium text-right mb-0"><?php echo "Rp " . number_format($TotalPembelianRp,0,',','.');?></h5>
                </div>
            </div>
            </div>
            <p class="text-muted mt-3 mb-0">
            </p>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-account-multiple text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Supplier</p>
                        <div class="fluid-container">
                            <h5 class="font-weight-medium text-right mb-0"><?php echo "$JumlahMember Orang";?></h5>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-cake text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Pasien</p>
                        <div class="fluid-container">
                            <h5 class="font-weight-medium text-right mb-0"><?php echo "$JumlahPasien Orang";?></h5>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-coins text-primary icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Rawat Jalan</p>
                        <div class="fluid-container">
                            <h5 class="font-weight-medium text-right mb-0"><?php echo "$JumlahKunjunganRajal Kali";?></h5>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-send text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Rawat Inap</p>
                        <div class="fluid-container">
                            <h5 class="font-weight-medium text-right mb-0"><?php echo "$JumlahKunjunganRanap Kali";?></h5>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="alert alert-primary text-justify" role="alert">
                    <b>Kontak Bantuan</b><br>
                    <small>
                        Aplikasi ini dikembangkan untuk mempermudah manajemen melakukan pengelolaan data barang dan transaksi 
                        yang dilakukan. Setiap fitur yang dibangun merupakan hasil kajian dan analisa kebutuhan sistem pada beberapa bisnis, 
                        sehingga masih memungkinkan adanya perubahan versi dan perbedaan komposisi modul yang ada pada aplikasi tersebut. 
                        Apabila anda mengalami kendala berupa gangguan atau adanya temuan error maka anda dapat menghubungi 
                        nomor kontak 089601154726 (An: Solihul Hadi) atau via <i>Whatsapp</i> 089660757177.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            
        </div>
    </div>
</div>