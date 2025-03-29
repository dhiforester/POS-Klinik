<script type="text/javascript">
    
</script>
<?php
    //error display
    ini_set("display_errors","off");
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    //Tangkap NewOrEdit
    if(empty($_POST['NewOrEdit'])){
        echo '<div class="row">';
        echo '  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">';
        echo '      <div class="card-body">';
        echo '          <div class="col col-lg-12">';
        echo '              Maaf Terjadi Kesalahan pada saat membuka halaman kasir. Silahkan hubungi admin aplikasi untuk melakukan perbaikan';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $NewOrEdit=$_POST['NewOrEdit'];
        //Apabila New
        if($NewOrEdit=="New"){
            //Title kasir
            $Title="Kasir";
            //Tangkap jenis transaksi
            if(empty($_POST['jenis_transaksi'])){
                $trans='penjualan';
            }else{
                $trans=$_POST['jenis_transaksi'];
            }
            //Buat kode transaksi
            $query_kode=mysqli_query($conn, "SELECT max(id_transaksi) as maksimal FROM transaksi WHERE jenis_transaksi='$trans'")or die(mysqli_error($conn));
            while($hasil_kode=mysqli_fetch_array($query_kode)){
                $nilai=$hasil_kode['maksimal'];
            }
            $kode_dasar=$nilai+1;
            $kode_dasar1=sprintf("%07d", $kode_dasar);
            if($trans=='penjualan'){$kode_trans='PNJL';}
            if($trans=='pembelian'){$kode_trans='PMBL';}
            $kode_transaksi="$kode_trans$SessionIdUser$kode_dasar1";
            //Hitung subtotal
            $QrySubtotal = mysqli_query($conn, "SELECT SUM(jumlah) as jumlah from rincian_transaksi WHERE kode_transaksi='$kode_transaksi'");
            $DataSubtotal = mysqli_fetch_array($QrySubtotal);
            $subtotal=$DataSubtotal['jumlah'];
            //Buka setting transaksi
            $QrySetting = mysqli_query($conn, "SELECT * FROM transaksi_setting WHERE trans='$trans'")or die(mysqli_error($conn));
            $DataSetting = mysqli_fetch_array($QrySetting);
            $ppn = $DataSetting['ppn'];
            $diskon = $DataSetting['diskon'];
            $biaya = $DataSetting['biaya'];
            //Menghitung Nilai RP
            $RpPpn=($subtotal*$ppn)/100;
            $RpDiskon=($subtotal*$diskon)/100;
            $RpBiaya=($subtotal*$biaya)/100;
            //Menghitung total tagihan
            $total_tagihan = ($subtotal+$RpPpn+$RpBiaya)-$RpDiskon;
            $pembayaran = $total_tagihan;
            $selisih = $total_tagihan-$pembayaran;
            if($selisih=="0"){
                $keterangan ="Lunas";
            }else{
                if($selisih<0){
                    $selisih=$selisih*-1;
                    $keterangan ="Utang";
                }else{
                    $keterangan ="Piutang";
                }
            }
            //Petugas berdasarkan session
            $petugas =$SessionUsername;
        }else{
            //Title menjadi detail transaksi
            $Title="Detail Transaksi";
            //Kode ditangkap dari parameter
            $kode_transaksi=$_POST['kode_transaksi'];
            //Buka rincian transaksi
            $QryTransaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'")or die(mysqli_error($conn));
            $DataTransaksi = mysqli_fetch_array($QryTransaksi);
            $trans=$DataTransaksi['jenis_transaksi'];
            $subtotal = $DataTransaksi['subtotal'];
            $RpPpn = $DataTransaksi['ppn'];
            $RpBiaya = $DataTransaksi['biaya'];
            $RpDiskon = $DataTransaksi['diskon'];
            $total_tagihan = $DataTransaksi['total_tagihan'];
            $pembayaran = $DataTransaksi['pembayaran'];
            if(!empty($DataTransaksi['pembayaran'])){
                $pembayaran = $DataTransaksi['pembayaran'];
            }else{
                $pembayaran = "0";
            }
            $selisih = $DataTransaksi['selisih'];
            $keterangan = $DataTransaksi['keterangan'];
            $petugas = $DataTransaksi['petugas'];
            //Menghitung Nilai RP
            $ppn=($RpPpn/$subtotal)*100;
            $diskon=($RpDiskon/$subtotal)*100;
            $biaya=($RpBiaya*$subtotal)*100;
        }
    }
    include "../../_Page/Kasir/KasirJs.php";
