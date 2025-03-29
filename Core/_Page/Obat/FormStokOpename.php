<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['id_so'])){
        $id_so="";
        if(!empty($_POST['id_obat'])){
            $id_obat=$_POST['id_obat'];
            //Buka data obat
            $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
            $DataObat = mysqli_fetch_array($QryObat);
            $id_obat= $DataObat['id_obat'];
            $nama= $DataObat['nama'];
            $kode = $DataObat['kode'];
            $kategori = $DataObat['kategori'];
            $satuan = $DataObat['satuan'];
            $konversi = $DataObat['konversi'];
            $stok= $DataObat['stok'];
            $harga_1= $DataObat['harga_1'];
            $harga_2= $DataObat['harga_2'];
            $harga_3= $DataObat['harga_3'];
            $harga_4= $DataObat['harga_4'];   
        }else{
            $id_obat="";
            $nama="";
            $kode="";
            $kategori ="";
            $satuan="";
            $konversi="";
            $stok="";
            $harga_1="";
            $harga_2="";
            $harga_3="";
            $harga_4="";
        }
        if(!empty($_POST['periode'])){
            $periode=$_POST['periode'];
        }else{
            $periode="";
        }
        $stok_nyata ="";
        $selisih="";
        $keterangan="";
    }else{
        $id_so=$_POST['id_so'];
        //Buka data stok opename
        $QrySo = mysqli_query($conn, "SELECT * FROM stok_opename WHERE id_so='$id_so'")or die(mysqli_error($conn));
        $DataSo = mysqli_fetch_array($QrySo);
        $id_obat= $DataSo['id_barang'];
        $periode= $DataSo['tanggal'];
        $stok = $DataSo['stok_data'];
        $stok_nyata = $DataSo['stok_nyata'];
        $selisih= $DataSo['selisih'];
        $keterangan= $DataSo['keterangan'];
        //Buka Data Obat
        $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
        $DataObat = mysqli_fetch_array($QryObat);
        $nama= $DataObat['nama'];
        $kode = $DataObat['kode'];
        $satuan = $DataObat['satuan'];
    }
?>
<script type="text/javascript">
    $(document).on("keyup", function(event) {
        if (event.keyCode === 27) {
            document.getElementById("TutupMultiHarga").click();
        }
    });
</script>
<script>
    $('#stok_nyata').keyup(function() {
        var stok_nyata = $('#stok_nyata').val();
        var stok_nyata = parseInt(stok_nyata);
        var stok_data = $('#stok_data').val();
        var stok_data = parseInt(stok_data);
        var selisih=stok_nyata-stok_data;
        $('#selisih').val(selisih);
    });
    $('#ProsesInputStokopename').submit(function() {
        $('#NotifikasiProsesStokopename').html('Loading..');
        var ProsesInputStokopename = $('#ProsesInputStokopename').serialize();
        $.ajax({
            url     : "_Page/Obat/ProsesInputStokopename.php",
            method  : "POST",
            data    : ProsesInputStokopename,
            success: function (data) {
                $('#NotifikasiProsesStokopename').html(data);
                var NotifikasiInputSoBerhasil=$('#NotifikasiInputSoBerhasil').html();
                if(NotifikasiInputSoBerhasil=="Input Stok Opename Berhasil"){
                    var periode=$('#periode').val();
                    $.ajax({
                        url     : "_Page/Obat/FormStokOpename.php",
                        method  : "POST",
                        data    : { periode: periode },
                        success: function (data) {
                            $('#FormStokOpename').html(data);
                        }
                    })
                }
            }
        })
    });
