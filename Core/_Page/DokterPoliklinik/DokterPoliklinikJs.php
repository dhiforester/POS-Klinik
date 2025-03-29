<script>
    $(document).ready(function(){
        $('#PencarianDokterPoliklinik').focus();
        $('#TabelDokterPoliklinik').load("_Page/DokterPoliklinik/TabelDokterPoliklinik.php");
        //Pencarian Dokter Poliklinik
        $('#PencarianDokterPoliklinik').keyup(function(){
            var keyword = $('#PencarianDokterPoliklinik').val();
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/DokterPoliklinik/TabelDokterPoliklinik.php',
                data 	:  'keyword='+ keyword,
                success : function(data){
                    $('#TabelDokterPoliklinik').html(data);
                }
            });
        });
        //Reload Dokter Poliklinik
        $('#ReloadDokterPoliklinik').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#TabelDokterPoliklinik').html(Loading);
            $('#TabelDokterPoliklinik').load('_Page/DokterPoliklinik/TabelDokterPoliklinik.php');
        });
        // Modal Tambah Dokter Poliklinik
        $('#ModalTambahDokterPoliklinik').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormTambahDokterPoliklinik').html(Loading);
            var IdMember = $(e.relatedTarget).data('id');
            $.ajax({
                url     : "_Page/DokterPoliklinik/FormTambahDokterPoliklinik.php",
                method  : "POST",
                success: function (data) {
                    $('#FormTambahDokterPoliklinik').html(data);
                    $('#ProsesSimpanDokterPoliklinik').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiSimpanPoliklinik').html(Loading);
                        var ProsesSimpanDokterPoliklinik=$('#ProsesSimpanDokterPoliklinik').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/DokterPoliklinik/ProsesSimpanDokterPoliklinik.php',
                            data 	: ProsesSimpanDokterPoliklinik,
                            success : function(data){
                                $('#NotifikasiSimpanPoliklinik').html(data);
                                var NotifikasiSimpanPoliklinikBerhasil= $('#NotifikasiSimpanPoliklinikBerhasil').html();
                                if(NotifikasiSimpanPoliklinikBerhasil=="Berhasil"){
                                    $('#ModalTambahDokterPoliklinik').modal('hide');
                                    $('#ModalNotifikasiTambahDokterPoliklinik').modal('show');
                                    $('#TabelDokterPoliklinik').load("_Page/DokterPoliklinik/TabelDokterPoliklinik.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Histori Kunjungan
        $('#ModalHistoriKunjungan').on('show.bs.modal', function (e) {
            var id_dokter = $(e.relatedTarget).data('id');
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HistoryKunjunganDokter').html(Loading);
            $.ajax({
                url     : "_Page/DokterPoliklinik/HistoryKunjunganDokter.php",
                method  : "POST",
                data    : {id_dokter: id_dokter},
                success: function (data) {
                    $('#HistoryKunjunganDokter').html(data);
                }
            })
        });
        // Modal Edit Dokter Poliklinik
        $('#ModalEditDokter').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_dokter=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormEditDokter').html(Loading);
            $.ajax({
                url     : "_Page/DokterPoliklinik/FormEditDokter.php",
                method  : "POST",
                data    : {id_dokter: id_dokter},
                success: function (data) {
                    $('#FormEditDokter').html(data);
                    $('#ProsesEditDokterPoliklinik').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiEditPoliklinik').html(Loading);
                        var ProsesEditDokterPoliklinik=$('#ProsesEditDokterPoliklinik').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/DokterPoliklinik/ProsesEditDokterPoliklinik.php',
                            data 	: ProsesEditDokterPoliklinik,
                            success : function(data){
                                $('#NotifikasiEditPoliklinik').html(data);
                                var NotifikasiEditPoliklinikBerhasil= $('#NotifikasiEditPoliklinikBerhasil').html();
                                if(NotifikasiEditPoliklinikBerhasil=="Berhasil"){
                                    $('#ModalEditDokter').modal('hide');
                                    $('#ModalNotifikasiEditPoliklinik').modal('show');
                                    $('#TabelDokterPoliklinik').load("_Page/DokterPoliklinik/TabelDokterPoliklinik.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Delete Dokter Poliklinik
        $('#ModalDeleteDokter').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_dokter=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormDeleteDokter').html(Loading);
            $.ajax({
                url     : "_Page/DokterPoliklinik/FormDeleteDokter.php",
                method  : "POST",
                data    : {id_dokter: id_dokter},
                success: function (data) {
                    $('#FormDeleteDokter').html(data);
                    $('#ClickDeleteDokter').click(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiHapusPoliklinik').html(Loading);
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/DokterPoliklinik/ProsesHapusDokter.php',
                            data    : {id_dokter: id_dokter},
                            success : function(data){
                                $('#NotifikasiHapusPoliklinik').html(data);
                                var NotifikasiHapusPoliklinikBerhasil= $('#NotifikasiHapusPoliklinikBerhasil').html();
                                if(NotifikasiHapusPoliklinikBerhasil=="Berhasil"){
                                    $('#ModalDeleteDokter').modal('hide');
                                    $('#ModalNotifikasiDeleteDokterPoliklinik').modal('show');
                                    $('#TabelDokterPoliklinik').load("_Page/DokterPoliklinik/TabelDokterPoliklinik.php");
                                }
                            }
                        });
                    });
                }
            })
        });
    });
</script>