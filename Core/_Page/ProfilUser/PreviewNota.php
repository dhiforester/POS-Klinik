<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/SettingCetakNota.php";
?>
    <html>
        <Header>
            <title>Cetak Antrian</title>
            <style type="text/css">
                body{
                    font-family: <?php echo $NamaFornSettingNota;?>;
                    color: <?php echo "$WarnaFornSettingNota";?>;
                    font-size: <?php echo "$UkuranFornSettingNota";?>;
                }
                div.card{
                    border: 1px solid #999;
                    width: <?php echo "$PanjangSettingNota";?>;
                    height: <?php echo "$LebarSettingNota";?>;
                }
                div.inside{
                    margin-top: <?php echo "$MarginAtasSettingNota";?>;
                    margin-bottom: <?php echo "$MarginBawahNota";?>;
                    margin-left: <?php echo "$MarginKiriNota";?>;
                    margin-right: <?php echo "$MarginKananNota";?>;
                    font-size: <?php echo "$UkuranFornSettingNota";?>;
                }
                table tr td{
                    padding: 0px;
                    font-size: <?php echo "$UkuranFornSettingNota";?>;
                }
                table tr td.bordertop{
                    border-top: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingNota";?>;
                }
                table tr td.borderbottom{
                    border-bottom: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingNota";?>;
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
                                    if($LogoNota=="Ya"){
                                        echo '<img src="../../images/'.$logo.'" width="'.$PanjangLogoNota.'" heigth="'.$LebarLogoNota.'"></img><br>';
                                    }
                                ?>
                                <b><?php echo "$nama_perusahaan";?></b><br>
                                <i><?php echo "$alamat";?></i><br>
                            </td>
                        </tr>
                        <tr>
                            <?php
                                if($BarcodeNota=="Ya"){
                                    echo ' <td align="center">';
                                    echo '      <img src="../../vendors/barcode/barcode_2.php?size='.$UkuranBarcodeNota.'&text=PNJ00012"/>';
                                    echo '      <br><b>ID: PNJ00012</b>';
                                    echo ' </td>';
                                }
                            ?>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td class="bordertop" colspan="3"></td>
                        </tr>
                        <tr>
                            <td><b>ID Transaksi</b></td>
                            <td><b>:</b></td>
                            <td>PNJ00012</td>
                        </tr>
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
                            <td valign="top"><b>Tanggal</dt></td>
                            <td valign="top"><b>:</dt></td>
                            <td valign="top">13 Mei 2022</td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td class="bordertop" colspan="4"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>No</b></td>
                            <td align="center"><b>Keterangan</b></td>
                            <td align="center"><b>QTy</b></td>
                            <td align="center"><b>Jumlah</b></td>
                        </tr>
                        <tr>
                            <td class="bordertop" colspan="4"></td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>Amocscilin (2.000)</td>
                            <td align="center">8</td>
                            <td align="right">16.000</td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>Paracetamol (1.000)</td>
                            <td align="center">8</td>
                            <td align="right">8.000</td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>Asam Mafenamat (1.500)</td>
                            <td align="center">10</td>
                            <td align="right">15.000</td>
                        </tr>
                        <tr>
                            <td class="bordertop" colspan="3"><b>Subtotal</b></td>
                            <td class="bordertop" align="right">39.000</td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>PPN (10%)</b></td>
                            <td align="right">0</td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Pembayaran</b></td>
                            <td align="right">50.000</td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Kembalian</b></td>
                            <td align="right">11.000</td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <?php
                                if($KutipanBawahNota=="Ya"){
                                    echo ' <td align="center" class="bordertop">';
                                    echo '      <i>'.$IsiKutipanNota.'</i>';
                                    echo ' </td>';
                                }
                            ?>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
    </html>
