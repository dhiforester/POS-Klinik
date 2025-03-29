<?php
    //Ini adalah halaman untuk melakukan konfigurasi database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "toko_migrasi";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Atur Batas
    $batas="500";
    $Kategori="";
    //Atur Page
    $page="1";
    if(!empty($page)){
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $posisi = 0;
    }
    //Atur Keyword
    $keyword="";
    if(isset($keyword)){
        $keyword=$keyword;
    }else{
        $keyword="";
    }
    //Atur OrderBy
    if(isset($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="kode";
    }
    //Atur ShortBy
    if(isset($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="ASC";
    }
    //hitung jumlah data
    if(empty($Kategori)){
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM obat"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM obat WHERE nama like '%$keyword%' OR kode like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM obat WHERE kategori='$Kategori'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM obat WHERE kategori='$Kategori' AND nama like '%$keyword%' OR kode like '%$keyword%'"));
        }
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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Halaman Generate</title>
        <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="images/favicon.png" />
        <script src="vendors/bootstrap431/js/jquery.min.js"></script>
        <!--- Ini adalah plugin untuk kontrol halaman atau engine--->
    </head>
    <body>
        <script>
            $(document).ready(function(){
                $('#ModalDetailObat').on('show.bs.modal', function (e) {
                var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                $('#DetailGenerate').html(Loading);
                var id_obat = $(e.relatedTarget).data('id');
                $.ajax({
                    url     : "DetailGenerate.php",
                    method  : "POST",
                    data    : { id_obat: id_obat },
                    success: function (data) {
                        $('#DetailGenerate').html(data);
                    }
                })
            });
            });
        </script>
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-12 text-center">
                                <h2>
                                    <a href="">
                                     GENERATE DATA
                                    </a>
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12 text-center">
                                <a href="ProsesGenerate.php?batas=<?php echo $batas;?>&page=<?php echo $page;?>">Mulai Generate</a>
                                //
                                <a href="PindahkanBarcode.php?batas=<?php echo $batas;?>&page=<?php echo $page;?>">Pindahkan Barcode</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-12">
                                <form action="javascript:void(0);" id="Paging">
                                    
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="table-responsive" id="TabelDataBarang">
                                    <table class="table table-sm table-bordered table-hover table-md scroll-container">
                                        <tr>
                                            <td align="center"><b>No</b></td>
                                            <td align="center"><b>ID</b></td>
                                            <td align="center"><b>Kode</b></td>
                                            <td align="center"><b>Nama</b></td>
                                            <td align="center"><b>Kategori</b></td>
                                            <td align="center"><b>Satuan</b></td>
                                            <td align="center"><b>Konversi</b></td>
                                            <td align="center"><b>Stok</b></td>
                                            <td align="center"><b>H1</b></td>
                                            <td align="center"><b>H2</b></td>
                                            <td align="center"><b>H3</b></td>
                                            <td align="center"><b>H4</b></td>
                                            <td align="center"><b>Barcode</b></td>
                                        </tr>
                                        <?php
                                            $no = 1+$posisi;
                                            //KONDISI PENGATURAN MASING FILTER
                                            if(empty($Kategori)){
                                                if(empty($keyword)){
                                                    $query = mysqli_query($conn, "SELECT*FROM obat ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                                }else{
                                                    $query = mysqli_query($conn, "SELECT*FROM obat WHERE nama like '%$keyword%' OR kode like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                                }
                                            }else{
                                                if(empty($keyword)){
                                                    $query = mysqli_query($conn, "SELECT*FROM obat WHERE kategori='$Kategori' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                                }else{
                                                    $query = mysqli_query($conn, "SELECT*FROM obat WHERE kategori='$Kategori' AND nama like '%$keyword%' OR kode like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                                }
                                            }
                                            
                                            while ($data = mysqli_fetch_array($query)) {
                                                $id_obat = $data['id_obat'];
                                                $nama= $data['nama'];
                                                $kode = $data['kode'];
                                                $NamaKategori = $data['kategori'];
                                                $satuan = $data['satuan'];
                                                $stok= $data['stok'];
                                                $harga_1= $data['harga_1'];
                                                $harga_2= $data['harga_2'];
                                                $harga_3= $data['harga_3'];
                                                $harga_4= $data['harga_4'];
                                                $konversi= $data['konversi'];
                                                $barcode= $data['barcode'];
                                                //Cari data konversi berdasarkan kode
                                                $QryKonversi = mysqli_query($conn, "SELECT * FROM satuan_konversi WHERE kode='$kode' AND satuan='$satuan'")or die(mysqli_error($conn));
                                                $DataKonversi = mysqli_fetch_array($QryKonversi);
                                                $idKonversi= $DataKonversi['id'];
                                                $BarcodeKonversi= $DataKonversi['barcode'];
                                                if(empty($idKonversi)){
                                                    $idKonversi="$kode";
                                                }else{
                                                    //Pecahkan id
                                                    $Explode=explode("-",$idKonversi);
                                                    $Umt=$Explode['0'];
                                                    $IdDasar=$Explode['1'];
                                                    //Bentuk Kode
                                                    if(empty($Umt)){
                                                        $IdDasarSolid="$idKonversi";
                                                    }else{
                                                        $IdDasarSolid="$Umt-$IdDasar-";
                                                    }
                                                }
                                        ?>
                                        <tr tabindex="0" id="BarisDataBarang<?php echo "$no";?>" onmousemove="this.style.cursor='pointer'" data-toggle="modal" data-target="#ModalDetailObat" data-id="<?php echo $id_obat;?>">
                                            <td><?php echo "$no";?></td>
                                            <td><?php echo "$id_obat";?></td>
                                            <td><?php echo "$kode";?></td>
                                            <td><?php echo "$nama";?></td>
                                            <td><?php echo "$NamaKategori";?></td>
                                            <td><?php echo "$satuan";?></td>
                                            <td><?php echo "$konversi";?></td>
                                            <td><?php echo "$stok";?></td>
                                            <td><?php echo "$harga_1";?></td>
                                            <td><?php echo "$harga_2";?></td>
                                            <td><?php echo "$harga_3";?></td>
                                            <td><?php echo "$harga_4";?></td>
                                            <td><?php echo "$BarcodeKonversi";?></td>
                                        </tr>
                                        <?php $no++;} ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ModalDetailObat" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="DetailGenerate">
                </div>
            </div>
        </div>
        <?php
             include "_Partial/ScriptJs.php";
        ?>
    </body>
    
</html>

