<div id="ModalTambahObatBerhasil" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 text-center">
                        <img src="images/berhasil.gif" width="70%">
                        <h4 class="text-success">Tambah Data Barang Berhasil</h4>
                        <h4><b>ID:</b></h4><h4><b id="TempelIdObat"></b></h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 text-center">
                        <button class="btn btn-rounded btn-outline-primary" data-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ModalDetailObat" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Detail Inventory</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="DetailObat">

            </div>
        </div>
    </div>
</div>
<div id="ModalTambahMultiHarga" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="FormMultiHarga">
        </div>
    </div>
</div>
<div id="ModalPencarianBatc" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" id="FormPencarianBatch">
        </div>
    </div>
</div>
<div id="ModalDeleteObat" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="FormDeleteObat">
        </div>
    </div>
</div>
<div id="ModalDeleteObatBerhasil" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 text-center">
                        <img src="images/berhasil.gif" width="70%">
                        <h4 class="text-success">Delete Data Barang Berhasil!!</h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 text-center">
                        <button class="btn btn-rounded btn-outline-primary" data-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ModalEditMultiHarga" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body bg-danger" id="NilaiIdMultiHarga">
                <div class="row">
                    <div class="form-group col-md-12 text-center">
                        <img src="images/loading.gif" width="70%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ModalDeleteMultiHarga" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="FormDeleteMultiHarga">
        </div>
    </div>
</div>
<div id="ModalStokOpename" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="row">
                    <div class="col col-md-12">
                        <h3 class="text-white">
                            <i class="mdi mdi-check-all"></i>Stok Opename <?php echo '<i id="GetPeriode">'.date('Y-m-d').'</i>';?>
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12 text-white">
                        <form action="javascript:void(0);" id="KirimTanggal" autocomplete="off">
                            <div class="input-group">
                                <input type="date" id="periode" class="form-control border-warning" value="<?php echo date('Y-m-d');?>">
                                <div class="input-group-append border-primary">
                                    <button type="submit" class="btn btn-danger">
                                        Terapkan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="FormStokOpename">

            </div>
            <div class="modal-footer bg-primary">
                <div class="row">
                    <div class="form-group col-md-12 text-center">
                        <button type="button" class="btn btn-rounded btn-danger" id="TutupMultiHarga" data-dismiss="modal">
                            <i class="mdi mdi-close"></i> Tutup (Esc)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ModalPilihBarangSO" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-dark">
                <h2 class="text-light">Cari Inventory</h2>
            </div>
            <div id="ListBarangSo">
            
            </div>
        </div>
    </div>
</div>