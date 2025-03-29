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
    if(!empty($_GET['batas'])){
        $batas=$_GET['batas'];
    }else{
        $batas="200";
    }
    //Kategori
    $Kategori="";
    //Atur Batas
    if(!empty($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page="2";
    }
    //Atur Page
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
    //ARRAYKAN DATA BARANG UTAMA BERDASARKAN HALAMAN DAN BATAS DATA
    //AGAR PROSES BERLANGSUNG DENGAN RINGAN
    $no = 1+$posisi;
    $query = mysqli_query($conn, "SELECT*FROM obat ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
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
        
        if($data['kode']!==""){
            $kode=$data['kode'];
            echo "$no Kode Ditemukan--$kode --";
            //sarkan kode,satuan dan harga pokok
            $QryKonversi = mysqli_query($conn, "SELECT * FROM satuan_konversi WHERE kode='$kode' AND satuan='$satuan'")or die(mysqli_error($conn));
            $DataKonversi = mysqli_fetch_array($QryKonversi);
            $idKonversi= $DataKonversi['id'];
            $BarcodeKonversi= $DataKonversi['barcode'];
            $KonversiBaru= $DataKonversi['konversi'];
            $harga_pokok= $DataKonversi['harga_pokok'];
            //Lakukan Update pada data utama yang terdiri dari konversi dan harga pokok dan barcode
            //apabila syarat terpenuhi lakukan input
            $UpdateObat = mysqli_query($conn, "UPDATE obat SET 
            konversi='$KonversiBaru',
            harga_1='$harga_pokok',
            barcode='$BarcodeKonversi'
            WHERE id_obat='$id_obat'") or die(mysqli_error($conn)); 
            if($UpdateObat){
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
                echo "id_konversi=$idKonversi <br> ";
                //ARRAYKAN SATUAN KONVERSI
                $QryArrayKonversi = mysqli_query($conn, "SELECT*FROM satuan_konversi WHERE kode='$kode' AND id like '%$IdDasarSolid%'");
                while ($DataArrayKonversi = mysqli_fetch_array($QryArrayKonversi)) {
                    $id_data = $DataArrayKonversi['id_data'];
                    $id = $DataArrayKonversi['id'];
                    $kode_multi = $DataArrayKonversi['kode'];
                    $satuan_multi = $DataArrayKonversi['satuan'];
                    $konversiKonversi= $DataArrayKonversi['konversi'];
                    $barcodeArrayKonversi= $DataArrayKonversi['barcode'];
                    $harga_pokokArray= $DataArrayKonversi['harga_pokok'];
                    $stokBaru=$stok*$konversiKonversi;
                    //Buka data Harga
                    $QryHarga = mysqli_query($conn, "SELECT * FROM harga WHERE kode='$kode_multi' AND satuan='$satuan_multi' AND id like '%$IdDasarSolid%'")or die(mysqli_error($conn));
                    $DataHarga = mysqli_fetch_array($QryHarga);
                    $SatuanHarga= $DataHarga['satuan'];
                    $KodeHarga= $DataHarga['kode'];
                    if(!empty($DataHarga['harga_jual'])){
                        $harga_jual= $DataHarga['harga_jual'];
                    }else{
                        $harga_jual= $harga_2;
                    }
                    echo "Harga Jual : $harga_jual , ";
                    echo "id_obat : $id_obat , ";
                    echo "harga_pokokArray : $harga_pokokArray , ";
                    echo "Harga Jual : $harga_jual , ";
                    echo "satuan_multi : $satuan_multi , ";
                    echo "konversiKonversi : $konversiKonversi , ";
                    echo "stokBaru : $stokBaru , ";
                    echo "barcodeArrayKonversi : $barcodeArrayKonversi ";
                    if(empty($barcodeArrayKonversi)){
                        $barcodeArrayKonversi=$kode_multi;
                    }else{
                        $barcodeArrayKonversi=$barcodeArrayKonversi;
                    }
                    //Lakukan Input Data Ke Multi_Harga yang tidak sama
                    $InputDataMulti="INSERT INTO muti_harga (
                        id_barang,
                        harga1,
                        harga2,
                        harga3,
                        harga4,
                        satuan,
                        konversi,
                        stok,
                        barcode
                    ) VALUES (
                        '$id_obat',
                        '$harga_pokokArray',
                        '$harga_jual',
                        '$harga_jual',
                        '$harga_jual',
                        '$satuan_multi',
                        '$konversiKonversi',
                        '$stokBaru',
                        '$barcodeArrayKonversi'
                    )";
                    $ProsesInputHarga=mysqli_query($conn, $InputDataMulti);
                    if($ProsesInputHarga){
                        echo "$no Berhasil <br>";
                    }else{
                        echo "$no Gagal <br>";
                    }
                }
            }else{
                echo "Update data barang tahap pertama gagal <br>";
            }
        }else{
            echo "$no Kode Tidak Ditemukan";
        }
    $no++;
    }
?>