</script>
<?php
    //hitung jumlah data
    $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM stok_opename WHERE tanggal='$periode'"));
    $a=1;
    $b=$jml_data;
    for ( $i =$a; $i<=$b; $i++ ){
?>
    <script>
        $('#EditSo<?php echo $i;?>').click(function() {
            var EditSo = $('#EditSo<?php echo $i;?>').val();
            var mode = EditSo.split(',');
            var id_so = mode[0];
            var periode = mode[1];
            $('#FormStokOpename').html('Loading..');
            $.ajax({
                url     : "_Page/Obat/FormStokOpename.php",
                method  : "POST",
                data    : { id_so: id_so, periode: periode },
                success: function (data) {
                    $('#FormStokOpename').html(data);
                }
            })
        });
        $('#DeleteSo<?php echo $i;?>').click(function() {
            var DeleteSo = $('#DeleteSo<?php echo $i;?>').val();
            var mode = DeleteSo.split(',');
            var id_so = mode[0];
            var periode = mode[1];
            $('#FormStokOpename').html('Loading..');
            $.ajax({
                url     : "_Page/Obat/ProsesDeleteSo.php",
                method  : "POST",
                data    : { id_so: id_so, periode: periode },
                success: function (data) {
                    $.ajax({
                        url     : "_Page/Obat/FormStokOpename.php",
                        method  : "POST",
                        data    : { periode: periode },
                        success: function (data) {
                            $('#FormStokOpename').html(data);
                        }
                    })
                }
            })
        });
    </script>
<?php } ?>
<div class="modal-body">
    <form action="javascript:void(0);" id="ProsesInputStokopename" autocomplete="off">
        <input type="hidden" name="id_so" value="<?php echo $id_so;?>">
        <input type="hidden" name="id_obat" value="<?php echo $id_obat;?>">
        <div class="row">
            <div class="form-group col-md-2">
                <small>Tanggal</small>
                <input type="date" require readonly class="form-control border-warning" name="periode" value="<?php echo $periode;?>">
            </div>
            <div class="form-group col-md-2">
                <small>Kode</small>
                <input readonly type="text" require class="form-control border-warning" name="kode" id="kode" placeholder="Click" value="<?php echo $kode;?>" data-toggle="modal" data-target="#ModalPilihBarangSO">
            </div>
            <div class="form-group col-md-2">
                <small>Nama</small>
                <input readonly type="text" require class="form-control border-dark" name="nama" id="nama" value="<?php echo $nama;?>">
            </div>
            <div class="form-group col-md-1">
                <small>Stok</small>
                <input readonly type="text" require class="form-control border-dark" name="stok_data" id="stok_data" value="<?php echo $stok;?>">
            </div>
            <div class="form-group col-md-1">
                <small>Satuan</small>
                <input readonly type="text" require class="form-control border-dark" name="satuan" id="satuan" value="<?php echo $satuan;?>">
            </div>
            <div class="form-group col-md-1">
                <small>Stok Nyata</small>
                <input type="text" require class="form-control border-dark" name="stok_nyata" id="stok_nyata" value="<?php echo $stok_nyata;?>">
            </div>
            <div class="form-group col-md-1">
                <small>Selisih</small>
                <input type="text" require class="form-control border-dark" name="selisih" id="selisih" value="<?php echo $selisih;?>">
            </div>
            <div class="form-group col-md-2">
                <small>Keterangan</small>
                <input type="text" require class="form-control border-dark" name="keterangan" id="keterangan" value="<?php echo $keterangan;?>">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-md btn-primary" id="TombolInputSo">
                    <?php
                        if(empty($id_so)){
                            echo '<i class="mdi mdi-plus"></i> Add (Enter)';
                        }else{
                            echo '<i class="mdi mdi-plus"></i> Update (Enter)';
                        }
                    ?>
                </button>
            </div>
            <div class="col-md-10" id="NotifikasiProsesStokopename">
                <span>Pastikan Data Stok Opename Sudah Sesuai</span>
            </div>
        </div>
    </form>
    <div class="row bg-white">
        <div class="col-md-12" >
            <div class="table-responsive" id="TabelMultiHarga" style="height: 300px; overflow-y: scroll;">
                <table class="table table-bordered table-hover table-md scroll-container">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Opt</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Stok Nyata</th>
                            <th>Selisih</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            //KONDISI PENGATURAN MASING FILTER
                            $query = mysqli_query($conn, "SELECT*FROM stok_opename WHERE tanggal='$periode'");
                            while ($data = mysqli_fetch_array($query)) {
                                $id_so = $data['id_so'];
                                $id_barang = $data['id_barang'];
                                $tanggal = $data['tanggal'];
                                $stok_data= $data['stok_data'];
                                $stok_nyata= $data['stok_nyata'];
                                $selisih= $data['selisih'];
                                $keterangan= $data['keterangan'];
                                //Buka Barang
                                $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_barang'")or die(mysqli_error($conn));
                                $DataObat = mysqli_fetch_array($QryObat);
                                $namaBarang= $DataObat['nama'];
                                $kodeBarang = $DataObat['kode'];
                                $satuanBarang = $DataObat['satuan'];
                        ?>
                        <tr>
                            <td><?php echo "$no";?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" id="EditSo<?php echo "$no";?>" <?php echo "value='".$id_so.",".$periode."'"; ?>>
                                    <i class="menu-icon mdi mdi-pencil" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" id="DeleteSo<?php echo "$no";?>" <?php echo "value='".$id_so.",".$periode."'"; ?>>
                                    <i class="menu-icon mdi mdi-delete" aria-hidden="true"></i>
                                </button>
                            </td>
                            <td><?php echo "$tanggal";?></td>
                            <td><?php echo "$kodeBarang";?></td>
                            <td><?php echo "$namaBarang";?></td>
                            <td><?php echo "$satuanBarang";?></td>
                            <td><?php echo "" . number_format($stok_data,0,',','.');?></td>
                            <td><?php echo "" . number_format($stok_nyata,0,',','.');?></td>
                            <td><?php echo "" . number_format($selisih,0,',','.');?></td>
                            <td><?php echo "$keterangan";?></td>
                        </tr>
                        <?php $no++;} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
