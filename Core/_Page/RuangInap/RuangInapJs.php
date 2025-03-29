<script>
    $(document).ready(function(){
        $('#PencarianRuangInap').focus();
        $('#TabelRuangInap').load("_Page/RuangInap/TabelRuangInap.php");
        //Pencarian RuangInap Poliklinik
        $('#PencarianRuangInap').keyup(function(){
            var keyword = $('#PencarianRuangInap').val();
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/RuangInap/TabelRuangInap.php',
                data 	:  'keyword='+ keyword,
                success : function(data){
                    $('#TabelRuangInap').html(data);
                }
            });
        });
        //Reload RuangInap Poliklinik
        $('#ReloadRuangInap').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#TabelRuangInap').html(Loading);
            $('#TabelRuangInap').load('_Page/RuangInap/TabelRuangInap.php');
        });
        // Modal Tambah RuangInap Poliklinik
        $('#ModalTambahRuangInap').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormTambahRuangInap').html(Loading);
            var IdMember = $(e.relatedTarget).data('id');
            $.ajax({
                url     : "_Page/RuangInap/FormTambahRuangInap.php",
                method  : "POST",
                success: function (data) {
                    $('#FormTambahRuangInap').html(data);
                    $('#ProsesSimpanRuangInap').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiSimpanRuangInap').html(Loading);
                        var ProsesSimpanRuangInap=$('#ProsesSimpanRuangInap').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/RuangInap/ProsesSimpanRuangInap.php',
                            data 	: ProsesSimpanRuangInap,
                            success : function(data){
                                $('#NotifikasiSimpanRuangInap').html(data);
                                var NotifikasiSimpanRuangInapBerhasil= $('#NotifikasiSimpanRuangInapBerhasil').html();
                                if(NotifikasiSimpanRuangInapBerhasil=="Berhasil"){
                                    $('#ModalTambahRuangInap').modal('hide');
                                    $('#ModalNotifikasiTambahRuangInap').modal('show');
                                    $('#TabelRuangInap').load("_Page/RuangInap/TabelRuangInap.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Histori Kunjungan
        $('#ModalHistoriKunjunganRuangInap').on('show.bs.modal', function (e) {
            var id_ruang_inap = $(e.relatedTarget).data('id');
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#HistoryKunjunganRuangInap').html(Loading);
            $.ajax({
                url     : "_Page/RuangInap/HistoryKunjunganRuangInap.php",
                method  : "POST",
                data    : {id_ruang_inap: id_ruang_inap},
                success: function (data) {
                    $('#HistoryKunjunganRuangInap').html(data);
                }
            })
        });
        // Modal Edit Ruang Inap
        $('#ModalEditRuangInap').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_ruang_inap=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormEditRuangInap').html(Loading);
            $.ajax({
                url     : "_Page/RuangInap/FormEditRuangInap.php",
                method  : "POST",
                data    : {id_ruang_inap: id_ruang_inap},
                success: function (data) {
                    $('#FormEditRuangInap').html(data);
                    $('#ProsesEditRuangInap').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiEditRuangInap').html(Loading);
                        var ProsesEditRuangInap=$('#ProsesEditRuangInap').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/RuangInap/ProsesEditRuangInap.php',
                            data 	: ProsesEditRuangInap,
                            success : function(data){
                                $('#NotifikasiEditRuangInap').html(data);
                                var NotifikasiEditRuangInapBerhasil= $('#NotifikasiEditRuangInapBerhasil').html();
                                if(NotifikasiEditRuangInapBerhasil=="Berhasil"){
                                    $('#ModalEditRuangInap').modal('hide');
                                    $('#ModalNotifikasiEditRuangInap').modal('show');
                                    $('#TabelRuangInap').load("_Page/RuangInap/TabelRuangInap.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Delete RuangInap Poliklinik
        $('#ModalDeleteRuangInap').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_ruang_inap=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormDeleteRuangInap').html(Loading);
            $.ajax({
                url     : "_Page/RuangInap/FormDeleteRuangInap.php",
                method  : "POST",
                data    : {id_ruang_inap: id_ruang_inap},
                success: function (data) {
                    $('#FormDeleteRuangInap').html(data);
                    $('#ClickDeleteRuangInap').click(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiHapusRuangInap').html(Loading);
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/RuangInap/ProsesHapusRuangInap.php',
                            data    : {id_ruang_inap: id_ruang_inap},
                            success : function(data){
                                $('#NotifikasiHapusRuangInap').html(data);
                                var NotifikasiHapusRuangInapBerhasil= $('#NotifikasiHapusRuangInapBerhasil').html();
                                if(NotifikasiHapusRuangInapBerhasil=="Berhasil"){
                                    $('#ModalDeleteRuangInap').modal('hide');
                                    $('#ModalNotifikasiDeleteRuangInap').modal('show');
                                    $('#TabelRuangInap').load("_Page/RuangInap/TabelRuangInap.php");
                                }
                            }
                        });
                    });
                }
            })
        });
    });
</script>