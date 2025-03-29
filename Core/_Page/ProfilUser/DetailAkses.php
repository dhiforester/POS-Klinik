<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/SessionSettingAcc.php";
?>
<div class="card">
    <div class="card-header">
        <h2>Detail Akses</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <td class="text-center"><b>1</b></td>
                        <td class="text-left"><b>Profile</b></td>
                        <td>Halaman Profile Pengguna</td>
                        <td class="text-center"><?php echo "$acc_profile";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>2</b></td>
                        <td class="text-left"><b>Setting</b></td>
                        <td>Setting Aplikasi</td>
                        <td class="text-center"><?php echo "$acc_setting";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>3</b></td>
                        <td class="text-left"><b>Akses</b></td>
                        <td>Halaman Kelola Data Akses</td>
                        <td class="text-center"><?php echo "$acc_akses";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>4</b></td>
                        <td class="text-left"><b>Dokter & Poliklinik</b></td>
                        <td>Halaman Kelola Data Dokter & Poliklinik</td>
                        <td class="text-center"><?php echo "$acc_dokter";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>5</b></td>
                        <td class="text-left"><b>Ruang Inap</b></td>
                        <td>Halaman Kelola Ruang Rawat Inap</td>
                        <td class="text-center"><?php echo "$acc_ruang_inap";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>6</b></td>
                        <td class="text-left"><b>Pasien</b></td>
                        <td>Halaman Rekam Medis Pasien</td>
                        <td class="text-center"><?php echo "$acc_pasien";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>7</b></td>
                        <td class="text-left"><b>Kunjungan</b></td>
                        <td>Halaman Kelola Kunjungan Rawat Inap/Jalan</td>
                        <td class="text-center"><?php echo "$acc_kunjungan";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>8</b></td>
                        <td class="text-left"><b>Supplier</b></td>
                        <td>Halaman Kelola Data Supplier</td>
                        <td class="text-center"><?php echo "$acc_supplier";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>9</b></td>
                        <td class="text-left"><b>Inventory</b></td>
                        <td>Halaman Kelola Data Obat & Alkes</td>
                        <td class="text-center"><?php echo "$acc_inventory";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>10</b></td>
                        <td class="text-left"><b>Kasir</b></td>
                        <td>Fitur Kasir/Billing Transaksi</td>
                        <td class="text-center"><?php echo "$acc_kasir";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>11</b></td>
                        <td class="text-left"><b>Transaksi</b></td>
                        <td>Halaman Kelola Data Transaksi</td>
                        <td class="text-center"><?php echo "$acc_transaksi";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>12</b></td>
                        <td class="text-left"><b>Laporan</b></td>
                        <td>Fitur Tampilkan Data Laporan</td>
                        <td class="text-center"><?php echo "$acc_laporan";?></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>13</b></td>
                        <td class="text-left"><b>Backup & Restore</b></td>
                        <td>Fitur Log dan Backup Database</td>
                        <td class="text-center"><?php echo "$acc_backup";?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <small>
            Pengaturan aksesibilitas ini sepenuhnya di kelola pada fitur akses.
        </small>
    </div>
</div>