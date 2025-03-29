<script>
    $(document).ready(function(){
        $('#TabelUser').load("_Page/User/TabelUser.php");
    });
    //Pencarian
    $('#PencarianUser').keyup(function(){
        var keyword = $('#PencarianUser').val();
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/User/TabelUser.php',
            data 	:  'keyword='+ keyword,
            success : function(data){
                $('#TabelUser').html(data);
            }
        });
    });
    $('#TambahUser').click(function(){
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#Halaman').html(Loading);
        $('#Halaman').load('_Page/User/TambahUser.php');
    });
    // Modal Edit Acc Askes
    $('#ModalEditAccAskes').on('show.bs.modal', function (e) {
        var akses = $(e.relatedTarget).data('id');
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormEditAksesibilitas').html(Loading);
        $.ajax({
            url     : "_Page/User/FormEditAksesibilitas.php",
            method  : "POST",
            data    : {akses: akses},
            success: function (data) {
                $('#FormEditAksesibilitas').html(data);
                $('#ProsesEditAksesibilitas').submit(function(){
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#NotifikasiEditAksesibilitas').html(Loading);
                    var ProsesEditAksesibilitas=$('#ProsesEditAksesibilitas').serialize();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/User/ProsesEditAksesibilitas.php',
                        data 	: ProsesEditAksesibilitas,
                        success : function(data){
                            $('#NotifikasiEditAksesibilitas').html(data);
                            var NotifikasiEditAksesibilitasBerhasil= $('#NotifikasiEditAksesibilitasBerhasil').html();
                            if(NotifikasiEditAksesibilitasBerhasil=="Berhasil"){
                                $('#ModalEditAccAskes').modal('hide');
                                $('#ModalEditAccAskesBerhasil').modal('show');
                                $('#TabelUser').load("_Page/User/TabelUser.php");
                            }
                        }
                    });
                });
            }
        })
    });
</script>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="text-primary"><i class="menu-icon mdi mdi-account-box"></i> Data Akses</h3>
                <small>Buat akses admin dan kasir, ubah password dan hapus akses</small>
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" id="TambahUser">
            <div class="card-body">
                <i class="mdi mdi mdi-account-plus icon-md"></i><br>
                Tambah User
            </div>
        </div>
    </div>
    <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="col-md-3 grid-margin stretch-card text-center">
        <div class="card card-statistics bg-inverse-dark" id="ReloadUser">
            <div class="card-body">
                <i class="mdi mdi mdi-reload icon-md"></i><br>
                Reload
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card bg-inverse-dark">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col col-md-6 text-center">
                        <div class="input-group">
                            <input type="text" class="form-control" id="PencarianUser" class="form-control" placeholder="Cari.." value="">
                            <div class="input-group-append border-primary">
                                <span class="input-group-text bg-transparent">
                                    <i class="mdi mdi-menu mdi-search-web"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  id="TabelUser">
                <!----- Tabel disini ----->
            </div>
        </div>
    </div>
</div>