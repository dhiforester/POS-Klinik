<script>
    $(document).ready(function(){
        //Defult Page
        $('#HalamanProfile').load('_Page/ProfilUser/DetailProfile.php');
        //DetailProfile Click
        $('#DetailProfile').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HalamanProfile').html(Loading);
            $('#HalamanProfile').load('_Page/ProfilUser/DetailProfile.php');
            //add class DetailProfile
            $('#DetailProfile').addClass('btn-primary');
            $('#DetailProfile').removeClass('btn-secondary');
            //add class DetailAkses
            $('#DetailAkses').addClass('btn-secondary');
            $('#DetailAkses').removeClass('btn-primary');
            //add class KartuPasien
            $('#KartuPasien').addClass('btn-secondary');
            $('#KartuPasien').removeClass('btn-primary');
            //add class LabelObat
            $('#LabelObat').addClass('btn-secondary');
            $('#LabelObat').removeClass('btn-primary');
            //add class LabelResep
            $('#LabelResep').addClass('btn-secondary');
            $('#LabelResep').removeClass('btn-primary');
            //add class CetakNota
            $('#CetakNota').addClass('btn-secondary');
            $('#CetakNota').removeClass('btn-primary');
            //add class CetakLaporan
            $('#CetakLaporan').addClass('btn-secondary');
            $('#CetakLaporan').removeClass('btn-primary');
        });
        //DetailAkses Click
        $('#DetailAkses').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HalamanProfile').html(Loading);
            $('#HalamanProfile').load('_Page/ProfilUser/DetailAkses.php');
            //add class DetailProfile
            $('#DetailProfile').addClass('btn-secondary');
            $('#DetailProfile').removeClass('btn-primary');
            //add class DetailAkses
            $('#DetailAkses').addClass('btn-primary');
            $('#DetailAkses').removeClass('btn-secondary');
            //add class KartuPasien
            $('#KartuPasien').addClass('btn-secondary');
            $('#KartuPasien').removeClass('btn-primary');
            //add class LabelObat
            $('#LabelObat').addClass('btn-secondary');
            $('#LabelObat').removeClass('btn-primary');
            //add class LabelResep
            $('#LabelResep').addClass('btn-secondary');
            $('#LabelResep').removeClass('btn-primary');
            //add class CetakNota
            $('#CetakNota').addClass('btn-secondary');
            $('#CetakNota').removeClass('btn-primary');
            //add class CetakLaporan
            $('#CetakLaporan').addClass('btn-secondary');
            $('#CetakLaporan').removeClass('btn-primary');
        });
        //KartuPasien Click
        $('#KartuPasien').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HalamanProfile').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/ProfilUser/KartuPasien.php',
                success : function(data){
                    $('#HalamanProfile').html(data);
                }
            });
            //add class DetailProfile
            $('#DetailProfile').addClass('btn-secondary');
            $('#DetailProfile').removeClass('btn-primary');
            //add class DetailAkses
            $('#DetailAkses').addClass('btn-secondary');
            $('#DetailAkses').removeClass('btn-primary');
            //add class KartuPasien
            $('#KartuPasien').addClass('btn-primary');
            $('#KartuPasien').removeClass('btn-secondary');
            //add class LabelObat
            $('#LabelObat').addClass('btn-secondary');
            $('#LabelObat').removeClass('btn-primary');
            //add class LabelResep
            $('#LabelResep').addClass('btn-secondary');
            $('#LabelResep').removeClass('btn-primary');
            //add class CetakNota
            $('#CetakNota').addClass('btn-secondary');
            $('#CetakNota').removeClass('btn-primary');
            //add class CetakLaporan
            $('#CetakLaporan').addClass('btn-secondary');
            $('#CetakLaporan').removeClass('btn-primary');
        });
        //LabelObat Click
        $('#LabelObat').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HalamanProfile').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/ProfilUser/LabelObat.php',
                success : function(data){
                    $('#HalamanProfile').html(data);
                }
            });
            //add class DetailProfile
            $('#DetailProfile').addClass('btn-secondary');
            $('#DetailProfile').removeClass('btn-primary');
            //add class DetailAkses
            $('#DetailAkses').addClass('btn-secondary');
            $('#DetailAkses').removeClass('btn-primary');
            //add class KartuPasien
            $('#KartuPasien').addClass('btn-secondary');
            $('#KartuPasien').removeClass('btn-primary');
            //add class LabelObat
            $('#LabelObat').addClass('btn-primary');
            $('#LabelObat').removeClass('btn-secondary');
            //add class LabelResep
            $('#LabelResep').addClass('btn-secondary');
            $('#LabelResep').removeClass('btn-primary');
            //add class CetakNota
            $('#CetakNota').addClass('btn-secondary');
            $('#CetakNota').removeClass('btn-primary');
            //add class CetakLaporan
            $('#CetakLaporan').addClass('btn-secondary');
            $('#CetakLaporan').removeClass('btn-primary');
        });
        //LabelResep Click
        $('#LabelResep').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HalamanProfile').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/ProfilUser/LabelResep.php',
                success : function(data){
                    $('#HalamanProfile').html(data);
                }
            });
            //add class DetailProfile
            $('#DetailProfile').addClass('btn-secondary');
            $('#DetailProfile').removeClass('btn-primary');
            //add class DetailAkses
            $('#DetailAkses').addClass('btn-secondary');
            $('#DetailAkses').removeClass('btn-primary');
            //add class KartuPasien
            $('#KartuPasien').addClass('btn-secondary');
            $('#KartuPasien').removeClass('btn-primary');
            //add class LabelObat
            $('#LabelObat').addClass('btn-secondary');
            $('#LabelObat').removeClass('btn-primary');
            //add class LabelResep
            $('#LabelResep').addClass('btn-primary');
            $('#LabelResep').removeClass('btn-secondary');
            //add class CetakNota
            $('#CetakNota').addClass('btn-secondary');
            $('#CetakNota').removeClass('btn-primary');
            //add class CetakLaporan
            $('#CetakLaporan').addClass('btn-secondary');
            $('#CetakLaporan').removeClass('btn-primary');
        });
        //CetakNota Click
        $('#CetakNota').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HalamanProfile').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/ProfilUser/CetakNota.php',
                success : function(data){
                    $('#HalamanProfile').html(data);
                }
            });
            //add class DetailProfile
            $('#DetailProfile').addClass('btn-secondary');
            $('#DetailProfile').removeClass('btn-primary');
            //add class DetailAkses
            $('#DetailAkses').addClass('btn-secondary');
            $('#DetailAkses').removeClass('btn-primary');
            //add class KartuPasien
            $('#KartuPasien').addClass('btn-secondary');
            $('#KartuPasien').removeClass('btn-primary');
            //add class LabelObat
            $('#LabelObat').addClass('btn-secondary');
            $('#LabelObat').removeClass('btn-primary');
            //add class LabelResep
            $('#LabelResep').addClass('btn-secondary');
            $('#LabelResep').removeClass('btn-primary');
            //add class CetakNota
            $('#CetakNota').addClass('btn-primary');
            $('#CetakNota').removeClass('btn-secondary');
            //add class CetakLaporan
            $('#CetakLaporan').addClass('btn-secondary');
            $('#CetakLaporan').removeClass('btn-primary');
        });
        //CetakLaporan Click
        $('#CetakLaporan').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HalamanProfile').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/ProfilUser/CetakLaporan.php',
                success : function(data){
                    $('#HalamanProfile').html(data);
                }
            });
            //add class DetailProfile
            $('#DetailProfile').addClass('btn-secondary');
            $('#DetailProfile').removeClass('btn-primary');
            //add class DetailAkses
            $('#DetailAkses').addClass('btn-secondary');
            $('#DetailAkses').removeClass('btn-primary');
            //add class KartuPasien
            $('#KartuPasien').addClass('btn-secondary');
            $('#KartuPasien').removeClass('btn-primary');
            //add class LabelObat
            $('#LabelObat').addClass('btn-secondary');
            $('#LabelObat').removeClass('btn-primary');
            //add class LabelResep
            $('#LabelResep').addClass('btn-secondary');
            $('#LabelResep').removeClass('btn-primary');
            //add class CetakNota
            $('#CetakNota').addClass('btn-secondary');
            $('#CetakNota').removeClass('btn-primary');
            //add class CetakLaporan
            $('#CetakLaporan').addClass('btn-primary');
            $('#CetakLaporan').removeClass('btn-secondary');
        });
        $('#ModalEditProfile').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormEditProfile').html(Loading);
            var IdUser = $(e.relatedTarget).data('id');
            $.ajax({
                url     : "_Page/ProfilUser/FormEditProfile.php",
                method  : "POST",
                success: function (data) {
                    $('#FormEditProfile').html(data);
                    //Ketika disetujui submit
                    $('#ProsesEditProfile').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiEditProfile').html(Loading);
                        var ProsesEditProfile = new FormData($(this)[0]);
                        $.ajax({
                            type 	    : 'POST',
                            url 	    : '_Page/ProfilUser/ProsesEditProfile.php',
                            data 	    :  ProsesEditProfile,
                            processData : false,
                            contentType : false,
                            success : function(data){
                                $('#NotifikasiEditProfile').html(data);
                                //menangkap keterangan notifikasi
                                var NotifikasiEditProfileBerhasil=$('#NotifikasiEditProfileBerhasil').html();
                                if(NotifikasiEditProfileBerhasil=="Berhasil"){
                                    $('#HalamanProfile').html(Loading);
                                    $('#HalamanProfile').load('_Page/ProfilUser/DetailProfile.php');
                                    $('#ModalEditProfile').modal('hide');
                                    $('#ModalEditProfilBerhasil').modal('show');
                                }
                            }
                        });
                    });
                }
            })
        });
        $('#ModalUbahPassword').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormUbahPassword').html(Loading);
            $.ajax({
                url     : "_Page/ProfilUser/FormUbahPassword.php",
                method  : "POST",
                success: function (data) {
                    $('#FormUbahPassword').html(data);
                    //Ketika disetujui submit
                    $('#ProsesUbahPassword').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiUbahPassword').html(Loading);
                        var ProsesUbahPassword = new FormData($(this)[0]);
                        $.ajax({
                            type 	    : 'POST',
                            url 	    : '_Page/ProfilUser/ProsesUbahPassword.php',
                            data 	    :  ProsesUbahPassword,
                            processData : false,
                            contentType : false,
                            success : function(data){
                                $('#NotifikasiUbahPassword').html(data);
                                //menangkap keterangan notifikasi
                                var NotifikasiUbahPasswordBerhasil=$('#NotifikasiUbahPasswordBerhasil').html();
                                if(NotifikasiUbahPasswordBerhasil=="Berhasil"){
                                    $('#HalamanProfile').html(Loading);
                                    $('#HalamanProfile').load('_Page/ProfilUser/DetailProfile.php');
                                    $('#ModalUbahPassword').modal('hide');
                                    $('#ModalUbahPasswordBerhasil').modal('show');
                                }
                            }
                        });
                    });
                }
            })
        });
    });
</script>