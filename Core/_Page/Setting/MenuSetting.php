<?php
    //Tangkap Subhalaman
    if(!empty($_POST['SubHalaman'])){
        $SubHalaman=$_POST['SubHalaman'];
    }else{
        $SubHalaman="SettingAplikasi";
    }
?>
<script>
    $(document).ready(function(){
        var Loading='<div class="row text-center"><div class="form-group col col-md-12"><img src="images/loading.gif"></div></div>';
        //LembarNota
        $('#LembarNota').click(function(){
            var SubHalaman = "LembarNota";
            $('#FormSetting').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/FormSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#FormSetting').html(data);
                }
            });
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/MenuSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#MenuSetting').html(data);
                }
            });
        });
        //LembarBarcode
        $('#LembarBarcode').click(function(){
            var SubHalaman = "LembarBarcode";
            $('#FormSetting').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/FormSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#FormSetting').html(data);
                }
            });
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/MenuSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#MenuSetting').html(data);
                }
            });
        });
        //LembarLaporan
        $('#LembarLaporan').click(function(){
            var SubHalaman = "LembarLaporan";
            $('#FormSetting').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/FormSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#FormSetting').html(data);
                }
            });
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/MenuSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#MenuSetting').html(data);
                }
            });
        });
        //LembarLabel
        $('#LembarLabel').click(function(){
            var SubHalaman = "LembarLabel";
            $('#FormSetting').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/FormSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#FormSetting').html(data);
                }
            });
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/MenuSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#MenuSetting').html(data);
                }
            });
        });
        //Setting Aplikasi
        $('#SettingAplikasi').click(function(){
            var SubHalaman = "SettingAplikasi";
            $('#FormSetting').html(Loading);
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/FormSettingAplikasi.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#FormSetting').html(data);
                }
            });
            $.ajax({
                type 	: 'POST',
                url 	: '_Page/Setting/MenuSetting.php',
                data 	:  'SubHalaman='+ SubHalaman,
                success : function(data){
                    $('#MenuSetting').html(data);
                }
            });
        });
    });
</script>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card text-center">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="card <?php if($SubHalaman=="SettingAplikasi"){echo "bg-inverse-primary";}else{echo "bg-inverse-dark";} ?>" id="SettingAplikasi">
            <div class="card-body">
                <i class="mdi mdi-content-save-settings icon-lg"></i><br>
                Apps
            </div>
        </div>
    </div>
    <!-- <div class="col-md-4 grid-margin stretch-card text-center">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="card <?php if($SubHalaman=="LembarNota"){echo "bg-inverse-primary";}else{echo "bg-inverse-dark";} ?>" id="LembarNota">
            <div class="card-body">
                <i class="mdi mdi-note icon-lg"></i><br>
                Nota
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card text-center">
        <div tabindex="0" onmousemove="this.style.cursor='pointer'" class="card <?php if($SubHalaman=="LembarLaporan"){echo "bg-inverse-primary";}else{echo "bg-inverse-dark";} ?>" id="LembarLaporan">
            <div class="card-body">
                <i class="mdi mdi-printer-settings icon-lg"></i><br>
                Laporan
            </div>
        </div>
    </div> -->
</div>