?>
<div class="row">
    <div class="col col-md-4 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary"><i class="menu-icon mdi mdi-play-circle-outline"></i> <?php echo $Title;?></h3>
                <small><b>Kode:</b> <?php echo $kode_transaksi;?></small><br>
                <small><b>Date Time:</b> <?php echo date('Y-m-d H:i:s'); ?></small><br>
            </div>
        </div>
    </div>
    <div class="col col-md-4 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="col col-lg-12 text-center">
                    <h4>JENIS TRANSAKSI :</h4>
                    <button title="Transaksi Penjualan" class="btn btn-sm <?php if($trans=="penjualan"){echo 'btn-info';}else{echo 'btn-outline-info';} ?> mt-2 mr-2" id="Penjualan">
                        PNJ
                    </button>
                    <button title="Transaksi Pembelian" class="btn btn-sm <?php if($trans=="pembelian"){echo 'btn-info';}else{echo 'btn-outline-info';} ?> mt-2 mr-2" id="Pembelian">
                        PMB
                    </button>
                    <button title="Transaksi Retur" class="btn btn-sm btn-outline-danger mt-2 mr-2" data-toggle="modal" data-target="#ModalPilihTransaksiRetur">
                        Ret
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-4 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h4>SUBTOTAL :</h4>
                <h2 class="text-danger"><?php echo "Rp " . number_format($subtotal,0,',','.');?></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-md-3 grid-margin stretch-card">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="card card-statistics bg-inverse-dark" id="AddRincianTransaksi" data-toggle="modal" data-target="#ModalTambahRincian" data-id="<?php echo "$NewOrEdit,$trans,$kode_transaksi";?>">
            <div class="card-body text-center">
                <i class="menu-icon mdi mdi-plus"></i> Add (F1)
            </div>
        </div>
    </div>
    <?php if($NewOrEdit=="New"){ ?>
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col col-md-3 grid-margin stretch-card">
            <div class="card card-statistics bg-inverse-dark" id="ScanBarang" data-toggle="modal" data-target="#ModalScan" data-id="<?php echo "$NewOrEdit,$trans,$kode_transaksi";?>">
                <div class="card-body text-center">
                    <i class="menu-icon mdi mdi-barcode-scan"></i> Scan (F2)
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if($NewOrEdit=="Edit"){ ?>
        <a href="_Page/Transaksi/CetakDetailTransaksi.php?kode_transaksi=<?php echo "$kode_transaksi";?>" id="PrintTransaksi" target="_blank" class="col col-md-3 grid-margin stretch-card">
            <div class="card card-statistics bg-inverse-dark" id="AddRincianTransaksi" data-toggle="modal" data-target="#ModalTambahRincian" data-id="<?php echo "$NewOrEdit,$trans,$kode_transaksi";?>">
                <div class="card-body text-center">
                    <i class="menu-icon mdi mdi-printer"></i> Print (F5)
                </div>
            </div>
        </a>
    <?php } ?>
    <div class="col col-md-3 grid-margin stretch-card">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'"  class="card card-statistics bg-inverse-dark" id="PengaturanDataTransaksi" data-toggle="modal" data-target="#ModalPengaturanKasir" data-id="<?php echo "$NewOrEdit,$trans,$kode_transaksi";?>">
            <div class="card-body text-center">
                <i class="menu-icon mdi mdi-settings"></i> Setup
            </div>
        </div>
    </div>
    <div class="col col-md-3 grid-margin stretch-card">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="card card-statistics bg-inverse-dark" id="SimpanTransaksi" data-toggle="modal" data-target="#ModalSettingKasir" data-id="<?php echo "$NewOrEdit,$trans,$kode_transaksi";?>">
            <div class="card-body text-center">
                <i class="menu-icon mdi mdi-floppy"></i> Save (F4)
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card ">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 grid-margin">
                        <div class="table-responsive" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-bordered scroll-container table-hover">
                                <thead class="thead-dark">
                                    <tr class="bg-dark">
                                        <th>No</th>
                                        <th>Nama/Merek</th>
                                        <th>QTY</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Option</th>
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
                                            //harga
                                            if(!empty($data['harga'])){
                                                $harga = $data['harga'];
                                            }else{
                                                $harga ="0";
                                            }
                                            //jumlah
                                            if(!empty($data['jumlah'])){
                                                $jumlah= $data['jumlah'];
                                            }else{
                                                $jumlah= "0";
                                            }
                                            //id_multi
                                            if(!empty($data['id_multi'])){
                                                $id_multi= $data['id_multi'];
                                            }else{
                                                $id_multi= "0";
                                            }
                                            //standar_harga
                                            if(!empty($data['standar_harga'])){
                                                $standar_harga= $data['standar_harga'];
                                            }else{
                                                $standar_harga= "0";
                                            }
                                            //Buka data Obat
                                            $QryObat = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
                                            $DataObat = mysqli_fetch_array($QryObat);
                                            //Apabila tidak menggunakan multi harga
                                            if(empty($id_multi)){
                                                $satuan = $DataObat['satuan'];
                                            }else{
                                                //Buka satuan berdasarkan id multi
                                                $QryMultiSatuan = mysqli_query($conn, "SELECT * FROM muti_harga WHERE id_multi='$id_multi'")or die(mysqli_error($conn));
                                                $DataMultiSatuan = mysqli_fetch_array($QryMultiSatuan);
                                                $satuan = $DataMultiSatuan['satuan'];
                                            }
                                            
                                    ?>
                                    <tr>
                                        <td><?php echo "$no";?></td>
                                        <td><?php echo "$nama";?></td>
                                        <td><?php echo "$qty $satuan";?></td>
                                        <td><?php echo "Rp " . number_format($harga,0,',','.');?></td>
                                        <td><?php echo "Rp " . number_format($jumlah,0,',','.');?></td>
                                        <td align="center" width="10%">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ModalEditRincian" data-id="<?php echo "$NewOrEdit,$id_rincian,$kode_transaksi,$trans";?>">
                                                    <i class="menu-icon mdi mdi-pencil" aria-hidden="true"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDeleteRincian" data-id="<?php echo "$NewOrEdit,$id_rincian,$kode_transaksi,$trans";?>">
                                                    <i class="menu-icon mdi mdi-delete" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                        $no++;} 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin bg-white">
                        <div class="form-group row">
                            <div class="form-input col col-md-3">
                                <label><b>SUBTOTAL</b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "Rp " . number_format($subtotal,0,',','.');?>">
                            </div>
                            <div class="form-input col col-md-3">
                                <label><b>PPN <?php echo "($ppn %)";?></b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "Rp " . number_format($RpPpn,0,',','.');?>" data-toggle="modal" data-target="#ModalPengaturanKasir" data-id="<?php echo "$NewOrEdit,$trans,$kode_transaksi";?>">
                            </div>
                            <div class="form-input col col-md-3">
                                <label><b>DISKON <?php echo "($diskon %)";?></b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "Rp " . number_format($RpDiskon,0,',','.');?>" data-toggle="modal" data-target="#ModalPengaturanKasir" data-id="<?php echo "$NewOrEdit,$trans,$kode_transaksi";?>">
                            </div>
                            <div class="form-input col col-md-3">
                                <label><b>TOTAL</b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "Rp " . number_format($total_tagihan,0,',','.');?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-input col col-md-3">
                                <label><b>PEMBAYARAN</b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "Rp " . number_format($pembayaran,0,',','.');?>">
                            </div>
                            <div class="form-input col col-md-3">
                                <label><b>SELISIH</b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "Rp " . number_format($selisih,0,',','.');?>">
                            </div>
                            <div class="form-input col col-md-3">
                                <label><b>KETERANGAN</b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "$keterangan";?>">
                            </div>
                            <div class="form-input col col-md-3">
                                <label><b>PETUGAS</b></label>
                                <input type="text" class="form-control border-warning" readonly value="<?php echo "$petugas";?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>