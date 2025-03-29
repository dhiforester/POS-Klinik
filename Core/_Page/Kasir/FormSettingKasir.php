<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Tangkap parameter NewOrEdit
    if(!empty($_POST['NewOrEdit'])){
        $NewOrEdit=$_POST['NewOrEdit'];
    }else{
        $NewOrEdit="New";
    }
    //Tangkap parameter trans
    if(!empty($_POST['trans'])){
        $trans=$_POST['trans'];
    }else{
        $trans="penjualan";
    }
    //Buka setting aplikasi
    //Buka data setting
    $QrySettingAplikasi = mysqli_query($conn, "SELECT * FROM setting_aplikasi")or die(mysqli_error($conn));
    $DataSettingAplikasi = mysqli_fetch_array($QrySettingAplikasi);
    $aktif_promo=$DataSettingAplikasi['aktif_promo'];
    $jumlah_point=$DataSettingAplikasi['jumlah_point'];
    $kelipatan_belanja=$DataSettingAplikasi['kelipatan_belanja'];

    //Tangkap parameter kode_transaksi
    if(empty($_POST['kode_transaksi'])){
        echo'<div class="modal-body">';
        echo'    <div class="card card-statistics">';
        echo'        <div class="card-body">';
        echo'            <div class="row">';
        echo'                <div class="col-md-12 text-center">';
        echo'                    <b class="text-danger">Maaf Kode Transaksi Tidak Boleh Kosong!!</b>';
        echo'                </div>';
        echo'            </div>';
        echo'        </div>';
        echo'    </div>';
        echo'</div>';
    }else{
        $kode_transaksi=$_POST['kode_transaksi'];
        //Buka Data Setting Yang Sudah Ada Berdasarkan NewOrEdit
        //Apabila Data Kasir Baru Buka Setting Dari Database
        if($NewOrEdit=="New"){
            //Buka data setting
            $QrySetting = mysqli_query($conn, "SELECT * FROM transaksi_setting WHERE trans='$trans'")or die(mysqli_error($conn));
            $DataSetting = mysqli_fetch_array($QrySetting);
            $ppn=$DataSetting['ppn'];
            if(empty($DataSetting['ppn'])){
                $ppn="0";
            }else{
                $ppn=$DataSetting['ppn'];
            }
            if(empty($DataSetting['diskon'])){
                $diskon="0";
            }else{
                $diskon=$DataSetting['diskon'];
            }
            if(empty($DataSetting['biaya'])){
                $biaya="0";
            }else{
                $biaya=$DataSetting['biaya'];
            }
            if(empty($DataSetting['standar_harga'])){
                $standar_harga="0";
            }else{
                $standar_harga=$DataSetting['standar_harga'];
            }
            //Menghitung Subtotal
            //Hitung subtotal
            $QrySubtotal = mysqli_query($conn, "SELECT SUM(jumlah) as jumlah from rincian_transaksi WHERE kode_transaksi='$kode_transaksi'");
            $DataSubtotal = mysqli_fetch_array($QrySubtotal);
            if(empty($DataSubtotal['jumlah'])){
                $subtotal="0";
            }else{
                $subtotal=$DataSubtotal['jumlah'];
            }
            //Menghitung Nilai RP
            $RpPPN=($subtotal*$ppn)/100;
            $RpDiskon=($subtotal*$diskon)/100;
            $RpBiaya=($subtotal*$biaya)/100;
            //Menghitung total tagihan
            $total_tagihan = ($subtotal+$RpPPN)-$RpDiskon;
            $pembayaran = $total_tagihan;
            $selisih ="0";
            $keterangan="Lunas";
            $tanggal=date('Y-m-d H:i:s');
            $pembayaran=round($pembayaran, 0);
            $total_tagihan=round($total_tagihan, 0);
            //Variabel Pemberian Point
            $id_pemberian_point="";
            $TanggalPemberianPoint="";
            $IdMemberYangDiberikan="";
            $PointYangDiberikan="";
        }else{
            //Apabila Edit maka buka dari transaksi berdasarkan kode transaksi
            $QryTransaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'")or die(mysqli_error($conn));
            $DataTransaksi = mysqli_fetch_array($QryTransaksi);
            $tanggal=$DataTransaksi['tanggal'];
            $RpPPN=$DataTransaksi['ppn'];
            $RpDiskon=$DataTransaksi['diskon'];
            $RpBiaya=$DataTransaksi['biaya'];
            $subtotal=$DataTransaksi['subtotal'];
            $total_tagihan=$DataTransaksi['total_tagihan'];
            $pembayaran=$DataTransaksi['pembayaran'];
            $selisih=$DataTransaksi['selisih'];
            $keterangan=$DataTransaksi['keterangan'];
            //Hitung Persen PPN
            $ppn=($RpPPN/$subtotal)*100;
            $ppn=round($ppn, 2);
            //Hitung Persen Diskon
            $diskon=($RpDiskon/$subtotal)*100;
            $diskon=round($diskon ,2);
            //Hitung Persen Baiaya
            $biaya=($RpBiaya/$subtotal)*100;
            $biaya=round($biaya, 2);
            $standar_harga="harga_1";
            //Buka histori pemberian point untuk transaksi ini
            $QryPemberianPoint = mysqli_query($conn, "SELECT * FROM pemberian_point WHERE kode_transaksi='$kode_transaksi'")or die(mysqli_error($conn));
            $DataPemberianPoint = mysqli_fetch_array($QryPemberianPoint);
            if(!empty($DataPemberianPoint['id_pemberian_point'])){
                $id_pemberian_point=$DataPemberianPoint['id_pemberian_point'];
                $TanggalPemberianPoint=$DataPemberianPoint['tanggal'];
                $IdMemberYangDiberikan=$DataPemberianPoint['id_member'];
                $PointYangDiberikan=$DataPemberianPoint['point'];
                //Buka data member Yang memperoleh point
                $QryMemberIni = mysqli_query($conn, "SELECT * FROM member WHERE id_member='$IdMemberYangDiberikan'")or die(mysqli_error($conn));
                $DataMemberIni = mysqli_fetch_array($QryMemberIni);
                $NikMemberIni=$DataMemberIni['nik'];
                $NamaMemberIni=$DataMemberIni['nama'];
                $PointMemberIni=$DataMemberIni['point'];
            }else{
                $id_pemberian_point="";
                $TanggalPemberianPoint="";
                $IdMemberYangDiberikan="";
                $PointYangDiberikan="";
            }
            //Buka supplier untuk transaksi ini
            $QrySupplier = mysqli_query($conn, "SELECT * FROM transaksi_supplier WHERE kode_transaksi='$kode_transaksi'")or die(mysqli_error($conn));
            $DataSupplier = mysqli_fetch_array($QrySupplier);
            if(!empty($DataSupplier['id_transaksi_supplier'])){
                $id_pemberian_point=$DataSupplier['id_pemberian_point'];
                $IdSupplier=$DataSupplier['id_member'];
                $NamaSupplier=$DataSupplier['nama'];
                //Buka data Supplier
                $QrySupplier2 = mysqli_query($conn, "SELECT * FROM member WHERE id_member='$IdSupplier'")or die(mysqli_error($conn));
                $DataSupplier2 = mysqli_fetch_array($QrySupplier2);
                $NikSupplier=$DataSupplier2['nik'];
                $NamaSupplier2=$DataSupplier2['nama'];
            }else{
                $id_pemberian_point="";
                $IdSupplier="";
                $NamaSupplier="";
            }
            
        }
    }
