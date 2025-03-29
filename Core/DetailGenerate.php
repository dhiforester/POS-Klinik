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
    //id_obat
    if(!empty($_POST['id_obat'])){
        $id_obat=$_POST['id_obat'];
    }else{
        $id_obat="";
    }
    
    //Buka data obat
    $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
    $DataObat = mysqli_fetch_array($QryObat);
    $nama= $DataObat['nama'];
    $kode = $DataObat['kode'];
    $kategori = $DataObat['kategori'];
    $satuan = $DataObat['satuan'];
    $stok= $DataObat['stok'];
    $harga_1= $DataObat['harga_1'];
    $harga_2= $DataObat['harga_2'];
    //Cari data konversi berdasarkan kode
    $QryKonversi = mysqli_query($conn, "SELECT * FROM satuan_konversi WHERE kode='$kode' AND satuan='$satuan'")or die(mysqli_error($conn));
    $DataKonversi = mysqli_fetch_array($QryKonversi);
    $idKonversi= $DataKonversi['id'];
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
     
?>
<div class="modal-body bg-white">
    <div class="table-responsive">
        Kode Dasar : <?php echo $IdDasarSolid;?>
        <table class="table table-sm table-bordered table-hover">
            <tbody>
                <tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>ID DATA</b></td>
                    <td align="center"><b>ID</b></td>
                    <td align="center"><b>KODE</b></td>
                    <td align="center"><b>SATUAN</b></td>
                    <td align="center"><b>KONVERSI</b></td>
                    <td align="center"><b>BARCODE</b></td>
                    <td align="center"><b>HARGA POKOK</b></td>
                    <td align="center"><b>HARGA JUAL</b></td>
                </tr>
                <?php
                    $no = 1;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($conn, "SELECT*FROM satuan_konversi WHERE kode='$kode' AND id like '%$IdDasarSolid%'");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_data = $data['id_data'];
                        $id = $data['id'];
                        $kode_multi = $data['kode'];
                        $satuan_multi = $data['satuan'];
                        $konversi= $data['konversi'];
                        $barcode= $data['barcode'];
                        $harga_pokok= $data['harga_pokok'];
                        //Buka data Harga
                        $QryHarga = mysqli_query($conn, "SELECT * FROM harga WHERE kode='$kode_multi' AND satuan='$satuan_multi' AND id like '%$IdDasarSolid%'")or die(mysqli_error($conn));
                        $DataHarga = mysqli_fetch_array($QryHarga);
                        if(!empty($DataHarga['harga_jual'])){
                            $harga_jual= $DataHarga['harga_jual'];
                        }else{
                            $harga_jual= $harga_2;
                        }
                       
                        echo "<tr>";
                        echo "  <td>";
                        echo "      $no";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $id_data";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $id";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $kode_multi";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $satuan_multi";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $konversi";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $barcode";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $harga_pokok";
                        echo "  </td>";
                        echo "  <td>";
                        echo "      $harga_jual";
                        echo "  </td>";
                        echo "</tr>";
                    $no++;}
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12 text-center">
            <h4>Multi Harga</h4>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td align="center"><b>NO</b></td>
                            <td align="center"><b>ID BARANG</b></td>
                            <td align="center"><b>HARGA 1</b></td>
                            <td align="center"><b>HARGA 2</b></td>
                            <td align="center"><b>HARGA 3</b></td>
                            <td align="center"><b>HARGA 4</b></td>
                            <td align="center"><b>SATUAN</b></td>
                            <td align="center"><b>KONVERSI</b></td>
                            <td align="center"><b>STOK</b></td>
                            <td align="center"><b>BARCODE</b></td>
                        </tr>
                        <?php
                            $no_multi = 1;
                            //KONDISI PENGATURAN MASING FILTER
                            $qryMulti = mysqli_query($conn, "SELECT*FROM muti_harga WHERE id_barang='$id_obat'");
                            while ($DataMulti = mysqli_fetch_array($qryMulti)) {
                                $id_barangMulti = $DataMulti['id_barang'];
                                $HargaMulti1 = $DataMulti['harga1'];
                                $HargaMulti2 = $DataMulti['harga2'];
                                $HargaMulti3= $DataMulti['harga3'];
                                $HargaMulti4 = $DataMulti['harga4'];
                                $SatuanMulti = $DataMulti['satuan'];
                                $KonversiMulti = $DataMulti['konversi'];
                                $StokMulti = $DataMulti['stok'];
                                $BarcodeMulti = $DataMulti['barcode'];
                            
                            
                                echo "<tr>";
                                echo "  <td>";
                                echo "      $no_multi";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $id_barangMulti";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $HargaMulti1";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $HargaMulti2";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $HargaMulti3";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $HargaMulti4";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $SatuanMulti";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $KonversiMulti";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $StokMulti";
                                echo "  </td>";
                                echo "  <td>";
                                echo "      $BarcodeMulti";
                                echo "  </td>";
                                echo "</tr>";
                            $no++;}
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12 text-center">
            <button class="btn btn-rounded btn-outline-light" data-dismiss="modal">
                <i class="mdi mdi-close"></i> Tutup
            </button>
        </div>
    </div>
</div>