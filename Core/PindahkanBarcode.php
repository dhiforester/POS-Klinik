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
        if($barcode!==""){
            $UpdateObat = mysqli_query($conn, "UPDATE obat SET 
            kode='$barcode',
            stok='9999'
            WHERE id_obat='$id_obat'") or die(mysqli_error($conn)); 
            if($UpdateObat){
                if($NamaKategori==""){
                    $UpdateObat = mysqli_query($conn, "UPDATE obat SET kategori='Lainnya' WHERE id_obat='$id_obat'") or die(mysqli_error($conn)); 
                    if($UpdateObat){
                        echo "$no . Update Berhasil<br>";
                    }else{
                        echo "$no . Update Tahap 2 Gagal<br>";
                    }
                }
            }else{
                echo "$no . Update Tahap 1 Gagal<br>";
            }
        }else{
            echo "$no . Barcode Kosong<br>";
        }
    $no++;
    }
?>