<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/SettingCetakLabelResep.php";
?>
    <html>
        <Header>
            <title>Cetak Antrian</title>
            <style type="text/css">
                body{
                    font-family: <?php echo $NamaFornSettingLabelResep;?>;
                    color: <?php echo "$WarnaFornSettingLabelResep";?>;
                    font-size: <?php echo "$UkuranFornSettingLabelResep";?>;
                }
                div.card{
                    border: 1px solid #999;
                    width: <?php echo "$PanjangSettingLabelResep";?>;
                    height: <?php echo "$LebarSettingLabelResep";?>;
                }
                div.inside{
                    margin-top: <?php echo "$MarginAtasSettingLabelResep";?>;
                    margin-bottom: <?php echo "$MarginBawahLabelResep";?>;
                    margin-left: <?php echo "$MarginKiriLabelResep";?>;
                    margin-right: <?php echo "$MarginKananLabelResep";?>;
                    font-size: <?php echo "$UkuranFornSettingLabelResep";?>;
                }
                table tr td{
                    padding: 4px;
                    font-size: <?php echo "$UkuranFornSettingLabelResep";?>;
                }
                table tr td.bordertop{
                    border-top: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingLabelResep";?>;
                }
                table tr td.borderbottom{
                    border-bottom: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingLabelResep";?>;
                }
            </style>
        </Header>
        <body>
            <div class="card">
                <div class="inside">
                    <table width="100%">
                        <tr>
                            <td align="center" class="borderbottom">
                                <?php
                                    if($LogoLabelResep=="Ya"){
                                        echo '<img src="../../images/'.$logo.'" width="'.$PanjangLogoLabelResep.'" heigth="'.$LebarLogoLabelResep.'"></img><br>';
                                    }
                                ?>
                                <b><?php echo "$nama_perusahaan";?></b><br>
                                <i><?php echo "$alamat";?></i><br>
                            </td>
                        </tr>
                        <tr>
                            <?php
                                if($BarcodeLabelResep=="Ya"){
                                    echo ' <td align="center">';
                                    echo '      <b>Amocscilin</b><br>';
                                    echo '      <img src="../../vendors/barcode/barcode_2.php?size='.$UkuranBarcodeLabelResep.'&text=123000120101"/>';
                                    echo '      <br><b>123000120101</b>';
                                    echo ' </td>';
                                }
                            ?>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td><b>No.RM</b></td>
                            <td><b>:</b></td>
                            <td>001312</td>
                        </tr>
                        <tr>
                            <td><b>Nama Pasien</dt></td>
                            <td><b>:</dt></td>
                            <td>Mr/Mrs Anonimous</td>
                        </tr>
                        <tr>
                            <td valign="top"><b>Apoteker</dt></td>
                            <td valign="top"><b>:</dt></td>
                            <td valign="top">Mr/Mrs Anonimous</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="left" class="bordertop">
                                <b>Petunjuk Penggunaan : </b><br>
                                Diminum 3 X 1
                                <br><br>
                                <b>Waktu : </b><br>
                                Pagi, Siang dan Malam<br><br>
                                <b>Keterangan : </b><br>
                                Dihabiskan!!
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <?php
                                if($KutipanBawahLabelResep=="Ya"){
                                    echo ' <td align="center" class="bordertop">';
                                    echo '      <i>'.$IsiKutipanLabelResep.'</i>';
                                    echo ' </td>';
                                }
                            ?>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
    </html>
