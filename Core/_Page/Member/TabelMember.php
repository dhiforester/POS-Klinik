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
        $OrderBy="id_member";
    }
    //Atur ShortBy
    if(isset($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="DESC";
    }
    //hitung jumlah data
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM member"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM member WHERE nama like '%$keyword%' OR nik like '%$keyword%' OR perusahaan like '%$keyword%' OR kontak like '%$keyword%'"));
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
        
        $('#ModalDetailMember').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#DetailMember').html(Loading);
            var IdMember = $(e.relatedTarget).data('id');
            $.ajax({
                url     : "_Page/Member/DetailMember.php",
                method  : "POST",
                data    : { IdMember: IdMember },
                success: function (data) {
                    $('#DetailMember').html(data);
                }
            })
        });
        //ketika klik next
        $('#NextPage').click(function() {
            var valueNext = $('#NextPage').val();
            var mode = valueNext.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/Member/TabelMember.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success: function (data) {
                    $('#TabelMember').html(data);

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
                url     : "_Page/Member/TabelMember.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success : function (data) {
                    $('#TabelMember').html(data);
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
                    url     : "_Page/Member/TabelMember.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData },
                    success: function (data) {
                        $('#TabelMember').html(data);
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
                    <th class="text-center">No</th>
                    <th>Nama Supplier</th>
                    <th>Kontak</th>
                    <th>Perusahaan</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1+$posisi;
                    //KONDISI PENGATURAN MASING FILTER
                    if(empty($keyword)){
                        $query = mysqli_query($conn, "SELECT*FROM member ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }else{
                        $query = mysqli_query($conn, "SELECT*FROM member WHERE nama like '%$keyword%' OR nik like '%$keyword%' OR perusahaan like '%$keyword%' OR kontak like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        $id_member = $data['id_member'];
                        $nama= $data['nama'];
                        $nik = $data['nik'];
                        $perusahaan = $data['perusahaan'];
                        $kontak = $data['kontak'];
                ?>
                <tr>
                    <td class="text-center"><?php echo "$no";?></td>
                    <td><?php echo "$nama";?></td>
                    <td><?php echo "$kontak";?></td>
                    <td class="text-left"><?php echo "$perusahaan";?></td>
                    <td align="center" width="10%">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalEditMember"  data-id="<?php echo "$id_member"; ?>" title="Edit Data Supplier">
                                <i class="menu-icon mdi mdi-pencil" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDeleteMember" data-id="<?php echo $id_member;?>" title="Hapus Data Supplier">
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