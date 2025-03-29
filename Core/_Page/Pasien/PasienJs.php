<script>
    $(document).ready(function(){
        $('#PencarianPasien').focus();
        $('#TabelPasien').load("_Page/Pasien/TabelPasien.php");
        //Pencarian Pasien Pasien
        $('#PencarianPasien').keyup(function(){
            var keyword = $('#PencarianPasien').val();
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Pasien/TabelPasien.php',
                data 	:  'keyword='+ keyword,
                success : function(data){
                    $('#TabelPasien').html(data);
                }
            });
        });
        //Reload Pasien Pasien
        $('#ReloadPasien').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#TabelPasien').html(Loading);
            $('#TabelPasien').load('_Page/Pasien/TabelPasien.php');
        });
        // Modal Tambah Pasien Pasien
        $('#ModalTambahPasien').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormTambahPasien').html(Loading);
            var IdMember = $(e.relatedTarget).data('id');
            $.ajax({
                url     : "_Page/Pasien/FormTambahPasien.php",
                method  : "POST",
                success: function (data) {
                    $('#FormTambahPasien').html(data);
                    $('#ProsesSimpanPasien').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiSimpanPasien').html(Loading);
                        var ProsesSimpanPasien=$('#ProsesSimpanPasien').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Pasien/ProsesSimpanPasien.php',
                            data 	: ProsesSimpanPasien,
                            success : function(data){
                                $('#NotifikasiSimpanPasien').html(data);
                                var NotifikasiSimpanPasienBerhasil= $('#NotifikasiSimpanPasienBerhasil').html();
                                if(NotifikasiSimpanPasienBerhasil=="Berhasil"){
                                    $('#ModalTambahPasien').modal('hide');
                                    $('#ModalNotifikasiTambahPasien').modal('show');
                                    $('#TabelPasien').load("_Page/Pasien/TabelPasien.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Edit Ruang Inap
        $('#ModalEditPasien').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_pasien=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormEditPasien').html(Loading);
            $.ajax({
                url     : "_Page/Pasien/FormEditPasien.php",
                method  : "POST",
                data    : {id_pasien: id_pasien},
                success: function (data) {
                    $('#FormEditPasien').html(data);
                    $('#ProsesEditPasien').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiEditPasien').html(Loading);
                        var ProsesEditPasien=$('#ProsesEditPasien').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Pasien/ProsesEditPasien.php',
                            data 	: ProsesEditPasien,
                            success : function(data){
                                $('#NotifikasiEditPasien').html(data);
                                var NotifikasiEditPasienBerhasil= $('#NotifikasiEditPasienBerhasil').html();
                                if(NotifikasiEditPasienBerhasil=="Berhasil"){
                                    $('#ModalEditPasien').modal('hide');
                                    $('#ModalNotifikasiEditPasien').modal('show');
                                    $('#TabelPasien').load("_Page/Pasien/TabelPasien.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Delete Pasien Pasien
        $('#ModalDeletePasien').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_pasien=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormDeletePasien').html(Loading);
            $.ajax({
                url     : "_Page/Pasien/FormDeletePasien.php",
                method  : "POST",
                data    : {id_pasien: id_pasien},
                success: function (data) {
                    $('#FormDeletePasien').html(data);
                    $('#ClickDeletePasien').click(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiHapusPasien').html(Loading);
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Pasien/ProsesHapusPasien.php',
                            data    : {id_pasien: id_pasien},
                            success : function(data){
                                $('#NotifikasiHapusPasien').html(data);
                                var NotifikasiHapusPasienBerhasil= $('#NotifikasiHapusPasienBerhasil').html();
                                if(NotifikasiHapusPasienBerhasil=="Berhasil"){
                                    $('#ModalDeletePasien').modal('hide');
                                    $('#ModalNotifikasiDeletePasien').modal('show');
                                    $('#TabelPasien').load("_Page/Pasien/TabelPasien.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal detail Pasien Pasien
        $('#ModalDetailPasien').on('show.bs.modal', function (e) {
            var id_pasien = $(e.relatedTarget).data('id');
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormDetailPasien').html(Loading);
            $.ajax({
                url     : "_Page/Pasien/FormDetailPasien.php",
                method  : "POST",
                data    : {id_pasien: id_pasien},
                success: function (data) {
                    $('#FormDetailPasien').html(data);
                }
            })
        });
    });
</script>