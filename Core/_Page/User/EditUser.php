<?php
    //koneksi
    include "../../_Config/Connection.php";
    if(!empty($_POST['IdUser'])){
        //tangkap variabel
        $id_akses=$_POST['IdUser'];
        //Tangkap page
        $page=$_POST['page'];
        $BatasData=$_POST['BatasData'];
        //Buka data pelanggan berdasarkan IdPelanggan
        $QryUser = mysqli_query($conn, "SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($conn));
        $DataUser = mysqli_fetch_array($QryUser);
        $nama = $DataUser['nama'];
        $kontak = $DataUser['kontak'];
        $email = $DataUser['email'];
        $akses = $DataUser['akses'];
        $status = $DataUser['status'];
    }
?>
<script>
    $(document).ready(function(){
        $('#KembaliUser').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#Halaman').html(Loading);
            $('#Halaman').load("_Page/User/User.php");
        });
        $('#ProsesEditUser').submit(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            var ProsesEditUser = $('#ProsesEditUser').serialize();
            $('#NotifikasiEditUser').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/User/ProsesEditUser.php',
                data 	:  ProsesEditUser,
                success : function(data){
                    $('#NotifikasiEditUser').html(data);
                    //menangkap keterangan notifikasi
                    var Notifikasi=$('#NotifikasiProsesEditUser').html();
                    var page=$('#page').html();
                    var BatasData=$('#BatasData').html();
                    if(Notifikasi=="Berhasil"){
                        $('#Halaman').load("_Page/User/User.php");
                        $.ajax({
                            url     : "_Page/User/TabelUser.php",
                            method  : "POST",
                            data    : { page: page, BatasData: BatasData },
                            success: function (data) {
                                $('#TabelUser').html(data);
                            }
                        })
                        $('#ModalEditUserBerhasil').modal('show');
                    }
                }
            });
        });
    });
</script>
<div class="row">
    <div class="col col-md-8 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary"><i class="menu-icon mdi mdi-pencil-box-outline"></i> Edit User</h3>
                <small>Berikut ini adalah form untuk melakukan perubahan data user akses.</small>
            </div>
        </div>
    </div>
    <div class="col col-md-4 grid-margin stretch-card text-center">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'"  class="card card-statistics bg-inverse-dark" id="KembaliUser">
            <div class="card-body text-center">
                <i class="menu-icon mdi mdi-arrow-left icon-md"></i><br>
                Kembali
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card">
            <form action="javascript:void(0);" id="ProsesEditUser" autocomplete="off">
                <div class="card-header">
                    <h3>Form Edit User</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id_akses" value="<?php echo $id_akses;?>">
                    <input type="hidden" name="page" value="<?php echo $page;?>">
                    <input type="hidden" name="BatasData" value="<?php echo $BatasData;?>">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control border-dark" value="<?php echo "$nama"; ?>" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="kontak">No.Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="form-control border-dark" value="<?php echo "$kontak"; ?>" placeholder="+62" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="email">Email/Username</label>
                            <input type="text" name="email" id="email" class="form-control border-dark" placeholder="youremail@domain.com" value="<?php echo "$email"; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="akses">Akses Group</label>
                            <input type="text" name="akses" id="akses" list="ListAkses" class="form-control border-dark" value="<?php echo "$akses"; ?>" required>
                            <datalist id="ListAkses">
                                <?php
                                    include "../../_Config/Connection.php";
                                    $QueryAkses = mysqli_query($conn, "SELECT DISTINCT akses FROM akses");
                                    while($HasilAkses = mysqli_fetch_array($QueryAkses)){
                                        echo '<option value="'.$HasilAkses['akses'].'">';
                                    }
                                ?>
                            </datalist>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="password1">Password</label>
                            <input type="password" name="password1" id="password1" class="form-control border-dark" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="password2">Ulangi Password</label>
                            <input type="password" name="password2" id="password2" class="form-control border-dark" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control border-dark">
                                <option <?php if($status=="Aktif"){echo "selected";} ?> value="Aktif">Aktif</option>
                                <option <?php if($status=="Non Aktif"){echo "selected";} ?> value="Non Aktif">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md col-12 mt-3" id="NotifikasiEditUser">
                            <div class="alert alert-primary" role="alert">
                                Pastikan data yang anda input sudah lengkap!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg mr-3">
                            <i class="menu-icon mdi mdi-check"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-secondary btn-lg">
                            <i class="menu-icon mdi mdi-reload"></i> Reset
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>