?>
<script>
    $('#ppn').keyup(function(){
        var jenis_transaksi = $('#jenis_transaksi').val();
        var ppn = $('#ppn').val();
        var ppn = parseInt(ppn);
        var subtotal = $('#subtotal').val();
        var subtotal = parseInt(subtotal);
        var RpDiskon = $('#RpDiskon').val();
        var RpDiskon = parseInt(RpDiskon);
        var pembayaran = $('#pembayaran').val();
        var pembayaran = parseInt(pembayaran);
        var RpPPN=(ppn*subtotal)/100;
        var total=(subtotal+RpPPN)-RpDiskon;
        var selisih=total-pembayaran;
        if(jenis_transaksi=="penjualan"){
            if(selisih=="0"){
                var keterangan="Lunas";
            }else{
                if(selisih<0){
                    var selisih=selisih*-1;
                    var keterangan="Utang";
                }else{
                    var keterangan="Piutang";
                }
            }
            
        }else{
            if(selisih=="0"){
                var keterangan="Lunas";
            }else{
                if(selisih<0){
                    var selisih=selisih*-1;
                    var keterangan="Piutang";
                }else{
                    var keterangan="Utang";
                }
            }
        }


        $('#RpPPN').val(RpPPN);
        $('#total').val(total);
        $('#selisih').val(selisih);
        $('#keterangan').val(keterangan);
    });
    $('#RpPPN').keyup(function(){
        var jenis_transaksi = $('#jenis_transaksi').val();
        var RpPPN = $('#RpPPN').val();
        var RpPPN = parseInt(RpPPN);
        var subtotal = $('#subtotal').val();
        var subtotal = parseInt(subtotal);
        var RpDiskon = $('#RpDiskon').val();
        var RpDiskon = parseInt(RpDiskon);
        var pembayaran = $('#pembayaran').val();
        var pembayaran = parseInt(pembayaran);
        var ppn=(RpPPN/subtotal)*100;
        var total=(subtotal+RpPPN)-RpDiskon;
        var selisih=total-pembayaran;
        if(jenis_transaksi=="penjualan"){
            if(selisih=="0"){
                var keterangan="Lunas";
            }else{
                if(selisih<0){
                    var selisih=selisih*-1;
                    var keterangan="Utang";
                }else{
                    var keterangan="Piutang";
                }
            }
            
        }else{
            if(selisih=="0"){
                var keterangan="Lunas";
            }else{
                if(selisih<0){
                    var selisih=selisih*-1;
                    var keterangan="Piutang";
                }else{
                    var keterangan="Utang";
                }
            }
        }
        $('#ppn').val(ppn);
        $('#total').val(total);
        $('#selisih').val(selisih);
        $('#keterangan').val(keterangan);
    });
    $('#JumlahUang').keyup(function(){
        var JumlahUang = $('#JumlahUang').val();
        var validasiAngka = /^[0-9]+$/;
        if(JumlahUang.match(validasiAngka)) {
            var total = $('#total').val();
            var selisih=JumlahUang-total;
            //Buat Format Rupiah Untuk Jumlah Uang
            var	reverse = JumlahUang.toString().split('').reverse().join(''),
            RpJumlahUang    = reverse.match(/\d{1,3}/g);
            RpJumlahUang    = RpJumlahUang.join('.').split('').reverse().join('');
            //Buat Format Rupiah Untuk Selisih
            var	reverse2 = selisih.toString().split('').reverse().join(''),
            RpSelisih    = reverse2.match(/\d{1,3}/g);
            RpSelisih    = RpSelisih.join('.').split('').reverse().join('');
            //Apabila Nilai Sisa Sama dengan Nol atau Bukan
            if(selisih=="0"){
                $('#TampilkanJumlahUang').html(RpJumlahUang);
                $('#TampilkanKembalian').html("0");
            }else{
                if(selisih<0){
                    $('#TampilkanJumlahUang').html(RpJumlahUang);
                    $('#TampilkanKembalian').html("0");
                }else{
                    $('#TampilkanJumlahUang').html(RpJumlahUang);
                    $('#TampilkanKembalian').html(RpSelisih);
                }
            }
        }else{
            $('#TampilkanJumlahUang').html("<b class='text-danger'>Error!!</b>");
        }
    });
    $('#pembayaran').keyup(function(){
        var jenis_transaksi = $('#jenis_transaksi').val();
        var ppn = $('#ppn').val();
        var ppn = parseInt(ppn);
        var RpPPN = $('#RpPPN').val();
        var RpPPN = parseInt(RpPPN);
        var subtotal = $('#subtotal').val();
        var subtotal = parseInt(subtotal);
        var diskon = $('#diskon').val();
        var diskon = parseInt(diskon);
        var RpDiskon = $('#RpDiskon').val();
        var RpDiskon = parseInt(RpDiskon);
        var pembayaran = $('#pembayaran').val();
        var pembayaran = parseInt(pembayaran);
        var total = $('#total').val();
        var total = parseInt(total);
        var selisih=total-pembayaran;
        if(jenis_transaksi=="penjualan"){
            if(selisih=="0"){
                var keterangan="Lunas";
            }else{
                if(selisih<0){
                    var selisih=selisih*-1;
                    var keterangan="Utang";
                }else{
                    var keterangan="Piutang";
                }
            }
        }else{
            if(selisih=="0"){
                var keterangan="Lunas";
            }else{
                if(selisih<0){
                    var selisih=selisih*-1;
                    var keterangan="Piutang";
                }else{
                    var keterangan="Utang";
                }
            }
        }
        $('#selisih').val(selisih);
        $('#keterangan').val(keterangan);
    });
    $('#MetodePembayaran').change(function(){
        var MetodePembayaran = $('#MetodePembayaran').val();
        if(MetodePembayaran=="Kontan"){
            document.getElementById("pembayaran").setAttribute("readonly",true);
        }else{
            document.getElementById("pembayaran").removeAttribute("readonly");
        }
    });
    $('#TabelPilihPasien').load('_Page/Kasir/TabelPilihPasien.php');
    $('#keyword_pasien').keyup(function(){
        var keyword = $('#keyword_pasien').val();
        $.ajax({
            url     : "_Page/Kasir/TabelPilihPasien.php",
            method  : "POST",
            data    : { keyword: keyword },
            success: function (data) {
                $('#TabelPilihPasien').html(data);
            }
        })
    });
    $('#ClickCariPasien').click(function(){
        var keyword = $('#keyword_pasien').val();
        $.ajax({
            url     : "_Page/Kasir/TabelPilihPasien.php",
            method  : "POST",
            data    : { keyword: keyword },
            success: function (data) {
                $('#TabelPilihPasien').html(data);
            }
        })
    });
    $('#TabelPilihSupplier').load('_Page/Kasir/TabelPilihSupplier.php');
    $('#keyword_supplier').keyup(function(){
        var keyword = $('#keyword_supplier').val();
        $.ajax({
            url     : "_Page/Kasir/TabelPilihSupplier.php",
            method  : "POST",
            data    : { keyword: keyword },
            success: function (data) {
                $('#TabelPilihSupplier').html(data);
            }
        })
    });
    $('#ClickCariSupplier').click(function(){
        var keyword = $('#keyword_supplier').val();
        $.ajax({
            url     : "_Page/Kasir/TabelPilihSupplier.php",
            method  : "POST",
            data    : { keyword: keyword },
            success: function (data) {
                $('#TabelPilihSupplier').html(data);
            }
        })
    });
