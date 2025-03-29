<script>
    $(document).ready(function(){
        $(document).on("keyup", function(event) {
            if (event.keyCode === 112) {
                document.getElementById("AddRincianTransaksi").click();
            }
            if (event.keyCode === 113) {
                document.getElementById("ScanBarang").click();
            }
            if (event.keyCode === 115) {
                document.getElementById("SimpanTransaksi").click();
            }
            if (event.keyCode === 116) {
                document.getElementById("PrintTransaksi").click();
            }
        });
        $('#Penjualan').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#Halaman').html(Loading);
            var jenis_transaksi="penjualan";
            var NewOrEdit="New";
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Kasir/Kasir.php',
                data 	:  { jenis_transaksi: jenis_transaksi, NewOrEdit: NewOrEdit, },
                success : function(data){
                    $('#Halaman').html(data);
                }
            });
        });
        $('#Pembelian').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#Halaman').html(Loading);
            var jenis_transaksi="pembelian";
            var NewOrEdit="New";
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Kasir/Kasir.php',
                data 	:  { jenis_transaksi: jenis_transaksi, NewOrEdit: NewOrEdit, },
                success : function(data){
                    $('#Halaman').html(data);
                }
            });
        });
    });
    //ketika Modal Tambah rincian muncul
    $('#ModalTambahRincian').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormTambahRincian').html(Loading);
        var DetailRincian = $(e.relatedTarget).data('id');
        var mode = DetailRincian.split(',');
        var NewOrEdit = mode[0];
        var trans = mode[1];
        var kode_transaksi = mode[2];
        $.ajax({
            url     : "_Page/Kasir/FormTambahRincian.php",
            method  : "POST",
            data    : { NewOrEdit: NewOrEdit, trans: trans, kode_transaksi: kode_transaksi },
            success: function (data) {
                $('#FormTambahRincian').html(data);
                //Mulai Pencarian
                $('#MulaiCariBarang').submit(function(){
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#TabelTambahRincian').html(Loading);
                    var JenisHarga=$('#JenisHarga').val();
                    var Keyword=$('#PencarianObat').val();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Kasir/TabelTambahRincian.php',
                        data    : { JenisHarga: JenisHarga, Keyword: Keyword, NewOrEdit: NewOrEdit,  trans: trans,  kode_transaksi: kode_transaksi },
                        success : function(data){
                            $('#TabelTambahRincian').html(data);
                        }
                    });
                });
            }
        })
    });
    $('#ModalPilihBarang').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormPilihBarang').html(Loading);
        var GetData = $(e.relatedTarget).data('id');
        var Pisah = GetData.split(',');
        var id_obat = Pisah[0];
        var StandarHarga = Pisah[1];
        var kode_transaksi = Pisah[2];
        var jenis_transaksi = Pisah[3];
        var NewOrEdit = Pisah[4];
        $.ajax({
            url     : "_Page/Kasir/FormPilihBarang.php",
            method  : "POST",
            data    : { StandarHarga: StandarHarga, jenis_transaksi: jenis_transaksi, NewOrEdit: NewOrEdit, id_obat: id_obat, kode_transaksi: kode_transaksi },
            success: function (data) {
                $('#FormPilihBarang').html(data);
                //Id_multi berubah
                $('#id_multi').change(function(){
                    var StandarHarga = $('#StandarHarga').val();
                    var IdBarang =$('#IdBarang').val();
                    var id_multi =$('#id_multi').val();
                    var JumlahQty = $('#JumlahQty').val();
                    if(id_multi==""){
                        if(StandarHarga=="harga_1"){
                            var harga=$('#FormGetHarga1').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga=="harga_2"){
                            var harga=$('#FormGetHarga2').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga=="harga_3"){
                            var harga=$('#FormGetHarga3').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga=="harga_4"){
                            var harga=$('#FormGetHarga4').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga==""){
                            var harga="0";
                            $('#IdHargaSekarang').val(harga);
                            $('#NilaiSubtotal').html("0");
                        }
                    }else{
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kasir/CariMultiHarga.php',
                            data 	: {StandarHarga: StandarHarga, IdBarang: IdBarang, id_multi: id_multi},
                            success : function(data){
                                //Hilangkan spasi dengan trim coy....
                                var hargaJadi=data.trim();
                                $('#IdHargaSekarang').val(hargaJadi);
                                var hargaJadiPar=parseInt(hargaJadi);
                                if(JumlahQty!==""){
                                    var Subtotal=JumlahQty*hargaJadiPar;
                                    $('#NilaiSubtotal').html(Subtotal);
                                }else{
                                    $('#NilaiSubtotal').html("0");
                                }
                            }
                        });
                    }
                });
                //Ketika standar harga Change
                $('#StandarHarga').change(function(){
                    var StandarHarga = $('#StandarHarga').val();
                    var IdBarang =$('#IdBarang').val();
                    var id_multi =$('#id_multi').val();
                    var JumlahQty = $('#JumlahQty').val();
                    if(id_multi==""){
                        if(StandarHarga=="harga_1"){
                            var harga=$('#FormGetHarga1').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga=="harga_2"){
                            var harga=$('#FormGetHarga2').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga=="harga_3"){
                            var harga=$('#FormGetHarga3').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga=="harga_4"){
                            var harga=$('#FormGetHarga4').val();
                            var harga = parseInt(harga);
                            var JumlahQtyPar = parseInt(JumlahQty);
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                            $('#IdHargaSekarang').val(harga);
                        }
                        if(StandarHarga==""){
                            var harga="0";
                            $('#IdHargaSekarang').val(harga);
                            $('#NilaiSubtotal').html("0");
                        }
                    }else{
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kasir/CariMultiHarga.php',
                            data 	: {StandarHarga: StandarHarga, IdBarang: IdBarang, id_multi: id_multi},
                            success : function(data){
                                //Hilangkan spasi dengan trim coy....
                                var hargaJadi=data.trim();
                                $('#IdHargaSekarang').val(hargaJadi);
                                var hargaJadiPar=parseInt(hargaJadi);
                                if(JumlahQty!==""){
                                    var Subtotal=JumlahQty*hargaJadiPar;
                                    $('#NilaiSubtotal').html(Subtotal);
                                }else{
                                    $('#NilaiSubtotal').html("0");
                                }
                            }
                        });
                    }
                });
                //Ketika Jumlah Qty Di ketik
                $('#JumlahQty').keyup(function(){
                    var JumlahQty = $('#JumlahQty').val();
                    var harga =$('#IdHargaSekarang').val();
                    var harga = parseInt(harga);
                    var JumlahQtyPar = parseInt(JumlahQty);
                    if(JumlahQty==""){
                        $('#NilaiSubtotal').val("Rp 0");
                    }else{
                        if(JumlahQty.match(/^\d+/)){
                            var Subtotal=JumlahQtyPar*harga;
                            $('#NilaiSubtotal').html(Subtotal);
                        }else{
                            $('#NilaiSubtotal').html("<i class='text-danger'>Maaf! Hanya Boleh Angka</i>");
                        }
                        
                    }
                });
                //Ketika Harga di rubah keyup
                $('#IdHargaSekarang').keyup(function(){
                    var JumlahQty = $('#JumlahQty').val();
                    var harga =$('#IdHargaSekarang').val();
                    var hargaPar = parseInt(harga);
                    var JumlahQtyPar = parseInt(JumlahQty);
                    if(JumlahQty==""){
                        $('#NilaiSubtotal').val("Rp 0");
                    }else{
                        if(harga.match(/^\d+/)){
                            var Subtotal=JumlahQtyPar*hargaPar;
                            $('#NilaiSubtotal').html(Subtotal);
                        }else{
                            $('#NilaiSubtotal').html("<i class='text-danger'>Maaf! Hanya Boleh Angka</i>");
                        }
                    }
                });
                //Tambah Rincian
                $('#ProsesPilihBarang').submit(function(){
                    var ProsesPilihBarang = $('#ProsesPilihBarang').serialize();
                    $('#TombolTambahkan').html('Loading..');
                    $.ajax({
                        url     : "_Page/Kasir/ProsesTambahRincian.php",
                        method  : "POST",
                        data    : ProsesPilihBarang,
                        success: function (data) {
                            $('#NotifikasiTambahRincian').html(data);
                            var NotifikasiTambahRincianBerhasil=$('#NotifikasiTambahRincianBerhasil').html();
                            if(NotifikasiTambahRincianBerhasil=="Ok"){
                                $('#ModalPilihBarang').modal('hide');
                                $('#ModalTambahRincian').modal('hide');
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Kasir/Kasir.php',
                                    data 	:  ProsesPilihBarang,
                                    success : function(data){
                                        $('#Halaman').html(data);
                                    }
                                });
                            }
                        }
                    })
                });
            }
        })
    });
    //ketika Modal Edit  rincian muncul
    $('#ModalEditRincian').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormEditRincian').html(Loading);
        var DetailRincian = $(e.relatedTarget).data('id');
        var mode = DetailRincian.split(',');
        var NewOrEdit = mode[0];
        var id_rincian = mode[1];
        var kode_transaksi = mode[2];
        var jenis_transaksi = mode[3];
        $.ajax({
            url     : "_Page/Kasir/FormEditRincian.php",
            method  : "POST",
            data    : { NewOrEdit: NewOrEdit, id_rincian: id_rincian, kode_transaksi: kode_transaksi, jenis_transaksi: jenis_transaksi },
            success: function (data) {
                $('#FormEditRincian').html(data);
                $('#qty').focus();
                $('#ProsesEditRincian').submit(function(){
                    $('#NotifikasiEditRincian').html('Loading...');
                    var ProsesEditRincian = $('#ProsesEditRincian').serialize();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Kasir/ProsesEditRincian.php',
                        data 	:  ProsesEditRincian,
                        success : function(data){
                            $('#NotifikasiEditRincian').html(data);
                            //menangkap keterangan notifikasi
                            var Notifikasi=$('#NotifikasiEditRincianBerhasil').html();
                            if(Notifikasi=="Berhasil"){
                                $('#ModalEditRincian').modal('hide');
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Kasir/Kasir.php',
                                    data 	:  { jenis_transaksi: jenis_transaksi, NewOrEdit: NewOrEdit, kode_transaksi: kode_transaksi, },
                                    success : function(data){
                                        $('#Halaman').html(data);
                                    }
                                });
                            }
                        }
                    });
                });
            }
        })
    });
    //ketika Modal delete  rincian muncul
    $('#ModalDeleteRincian').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormDeleteRincian').html(Loading);
        var DetailRincian = $(e.relatedTarget).data('id');
        var mode = DetailRincian.split(',');
        var NewOrEdit = mode[0];
        var id_rincian = mode[1];
        var kode_transaksi = mode[2];
        var jenis_transaksi = mode[3];
        $.ajax({
            url     : "_Page/Kasir/FormDeleteRincian.php",
            method  : "POST",
            data    : { NewOrEdit: NewOrEdit, id_rincian: id_rincian, kode_transaksi: kode_transaksi, jenis_transaksi: jenis_transaksi },
            success: function (data) {
                $('#FormDeleteRincian').html(data);
                $('#ProsesDeleteRincian').submit(function(){
                    $('#NotifikasiDeleteRincian').html('Loading...');
                    var ProsesDeleteRincian = $('#ProsesDeleteRincian').serialize();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Kasir/ProsesDeleteRincian.php',
                        data 	:  { id_rincian: id_rincian, NewOrEdit: NewOrEdit },
                        success : function(data){
                            $('#NotifikasiDeleteRincian').html(data);
                            //menangkap keterangan notifikasi
                            var Notifikasi=$('#NotifikasiDeleteRincianBerhasil').html();
                            if(Notifikasi=="Berhasil"){
                                $('#ModalDeleteRincian').modal('hide');
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Kasir/Kasir.php',
                                    data 	:  { jenis_transaksi: jenis_transaksi, NewOrEdit: NewOrEdit, kode_transaksi: kode_transaksi, },
                                    success : function(data){
                                        $('#Halaman').html(data);
                                    }
                                });
                            }
                        }
                    });
                });
            }
        })
    });
    //ketika Modal Scan  muncul
    $('#ModalScan').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormScan').html(Loading);
        var DetailScan = $(e.relatedTarget).data('id');
        var mode = DetailScan.split(',');
        var NewOrEdit = mode[0];
        var trans = mode[1];
        var kode_transaksi = mode[2];
        $.ajax({
            url     : "_Page/Kasir/FormScan.php",
            method  : "POST",
            data    : { NewOrEdit: NewOrEdit, trans: trans, kode_transaksi: kode_transaksi },
            success: function (data) {
                $('#FormScan').html(data);
                //Ketika proses submit
                $('#ProsesScanKasir').submit(function(){
                    $('#ScanTitle').html('Loading...');
                    //Tangkap data dari form
                    var ScanBarcode = $('#ScanBarcode').val();
                    var StandarHargaScan = $('#StandarHargaScan').val();
                    var id_multi = $('#id_multi_scan').val();
                    var quantitas = $('#quantitas').val();
                    var IdHargaScan = $('#IdHargaScan').val();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Kasir/ProsesScanKasir.php',
                        data    : { NewOrEdit: NewOrEdit, trans: trans, kode_transaksi: kode_transaksi, ScanBarcode: ScanBarcode, quantitas: quantitas, StandarHargaScan: StandarHargaScan, id_multi: id_multi, harga: IdHargaScan },
                        success : function(data){
                            $('#ScanTitle').html(data);
                            //menangkap keterangan notifikasi
                            var Notifikasi=$('#NotifikasiScanBerhasil').html();
                            var IdBarangKirim=$('#GetIdBarang').html();
                            var StandarHargaKirim=$('#GetStandarHarga').html();
                            if(Notifikasi=="Lanjut Scan"){
                                $('#ScanBarcode').val('');
                                $('#ScanLanjutan').html('');
                                $('#ScanBarcode').focus();
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Kasir/Kasir.php',
                                    data 	:  { jenis_transaksi: trans, NewOrEdit: NewOrEdit, kode_transaksi: kode_transaksi, },
                                    success : function(data){
                                        $('#Halaman').html(data);
                                    }
                                });
                            }
                            if(Notifikasi=="Multi Harga Ditemukan"){
                                $('#ScanBarcode').focus();
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Kasir/ScanLanjutan.php',
                                    data 	:  { IdBarang: IdBarangKirim, StandarHarga: StandarHargaKirim },
                                    success : function(data){
                                        $('#ScanLanjutan').html(data);
                                    }
                                });
                            }
                        }
                    });
                });
            }
        })
    });
    
    //ketika ModalSettingKasir  muncul
    $('#ModalSettingKasir').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormSettingKasir').html(Loading);
        var DetailScan = $(e.relatedTarget).data('id');
        var mode = DetailScan.split(',');
        var NewOrEdit = mode[0];
        var trans = mode[1];
        var kode_transaksi = mode[2];
        $.ajax({
            url     : "_Page/Kasir/FormSettingKasir.php",
            method  : "POST",
            data    : { NewOrEdit: NewOrEdit, trans: trans, kode_transaksi: kode_transaksi },
            success: function (data) {
                $('#FormSettingKasir').html(data);
                $('#JumlahUang').focus();
                $('#ProsesSettingTransaksi').submit(function(){
                    $('#NotifikasiSettingTransaksi').html('<i>Loading...</i>');
                    var ProsesSettingTransaksi = $('#ProsesSettingTransaksi').serialize();
                    var TampilkanKembalian = $('#TampilkanKembalian').html();
                    var JumlahUang = $('#JumlahUang').val();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Kasir/ProsesSettingTransaksi.php',
                        data    : ProsesSettingTransaksi,
                        success : function(data){
                            $('#NotifikasiSettingTransaksi').html(data);
                            //menangkap keterangan notifikasi
                            var Notifikasi=$('#NotifikasiSettingTransaksiBerhasil').html();
                            if(Notifikasi=="Berhasil"){
                                $('#FormSettingKasir').html(Loading);
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Kasir/DetailKasir.php',
                                    data 	:  { jenis_transaksi: trans, NewOrEdit: NewOrEdit, kode_transaksi: kode_transaksi, kembalian: TampilkanKembalian, JumlahUang: JumlahUang },
                                    success : function(data){
                                        $('#FormSettingKasir').html(data);
                                        $('#TampilkanKembalianTransaksi').html(TampilkanKembalian);
                                        var NewOrEdit="<?php echo "$NewOrEdit";?>";
                                        if(NewOrEdit=="New"){
                                            var kode_transaksi="";
                                        }else{
                                            var kode_transaksi="<?php echo $kode_transaksi;?>";
                                        }
                                        $.ajax({
                                            type 	: 'POST',
                                            url 	: '_Page/Kasir/Kasir.php',
                                            data    : { NewOrEdit: NewOrEdit, jenis_transaksi: trans, kode_transaksi: kode_transaksi },
                                            success : function(data){
                                                $('#Halaman').html(data);
                                            }
                                        });
                                    }
                                });
                                
                                $(document).on("keyup", function(event) {
                                    if (event.keyCode === 27) {
                                        $('#ModalSettingKasir').modal('hide');
                                    }
                                });

                            }
                        }
                    });
                });
            }
        })
    });

    //ketika Modal Pengaturan  muncul
    $('#ModalPengaturanKasir').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormPengaturanKasir').html(Loading);
        var DetailTransaksi = $(e.relatedTarget).data('id');
        var mode = DetailTransaksi.split(',');
        var NewOrEdit = mode[0];
        var trans = mode[1];
        var kode_transaksi = mode[2];
        $.ajax({
            url     : "_Page/Kasir/FormPengaturanKasir.php",
            method  : "POST",
            data    : { NewOrEdit: NewOrEdit, trans: trans, kode_transaksi: kode_transaksi },
            success: function (data) {
                $('#FormPengaturanKasir').html(data);
                $('#ProsesPengaturanKasir').submit(function(){
                    $('#NotifikasiPengaturanKasir').html('<i>Loading...</i>');
                    var ProsesPengaturanKasir = $('#ProsesPengaturanKasir').serialize();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Kasir/ProsesPengaturanKasir.php',
                        data    : ProsesPengaturanKasir,
                        success : function(data){
                            $('#NotifikasiPengaturanKasir').html(data);
                            //menangkap keterangan notifikasi
                            var Notifikasi=$('#NotifikasiPengaturanKasirBerhasil').html();
                            if(Notifikasi=="Berhasil"){
                                $('#ModalPengaturanKasir').modal('hide');
                                $.ajax({
                                    type 	: 'POST',
                                    url 	: '_Page/Kasir/Kasir.php',
                                    data 	:  { jenis_transaksi: trans, NewOrEdit: NewOrEdit, kode_transaksi: kode_transaksi, },
                                    success : function(data){
                                        $('#Halaman').html(data);
                                    }
                                });
                            }
                        }
                    });
                });
            }
        })
    });
    $('#ModalPilihTransaksiRetur').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#TablePilihTransaksiRetur').html(Loading);
        $('#TablePilihTransaksiRetur').load('_Page/Kasir/TablePilihTransaksiRetur.php');
    });   
</script>