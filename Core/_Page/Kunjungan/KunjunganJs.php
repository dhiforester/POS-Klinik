<script>
    $(document).ready(function(){
        $('#PencarianKunjungan').focus();
        $('#TabelKunjungan').load("_Page/Kunjungan/TabelKunjungan.php");
        //Pencarian Kunjungan
        $('#PencarianKunjungan').keyup(function(){
            var keyword = $('#PencarianKunjungan').val();
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Kunjungan/TabelKunjungan.php',
                data 	:  'keyword='+ keyword,
                success : function(data){
                    $('#TabelKunjungan').html(data);
                }
            });
        });
        //Reload Kunjungan
        $('#ReloadKunjungan').click(function(){
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#TabelKunjungan').html(Loading);
            $('#TabelKunjungan').load('_Page/Kunjungan/TabelKunjungan.php');
        });
        // Modal Pilih Pasien
        $('#ModalPilihPasien').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormPilihPasien').html(Loading);
            $.ajax({
                url     : "_Page/Kunjungan/FormPilihPasien.php",
                method  : "POST",
                success: function (data) {
                    $('#FormPilihPasien').html(data);
                    $('#TabelPilihPasien').load("_Page/Kunjungan/TabelPilihPasien.php");
                    $('#ProsesCariPasien').submit(function(){
                        var keyword = $('#keyword_pasien').val();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/TabelPilihPasien.php',
                            data 	:  'keyword='+ keyword,
                            success : function(data){
                                $('#TabelPilihPasien').html(data);
                            }
                        });
                    });
                }
            })
        });
        // Modal Tambah Kunjungan
        $('#ModalTambahKunjungan').on('show.bs.modal', function (e) {
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormTambahKunjungan').html(Loading);
            var id_pasien = $(e.relatedTarget).data('id');
            $.ajax({
                url     : "_Page/Kunjungan/FormTambahKunjungan.php",
                method  : "POST",
                data    : "id_pasien="+id_pasien,
                success: function (data) {
                    $('#FormTambahKunjungan').html(data);
                    $('#TabelPilihDiagnosa').load("_Page/Kunjungan/TabelPilihDiagnosa.php");
                    $('#keyword_diagnosa').keyup(function(){
                        var keyword = $('#keyword_diagnosa').val();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/TabelPilihDiagnosa.php',
                            data 	:  'keyword='+ keyword,
                            success : function(data){
                                $('#TabelPilihDiagnosa').html(data);
                            }
                        });
                    });
                    $('#ClcikCariDiagnosa').click(function(){
                        var keyword = $('#keyword_diagnosa').val();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/TabelPilihDiagnosa.php',
                            data 	:  'keyword='+ keyword,
                            success : function(data){
                                $('#TabelPilihDiagnosa').html(data);
                            }
                        });
                    });
                    //Change tujuan
                    $('#tujuan').change(function(){
                        var tujuan = $('#tujuan').val();
                        if(tujuan=="Rajal"){
                            //disabled ruangan
                            $('#id_ruang_inap').attr('disabled',true);
                        }else{
                            //enabled ruangan
                            $('#id_ruang_inap').attr('disabled',false);
                        }
                    });
                    $('#ProsesSimpanKunjungan').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiSimpanKunjungan').html(Loading);
                        var ProsesSimpanKunjungan=$('#ProsesSimpanKunjungan').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/ProsesSimpanKunjungan.php',
                            data 	: ProsesSimpanKunjungan,
                            success : function(data){
                                $('#NotifikasiSimpanKunjungan').html(data);
                                var NotifikasiSimpanKunjunganBerhasil= $('#NotifikasiSimpanKunjunganBerhasil').html();
                                if(NotifikasiSimpanKunjunganBerhasil=="Berhasil"){
                                    $('#ModalTambahKunjungan').modal('hide');
                                    $('#ModalPilihPasien').modal('hide');
                                    $('#ModalNotifikasiTambahKunjungan').modal('show');
                                    $('#TabelKunjungan').load('_Page/Kunjungan/TabelKunjungan.php');
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Edit Ruang Inap
        $('#ModalEditKunjungan').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_kunjungan=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormEditKunjungan').html(Loading);
            $.ajax({
                url     : "_Page/Kunjungan/FormEditKunjungan.php",
                method  : "POST",
                data    : {id_kunjungan: id_kunjungan},
                success: function (data) {
                    $('#FormEditKunjungan').html(data);
                    $('#keyword_diagnosa2').keyup(function(){
                        var keyword = $('#keyword_diagnosa2').val();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/TabelPilihDiagnosa.php',
                            data 	:  'keyword='+ keyword,
                            success : function(data){
                                $('#TabelPilihDiagnosa2').html(data);
                            }
                        });
                    });
                    $('#ClcikCariDiagnosa2').click(function(){
                        var keyword = $('#keyword_diagnosa2').val();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/TabelPilihDiagnosa.php',
                            data 	:  'keyword='+ keyword,
                            success : function(data){
                                $('#TabelPilihDiagnosa2').html(data);
                            }
                        });
                    });
                    //Change tujuan
                    $('#tujuan').change(function(){
                        var tujuan = $('#tujuan').val();
                        if(tujuan=="Rajal"){
                            //disabled ruangan
                            $('#id_ruang_inap').attr('disabled',true);
                        }else{
                            //enabled ruangan
                            $('#id_ruang_inap').attr('disabled',false);
                        }
                    });
                    $('#ProsesEditKunjungan').submit(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiEditKunjungan').html(Loading);
                        var ProsesEditKunjungan=$('#ProsesEditKunjungan').serialize();
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/ProsesEditKunjungan.php',
                            data 	: ProsesEditKunjungan,
                            success : function(data){
                                $('#NotifikasiEditKunjungan').html(data);
                                var NotifikasiEditKunjunganBerhasil= $('#NotifikasiEditKunjunganBerhasil').html();
                                if(NotifikasiEditKunjunganBerhasil=="Berhasil"){
                                    $('#ModalEditKunjungan').modal('hide');
                                    $('#ModalNotifikasiEditKunjungan').modal('show');
                                    $('#TabelKunjungan').load("_Page/Kunjungan/TabelKunjungan.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal Delete Kunjungan
        $('#ModalDeleteKunjungan').on('show.bs.modal', function (e) {
            var DataId = $(e.relatedTarget).data('id');
            //Explode DataId
            var DataIdArray=DataId.split(",");
            var id_kunjungan=DataIdArray[0];
            var page=DataIdArray[1];
            var batas=DataIdArray[2];
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormDeleteKunjungan').html(Loading);
            $.ajax({
                url     : "_Page/Kunjungan/FormDeleteKunjungan.php",
                method  : "POST",
                data    : {id_kunjungan: id_kunjungan},
                success: function (data) {
                    $('#FormDeleteKunjungan').html(data);
                    $('#ClickDeleteKunjungan').click(function(){
                        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
                        $('#NotifikasiHapusKunjungan').html(Loading);
                        $.ajax({
                            type 	: 'POST',
                            url 	: '_Page/Kunjungan/ProsesHapusKunjungan.php',
                            data    : {id_kunjungan: id_kunjungan},
                            success : function(data){
                                $('#NotifikasiHapusKunjungan').html(data);
                                var NotifikasiHapusKunjunganBerhasil= $('#NotifikasiHapusKunjunganBerhasil').html();
                                if(NotifikasiHapusKunjunganBerhasil=="Berhasil"){
                                    $('#ModalDeleteKunjungan').modal('hide');
                                    $('#ModalNotifikasiDeleteKunjungan').modal('show');
                                    $('#TabelKunjungan').load("_Page/Kunjungan/TabelKunjungan.php");
                                }
                            }
                        });
                    });
                }
            })
        });
        // Modal detail Kunjungan
        $('#ModalDetailKunjungan').on('show.bs.modal', function (e) {
            var id_kunjungan = $(e.relatedTarget).data('id');
            var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
            $('#FormDetailKunjungan').html(Loading);
            $.ajax({
                url     : "_Page/Kunjungan/FormDetailKunjungan.php",
                method  : "POST",
                data    : {id_kunjungan: id_kunjungan},
                success: function (data) {
                    $('#FormDetailKunjungan').html(data);
                }
            })
        });
    });
</script>