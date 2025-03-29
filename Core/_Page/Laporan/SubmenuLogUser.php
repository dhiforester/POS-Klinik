<script>
    $('#KategoriLaporan').change(function(){
        var KategoriLaporan=$('#KategoriLaporan').val();
        if(KategoriLaporan=="Harian"){
            $('#FormTanggal').load("_Page/Laporan/FormHarian.php");
        }
        if(KategoriLaporan=="Bulanan"){
            $('#FormTanggal').load("_Page/Laporan/FormBulanan.php");
        }
        if(KategoriLaporan=="Tahunan"){
            $('#FormTanggal').load("_Page/Laporan/FormTahunan.php");
        }
        if(KategoriLaporan=="Periode"){
            $('#FormTanggal').load("_Page/Laporan/FormPeriode.php");
        }
    });
    $('#mode_laporan').change(function(){ 
        $('#form_order_by').html("Loading...");
        var mode_laporan=$('#mode_laporan').val();
        if(mode_laporan=="Rekapitulasi"){
            $('#form_order_by').load("_Page/Laporan/form_order_rekap.php");
        }
        if(mode_laporan=="Uraian"){
            $('#form_order_by').load("_Page/Laporan/form_order_uraian.php");
        }
        if(mode_laporan==""){
            $('#form_order_by').load("_Page/Laporan/form_order_rekap.php");
        }
    });
    $('#ProsesTampilkanLaporanLogUser').submit(function(){ 
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        var ProsesTampilkanLaporanLogUser=$('#ProsesTampilkanLaporanLogUser').serialize();
        $('#KontenLaporan').html(Loading);
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/Laporan/TabelLaporanLogUser.php',
            data 	:  ProsesTampilkanLaporanLogUser,
            success : function(data){
                $('#KontenLaporan').html(data);
            }
        });
    });
</script>
<form action="javascript:void(0);" id="ProsesTampilkanLaporanLogUser">
    <div class="form-group row">
        <div class="col col-md-2">
            <label>Mode Laporan</label>
            <select name="mode_laporan" id="mode_laporan" class="form-control border-dark" required>
                <option value="">Pilih</option>
                <option value="Rekapitulasi">Rekapitulasi</option>
                <option value="Uraian">Uraian</option>
            </select>
        </div>
        <div class="col col-md-2">
            <label>Kategori Laporan</label>
            <select name="KategoriLaporan" id="KategoriLaporan" class="form-control border-dark">
                <option value="Harian">Harian</option>
                <option value="Bulanan">Bulanan</option>
                <option value="Tahunan">Tahunan</option>
                <option value="Periode">Periode</option>
            </select>
        </div>
        <div class="col col-md-2" id="form_order_by">
            <label>Transaksi</label>
            <select name="OrderBy" id="OrderBy" class="form-control border-dark">
                <option value="Penjualan">Penjualan</option>
                <option value="Pembelian">Pembelian</option>
            </select>
        </div>
        <div class="col col-md-2">
            <label>Short By</label>
            <select name="ShortBy" id="ShortBy" class="form-control border-dark">
                <option value="ASC">A to Z / 0-9</option>
                <option value="DESC">Z to A / 9-0</option>
            </select>
        </div>
        <div class="col col-md-4" id="FormTanggal">
            <div class="col col-md-12" id="FormTanggal">
                <label>Tanggal</label>
                <input type="date" class="form-control border-dark" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d');?>">
            </div>  
        </div>
    </div>
    <div class="row mt-3">
        <div class="col col-md-2">
            <button type="submit" class="btn btn-md btn-primary">
                <i class="mdi mdi-check-all"></i> Tampilkan
            </button>
        </div>
    </div>
</form>
