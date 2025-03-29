<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['akses'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <span class="text-danger">Maaf, ID Ruangan Tidak Dapat Di Tangkap Oleh Sistem!!</span>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-primary">';
        echo '  <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">';
        echo '      <i class="mdi mdi-close"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        //Tampilkan Data ruang inap
        $akses = $_POST['akses'];
        //panggil dari database
        $QryAcc = mysqli_query($conn, "SELECT * FROM setting_acc WHERE akses='$akses'")or die(mysqli_error($conn));
        $DataAcc = mysqli_fetch_array($QryAcc);
        if(!empty($DataAcc['akses'])){
            $acc_profile=$DataAcc['acc_profile'];
            $acc_setting=$DataAcc['acc_setting'];
            $acc_akses=$DataAcc['acc_akses'];
            $acc_dokter=$DataAcc['acc_dokter'];
            $acc_ruang_inap=$DataAcc['acc_ruang_inap'];
            $acc_pasien=$DataAcc['acc_pasien'];
            $acc_kunjungan=$DataAcc['acc_kunjungan'];
            $acc_supplier=$DataAcc['acc_supplier'];
            $acc_inventory=$DataAcc['acc_inventory'];
            $acc_kasir=$DataAcc['acc_kasir'];
            $acc_transaksi=$DataAcc['acc_transaksi'];
            $acc_laporan=$DataAcc['acc_laporan'];
            $acc_backup=$DataAcc['acc_backup'];
        }else{
            $acc_profile="No";
            $acc_setting="No";
            $acc_akses="No";
            $acc_dokter="No";
            $acc_ruang_inap="No";
            $acc_pasien="No";
            $acc_kunjungan="No";
            $acc_supplier="No";
            $acc_inventory="No";
            $acc_kasir="No";
            $acc_transaksi="No";
            $acc_laporan="No";
            $acc_backup="No";
        }
?>
    <form action="javascript:void(0);" id="ProsesEditAksesibilitas">
        <input type="hidden" name="akses" id="akses" value="<?php echo "$akses"; ?>">
        <div class="modal-body bg-white">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover" width="100%">
                            <tbody>
                                <tr>
                                    <td class="text-center"><b>1</b></td>
                                    <td class="text-left"><b>Profile</b></td>
                                    <td>
                                        <small>
                                            Halaman Profile Pengguna. <br>
                                            Lihat pengaturan aksesibilitas, ubah informasi pribadi pengguna,
                                            <br>
                                            ubah password, atur ukuran cetak nota, kartu pasien dan label.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_profile" id="acc_profile">
                                            <option value="No" <?php if($acc_profile=="No"||$acc_profile==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_profile=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>2</b></td>
                                    <td class="text-left"><b>Setting</b></td>
                                    <td>
                                        <small>
                                            Setting Aplikasi.<br>
                                            Kelola informasi dasar aplikasi, nama perusahaan,<br> 
                                            alamat perusahaan, logo perusahaan, dan mode cetak.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_setting" id="acc_setting">
                                            <option value="No" <?php if($acc_setting=="No"||$acc_setting==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_setting=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>3</b></td>
                                    <td class="text-left"><b>Akses</b></td>
                                    <td>
                                        <small>
                                            Halaman Kelola Data Akses.<br>
                                            Buat akses baru, edit dan hapus data akses.<br> 
                                            Atur aksesibilitas pengguna aplikasi.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_akses" id="acc_akses">
                                            <option value="No" <?php if($acc_akses=="No"||$acc_akses==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_akses=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>4</b></td>
                                    <td class="text-left"><b>Dokter & Poliklinik</b></td>
                                    <td>
                                        <small>
                                            Kelola data dokter dan poliklinik.<br>
                                            Daftaran dokter baru dan layanan poliklinik.<br> 
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_dokter" id="acc_dokter">
                                            <option value="No" <?php if($acc_dokter=="No"||$acc_dokter==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_dokter=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>5</b></td>
                                    <td class="text-left"><b>Ruang Inap</b></td>
                                    <td>
                                        <small>
                                            Halaman Kelola Data Ruang Inap.<br>
                                            Tambahkan data ruangan baru, jumlah quota.<br> 
                                            Atur pembagian ruang inap dan kelas ruangan.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_ruang_inap" id="acc_ruang_inap">
                                            <option value="No" <?php if($acc_ruang_inap=="No"||$acc_ruang_inap==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_ruang_inap=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>6</b></td>
                                    <td class="text-left"><b>Pasien</b></td>
                                    <td>
                                        <small>
                                            Kelola Data Rekam Medis<br>
                                            Daftarkan pasien baru, buat nomor RM pasien, kartu berobat.<br> 
                                            Simpan data identitas pasien, ubah identitas pasien dan hapus pasien.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_pasien" id="acc_pasien">
                                            <option value="No" <?php if($acc_pasien=="No"||$acc_pasien==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_pasien=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>7</b></td>
                                    <td class="text-left"><b>Kunjungan</b></td>
                                    <td>
                                        <small>
                                            Kelola kunjungan rawat inap dan rawat jalan pasien.<br>
                                            Tambahkan data ruangan baru, jumlah quota.<br> 
                                            Atur pembagian ruang inap dan kelas ruangan.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_kunjungan" id="acc_kunjungan">
                                            <option value="No" <?php if($acc_kunjungan=="No"||$acc_kunjungan==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_kunjungan=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>8</b></td>
                                    <td class="text-left"><b>Supplier</b></td>
                                    <td>
                                        <small>
                                            Kelola data supplier.<br>
                                            Tambah, edit dan hapus data supplier, .<br> 
                                            Hubungkan data supplier dengan transaksi pembelian.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_supplier" id="acc_supplier">
                                            <option value="No" <?php if($acc_supplier=="No"||$acc_supplier==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_supplier=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>9</b></td>
                                    <td class="text-left"><b>Inventory</b></td>
                                    <td>
                                        <small>
                                            Kelola Data Obat, alkes dan inventory lainnya.<br>
                                            Tambah, ubah dan hapus data inventory.<br> 
                                            Atur persediaan, multi satuan, label barcode dan expired berdasarkan batch.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_inventory" id="acc_inventory">
                                            <option value="No" <?php if($acc_inventory=="No"||$acc_inventory==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_inventory=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>10</b></td>
                                    <td class="text-left"><b>Kasir</b></td>
                                    <td>
                                        <small>
                                            Kelola data transaksi penjualan, pembelian, retur dan utang-piutang.<br>
                                            Tambahkan rincian transaksi, hubungkan dengan data pasien dan supplier.<br> 
                                            Cetak nota, atur transaksi retur dan pembayaran.
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_kasir" id="acc_kasir">
                                            <option value="No" <?php if($acc_kasir=="No"||$acc_kasir==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_kasir=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>11</b></td>
                                    <td class="text-left"><b>Transaksi</b></td>
                                    <td class="text-left">
                                        <small>
                                            Kelola data transaksi penjualan, pembelian, retur dan utang-piutang.<br>
                                            Lakukan perubahan data transaksi, cetak nota transaksi.<br> 
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_transaksi" id="acc_transaksi">
                                            <option value="No" <?php if($acc_transaksi=="No"||$acc_transaksi==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_transaksi=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>12</b></td>
                                    <td class="text-left"><b>Laporan</b></td>
                                    <td class="text-left">
                                        <small>
                                            Buat laporan jual beli, utang piutang, nilai asset inventory dan log pengguna.<br>
                                            Cetak laporan, shorting dan filter berdasarkan periode waktu.<br> 
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_laporan" id="acc_laporan">
                                            <option value="No" <?php if($acc_laporan=="No"||$acc_laporan==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_laporan=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>13</b></td>
                                    <td class="text-left"><b>Backup & Restore</b></td>
                                    <td class="text-left">
                                        <small>
                                            Backup dan restore database <br>
                                            Export data tabel ke dalam excel
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <select name="acc_backup" id="acc_backup">
                                            <option value="No" <?php if($acc_backup=="No"||$acc_backup==""){echo "selected";} ?>>No</option>
                                            <option value="Yes" <?php if($acc_backup=="Yes"){echo "selected";} ?>>Yes</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" id="NotifikasiEditAksesibilitas">
                    <span class="text-primary">Pastikan Pengaturan Aksesibilitas sudah sesuai</span>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-primary">
            <div class="row">
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-lg btn-rounded btn-dark mr-3">
                        <i class="mdi mdi-floppy"></i> Simpan
                    </button>
                    <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">
                        <i class="mdi mdi-close"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </form>
<?php } ?>