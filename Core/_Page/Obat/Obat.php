<script type="text/javascript">
    $(document).on("keyup", function(event) {
        if (event.keyCode === 112) {
            $('#PencarianObat').focus();
        }
        if (event.keyCode === 113) {
            document.getElementById("TambahObat").click();
        }
    });
</script>
<?php
    include "../../_Config/Connection.php";
    $JumlahItem = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM obat"));
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
    //keyword
    if(!empty($_POST['keyword'])){
        $keyword=$_POST['keyword'];
    }else{
        $keyword="";
    }
    if(empty($_POST['OrderBy'])){
?>
    <script>
        $(document).ready(function(){
            var AkseLoading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#TabelObat').html(AkseLoading);
            $('#PencarianObat').focus();
            var page="<?php echo $page;?>";
            var batas="<?php echo $batas;?>";
            var keyword="<?php echo $keyword;?>";
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Obat/TabelObat.php',
                data 	:  { page: page, batas: batas, keyword: keyword },
                success : function(data){
                    $('#TabelObat').html(data);
                }
            });
        });
    </script>
    <?php 
        }else{ 
            $OrderBy=$_POST['OrderBy'];
            $ShortBy=$_POST['ShortBy'];
    ?>
    <script>
        $(document).ready(function(){
            var AkseLoading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#TabelObat').html(AkseLoading);
            var page="<?php echo $page;?>";
            var batas="<?php echo $batas;?>";
            var keyword="<?php echo $keyword;?>";
            var OrderBy="<?php echo $OrderBy;?>";
            var ShortBy="<?php echo $ShortBy;?>";
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Obat/TabelObat.php',
                data 	:  { page: page, batas: batas, keyword: keyword, OrderBy: OrderBy, ShortBy: ShortBy },
                success : function(data){
                    $('#TabelObat').html(data);
                }
            });
        });
    </script>
