<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SessionLogin.php";
    include "../../_Config/SettingCetakLaporan.php";
?>
    <html>
        <Header>
            <title>Cetak Antrian</title>
            <style type="text/css">
                body{
                    font-family: <?php echo $NamaFornSettingLaporan;?>;
                    color: <?php echo "$WarnaFornSettingLaporan";?>;
                    font-size: <?php echo "$UkuranFornSettingLaporan";?>;
                }
                div.card{
                    border: 1px solid #999;
                    width: <?php echo "$PanjangSettingLaporan";?>;
                    height: <?php echo "$LebarSettingLaporan";?>;
                }
                div.inside{
                    margin-top: <?php echo "$MarginAtasSettingLaporan";?>;
                    margin-bottom: <?php echo "$MarginBawahLaporan";?>;
                    margin-left: <?php echo "$MarginKiriLaporan";?>;
                    margin-right: <?php echo "$MarginKananLaporan";?>;
                    font-size: <?php echo "$UkuranFornSettingLaporan";?>;
                }
                table tr td{
                    padding: 0px;
                    font-size: <?php echo "$UkuranFornSettingLaporan";?>;
                }
                table.Bergaris tr td{
                    border: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingLaporan";?>;
                    padding: 2px;
                }
                table tr td.borderbottom{
                    border-bottom: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingLaporan";?>;
                }
            </style>
        </Header>
        <body>
            <div class="card">
                <div class="inside">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <?php
                                    if($LogoLaporan=="Ya"){
                                        echo '<img src="../../images/'.$logo.'" width="'.$PanjangLogoLaporan.'" heigth="'.$LebarLogoLaporan.'"></img><br>';
                                    }
                                ?>
                                <b><?php echo "$nama_perusahaan";?></b><br>
                                <i><?php echo "$alamat";?></i><br>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" class="Bergaris" cellspacing="0">
                        <tr>
                            <td align="center"><b>No</b></td>
                            <td align="center"><b>Kode</b></td>
                            <td align="center"><b>Transaksi</b></td>
                            <td align="center"><b>Tanggal</b></td>
                            <td align="center"><b>Jumlah</b></td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>PNJ00001</td>
                            <td align="left">Penjualan</td>
                            <td align="left">2022-05-01</td>
                            <td align="right">10.000</td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>PNJ00002</td>
                            <td align="left">Penjualan</td>
                            <td align="left">2022-05-02</td>
                            <td align="right">20.000</td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>PNJ00003</td>
                            <td align="left">Penjualan</td>
                            <td align="left">2022-05-02</td>
                            <td align="right">20.000</td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>PNJ00004</td>
                            <td align="left">Penjualan</td>
                            <td align="left">2022-05-02</td>
                            <td align="right">20.000</td>
                        </tr>
                        <tr>
                            <td align="center">5</td>
                            <td>PNJ00005</td>
                            <td align="left">Penjualan</td>
                            <td align="left">2022-05-02</td>
                            <td align="right">20.000</td>
                        </tr>
                        <tr>
                            <td align="center">6</td>
                            <td>PNJ00006</td>
                            <td align="left">Penjualan</td>
                            <td align="left">2022-05-02</td>
                            <td align="right">20.000</td>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
    </html>
