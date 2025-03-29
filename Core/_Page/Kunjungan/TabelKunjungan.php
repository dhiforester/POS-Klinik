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
        $OrderBy="id_kunjungan";
    }
    //Atur ShortBy
    if(isset($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="DESC";
    }
    //hitung jumlah data
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_kunjungan like '%$keyword%' OR nama like '%$keyword%' OR id_pasien like '%$keyword%' OR tujuan like '%$keyword%' OR status like '%$keyword%'"));
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
                url     : "_Page/Kunjungan/TabelKunjungan.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success: function (data) {
                    $('#TabelKunjungan').html(data);

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
                url     : "_Page/Kunjungan/TabelKunjungan.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success : function (data) {
                    $('#TabelKunjungan').html(data);
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
                    url     : "_Page/Kunjungan/TabelKunjungan.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData },
                    success: function (data) {
                        $('#TabelKunjungan').html(data);
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
                    <th>No.RM</th>
                    <th>Pasien</th>
                    <th>Tanggal</th>
                    <th>Kunjungan</th>
                    <th>Status</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(empty($jml_data)){
                    echo "<tr><td colspan='7' align='center'>Tidak Ada Data Yang Ditampilkan</td></tr>";
                }else{
                    $no = 1+$posisi;
                    //KONDISI PENGATURAN MASING FILTER
                    if(empty($keyword)){
                        $query = mysqli_query($conn, "SELECT*FROM kunjungan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }else{
                        $query = mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_kunjungan like '%$keyword%' OR nama like '%$keyword%' OR id_pasien like '%$keyword%' OR tujuan like '%$keyword%' OR status like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        $id_kunjungan = $data['id_kunjungan'];
                        $id_pasien= $data['id_pasien'];
                        $nama = $data['nama'];
                        $tanggal = $data['tanggal'];
                        $tujuan = $data['tujuan'];
                        $status = $data['status'];
                        //Zero padding id_pasien
                        $NoRm = sprintf('%05d', $id_pasien);
                        if($status=="Terdaftar"){
                            $LabelStatus='<span class="badge badge-primary">Terdaftar</span>';
                        }else{
                            if($status=="Meninggal"){
                                $LabelStatus='<span class="badge badge-danger">Meninggal</span>';
                            }else{
                                if($status=="Pulang"){
                                    $LabelStatus='<span class="badge badge-success">Pulang</span>';
                                }else{
                                    $LabelStatus='<span class="badge badge-secondary">None</span>';
                                }
                            }
                        }
                ?>
                <tr>
                    <td class="text-left"><?php echo "$no";?></td>
                    <td class="text-center">
                        <span onmousemove="this.style.cursor='pointer'" class="badge badge-inverse-primary" data-toggle="modal" data-target="#ModalDetailKunjungan" data-id="<?php echo "$id_kunjungan";?>">
                            <?php echo "$NoRm";?>
                        </span>
                    </td>
                    <td class="text-left"><?php echo "$nama";?></td>
                    <td class="text-left"><?php echo "$tanggal";?></td>
                    <td class="text-center"><?php echo "$tujuan";?></td>
                    <td class="text-left"><?php echo "$LabelStatus";?></td>
                    <td align="center" width="10%">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#ModalEditKunjungan" data-id="<?php echo "$id_kunjungan,$page,$batas";?>" title="Edit Data Kunjungan">
                                <i class="menu-icon mdi mdi-pencil" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDeleteKunjungan" data-id="<?php echo "$id_kunjungan,$page,$batas";?>" title="Hapus Data Kunjungan">
                                <i class="menu-icon mdi mdi-delete" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php $no++;} }?>
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