<?php } ?>
<script>
    $('#TombolPencarian').focus(function(){
        $('#TombolPencarian').removeClass("btn-outline-primary");
        $('#TombolPencarian').addClass("btn-primary");
    });
    $('#TombolPencarian').focusout(function(){
        $('#TombolPencarian').removeClass("btn-primary");
        $('#TombolPencarian').addClass("btn-outline-primary");
    });
    $('#TambahObat').focus(function(){
        $('#TambahObat').removeClass("btn-outline-primary");
        $('#TambahObat').addClass("btn-primary");
    });
    $('#TambahObat').focusout(function(){
        $('#TambahObat').removeClass("btn-primary");
        $('#TambahObat').addClass("btn-outline-primary");
    });
    $('#TombolBatch').focus(function(){
        $('#TombolBatch').removeClass("btn-outline-primary");
        $('#TombolBatch').addClass("btn-primary");
    });
    $('#TombolBatch').focusout(function(){
        $('#TombolBatch').removeClass("btn-primary");
        $('#TombolBatch').addClass("btn-outline-primary");
    });
    $('#StokOpename').focus(function(){
        $('#StokOpename').removeClass("btn-outline-primary");
        $('#StokOpename').addClass("btn-primary");
    });
    $('#StokOpename').focusout(function(){
        $('#StokOpename').removeClass("btn-primary");
        $('#StokOpename').addClass("btn-outline-primary");
    });
    //Reload
    $('#ReloadObat').click(function(){
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#TabelObat').html(Loading);
        $('#TabelObat').load('_Page/Obat/TabelObat.php');
    });
    //Pencarian
    $('#MulaiPencarianBarang').submit(function(){
        var keyword = $('#PencarianObat').val();
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/Obat/TabelObat.php',
            data 	:  'keyword='+ keyword,
            success : function(data){
                $('#TabelObat').html(data);
            }
        });
    });

    $('#TambahObat').click(function(){
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#Halaman').html(Loading);
        $('#Halaman').load('_Page/Obat/TambahObat.php');
        $('#kode').focus();
    });
    $('#GenerateBarang').click(function(){
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#TabelObat').html(Loading);
        $('#TabelObat').load("_Page/Obat/GenerateBarang.php");
    });
    //ketika Modal pencarian batch muncul
    $('#ModalPencarianBatc').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormPencarianBatch').html(Loading);
        var id_obat = $(e.relatedTarget).data('id');
        $.ajax({
            url     : "_Page/Obat/FormPencarianBatch.php",
            method  : "POST",
            data    : { id_obat: id_obat },
            success: function (data) {
                $('#FormPencarianBatch').html(data);
            }
        })
    });
    //ketika Modal pencarian batch muncul
    $('#ModalStokOpename').on('show.bs.modal', function (e) {
        var GetPeriode=$('#periode').val();
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormStokOpename').html(Loading);
        $.ajax({
            url     : "_Page/Obat/FormStokOpename.php",
            method  : "POST",
            data    : { periode: GetPeriode },
            success: function (data) {
                $('#FormStokOpename').html(data);
                //Ketika mencari tanggal SO
                $('#KirimTanggal').submit(function() {
                    var periode = $('#periode').val();
                    $('#FormStokOpename').html(Loading);
                    $('#GetPeriode').html("Loading..");
                    $('#GetPeriode').html(periode);
                    $.ajax({
                        url     : "_Page/Obat/FormStokOpename.php",
                        method  : "POST",
                        data    : { periode: periode },
                        success: function (data) {
                            $('#FormStokOpename').html(data);
                        }
                    })
                });
                $('#ModalPilihBarangSO').on('show.bs.modal', function (e) {
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#ListBarangSo').html("Loading..");
                    $('#ListBarangSo').load('_Page/Obat/ListBarangSo.php');
                });
            }
        })
    });
    //ketika Modal Detail muncul
    $('#ModalDetailObat').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#DetailObat').html(Loading);
        var DataDetail = $(e.relatedTarget).data('id');
        var mode = DataDetail.split(',');
        var id_obat = mode[0];
        var page = mode[1];
        var batas = mode[2];
        var keyword = mode[3];
        $.ajax({
            url     : "_Page/Obat/DetailObat.php",
            method  : "POST",
            data    : { id_obat: id_obat, page: page, batas: batas, keyword: keyword },
            success: function (data) {
                $('#DetailObat').html(data);
                //Edit Obat
                $('#EditObat').click(function() {
                    var id_obat = mode[0];
                    var page = mode[1];
                    var batas = mode[2];
                    var keyword = mode[3];
                    $.ajax({
                        url     : "_Page/Obat/EditObat.php",
                        method  : "POST",
                        data    : { page: page, id_obat: id_obat, batas: batas, keyword: keyword },
                        success: function (data) {
                            $('#Halaman').html(data);
                        }
                    })
                });
                //ketika Modal Delete muncul
                $('#ModalDeleteObat').on('show.bs.modal', function (e) {
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#FormDeleteObat').html(Loading);
                    var DataDetail = $(e.relatedTarget).data('id');
                    var mode = DataDetail.split(',');
                    var id_obat = mode[0];
                    var page = mode[1];
                    var batas = mode[2];
                    var keyword = mode[3];
                    $.ajax({
                        url     : "_Page/Obat/FormDeleteObat.php",
                        method  : "POST",
                        data    : { id_obat: id_obat },
                        success: function (data) {
                            $('#FormDeleteObat').html(data);
                            //Ketika disetujui delete
                            $('#ProsesDeleteObat').submit(function(){
                                var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                                $('#NotifikasiDeleteObat').html(Loading);
                                var ProsesDeleteObat = $('#ProsesDeleteObat').serialize();
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Obat/ProsesDeleteObat.php',
                                    data 	:  ProsesDeleteObat,
                                    success : function(data){
                                        $('#NotifikasiDeleteObat').html(data);
                                        //menangkap keterangan notifikasi
                                        var Notifikasi=$('#NotifikasiDeleteObatBerhasil').html();
                                        if(Notifikasi=="Berhasil"){
                                            $.ajax({
                                                url     : "_Page/Obat/TabelObat.php",
                                                method  : "POST",
                                                data    : { page: page, batas: batas, keyword: keyword },
                                                success: function (data) {
                                                    $('#TabelObat').html(data);
                                                }
                                            })
                                            $('#ModalDeleteObat').modal('hide');
                                            $('#ModalDetailObat').modal('hide');
                                            $('#ModalDeleteObatBerhasil').modal('show');
                                        }
                                    }
                                });
                            });
                        }
                    })
                });
                //ketika Modal Multi Harga muncul
                $('#ModalTambahMultiHarga').on('show.bs.modal', function (e) {
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#FormMultiHarga').html(Loading);
                    var id_obat = $(e.relatedTarget).data('id');
                    $.ajax({
                        url     : "_Page/Obat/FormMultiHarga.php",
                        method  : "POST",
                        data    : { id_obat: id_obat },
                        success: function (data) {
                            $('#FormMultiHarga').html(data);
                            $('#satuanBaru').focus(); 
                        }
                    })
                });
            }
        })
    });
    //Paging
    
    
</script>
<div class="row">
    <div class="col col-md-4 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary" id="ReloadObat" onmousemove="this.style.cursor='pointer'">
                    <i class="mdi mdi-menu mdi-search-web"></i> Data Barang
                </h3>
                <small>Total <?php echo "" . number_format($JumlahItem,0,',','.');?> Item</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" id="TambahObat">
            <div class="card-body">
                <i class="menu-icon mdi mdi-plus icon-md"></i><br>
                Tambah (F2)
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-2 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" id="TombolBatch" data-toggle="modal" data-target="#ModalPencarianBatc">
            <div class="card-body">
                <i class="menu-icon mdi mdi-account-search icon-md"></i><br>
                Batch
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" id="StokOpename" data-toggle="modal" data-target="#ModalStokOpename">
            <div class="card-body">
                <i class="menu-icon mdi mdi-table icon-md"></i><br>
                Stok Opename
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col col-md-6">
                        <form action="javascript:void(0);" id="MulaiPencarianBarang">
                            <div class="form-group col col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="PencarianObat" class="form-control" placeholder="Cari (F1)" value="">
                                    <div class="input-group-append border-primary">
                                        <button type="submit" class="btn btn-outline-primary" id="TombolPencarian">
                                            <i class="mdi mdi-menu mdi-search-web"></i>
                                        </button>
                                    </div>
                                </div>
                                <small>
                                    (F1) Cari Barang - (ENTER) Mulai Cari 
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div  id="TabelObat">
                <!----- Tabel disini ----->
            </div>
        </div>
    </div>
</div>
