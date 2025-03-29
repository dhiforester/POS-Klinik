<script>
    $('#ProsesTampilkanLaporanAsset').submit(function(){ 
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        var ProsesTampilkanLaporanAsset=$('#ProsesTampilkanLaporanAsset').serialize();
        $('#KontenLaporan').html(Loading);
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/Laporan/TabelLaporanAsset.php',
            data 	:  ProsesTampilkanLaporanAsset,
            success : function(data){
                $('#KontenLaporan').html(data);
            }
        });
    });
</script>
<form action="javascript:void(0);" id="ProsesTampilkanLaporanAsset" autocomplete="off">
    <div class="form-group row">
        <div class="col col-md-3">
            <label>Mode Laporan</label>
            <select name="mode_laporan" id="mode_laporan" class="form-control border-dark" required>
                <option value="">Pilih</option>
                <option value="Item Barang">Item Barang</option>
                <option value="Kategori Barang">Kategori Barang</option>
            </select>
        </div>
        <div class="col col-md-3">
            <label>Short By</label>
            <select name="ShortBy" id="ShortBy" class="form-control border-dark">
                <option value="ASC">A to Z / 0-9</option>
                <option value="DESC">Z to A / 9-0</option>
            </select>
        </div>
        <div class="col col-md-3">
            <label>Standar Harga</label>
            <select name="harga" id="harga" class="form-control border-dark">
                <option value="harga_1">Harga Beli</option>
                <option value="harga_2">Harga Grosir</option>
                <option value="harga_3">Harga Toko</option>
                <option value="harga_4">Harga Eceran</option>
            </select>
        </div>
        <div class="col col-md-3">
            <label>Tampilkan Laporan</label><br>
            <button type="submit" class="btn btn-md btn-block btn-primary">
                <i class="mdi mdi-check-all"></i> Tampilkan
            </button>
        </div>
    </div>
</form>
