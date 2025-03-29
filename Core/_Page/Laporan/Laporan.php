<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
?>
<script>
    $(document).ready(function(){
        //Laporan Jual Beli
        $('#LaporanKunjunganPasien').click(function(){
            $('.bg-inverse-success').addClass('bg-inverse-dark');
            $('.bg-inverse-success').removeClass('bg-inverse-success');
            $('#LaporanKunjunganPasien').removeClass('bg-inverse-dark');
            $('#LaporanKunjunganPasien').addClass('bg-inverse-success');
            $('#KontenSubMenu').html('Loading...');
            $('#KontenSubMenu').load('_Page/Laporan/SubmenuLaporanKunjungan.php');
            $('#KontenLaporan').html('<h3>Laporan Kunjungan Pasien</h3>');
        });
        //Laporan Jual Beli
        $('#LaporanJualBeli').click(function(){
            $('.bg-inverse-success').addClass('bg-inverse-dark');
            $('.bg-inverse-success').removeClass('bg-inverse-success');
            $('#LaporanJualBeli').removeClass('bg-inverse-dark');
            $('#LaporanJualBeli').addClass('bg-inverse-success');
            $('#KontenSubMenu').html('Loading...');
            $('#KontenSubMenu').load('_Page/Laporan/SubmenuLaporanJualBeli.php');
            $('#KontenLaporan').html('<h3>Laporan Jual Beli</h3>');
        });
        //Tombol Laporan Utang Piutang
        $('#TombolLaporanUtangPiutang').click(function(){
            $('.bg-inverse-success').addClass('bg-inverse-dark');
            $('.bg-inverse-success').removeClass('bg-inverse-success');
            $('#TombolLaporanUtangPiutang').removeClass('bg-inverse-dark');
            $('#TombolLaporanUtangPiutang').addClass('bg-inverse-success');
            $('#KontenSubMenu').html('Loading...');
            $('#KontenSubMenu').load('_Page/Laporan/SubmenuLaporanUtangPiutang.php');
            $('#KontenLaporan').html('<h3>Laporan Utang Piutang</h3>');
        });
        //Tombol Laporan Nilai Asset
        $('#TombolNilaiAsset').click(function(){
            $('.bg-inverse-success').addClass('bg-inverse-dark');
            $('.bg-inverse-success').removeClass('bg-inverse-success');
            $('#TombolNilaiAsset').removeClass('bg-inverse-dark');
            $('#TombolNilaiAsset').addClass('bg-inverse-success');
            $('#KontenSubMenu').html('Loading...');
            $('#KontenSubMenu').load('_Page/Laporan/SubmenuLaporanAsset.php');
            $('#KontenLaporan').html('<h3>Laporan Nilai Asset</h3>');
        });
        //Tombol Laporan Log User
        $('#TombolLogUser').click(function(){
            $('.bg-inverse-success').addClass('bg-inverse-dark');
            $('.bg-inverse-success').removeClass('bg-inverse-success');
            $('#TombolLogUser').removeClass('bg-inverse-dark');
            $('#TombolLogUser').addClass('bg-inverse-success');
            $('#KontenSubMenu').html('Loading...');
            $('#KontenSubMenu').load('_Page/Laporan/SubmenuLogUser.php');
            $('#KontenLaporan').html('<h3>Laporan Transaksi By User</h3>');
        });
    });
</script>
<div class="row">
    <div class="col col-md-12 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary" onmousemove="this.style.cursor='pointer'" id="HalamanUtamaLaporan">
                    <i class="mdi mdi-file-document-box"></i> Laporan
                </h3>
                <small>Tampilkan data laporan transaksi</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" title="Laporan Data Pasien" id="LaporanKunjunganPasien">
            <div class="card-body">
                <i class="mdi mdi-account-box icon-lg"></i><br>
                <small>Kunjungan Pasien</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" title="Laporan Penjualan dan Pembelian" id="LaporanJualBeli">
            <div class="card-body">
                <i class="mdi mdi-file-document icon-lg"></i><br>
                <small>Jual/Beli</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-2 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" title="Laporan Utang Piutang" id="TombolLaporanUtangPiutang">
            <div class="card-body">
                <i class="mdi mdi-coins icon-lg"></i><br>
                <small>Utang/Piutang</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-2 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" title="Laporan Utang Piutang" id="TombolNilaiAsset">
            <div class="card-body">
                <i class="mdi mdi-box-shadow icon-lg"></i><br>
                <small>Nilai Asset</small>
            </div>
        </div>
    </div>
    <div class="col-md-2 grid-margin stretch-card text-center">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="card card-statistics bg-inverse-dark" title="Laporan Transaksi Berdasarkan User" id="TombolLogUser">
            <div class="card-body">
                <i class="mdi mdi-account-box icon-lg"></i><br>
                <small>Log User</small>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card">
            <div class="card-body" id="KontenSubMenu">
                <p class="text-primary">Belum ada data yang bisa ditampilkan, pilih salah satu jenis laporan pada tombol di atas.</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card">
            <div class="card-body" id="KontenLaporan">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-md scroll-container">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <b>No</b>
                                        </td>
                                        <td align="center">
                                            <b>Nama Laporan</b>
                                        </td>
                                        <td align="center">
                                            <b>Keterangan</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            1
                                        </td>
                                        <td align="left">
                                            Jual Beli
                                        </td>
                                        <td align="left">
                                            Laporan kinerja antara penjualan dan pembelian
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            2
                                        </td>
                                        <td align="left">
                                            Utang-Piutang
                                        </td>
                                        <td align="left">
                                            Laporan kinerja perbandingan antara transaksi utang dengan piutang
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            3
                                        </td>
                                        <td align="left">
                                            Nilai Asset
                                        </td>
                                        <td align="left">
                                            Laporan jumlah akumulasi asset/inventory barang
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            4
                                        </td>
                                        <td align="left">
                                            Log User
                                        </td>
                                        <td align="left">
                                            Data Transaksi Yang Di Hitung Berdasarkan Data Akses Petugas
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
