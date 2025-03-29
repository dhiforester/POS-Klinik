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
        $OrderBy="id_pasien";
    }
    //Atur ShortBy
    if(isset($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="ASC";
    }
    //hitung jumlah data
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM pasien"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM pasien WHERE id_pasien like '%$keyword%' OR nik like '%$keyword%' OR nama like '%$keyword%' OR gender like '%$keyword%' OR status like '%$keyword%'"));
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
        $('#NextPageKunjungan').click(function() {
            var valueNext = $('#NextPageKunjungan').val();
            var mode = valueNext.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/Kunjungan/TabelPilihPasien.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success: function (data) {
                    $('#TabelPilihPasien').html(data);

                }
            })
        });
        //Ketika klik Previous
        $('#PrevPageKunjungan').click(function() {
            var ValuePrev = $('#PrevPageKunjungan').val();
            var mode = ValuePrev.split(',');
            var page = mode[0];
            var BatasData = mode[1];
            $.ajax({
                url     : "_Page/Kunjungan/TabelPilihPasien.php",
                method  : "POST",
                data    : { page: page, BatasData: BatasData },
                success : function (data) {
                    $('#TabelPilihPasien').html(data);
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
                    url     : "_Page/Kunjungan/TabelPilihPasien.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData },
                    success: function (data) {
                        $('#TabelPilihPasien').html(data);
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
                        <th>No.RM</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Gender</th>
                        <th>Kontak</th>
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
                            $query = mysqli_query($conn, "SELECT*FROM pasien ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                        }else{
                            $query = mysqli_query($conn, "SELECT*FROM pasien WHERE id_pasien like '%$keyword%' OR nik like '%$keyword%' OR nama like '%$keyword%' OR gender like '%$keyword%' OR status like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                        }
                        while ($data = mysqli_fetch_array($query)) {
                            $id_pasien = $data['id_pasien'];
                            $nik= $data['nik'];
                            $nama = $data['nama'];
                            $gender = $data['gender'];
                            $tanggal_lahir = $data['tanggal_lahir'];
                            $alamat = $data['alamat'];
                            $kontak = $data['kontak'];
                            $status = $data['status'];
                            $updatetime = $data['updatetime'];
                            //Zero Padding id_pasien
                            $id_pasien = sprintf('%06d', $id_pasien);
                            if($gender=="Laki-laki"){
                                $LabelGender='<span class="badge badge-danger">L</span>';
                            }else{
                                $LabelGender='<span class="badge badge-primary">P</span>';
                            }
                            if($status=="Aktif"){
                                $LabelStatus='<span class="badge badge-success">Aktif</span>';
                            }else{
                                if($status=="Meninggal"){
                                    $LabelStatus='<span class="badge badge-danger">Meninggal</span>';
                                }else{
                                    if($status=="Non Aktif"){
                                        $LabelStatus='<span class="badge badge-secondary">Non Aktif</span>';
                                    }else{
                                        $LabelStatus='<span class="badge badge-secondary">None</span>';
                                    }
                                }
                            }
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php echo "$id_pasien";?>
                        </td>
                        <td class="text-left"><?php echo "$nama";?></td>
                        <td class="text-left"><?php echo "$nik";?></td>
                        <td class="text-center"><?php echo "$LabelGender";?></td>
                        <td class="text-left"><?php echo "$kontak";?></td>
                        <td class="text-center"><?php echo "$LabelStatus";?></td>
                        <td align="center" width="10%">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#ModalTambahKunjungan" data-id="<?php echo "$id_pasien";?>" title="Edit Data Pasien">
                                    <i class="menu-icon mdi mdi-check" aria-hidden="true"></i> Pilih
                                </button>
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
                <button type="button" class="btn btn-outline-secondary" id="PrevPageKunjungan" <?php echo "value='".$prev.",".$batas."'"; ?>>
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
                <button type="button" class="btn btn-outline-secondary" id="NextPageKunjungan" <?php echo "value='".$next.",".$batas."'"; ?>>
                    >>
                </button>
            </div>
        </form>
    </div>
</div>