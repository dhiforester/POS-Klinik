<?php
    //koneksi dan error
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    //Atur Batas
    if(!empty($_POST['batas'])){
        $batas=$_POST['batas'];
    }else{
        $batas="10";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    //Atur Keyword
    if(isset($_POST['keyword'])){
        $keyword=$_POST['keyword'];
    }else{
        $keyword="";
    }
    //Atur OrderBy
    if(isset($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="id_dokter";
    }
    //Atur ShortBy
    if(isset($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="DESC";
    }
    //hitung jumlah data
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM dokter"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM dokter WHERE dokter like '%$keyword%' OR poliklinik like '%$keyword%' OR status like '%$keyword%'"));
    }
    //Jumlah halaman
    $JmlHalaman = ceil($jml_data/$batas); 
    $JmlHalaman_real = ceil($jml_data/$batas); 
    $prev=$page-1;
    $next=$page+1;
    if($next>$JmlHalaman){
        $next=$page;
    }else{
        $next=$page+1;
    }
    if($prev<"1"){
        $prev="1";
    }else{
        $prev=$page-1;
    }
?>
<script>
    $(document).ready(function(){
        //ketika klik next
        $('#NextPage').click(function() {
            var valueNext = $('#NextPage').val();
            var mode = valueNext.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/DokterPoliklinik/TabelDokterPoliklinik.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success: function (data) {
                    $('#TabelDokterPoliklinik').html(data);

                }
            })
        });
        //Ketika klik Previous
        $('#PrevPage').click(function() {
            var ValuePrev = $('#PrevPage').val();
            var mode = ValuePrev.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/DokterPoliklinik/TabelDokterPoliklinik.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success : function (data) {
                    $('#TabelDokterPoliklinik').html(data);
                }
            })
        });
        <?php 
            $a=1;
            $b=$JmlHalaman;
            for ( $i =$a; $i<=$b; $i++ ){
        ?>
            //ketika klik page number
            $('#PageNumber<?php echo $i;?>').click(function() {
                var PageNumber = $('#PageNumber<?php echo $i;?>').val();
                var mode = PageNumber.split(',');
                var page = mode[0];
                var BatasData = mode[1];
                $.ajax({
                    url     : "_Page/DokterPoliklinik/TabelDokterPoliklinik.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData },
                    success: function (data) {
                        $('#TabelDokterPoliklinik').html(data);
                    }
                })
            });
        <?php } ?>
        
    });
</script>
<div class="card-body bg-white" style="height: 350px; overflow-y: scroll;">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Poliklinik</th>
                    <th>Status</th>
                    <th>Pasien</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1+$posisi;
                    //KONDISI PENGATURAN MASING FILTER
                    if(empty($keyword)){
                        $query = mysqli_query($conn, "SELECT*FROM dokter ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }else{
                        $query = mysqli_query($conn, "SELECT*FROM dokter WHERE dokter like '%$keyword%' OR poliklinik like '%$keyword%' OR status like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        $id_dokter = $data['id_dokter'];
                        $dokter= $data['dokter'];
                        $poliklinik = $data['poliklinik'];
                        $status = $data['status'];
                        $updatetime = $data['updatetime'];
                        //Label Kategori
                        if($status == "Aktif"){
                            $LabelStatus = '<span class="badge badge-primary">Aktif</span>';
                        }else{
                            $LabelStatus = '<span class="badge badge-danger">Non Aktif</span>';
                        }
                        //Hitung jumlah kunjungan
                        $JumlahPasien = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_dokter = '$id_dokter'"));
                        //Format rupiah
                        $JumlahPasien = "" . number_format($JumlahPasien,0,',','.');
                ?>
                <tr>
                    <td class="text-center"><?php echo "$no";?></td>
                    <td class="text-left"><?php echo "$dokter";?></td>
                    <td class="text-left"><?php echo "$poliklinik";?></td>
                    <td class="text-left"><?php echo "$LabelStatus";?></td>
                    <td class="text-right">
                        <span onmousemove="this.style.cursor='pointer'" class="badge badge-inverse-primary" data-toggle="modal" data-target="#ModalHistoriKunjungan" data-id="<?php echo "$id_dokter";?>" title="History Kunjungan">
                            <?php echo "$JumlahPasien Orang";?>
                        </span>
                    </td>
                    <td align="center" width="10%">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-seccondary"  data-toggle="modal" data-target="#ModalEditDokter" data-id="<?php echo "$id_dokter,$page,$batas";?>" title="Edit Data Dokter & Poliklinik">
                                <i class="menu-icon mdi mdi-pencil" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-seccondary" data-toggle="modal" data-target="#ModalDeleteDokter" data-id="<?php echo "$id_dokter,$page,$batas";?>" title="Hapus Data Dokter & Poliklinik">
                                <i class="menu-icon mdi mdi-delete" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php $no++;} ?>
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col col-lg-12">
            <form action="javascript:void(0);" id="Paging">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-secondary" id="PrevPage" <?php echo "value='".$prev.",".$batas."'"; ?>>
                        <<
                    </button>
                    <?php 
                        //Navigasi nomor
                        $nmr = '';
                        if($JmlHalaman>5){
                            if($page>=3){
                                $a=$page-2;
                                $b=$page+2;
                                if($JmlHalaman<=$b){
                                    $a=$page-2;
                                    $b=$JmlHalaman;
                                }
                            }else{
                                $a=1;
                                $b=$page+2;
                                if($JmlHalaman<=$b){
                                    $a=1;
                                    $b=$JmlHalaman;
                                }
                            }
                        }else{
                            $a=1;
                            $b=$JmlHalaman;
                        }
                        for ( $i =$a; $i<=$b; $i++ ){
                    ?>
                    <button type="button" class="<?php if($i==$page){echo "btn btn-primary";}else{echo "btn btn-grey";} ?>" id="PageNumber<?php echo $i;?>" <?php echo "value='".$i.",".$batas."'"; ?>>
                        <?php echo $i;?>
                    </button>
                    <?php 
                        }
                    ?>
                    <button type="button" class="btn btn-outline-secondary" id="NextPage" <?php echo "value='".$next.",".$batas."'"; ?>>
                        >>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>