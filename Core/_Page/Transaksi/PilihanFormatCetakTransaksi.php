<?php
    //Koneksi
    include "../../_Config/Connection.php";
    if(!empty($_POST['id_transaksi'])){
        $id_transaksi=$_POST['id_transaksi'];
    }else{
        $id_transaksi="";
    }
    if(!empty($id_transaksi)){
        //Buka rincian transaksi
        $QryTransaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'")or die(mysqli_error($conn));
        $DataTransaksi = mysqli_fetch_array($QryTransaksi);
        $kode_transaksi=$DataTransaksi['kode_transaksi'];
?>
    <div class="modal-header bg-dark">
        <h4 class="text-white">
            <i class="mdi mdi-printer"></i> CETAK TRANSAKSI
        </h4>
    </div>
    <div class="modal-body bg-white">
        <div class="row">
            <div class="col-md-12 text-center text-success">
                Silahkan pilih format cetak yang anda inginkan.
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <small>
                    <table>
                        <tr>
                            <td><b>1.</b></td>
                            <td><b>Direct</b></td>
                            <td>:</td>
                            <td>Cetak langsung ke printer termal (POS Printer)</td>
                        </tr>
                        <tr>
                            <td><b>2.</b></td>
                            <td><b>Html</b></td>
                            <td>:</td>
                            <td>Tampilkan terlebih dahulu format cetak dalam bentuk halaman HTML.</td>
                        </tr>
                        <tr>
                            <td><b>3.</b></td>
                            <td><b>PDF</b></td>
                            <td>:</td>
                            <td>Eksport Nota ke format PDF untuk kebutuhan data elektronik anda.</td>
                        </tr>
                    </table>
                </small>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-dark">
        <button class="btn btn-outline-light" id="PrintDetailDirect" value="<?php echo "$kode_transaksi";?>">
            <i class="mdi mdi-printer"></i> Direct
        </button>
        <a href="_Page/Transaksi/CetakDetailTransaksi.php?kode_transaksi=<?php echo $kode_transaksi; ?>" class="btn btn-outline-light" target="_blank">
            <i class="mdi mdi-web"></i> Html
        </a>
        <a href="_Page/Transaksi/CetakDetailTransaksiPdf.php?kode_transaksi=<?php echo $kode_transaksi; ?>" class="btn btn-outline-light" target="_blank">
            <i class="mdi mdi-file-pdf"></i> PDF
        </a>
        <button class="btn btn-outline-light" data-dismiss="modal">
            <i class="mdi mdi-close"></i> Tutup
        </button>
    </div>
<?php 
    }else{
        echo '<div class="modal-header bg-dark">';
        echo '  <h4 class="text-white">';
        echo '      <i class="mdi mdi-printer"></i> CETAK TRANSAKSI';
        echo '  </h4>';
        echo '</div>';
        echo '<div class="modal-body bg-white">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger">';
        echo '          Tidak ada data kode transaksi yang ditangkap.';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-dark">';
        echo '  <button class="btn btn-outline-light" data-dismiss="modal">';
        echo '      <i class="mdi mdi-close"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    } 
?>