<?php
    if(empty($_GET['id_obat'])){
        echo "Error: ID Obat tidak ditemukan";
    }else{
        //Koneksi
        date_default_timezone_set('Asia/Jakarta');
        include "../../_Config/Connection.php";
        include "../../_Config/SessionLogin.php";
        include "../../_Config/Setting.php";
        include "../../_Config/SettingCetakLabelObat.php";
        $id_obat= $_GET['id_obat'];
        //Buka data Pasien
        $QryObat = mysqli_query($conn,"SELECT * FROM obat WHERE id_obat='$id_obat'")or die(mysqli_error($conn));
        $DataObat = mysqli_fetch_array($QryObat);
        if(empty($DataObat['id_obat'])){
            echo "Error: Data Obbat tidak ditemukan";
        }else{
            $KodeObat= $DataObat['kode'];
            $NamaObat= $DataObat['nama'];
            $harga_3= $DataObat['harga_3'];
            //Format RP
            $harga_3=number_format($harga_3,0,',','.');
            //koneksi dan error
            $FileName= "Label-$KodeObat";
            //Config Plugin MPDF
            define('_MPDF_PATH','../../vendors/mpdf60/');
            include(_MPDF_PATH . "mpdf.php");
            $mpdf=new mPDF('utf-8', array($PanjangSettingLabel,$LebarSettingLabel)); 
            $html='<style>@page *{margin-top: '.$MarginAtasSettingLabel.';margin-bottom: '.$MarginBawahLabel.';margin-left: '.$MarginKiriLabel.';margin-right: '.$MarginKananLabel.';}</style>'; 
            //Beginning Buffer to save PHP variables and HTML tags
            ob_start(); 
?>
    <html>
        <Header>
            <title>Cetak Kartu</title>
            <style type="text/css">
                @page {
                    margin-top: <?php echo "$MarginAtasSettingLabel"; ?>;
                    margin-bottom: <?php echo "$MarginBawahLabel"; ?>;
                    margin-left: <?php echo "$MarginKiriLabel"; ?>;
                    margin-right: <?php echo "$MarginKananLabel"; ?>;
                }
                body{
                    font-family: <?php echo $NamaFontSettingLabel;?>;
                    color: <?php echo "$WarnaFontSettingLabel";?>;
                    font-size: <?php echo "$UkuranFontSettingLabel";?>;
                }
                table tr td.bordertop{
                    border-top: 1px solid #999;
                }
                table tr td.borderbottom{
                    border-bottom: 1px solid #999;
                }
            </style>
        </Header>
        <body>
            <table width="100%">
                <tr>
                    <?php
                        echo ' <td align="center">';
                        echo '      <img src="../../vendors/barcode/barcode_2.php?size='.$UkuranBarcodeLabel.'&text='.$KodeObat.'"/><br>';
                        if($KodeObatLabel=="Ya"){
                            echo ''.$KodeObat.'<br>';
                        }
                        if($NamaObatLabel=="Ya"){
                            echo ''.$NamaObat.'<br>';
                        }
                        if($HargaObatLabel=="Ya"){
                            echo 'Rp '.$harga_3.'<br>';
                        }
                        echo ' </td>';
                    ?>
                </tr>
            </table>
        </body>
    </html>
<?php 
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($FileName.".pdf" ,'I');
        exit;
    }
} 
?>