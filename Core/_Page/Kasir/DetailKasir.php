<?php
    //koneksi dan error
    ini_set("display_errors","off");
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    $WaktuSekarang=date('Y-m-d H:i:s');
    $milliseconds = round(microtime(true) * 1000);
    $CekToken=mysqli_num_rows(mysqli_query($conn, "SELECT*FROM validasi_input WHERE token='$milliseconds'"));
    
    if(!empty($_POST['NewOrEdit'])){
        $NewOrEdit=$_POST['NewOrEdit'];
    }else{
        $NewOrEdit="";
    }

    if(!empty($_POST['kode_transaksi'])){
        $kode_transaksi=$_POST['kode_transaksi'];
    }else{
        $kode_transaksi="";
    }
    if(!empty($_POST['kembalian'])){
        $kembalian=$_POST['kembalian'];
    }else{
        $kembalian="0";
    }
    if(!empty($_POST['JumlahUang'])){
        $JumlahUang=$_POST['JumlahUang'];
    }else{
        $JumlahUang="0";
    }
    //Buka transaksi
    //Buka rincian transaksi
    $QryTransaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'")or die(mysqli_error($conn));
    $DataTransaksi = mysqli_fetch_array($QryTransaksi);
    $id_transaksi=$DataTransaksi['id_transaksi'];
    $id_akses=$DataTransaksi['id_akses'];
    $id_pasien=$DataTransaksi['id_pasien'];
    $id_kunjungan=$DataTransaksi['id_kunjungan'];
    $id_supplier=$DataTransaksi['id_supplier'];
    $tanggal=$DataTransaksi['tanggal'];
    $trans=$DataTransaksi['jenis_transaksi'];
    $subtotal = $DataTransaksi['subtotal'];
    $RpPpn = $DataTransaksi['ppn'];
    $RpBiaya = $DataTransaksi['biaya'];
    $RpDiskon = $DataTransaksi['diskon'];
    $total_tagihan = $DataTransaksi['total_tagihan'];
    $pembayaran = $DataTransaksi['pembayaran'];
    $selisih = $DataTransaksi['selisih'];
    $keterangan = $DataTransaksi['keterangan'];
    $petugas = $DataTransaksi['petugas'];
    //Buka nama member
    $QryMember = mysqli_query($conn, "SELECT * FROM member WHERE id_member='$id_supplier'")or die(mysqli_error($conn));
    $DataMember = mysqli_fetch_array($QryMember);
    $NamaMember=$DataMember['nama'];
    if(empty($DataMember['id_member'])){
        $NamaMember="Tidak Ada";
    }else{
        $NamaMember=$DataMember['nama'];
    }
    //Buka data kunjungan
    $QryKunjungan = mysqli_query($conn, "SELECT * FROM kunjungan WHERE id_kunjungan='$id_kunjungan'")or die(mysqli_error($conn));
    $DataKunjungan = mysqli_fetch_array($QryKunjungan);
    if(empty($DataKunjungan['nama'])){
        $nama_pasien="Tidak Ada";
        $id_pasien="Tidak Ada";
    }else{
        $nama_pasien=$DataKunjungan['nama'];
        $id_pasien=$DataKunjungan['id_pasien'];
    }
    
?>
<script>
    $(document).on("keyup", function(event) {
        if (event.keyCode === 119) {
            var kode_transaksi="<?php echo $kode_transaksi;?>";
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Transaksi/CetakDetailTransaksiDirect.php',
                data 	: { kode_transaksi: kode_transaksi  },
                success : function(data){
                    alert("Proses print sedang berlangsung");
                }
            });
        }
    });
    $('#CetakNotaDirect').click(function(){
        var kode_transaksi="<?php echo $kode_transaksi;?>";
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/Transaksi/CetakDetailTransaksiDirect.php',
            data 	: { kode_transaksi: kode_transaksi  },
            success : function(data){
                alert("Proses print sedang berlangsung");
            }
        });
    });
</script>
<div class="modal-body bg-white">
    <div class="row">
        <div class="col-md-6">
            <small>
                <table width="100%">
                    <tr>
                        <td><b>Kode</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$kode_transaksi";?></td>
                        <td><b>Petugas</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$petugas";?></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$tanggal";?></td>
                        <td><b>Transaksi</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$trans";?></td>
                    </tr>
                    <tr>
                        <td><b>Pasien</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$nama_pasien ($id_pasien)";?></td>
                        <td><b>Supplier</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$NamaMember";?></td>
                    </tr>
                </table>
            </small>
        </div>
        <div class="col-md-6 text-right">
            <h1 class="text-danger"> KEMBALIAN : <br><b id="TampilkanKembalianTransaksi"></br></h1>
        </div>
    </div>
