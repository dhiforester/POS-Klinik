<div class="modal-header bg-dark">
    <div class="row">
        <div class="col col-md-12">
            <h3 class="text-white">
                <i class="mdi mdi-tag-text-outline"></i> Rincian Retur
            </h3>
        </div>
    </div>
</div>
<?php
    //koneksi
    include "../../_Config/Connection.php";
    //Tangkap variabel
    if(empty($_POST['id_rincian_retur'])){
        echo '<div class="modal-body bg-white">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12">';
        echo '          <h4 class="text-danger">Tidak ada Id Rincian Retur Yang ditangkap oleh halaman ini</h4>';
        echo '          <small class="text-danger">Pastikan aplikasi dalam kondisi stabil</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rincian_retur=$_POST['id_rincian_retur'];
        //Buka Data Rincian Retur
        $QryRincianRetur = mysqli_query($conn, "SELECT * FROM retur_rincian WHERE id_rincian_retur='$id_rincian_retur'")or die(mysqli_error($conn));
        $DataRincianRetur = mysqli_fetch_array($QryRincianRetur);
        $id_retur=$DataRincianRetur['id_retur'];
        $id_transaksi=$DataRincianRetur['id_transaksi'];
        $id_barang=$DataRincianRetur['id_barang'];
        $kode_barang=$DataRincianRetur['kode_barang'];
        $nama_barang=$DataRincianRetur['nama_barang'];
        $harga=$DataRincianRetur['harga'];
        $qty=$DataRincianRetur['qty'];
        $satuan=$DataRincianRetur['satuan'];
        $jumlah=$DataRincianRetur['jumlah'];
        $standar_harga=$DataRincianRetur['standar_harga'];
?>
<div class="modal-body bg-white">
    <div class="row">
        <div class="col col-md-12">
            <table width="100%">
                <tr>
                    <td><b>ID Retur</b></td>
                    <td><b>:</b></td>
                    <td><?php echo $id_retur;?></td>
                </tr>
                <tr>
                    <td><b>ID Transkasi</b></td>
                    <td><b>:</b></td>
                    <td><?php echo $id_transaksi;?></td>
                </tr>
                <tr>
                    <td><b>Kode Barang</b></td>
                    <td><b>:</b></td>
                    <td><?php echo $kode_barang;?></td>
                </tr>
                <tr>
                    <td><b>Nama/Merek Barang</b></td>
                    <td><b>:</b></td>
                    <td><?php echo "$nama_barang";?></td>
                </tr>
                <tr>
                    <td><b>Qty Retur</b></td>
                    <td><b>:</b></td>
                    <td><?php echo "$qty $satuan";?></td>
                </tr>
                <tr>
                    <td><b>Harga</b></td>
                    <td><b>:</b></td>
                    <td><?php echo "$harga";?></td>
                </tr>
                <tr>
                    <td><b>Jumlah</b></td>
                    <td><b>:</b></td>
                    <td><?php echo "$jumlah";?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="modal-body bg-white">
    <div class="row">
        <div class="col col-md-12 text-center text-danger" id="NotifikasiHapusRincianRetur">
            <!--Notifikasi---->    
            Belum ada proses yang berlangsung.
        </div>
    </div>
</div>     
<div class="modal-footer bg-dark">
    <button type="button" class="btn  btn-sm btn-rounded btn-danger" id="HapusRincianRetur" value="<?php echo "$id_rincian_retur";?>">
        <i class="mdi mdi-delete"></i> Hapus
    </button>
    <button type="button" class="btn  btn-sm btn-rounded btn-warning" data-dismiss="modal">
        <i class="mdi mdi-close"></i> Tutup
    </button>
</div>
<?php } ?>