</script>
<form action="javascript:void(0);" id="ProsesSettingTransaksi">
    <script>
        $('#ModalSettingKasir').on('shown.bs.modal', function() {
            $('#JumlahUang').focus();
        });
    </script>
    <input type="hidden" name="NewOrEdit" id="NewOrEdit" value="<?php echo $NewOrEdit;?>">
    <input type="hidden" name="kode_transaksi" id="kode_transaksi" value="<?php echo $kode_transaksi;?>">
    <input type="hidden" name="jenis_transaksi" id="jenis_transaksi" value="<?php echo $trans;?>">
    <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $tanggal;?>">
    <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $subtotal;?>">
    <input type="hidden" name="total" id="total" value="<?php echo $total_tagihan;?>">
    <input type="hidden" name="ppn" id="ppn" value="<?php echo $ppn;?>">
    <input type="hidden" name="RpPPN" id="RpPPN" value="<?php echo $RpPPN;?>">
    <input type="hidden" name="diskon" id="diskon" value="<?php echo $diskon;?>">
    <input type="hidden" name="RpDiskon" id="RpDiskon" value="<?php echo $RpDiskon;?>">
    <div class="modal-body bg-light bordered">
        <div class="form-group row">
            <label class="col-sm-6 col-form-label">
                <table width="100%">
                    <tr>
                        <td><b>Kode</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$kode_transaksi";?></td>
                    </tr>
                    <tr>
                        <td><b>Transaksi</b></td>
                        <td><b>:</b></td>
                        <td></b><?php echo "$trans";?></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td><b>:</b></td>
                        <td></b><?php echo "$tanggal";?></td>
                    </tr>
                    <tr>
                        <td><b>Subtotal</b></td>
                        <td><b>:</b></td>
                        <td></b><?php echo "Rp " . number_format($subtotal,0,',','.');?></td>
                    </tr>
                    <tr>
                        <td><b>PPN</b></td>
                        <td><b>:</b></td>
                        <td></b><?php echo "Rp " . number_format($RpPPN,0,',','.');?></td>
                    </tr>
                    <tr>
                        <td><b>Diskon</b></td>
                        <td><b>:</b></td>
                        <td></b><?php echo "Rp " . number_format($RpDiskon,0,',','.');?></td>
                    </tr>
                </table>
            </label>
            <input type="hidden" name="TambahPointMember" id="TambahPointMember" value="">
            <h1 class="col-sm-6">
                <table>
                    <tr>
                        <td><b>TOTAL</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "Rp " . number_format($total_tagihan,0,',','.');?></td>
                    </tr>
                    <tr>
                        <td><b>UANG</b></td>
                        <td><b>:</b></td>
                        <td><b>Rp</b> <b id="TampilkanJumlahUang">0</b></td>
                    </tr>
                    <tr class="text-primary">
                        <td><b>KEMBALIAN</b></td>
                        <td><b>:</b></td>
                        <td id="TampilkanKembalian"><b>Rp</b> <b>0</b></td>
                    </tr>
                </table>
            </h1>
        </div>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4 mt-3">
                <label for="JumlahUang">Jumlah Uang</label>
                <input type="text" name="uang" id="JumlahUang" class="form-control border-dark" value="">
            </div>
            <div class="col-md-4 mt-3">
                <label for="MetodePembayaran">Metode Pembayaran</label>
                <select name="MetodePembayaran" id="MetodePembayaran" class="form-control border-dark">
                    <option value="Kontan">Kontan</option>
                    <option value="Utang_Piutang">Utang/Piutang</option>
                </select>
            </div>
            <div class="col-md-4 mt-3">
                <label for="pembayaran">Nominal Pembayaran</label>
                <input type="text"  readonly name="pembayaran" id="pembayaran" class="form-control border-dark" value="<?php echo $pembayaran;?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-3">
                <label for="selisih">Selisih</label>
                <input type="text" readonly name="selisih" id="selisih" class="form-control border-dark" value="<?php echo $selisih;?>">
            </div>
            <div class="col-md-4 mt-3">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control border-dark" value="<?php echo $keterangan;?>">
            </div>
            <div class="col-md-4 mt-3">
                <label for="UpdateHarga">Update Harga</label>
                <select name="UpdateHarga" id="UpdateHarga" class="form-control border-dark">
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-body bg-inverse-secondary">
        <div class="row mb-3">
            <div class="col-md-8">Kunjungan Pasien</div>
            <div class="input-group col-md-4">
                <input type="text" name="keyword_pasien" id="keyword_pasien" class="form-control border-primary">
                <button type="button" class="btn btn-md btn-inverse-primary" id="ClickCariPasien">
                    Cari
                </button>
            </div>
        </div>
        <div id="TabelPilihPasien">

        </div>
    </div>
    <div class="modal-body bg-inverse-secondary">
        <div class="row mb-3">
            <div class="col-md-8">Pilih Supplier</div>
            <div class="input-group col-md-4">
                <input type="text" name="keyword_supplier" id="keyword_supplier" class="form-control border-primary">
                <button type="button" class="btn btn-md btn-inverse-primary" id="ClickCariSupplier">
                    Cari
                </button>
            </div>
        </div>
        <div id="TabelPilihSupplier">

        </div>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 mt-3 text-center">
                <small id="NotifikasiSettingTransaksi" class="text-primary">Pastikan Data Transaksi Sudah Benar</small>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-primary">
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="reset" class="btn btn-lg btn-rounded btn-warning mt-2 mr-2 mb-2">
                    <i class="mdi mdi-undo"></i> Reset
                </button>
                <button type="submit" class="btn btn-lg btn-rounded btn-dark mt-2 mr-2 mb-2">
                    <i class="mdi mdi-floppy"></i> Simpan
                </button>
                <button class="btn btn-rounded btn-lg btn-danger mt-2 mr-2 mb-2" data-dismiss="modal">
                    <i class="mdi mdi-close"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</form>