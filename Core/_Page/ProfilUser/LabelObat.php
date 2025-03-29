<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SettingCetakLabelObat.php";
?>
<script>
    //Submit Form Edit Profil
    $('#ProsesSimpanSetingLabel').submit(function(){
        var ProsesSimpanSetingLabel=$('#ProsesSimpanSetingLabel').serialize();
        $('#NotifikasiSimpanSettingLabel').html("Loading...");
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/ProfilUser/ProsesSimpanSetingLabel.php',
            data 	: ProsesSimpanSetingLabel,
            success : function(data){
                $('#NotifikasiSimpanSettingLabel').html(data);
                var NotifikasiSimpanSettingLabelBerhasil= $('#NotifikasiSimpanSettingLabelBerhasil').html();
                if(NotifikasiSimpanSettingLabelBerhasil=="Berhasil"){
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/ProfilUser/LabelObat.php',
                        success : function(data){
                            $('#HalamanProfile').html(data);
                            $('#ModalUpdateSettingCetakLabelObatBerhasil').modal('show');
                        }
                    });
                }
            }
        });
    });
</script>
<div class="card">
    <form action="javasript:void(0);" id="ProsesSimpanSetingLabel">
        <div class="card-header">
            <h2>Setting Label Obat</h2>
        </div>
        <div class="card-body bg-white">
            <diw class="row">
                <div class="col-md-12 mb-4">
                    <iframe src="<?php echo $base_url;?>/_Page/ProfilUser/PreviewLabelObat.php" frameborder="1" width="100%" height="150px"></iframe>
                </div>
            </diw>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <label for="tanggal_setting">Tanggal</label>
                    <input type="date" readonly name="tanggal_setting" id="tanggal_setting" class="form-control border-dark" value="<?php echo "$TanggalSettingLabel";?>" required>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="nama_font">Nama Font</label>
                    <input type="text" name="nama_font" id="nama_font" list="NamaFont" class="form-control border-dark"  value="<?php echo "$NamaFontSettingLabel";?>" required>
                    <datalist id="NamaFont">
                        <option value="Arial">
                        <option value="Comic Sans MS Bold">
                        <option value="Courier New">
                        <option value="Georgia">
                        <option value="Impact">
                        <option value="Lucida Console">
                        <option value="Marlett">
                        <option value="Minion Web">
                        <option value="Times New Roman">
                        <option value="Tahoma">
                    </datalist>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="ukuran_font">Ukuran Font</label>
                    <input type="text" name="ukuran_font" id="ukuran_font" list="UkuranFont" class="form-control border-dark"  value="<?php echo "$UkuranFontSettingLabel";?>" required>
                    <datalist id="UkuranFont">
                        <option value="4pt">
                        <option value="6pt">
                        <option value="12pt">
                        <option value="14pt">
                        <option value="16pt">
                        <option value="18pt">
                        <option value="20pt">
                        <option value="22pt">
                        <option value="24pt">
                        <option value="28pt">
                    </datalist>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="warna_font">Warna Font</label>
                    <input type="color" name="warna_font" id="warna_font" class="form-control border-dark form-control border-dark-color" value="<?php echo "$WarnaFontSettingLabel";?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="panjang_x">Panjang X</label>
                    <input type="text" name="panjang_x" id="panjang_x" list="PanjangKertas" class="form-control border-dark" value="<?php echo "$PanjangSettingLabel";?>" required>
                    <datalist id="PanjangKertas">
                        <option value="50mm">
                        <option value="60mm">
                        <option value="70mm">
                        <option value="80mm">
                        <option value="90mm">
                        <option value="100mm">
                        <option value="120mm">
                        <option value="130mm">
                        <option value="150mm">
                        <option value="160mm">
                    </datalist>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="lebar_y">Lebar Y</label>
                    <input type="text" name="lebar_y" id="lebar_y" list="LebarKertas" class="form-control border-dark" value="<?php echo "$LebarSettingLabel";?>" required>
                    <datalist id="LebarKertas">
                        <option value="50mm">
                        <option value="60mm">
                        <option value="70mm">
                        <option value="80mm">
                        <option value="90mm">
                        <option value="100mm">
                        <option value="120mm">
                        <option value="130mm">
                        <option value="150mm">
                        <option value="160mm">
                    </datalist>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <label for="margin_atas">Margin Atas</label>
                    <input type="text" name="margin_atas" id="margin_atas" list="MarginAtas" class="form-control border-dark" value="<?php echo "$MarginAtasSettingLabel";?>">
                    <datalist id="MarginAtas">
                        <option value="1mm">
                        <option value="2mm">
                        <option value="3mm">
                        <option value="4mm">
                        <option value="5mm">
                        <option value="6mm">
                        <option value="7mm">
                        <option value="8mm">
                        <option value="9mm">
                        <option value="10mm">
                    </datalist>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="margin_bawah">Margin Bawah</label>
                    <input type="text" name="margin_bawah" id="margin_bawah" list="MarginBawah" class="form-control border-dark form-control border-dark-color" value="<?php echo "$MarginBawahLabel";?>">
                    <datalist id="MarginBawah">
                        <option value="1mm">
                        <option value="2mm">
                        <option value="3mm">
                        <option value="4mm">
                        <option value="5mm">
                        <option value="6mm">
                        <option value="7mm">
                        <option value="8mm">
                        <option value="9mm">
                        <option value="10mm">
                    </datalist>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="margin_kiri">Margin Kiri</label>
                    <input type="text" name="margin_kiri" id="margin_kiri" list="MarginKiri" class="form-control border-dark" value="<?php echo "$MarginKiriLabel";?>">
                    <datalist id="MarginKiri">
                        <option value="1mm">
                        <option value="2mm">
                        <option value="3mm">
                        <option value="4mm">
                        <option value="5mm">
                        <option value="6mm">
                        <option value="7mm">
                        <option value="8mm">
                        <option value="9mm">
                        <option value="10mm">
                    </datalist>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="margin_kanan">Margin Kanan</label>
                    <input type="text" name="margin_kanan" id="margin_kanan" list="MarginKanan" class="form-control border-dark" value="<?php echo "$MarginKananLabel";?>">
                    <datalist id="MarginKanan">
                        <option value="1mm">
                        <option value="2mm">
                        <option value="3mm">
                        <option value="4mm">
                        <option value="5mm">
                        <option value="6mm">
                        <option value="7mm">
                        <option value="8mm">
                        <option value="9mm">
                        <option value="10mm">
                    </datalist>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <label for="tampilkan_kode_obat">Tampilkan Kode Obat?</label>
                    <select name="tampilkan_kode_obat" id="tampilkan_kode_obat" class="form-control border-dark" required>
                        <option <?php if($KodeObatLabel==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($KodeObatLabel=="Tidak"){echo "selected";} ?> value="Tidak">Tidak</option>
                        <option <?php if($KodeObatLabel=="Ya"){echo "selected";} ?> value="Ya">Ya</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="tampilkan_nama_obat">Tampilkan Nama Obat?</label>
                    <select name="tampilkan_nama_obat" id="tampilkan_nama_obat" class="form-control border-dark" required>
                        <option <?php if($NamaObatLabel==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($NamaObatLabel=="Tidak"){echo "selected";} ?> value="Tidak">Tidak</option>
                        <option <?php if($NamaObatLabel=="Ya"){echo "selected";} ?> value="Ya">Ya</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="tampilkan_harga_obat">Tampilkan Harga Obat?</label>
                    <select name="tampilkan_harga_obat" id="tampilkan_harga_obat" class="form-control border-dark" required>
                        <option <?php if($HargaObatLabel==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($HargaObatLabel=="Tidak"){echo "selected";} ?> value="Tidak">Tidak</option>
                        <option <?php if($HargaObatLabel=="Ya"){echo "selected";} ?> value="Ya">Ya</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="ukuran_barcode">Ukuran Barcode</label>
                    <input type="text" name="ukuran_barcode" id="ukuran_barcode" list="UkuranBarcode" class="form-control border-dark" value="<?php echo "$UkuranBarcodeLabel";?>">
                    <datalist id="UkuranBarcode">
                        <option value="5">
                        <option value="10">
                        <option value="15">
                        <option value="20">
                        <option value="25">
                        <option value="30">
                        <option value="35">
                        <option value="40">
                        <option value="45">
                        <option value="50">
                    </datalist>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4" id="NotifikasiSimpanSettingLabel">
                    <span class="text-info">Pastikan anda mengisi form pengaturan dengan benar</span>
                </div>
            </div>
        </div>
        <div class="card-footer mt-4 mb-4">
            <button type="submit" class="btn btn-lg btn-primary">
                <i class="mdi mdi-floppy"></i> Simpan (click 2 x)
            </button>
        </div>
    </form>
</div>
