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
        $ShortBy="ASC";
    }
    //hitung jumlah data
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM member"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM member WHERE id_member like '%$keyword%' OR nama like '%$keyword%' OR nik like '%$keyword%' OR kontak like '%$keyword%' OR perusahaan like '%$keyword%'"));
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
        $('#NextPageSupplier').click(function() {
            var NextPageSupplier = $('#NextPageSupplier').val();
            var mode = NextPageSupplier.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/Kasir/TabelPilihSupplier.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success: function (data) {
                    $('#TabelPilihSupplier').html(data);

                }
            })
        });
        //Ketika klik Previous
        $('#PrevPageSupplier').click(function() {
            var PrevPageSupplier = $('#PrevPageSupplier').val();
            var mode = PrevPageSupplier.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/Kasir/TabelPilihSupplier.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success : function (data) {
                    $('#TabelPilihSupplier').html(data);
                }
            })
        });
        <?php 
            $a=1;
            $b=$JmlHalaman;
            for ( $i =$a; $i<=$b; $i++ ){
        ?>
            //ketika klik page number
            $('#PageNumberSupplier<?php echo $i;?>').click(function() {
                var PageNumberSupplier = $('#PageNumberSupplier<?php echo $i;?>').val();
                var mode = PageNumberSupplier.split(',');
                var page = mode[0];
                var BatasData = mode[1];
                $.ajax({
                    url     : "_Page/Kasir/TabelPilihSupplier.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData },
                    success: function (data) {
                        $('#TabelPilihSupplier').html(data);
                    }
                })
            });
        <?php } ?>
        
    });
</script>
<div class="row mb-3">
    <div class="col-md-12 bg-white" style="height: 200px; overflow-y: scroll;">
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
                    if(empty($jml_data)){
                        echo "<tr><td colspan='7' align='center'>Tidak Ada Data Yang Ditampilkan</td></tr>";
                    }else{
                        $no = 1+$posisi;
                        //KONDISI PENGATURAN MASING FILTER
                        if(empty($keyword)){
                            $query = mysqli_query($conn, "SELECT*FROM member ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                        }else{
                            $query = mysqli_query($conn, "SELECT*FROM member WHERE id_member like '%$keyword%' OR nama like '%$keyword%' OR nik like '%$keyword%' OR kontak like '%$keyword%' OR perusahaan like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
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
                        <td class="text-left"><?php echo "$nama";?></td>
                        <td class="text-left"><?php echo "$kontak";?></td>
                        <td class="text-left"><?php echo "$perusahaan";?></td>
                        <td align="center" width="10%">
                            <div class="btn-group">
                            <input class="form-check-input" type="radio" name="id_member" id="id_member" value="<?php echo "$id_member";?>">
                            </div>
                        </td>
                    </tr>
                    <?php $no++;} }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="javascript:void(0);" id="Paging">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-outline-secondary" id="PrevPageSupplier" <?php echo "value='".$prev.",".$batas."'"; ?>>
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
                <button type="button" class="<?php if($i==$page){echo "btn btn-primary";}else{echo "btn btn-grey";} ?>" id="PageNumberSupplier<?php echo $i;?>" <?php echo "value='".$i.",".$batas."'"; ?>>
                    <?php echo $i;?>
                </button>
                <?php 
                    }
                ?>
                <button type="button" class="btn btn-outline-secondary" id="NextPageSupplier" <?php echo "value='".$next.",".$batas."'"; ?>>
                    >>
                </button>
            </div>
        </form>
    </div>
</div>