<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_ruang_inap'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <span class="text-danger">Maaf, ID Dokter Tidak Dapat Di Tangkap Oleh Sistem!!</span>';
        echo '      </div>';
        echo '  </div>';
    }else{
        //Tampilkan Data Dokter
        $id_ruang_inap = $_POST['id_ruang_inap'];
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
            $OrderBy="id_ruang_inap";
        }
        //Atur ShortBy
        if(isset($_POST['ShortBy'])){
            $ShortBy=$_POST['ShortBy'];
        }else{
            $ShortBy="ASC";
        }
        $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_ruang_inap='$id_ruang_inap' AND status='Terdaftar'"));
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
            $('#NextPageHistoryKunjunganRuangInap').click(function() {
                var valueNext = $('#NextPageHistoryKunjunganRuangInap').val();
                var mode = valueNext.split(',');
                var page = mode[0];
                var BatasData = mode[1];
                var id_ruang_inap = mode[2];
                $.ajax({
                    url     : "_Page/RuangInap/HistoryKunjunganRuangInap.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData, id_ruang_inap: id_ruang_inap },
                    success: function (data) {
                        $('#HistoryKunjunganRuangInap').html(data);

                    }
                })
            });
            //Ketika klik Previous
            $('#PrevPageHistoryKunjunganRuangInap').click(function() {
                var ValuePrev = $('#PrevPageHistoryKunjunganRuangInap').val();
                var mode = ValuePrev.split(',');
                var page = mode[0];
                var BatasData = mode[1];
                var id_ruang_inap = mode[2];
                $.ajax({
                    url     : "_Page/RuangInap/HistoryKunjunganRuangInap.php",
                    method  : "POST",
                    data    : { page: page, BatasData: BatasData, id_ruang_inap: id_ruang_inap },
                    success : function (data) {
                        $('#HistoryKunjunganRuangInap').html(data);
                    }
                })
            });
            <?php 
                $a=1;
                $b=$JmlHalaman;
                for ( $i =$a; $i<=$b; $i++ ){
            ?>
                //ketika klik page number
                $('#PageNumberHistoryKunjunganRuangInap<?php echo $i;?>').click(function() {
                    var PageNumber = $('#PageNumberHistoryKunjunganRuangInap<?php echo $i;?>').val();
                    var mode = PageNumber.split(',');
                    var page = mode[0];
                    var BatasData = mode[1];
                    var id_ruang_inap = mode[2];
                    $.ajax({
                        url     : "_Page/RuangInap/HistoryKunjunganRuangInap.php",
                        method  : "POST",
                        data    : { page: page, BatasData: BatasData, id_ruang_inap: id_ruang_inap },
                        success: function (data) {
                            $('#HistoryKunjunganRuangInap').html(data);
                        }
                    })
                });
            <?php } ?>
            
        });
    </script>
    <div class="row">
        <div class="col-md-12" style="height: 350px; overflow-y: scroll;">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(empty($jml_data)){
                            echo "<tr><td colspan='7' align='center'>Tidak Ada Data Yang Ditampilkan</td></tr>";
                        }else{
                            $no = 1+$posisi;
                            //KONDISI PENGATURAN MASING FILTER
                            $query = mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_ruang_inap='$id_ruang_inap' AND status='Terdaftar' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
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
                        </tr>
                        <?php $no++;} }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-12">
            <form action="javascript:void(0);" id="Paging">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-secondary" id="PrevPageHistoryKunjunganRuangInap" <?php echo "value='".$prev.",".$batas.",".$id_ruang_inap."'"; ?>>
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
                    <button type="button" class="<?php if($i==$page){echo "btn btn-primary";}else{echo "btn btn-grey";} ?>" id="PageNumberHistoryKunjunganRuangInap<?php echo $i;?>" <?php echo "value='".$i.",".$batas.",".$id_ruang_inap."'"; ?>>
                        <?php echo $i;?>
                    </button>
                    <?php 
                        }
                    ?>
                    <button type="button" class="btn btn-outline-secondary" id="NextPageHistoryKunjunganRuangInap" <?php echo "value='".$next.",".$batas.",".$id_ruang_inap."'"; ?>>
                        >>
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>