</div>
<div class="modal-body bg-white">
    <div class="row">
        <div class="col-md-12" style="height: 350px; overflow-y: scroll;">
            <small>
                <div class="table-responsive">
                    <table class="table table-bordered scroll-container">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama/Merek</th>
                                <th>QTY</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT*FROM rincian_transaksi WHERE kode_transaksi='$kode_transaksi' ORDER BY id_rincian DESC");
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_rincian = $data['id_rincian'];
                                    $id_obat = $data['id_obat'];
                                    $nama = $data['nama'];
                                    $qty= $data['qty'];
                                    $harga = $data['harga'];
                                    $jumlah= $data['jumlah'];
                                    $id_multi= $data['id_multi'];
                                    //Buka Satuan
                                   
                                    if(empty($id_multi)){
                                        $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                                        $DataObat = mysqli_fetch_array($QryObat);
                                        $satuan = $DataObat['satuan'];
                                    }else{
                                        $QryObat = mysqli_query($conn, "SELECT * FROM muti_harga WHERE id_multi='$id_multi'")or die(mysqli_error($conn));
                                        $DataObat = mysqli_fetch_array($QryObat);
                                        $satuan = $DataObat['satuan'];
                                    }
                                    
                            ?>
                            <tr>
                                <td><?php echo "$no";?></td>
                                <td><?php echo "$nama";?></td>
                                <td><?php echo "$qty $satuan";?></td>
                                <td align="right"><?php echo "Rp " . number_format($harga,0,',','.');?></td>
                                <td align="right"><?php echo "Rp " . number_format($jumlah,0,',','.');?></td>
                            </tr>
                            <?php 
                                $no++;} 
                            ?>
                            <tr>
                                <td colspan="4" align="right">SUBTOTAL</td>
                                <td align="right"><?php echo "Rp " . number_format($subtotal,0,',','.');?></td>
                            </tr>
                            <?php if(!empty($RpPpn)){ ?>
                                <tr>
                                    <td colspan="4" align="right">PPN <?php echo "($ppn %)";?></td>
                                    <td align="right"><?php echo "Rp " . number_format($RpPpn,0,',','.');?></td>
                                </tr>
                            <?php }if(!empty($RpDiskon)){ ?>
                                <tr>
                                    <td colspan="4" align="right">DISKON <?php echo "($diskon %)";?></td>
                                    <td align="right"><?php echo "Rp " . number_format($RpDiskon,0,',','.');?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" align="right">TOTAL</td>
                                <td align="right"><?php echo "Rp " . number_format($total_tagihan,0,',','.');?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">PEMBAYARAN</td>
                                <td align="right"><?php echo "Rp " . number_format($pembayaran,0,',','.');?></td>
                            </tr>
                            <?php if(!empty($selisih)){ ?>
                                <tr>
                                    <td colspan="4" align="right">SELISIH</td>
                                    <td align="right"><?php echo "Rp " . number_format($selisih,0,',','.');?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" align="right">KETERANGAN</td>
                                <td align="right"><?php echo "$keterangan";?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">UANG</td>
                                <td align="right"><?php echo "Rp " . number_format($JumlahUang,0,',','.');?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">KEMBALIAN</td>
                                <td align="right"><?php echo "Rp " . number_format($JumlahUang-$total_tagihan,0,',','.');?></td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right">
                                    <?php
                                        //Hitung kembalian
                                        $HitungKembalian=$JumlahUang-$total_tagihan;
                                        //Ciptakan Token Apakah Sudah Ada
                                        if(empty($CekToken)){
                                            //input token
                                            $entryToken="INSERT INTO validasi_input (
                                                waktu,
                                                token
                                            ) VALUES (
                                                '$WaktuSekarang',
                                                '$milliseconds'
                                            )";
                                            $hasilToken=mysqli_query($conn, $entryToken);
                                            if($hasilToken){
                                                //Hapus Data Kembalian Barangkali sudah ada
                                                $HapusDataKembalianSebelumnya = mysqli_query($conn, "DELETE FROM transaksi_kembalian WHERE id_transaksi='$id_transaksi'") or die(mysqli_error($conn));    
                                                if($HapusDataKembalianSebelumnya){
                                                    //Input Data Kembalian
                                                    $EntryKembalian="INSERT INTO transaksi_kembalian (
                                                        id_transaksi,
                                                        kode,
                                                        tagihan,
                                                        uang,
                                                        kembalian
                                                    ) VALUES (
                                                        '$id_transaksi',
                                                        '$kode_transaksi',
                                                        '$total_tagihan',
                                                        '$JumlahUang',
                                                        '$HitungKembalian'
                                                    )";
                                                    $HasilInputKembalian=mysqli_query($conn, $EntryKembalian);
                                                    if($HasilInputKembalian){
                                                        echo "Update Data Kembalian Berhasil";
                                                    }else{
                                                        echo "Update Data Kembalian Gagal<br>";
                                                        echo "Nilai uang dan kembalian mungkin tidak akan muncul pada lembar Nota<br>";
                                                    }
                                                }else{
                                                    echo "Gagal hapus data kembalian sebelumnya!";
                                                }
                                            }else{
                                                echo "Token Tidak Bisa Di Input";
                                            }
                                        }else{
                                            echo "Mungkin koneksi perangkat anda tidak dalam keadaan stabil";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </small>
        </div>
    </div>
</div>
<div class="modal-footer bg-dark">
    <div class="row">
        <div class="form-group col-md-12 text-center">
            <button type="button" id="CetakNotaDirect" class="btn btn-lg btn-rounded btn-warning" value="<?php echo "$kode_transaksi";?>">
                Cetak Direct(F8)
            </button>
            <a href="_Page/Transaksi/CetakDetailTransaksi.php?kode_transaksi=<?php echo "$kode_transaksi";?>" target="_blank" id="CetakNota" class="btn btn-lg btn-rounded btn-primary">
                Preview HTML
            </a>
            <a href="_Page/Transaksi/CetakDetailTransaksiPdf.php?kode_transaksi=<?php echo "$kode_transaksi";?>" target="_blank" id="CetakNota" class="btn btn-lg btn-rounded btn-primary">
                Print PDF
            </a>
        </div>
    </div>
</div>
