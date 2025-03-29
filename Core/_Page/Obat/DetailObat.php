<?php
    //koneksi dan error
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    //id_obat
    if(!empty($_POST['id_obat'])){
        $id_obat=$_POST['id_obat'];
    }else{
        $id_obat="";
    }
    //page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
    }else{
        $page="";
    }
    //batas
    if(!empty($_POST['batas'])){
        $batas=$_POST['batas'];
    }else{
        $batas="";
    }
    //batas
    if(!empty($_POST['keyword'])){
        $keyword=$_POST['keyword'];
    }else{
        $keyword="";
    }
    //Buka data obat
    $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
    $DataObat = mysqli_fetch_array($QryObat);
    $nama= $DataObat['nama'];
    $kode = $DataObat['kode'];
    $kategori = $DataObat['kategori'];
    $satuan = $DataObat['satuan'];
    $stok= $DataObat['stok'];
    $harga_1= $DataObat['harga_1'];
    $harga_2= $DataObat['harga_2'];
    $harga_3= $DataObat['harga_3'];
    $harga_4= $DataObat['harga_4'];
?>
<script>
    $(document).ready(function(){
        $('#ShowBatch').click(function(){
            var ButtonBatch=$('#ShowBatch').html();
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Obat/Batch.php',
                data    : { id_obat: <?php echo $id_obat;?> },
                success : function(data){
                    $('#DetailObat').html(data);
                }
            });
        });
    });
</script>
<div class="modal-body bg-white">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <td colspan="4" align="center">
                        <a href="vendors/barcode/barcode_2.php?size=50&text=<?php echo "$kode"; ?>" target="_blank">
                            <img alt="barcode" src="vendors/barcode/barcode_2.php?size=50&text=<?php echo "$kode"; ?>"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><b>KODE BARANG</b></td>
                    <td><?php echo "$kode"; ?></td>
                    <td><b>HARGA BELI</b></td>
                    <td><?php echo "Rp " . number_format($harga_1,0,',','.');?></td>
                </tr>
                <tr>
                    <td><b>NAMA/MEREK</b></td>
                    <td><?php echo "$nama"; ?></td>
                    <td><b>HARGA GROSIR</b></td>
                    <td><?php echo "Rp " . number_format($harga_2,0,',','.');?></td>
                </tr>
                <tr>
                    <td><b>KATEGORI</b></td>
                    <td><?php echo "$kategori"; ?></td>
                    <td><b>HARGA TOKO</b></td>
                    <td><?php echo "Rp " . number_format($harga_3,0,',','.');?></td>
                </tr>
                <tr>
                    <td><b>STOK</b></td>
                    <td><?php echo "$stok / $satuan"; ?></td>
                    <td><b>HARGA ECERAN</b></td>
                    <td><?php echo "Rp " . number_format($harga_4,0,',','.');?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer bg-primary">
    <div class="row">
        <div class="col-md-12">
            <div class="btn btn-md btn-rounded btn-dark mt-3 mr-3 mb-3" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Option <i class="menu-icon mdi mdi-settings" aria-hidden="true"></i>
            </div>
            <div class="dropdown-menu border-primary" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="javascript:void(0);" id="ShowBatch">show Batch</a>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#ModalTambahMultiHarga" data-id="<?php echo $id_obat;?>">Multi Harga & Satuan</a>
                <a class="dropdown-item" href="javascript:void(0);" id="EditObat" data-dismiss="modal">Edit</a>
                <a class="dropdown-item" href="_Page/Obat/CetakBarcodeHtml.php?id_obat=<?php echo "$id_obat"; ?>" target="_blank">Cetak Barcode (HTML)</a>
                <a class="dropdown-item" href="_Page/Obat/CetakBarcodePdf.php?id_obat=<?php echo "$id_obat"; ?>" target="_blank">Cetak Barcode (PDF)</a>
            </div>
            <button class="btn btn-md btn-rounded btn-danger mt-3 mr-3 mb-3" data-toggle="modal" data-target="#ModalDeleteObat" <?php echo "data-id='".$id_obat.",".$page.",".$batas.",".$keyword."'"; ?>>
                <i class="menu-icon mdi mdi-delete" aria-hidden="true"></i> Hapus
            </button>
            <button class="btn btn-md btn-rounded btn-light mt-3 mr-3 mb-3" data-dismiss="modal">
                <i class="mdi mdi-close"></i> Tutup
            </button>
        </div>
    </div>
</div>