<?php
    //koneksi
    include "../../_Config/Connection.php";
    //Buka data Setting Aplikasi
    $Qry = mysqli_query($conn, "SELECT * FROM setting_aplikasi")or die(mysqli_error($conn));
    $DataSetting = mysqli_fetch_array($Qry);
    //Nama Perusahaan
    if(!empty($DataSetting['nama_perusahaan'])){
        $nama_perusahaan = $DataSetting['nama_perusahaan'];
    }else{
        $nama_perusahaan = "Business Today";
    }
    //Alamat
    if(!empty($DataSetting['alamat'])){
        $alamat = $DataSetting['alamat'];
    }else{
        $alamat ="";
    }
    //kontak
    if(!empty($DataSetting['kontak'])){
        $kontak = $DataSetting['kontak'];
    }else{
        $kontak ="";
    }
    //base_url
    if(!empty($DataSetting['base_url'])){
        $base_url = $DataSetting['base_url'];
    }else{
        $base_url ="http://localhost:81/POS-Klinik";
    }
    //logo
    if(!empty($DataSetting['logo'])){
        $logo = $DataSetting['logo'];
    }else{
        $logo ="";
    }
    //logo
    if(!empty($DataSetting['aktif_promo'])){
        $aktif_promo = $DataSetting['aktif_promo'];
    }else{
        $aktif_promo ="Tidak";
    }
    //jumlah_point
    if(!empty($DataSetting['jumlah_point'])){
        $jumlah_point = $DataSetting['jumlah_point'];
    }else{
        $jumlah_point ="0";
    }
    //kelipatan_belanja
    if(!empty($DataSetting['kelipatan_belanja'])){
        $kelipatan_belanja = $DataSetting['kelipatan_belanja'];
    }else{
        $kelipatan_belanja ="0";
    }
    //host_printer
    if(!empty($DataSetting['host_printer'])){
        $host_printer = $DataSetting['host_printer'];
    }else{
        $host_printer ="localhost";
    }
    //nama_printer
    if(!empty($DataSetting['nama_printer'])){
        $nama_printer = $DataSetting['nama_printer'];
    }else{
        $nama_printer ="POS";
    }
    //lebar_nota
    if(!empty($DataSetting['lebar_nota'])){
        $lebar_nota = $DataSetting['lebar_nota'];
    }else{
        $lebar_nota ="32";
    }
    //judul_nota
    if(!empty($DataSetting['judul_nota'])){
        $judul_nota = $DataSetting['judul_nota'];
    }else{
        $judul_nota ="Ya";
    }
    //footer_nota
    if(!empty($DataSetting['footer_nota'])){
        $footer_nota = $DataSetting['footer_nota'];
    }else{
        $footer_nota ="Ya";
    }
    //footer_nota
    if(!empty($DataSetting['komen_nota'])){
        $komen_nota = $DataSetting['komen_nota'];
    }else{
        $komen_nota ="TERIMA KASIH";
    }
?>
<script type="text/javascript">
    $(document).on("keyup", function(event) {
        if (event.keyCode === 27) {
            $('#ModalSettingAplikasiBerhasil').modal('hide');
        }
    });
</script>
<script>
    $(document).ready(function(){
        //ProsesSettingAplikasi
        $('#ProsesSettingAplikasi').submit(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            var ProsesSettingAplikasi = new FormData($(this)[0]);
            $('#NotifikasiSettingAplikasi').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/ProsesSettingAplikasi.php',
                data 	:  ProsesSettingAplikasi,
                processData : false,
                contentType : false,
                success : function(data){
                    $('#NotifikasiSettingAplikasi').html(data);
                    var Notifikasi=$('#NotifikasiSettingAplikasiBerhasil').html();
                    if(Notifikasi=="Berhasil"){
                        $('#ModalSettingAplikasiBerhasil').modal('show');
                        $('#TestPageDirect').click(function(){
                            $.ajax({
                                type 	: 'POST',
                                url 	: '_Page/Setting/testpage.php',
                                data 	: { kode_transaksi: ""  },
                                success : function(data){
                                    alert("Proses print sedang berlangsung");
                                }
                            });
                        });
                    }
                }
            });
        });
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="javascript:void(0);" id="ProsesSettingAplikasi" autocomplete="off">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-12">
                            <h4>Pengaturan Aplikasi</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label>Nama Perusahaan</label>
                            <input type="text" required name="nama_perusahaan" class="form-control border-dark" value="<?php echo $nama_perusahaan;?>">
                        </div>
                        <div class="col-md-8 mt-3">
                            <label>Alamat Perusahaan</label>
                            <input type="text"  required name="alamat" class="form-control border-dark" value="<?php echo $alamat;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label>Kontak/Telepon</label>
                            <input type="text"  required name="kontak" class="form-control border-dark" value="<?php echo $kontak;?>">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Base URL</label>
                            <input type="text"  required name="base_url" id="base_url" class="form-control border-dark" value="<?php echo $base_url;?>">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Logo Perusahaan</label>
                            <input type="file" name="logo" class="form-control border-dark" value="<?php echo $logo;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label>Host Printer</label>
                            <input type="text"  required name="host_printer" class="form-control border-dark" value="<?php echo $host_printer;?>">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Nama Printer</label>
                            <input type="text"  required name="nama_printer" class="form-control border-dark" value="<?php echo $nama_printer;?>">
                        </div>
                        <div class="col-md-4 mt-3">
                            <img src="images/<?php if(!empty($logo)){echo "$logo";}else{echo "no_image.jpg";}?>" width="100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3" id="NotifikasiSettingAplikasi">
                            <div class="alert alert-primary" role="alert">
                                Pastikan pengaturan yang anda gunakan sudah sesuai!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="menu-icon mdi mdi-check"></i> Simpan
                    </button>
                    <button type="reset" class="btn btn-lg btn-secondary ml-3">
                        <i class="menu-icon mdi mdi-reload"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>