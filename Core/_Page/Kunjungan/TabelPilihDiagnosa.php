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
        $OrderBy="id_diagnosa";
    }
    //Atur ShortBy
    if(isset($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="ASC";
    }
    //hitung jumlah data
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM diagnosa"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM diagnosa WHERE kode like '%$keyword%' OR long_des like '%$keyword%' OR short_des like '%$keyword%' OR versi like '%$keyword%'"));
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
        $('#NextPageDiagnosa').click(function() {
            var valueNext = $('#NextPageDiagnosa').val();
            var mode = valueNext.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/Kunjungan/TabelPilihDiagnosa.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success: function (data) {
                    $('#TabelPilihDiagnosa').html(data);
                }
            })
        });
        //Ketika klik Previous
        $('#PrevPageDiagnosa').click(function() {
            var ValuePrev = $('#PrevPageDiagnosa').val();
            var mode = ValuePrev.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/Kunjungan/TabelPilihDiagnosa.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success : function (data) {
                    $('#TabelPilihDiagnosa').html(data);
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
                    url     : "_Page/Kunjungan/TabelPilihDiagnosa.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData },
                    success: function (data) {
                        $('#TabelPilihDiagnosa').html(data);
                    }
                })
            });
        <?php } ?>
        
    });
</script>
<div class="row mb-3">
    <div class="col-md-12 bg-white" style="height: 350px; overflow-y: scroll;">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Short Des</th>
                        <th>Versi</th>
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
                            $query = mysqli_query($conn, "SELECT*FROM diagnosa ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                        }else{
                            $query = mysqli_query($conn, "SELECT*FROM diagnosa WHERE kode like '%$keyword%' OR long_des like '%$keyword%' OR short_des like '%$keyword%' OR versi like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                        }
                        while ($data = mysqli_fetch_array($query)) {
                            $id_diagnosa = $data['id_diagnosa'];
                            $kode= $data['kode'];
                            $long_des = $data['long_des'];
                            $short_des = $data['short_des'];
                            $versi = $data['versi'];
                    ?>
                    <tr for="">
                        <td class="text-center">
                            <?php echo "$no";?>
                        </td>
                        <td class="text-left"><?php echo "$kode";?></td>
                        <td class="text-left"><?php echo "$short_des";?></td>
                        <td class="text-center"><?php echo "$versi";?></td>
                        <td align="center" valign="center" class="text-center" width="10%">
                            <input class="form-check-input" type="radio" name="id_diagnosa" id="id_diagnosa" value="<?php echo "$id_diagnosa";?>">
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
                <button type="button" class="btn btn-outline-secondary" id="PrevPageDiagnosa" <?php echo "value='".$prev.",".$batas."'"; ?>>
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
                <button type="button" class="btn btn-outline-secondary" id="NextPageDiagnosa" <?php echo "value='".$next.",".$batas."'"; ?>>
                    >>
                </button>
            </div>
        </form>
    </div>
</div>