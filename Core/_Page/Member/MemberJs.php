<script>
    $(document).ready(function(){
        $('#PencarianMember').focus();
        $('#TabelMember').load("_Page/Member/TabelMember.php");
        //Event Focus TambahMember
        $('#TambahMember').focus(function(){
            $('#TambahMember').removeClass('btn-outline-primary');
            $('#TambahMember').addClass('btn-primary');
        });
        $('#TambahMember').focusout(function(){
            $('#TambahMember').removeClass('btn-primary');
            $('#TambahMember').addClass('btn-outline-primary');
        });
        //Event Focus ReloadMember
        $('#ReloadMember').focus(function(){
            $('#ReloadMember').removeClass('btn-outline-warning');
            $('#ReloadMember').addClass('btn-warning');
        });
        $('#ReloadMember').focusout(function(){
            $('#ReloadMember').removeClass('btn-warning');
            $('#ReloadMember').addClass('btn-outline-warning');
        });
    });
    //ReloadMember
    $('#ReloadMember').click(function(){
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#TabelMember').html(Loading);
        $('#TabelMember').load('_Page/Member/TabelMember.php');
    });
    //Pencarian
    $('#PencarianMember').keyup(function(){
        var keyword = $('#PencarianMember').val();
        $.ajax({
            type 	: 'POST',
            url 	: '_Page/Member/TabelMember.php',
            data 	:  'keyword='+ keyword,
            success : function(data){
                $('#TabelMember').html(data);
            }
        });
    });
    $('#ModalTambahMember').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormTambahMember').html(Loading);
        $.ajax({
            url     : "_Page/Member/FormTambahMember.php",
            method  : "POST",
            success: function (data) {
                $('#FormTambahMember').html(data);
                $('#ProsesTambahMember').submit(function(){
                    var ProsesTambahMember = $('#ProsesTambahMember').serialize();
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#NotifikasiTambahMember').html("Loading...");
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Member/ProsesTambahMember.php',
                        data 	:  ProsesTambahMember,
                        success : function(data){
                            $('#NotifikasiTambahMember').html(data);
                            //menangkap keterangan notifikasi
                            var NotifikasiTambahMemberBerhasil=$('#NotifikasiTambahMemberBerhasil').html();
                            if(NotifikasiTambahMemberBerhasil=="Berhasil"){
                                $('#ModalTambahMember').modal('hide');
                                $('#ModalTambahMemberBerhasil').modal('show');
                                $('#TabelMember').load('_Page/Member/TabelMember.php');
                            }
                        }
                    });
                });
            }
        })
    });
    //Modal Edit Supplier
    $('#ModalEditMember').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormEditMember').html(Loading);
        var id_member = $(e.relatedTarget).data('id');
        $.ajax({
            url     : "_Page/Member/FormEditMember.php",
            method  : "POST",
            data    : { id_member: id_member },
            success: function (data) {
                $('#FormEditMember').html(data);
                //Ketika disetujui delete
                $('#ProsesEditMember').submit(function(){
                    var ProsesEditMember = $('#ProsesEditMember').serialize();
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#NotifikasiEditMember').html(Loading);
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Member/ProsesEditMember.php',
                        data 	:  ProsesEditMember,
                        success : function(data){
                            $('#NotifikasiEditMember').html(data);
                            //menangkap keterangan notifikasi
                            var NotifikasiEditMemberBerhasil=$('#NotifikasiEditMemberBerhasil').html();
                            if(NotifikasiEditMemberBerhasil=="Berhasil"){
                                $('#ModalEditMember').modal('hide');
                                $('#ModalEditMemberBerhasil').modal('show');
                                $('#TabelMember').load('_Page/Member/TabelMember.php');
                            }
                        }
                    });
                });
            }
        })
    });
    //ketika Modal Delete muncul
    $('#ModalDeleteMember').on('show.bs.modal', function (e) {
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        $('#FormDeleteMember').html(Loading);
        var IdMember = $(e.relatedTarget).data('id');
        $.ajax({
            url     : "_Page/Member/FormDeleteMember.php",
            method  : "POST",
            data    : { IdMember: IdMember },
            success: function (data) {
                $('#FormDeleteMember').html(data);
                //Ketika disetujui delete
                $('#ProsesDeleteMember').submit(function(){
                    var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                    $('#NotifikasiDeleteMember').html(Loading);
                    var ProsesDeleteMember = $('#ProsesDeleteMember').serialize();
                    $.ajax({
                        type 	: 'POST',
                        url 	: '_Page/Member/ProsesDeleteMember.php',
                        data 	:  ProsesDeleteMember,
                        success : function(data){
                            $('#NotifikasiDeleteMember').html(data);
                            //menangkap keterangan notifikasi
                            var Notifikasi=$('#NotifikasiDeleteMemberBerhasil').html();
                            if(Notifikasi=="Berhasil"){
                                $('#Halaman').load('_Page/Member/Member.php');
                                $('#ModalDeleteMember').modal('hide');
                                $('#ModalDeleteMemberBerhasil').modal('show');
                            }
                        }
                    });
                });
            }
        })
    });
</script>