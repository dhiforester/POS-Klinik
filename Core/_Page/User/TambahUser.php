<script>
    $(document).ready(function(){
        $('#KembaliUser').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#Halaman').html(Loading);
            $('#Halaman').load("_Page/User/User.php");
        });
        $('#ProsesTambahUser').submit(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            var ProsesTambahUser = $('#ProsesTambahUser').serialize();
            $('#NotifikasiTambahUser').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/User/ProsesTambahUser.php',
                data 	:  ProsesTambahUser,
                success : function(data){
                    $('#NotifikasiTambahUser').html(data);
                    //menangkap keterangan notifikasi
                    var Notifikasi=$('#NotifikasiProsesTambahUser').html();
                    if(Notifikasi=="Berhasil"){
                        $('#Halaman').load('_Page/User/User.php');
                        $('#ModalTambahUserBerhasil').modal('show');
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
                <h3 class="text-primary"><i class="menu-icon mdi mdi-account-box"></i> Tambah User</h3>
                <small>Pastikan anda mengisi data akses pengguna dengan benar.</small>
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
            <form action="javascript:void(0);" autocomplete="off" id="ProsesTambahUser">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah User</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control border-dark" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="kontak">No.Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="form-control border-dark" placeholder="+62" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="email">Email/Username</label>
                            <input type="text" name="email" id="email" class="form-control border-dark" placeholder="youremail@domain.com" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="akses">Akses Group</label>
                            <input type="text" name="akses" id="akses" list="ListAkses" class="form-control border-dark" required>
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
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md col-12 mt-3" id="NotifikasiTambahUser">
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