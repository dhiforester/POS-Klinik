<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SettingCetakLaporan.php";
?>
<script>
    //Submit Form Edit Profil
    $('#ProsesSimpanSetingCetakLaporan').submit(function(){
        var ProsesSimpanSetingCetakLaporan=$('#ProsesSimpanSetingCetakLaporan').serialize();
        $('#NotifikasiSimpanSettingLaporan').html("Loading...");
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/ProfilUser/ProsesSimpanSetingCetakLaporan.php',
            data 	: ProsesSimpanSetingCetakLaporan,
            success : function(data){
                $('#NotifikasiSimpanSettingLaporan').html(data);
                var NotifikasiSimpanSettingLaporanBerhasil= $('#NotifikasiSimpanSettingLaporanBerhasil').html();
                if(NotifikasiSimpanSettingLaporanBerhasil=="Berhasil"){
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/ProfilUser/CetakLaporan.php',
                        success : function(data){
                            $('#HalamanProfile').html(data);
                            $('#NotifikasiSimpanSettingLaporanBerhasil').modal('show');
                        }
                    });
                }
            }
        });
    });
</script>
<div class="card">
    <form action="javasript:void(0);" id="ProsesSimpanSetingCetakLaporan" autocomplete="off">
        <div class="card-header">
            <h2>Setting Cetak Laporan</h2>
        </div>
        <div class="card-body bg-white">
            <diw class="row">
                <div class="col-md-12 mb-4">
                    <iframe src="<?php echo $base_url;?>/_Page/ProfilUser/PreviewLaporan.php" frameborder="1" width="100%" height="300px"></iframe>
                </div>
            </diw>
            <div class="row">
                <div class="col-md-3 mt-3">
                    <label for="tanggal_setting">Tanggal</label>
                    <input type="date" readonly name="tanggal_setting" id="tanggal_setting" class="form-control border-dark" value="<?php echo date('Y-m-d');?>" required>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="nama_font">Nama Font</label>
                    <input type="text" name="nama_font" id="nama_font" list="NamaFont" class="form-control border-dark" value="<?php echo "$NamaFornSettingLaporan";?>" required>
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
                    <input type="text" name="ukuran_font" id="ukuran_font" list="UkuranFont" class="form-control border-dark" value="<?php echo "$UkuranFornSettingLaporan";?>" required>
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
                    <input type="color" name="warna_font" id="warna_font" class="form-control form-control-color border-dark" value="<?php echo "$WarnaFornSettingLaporan";?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="panjang_x">Panjang X</label>
                    <input type="text" name="panjang_x" id="panjang_x" list="PanjangKertas" class="form-control border-dark" value="<?php echo "$PanjangSettingLaporan";?>" required>
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
                    <input type="text" name="lebar_y" id="lebar_y" list="LebarKertas" class="form-control border-dark" value="<?php echo "$LebarSettingLaporan";?>" required>
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
                    <input type="text" name="margin_atas" id="margin_atas" list="MarginAtas" class="form-control border-dark" value="<?php echo "$MarginAtasSettingLaporan";?>">
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
                    <input type="text" name="margin_bawah" id="margin_bawah" list="MarginBawah" class="form-control border-dark" value="<?php echo "$MarginBawahLaporan";?>">
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
                    <input type="text" name="margin_kiri" id="margin_kiri" list="MarginKiri" class="form-control border-dark" value="<?php echo "$MarginKiriLaporan";?>">
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
                    <input type="text" name="margin_kanan" id="margin_kanan" list="MarginKanan" class="form-control border-dark" value="<?php echo "$MarginKananLaporan";?>">
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
                    <label for="tampilkan_logo">Tampilkan Logo?</label>
                    <select name="tampilkan_logo" id="tampilkan_logo" class="form-control border-dark" required>
                        <option <?php if($LogoLaporan==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($LogoLaporan=="Tidak"){echo "selected";} ?> value="Tidak">Tidak</option>
                        <option <?php if($LogoLaporan=="Ya"){echo "selected";} ?> value="Ya">Ya</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="panjang_logo">Panjang Logo</label>
                    <input type="text" name="panjang_logo" id="panjang_logo" list="PanjangLogo" class="form-control border-dark" value="<?php echo "$PanjangLogoLaporan";?>">
                    <datalist id="PanjangLogo">
                        <option value="5mm">
                        <option value="10mm">
                        <option value="15mm">
                        <option value="20mm">
                        <option value="25mm">
                        <option value="30mm">
                        <option value="35mm">
                        <option value="40mm">
                        <option value="45mm">
                        <option value="50mm">
                    </datalist>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="lebar_logo">Lebar Logo</label>
                    <input type="text" name="lebar_logo" id="lebar_logo" list="LebarLogo" class="form-control border-dark" value="<?php echo "$LebarLogoLaporan";?>">
                    <datalist id="LebarLogo">
                        <option value="5mm">
                        <option value="10mm">
                        <option value="15mm">
                        <option value="20mm">
                        <option value="25mm">
                        <option value="30mm">
                        <option value="35mm">
                        <option value="40mm">
                        <option value="45mm">
                        <option value="50mm">
                    </datalist>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4" id="NotifikasiSimpanSettingLaporan">
                    <span class="text-info">Pastikan anda mengisi form pengaturan dengan benar</span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-lg btn-primary">
                <i class="mdi mdi-floppy"></i> Simpan (click 2 x)
            </button>
        </div>
    </form>
</div>
