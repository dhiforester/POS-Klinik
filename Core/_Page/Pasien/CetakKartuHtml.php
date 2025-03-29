<?php
    if(empty($_GET['id_pasien'])){
        echo "Error: ID Pasien tidak ditemukan";
    }else{
        //Koneksi
        date_default_timezone_set('Asia/Jakarta');
        include "../../_Config/Connection.php";
        include "../../_Config/SessionLogin.php";
        include "../../_Config/Setting.php";
        include "../../_Config/SettingCetakKartuPasien.php";
        $id_pasien= $_GET['id_pasien'];
        //Buka data Pasien
        $QryPasien = mysqli_query($conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($conn));
        $DataPasien = mysqli_fetch_array($QryPasien);
        if(empty($DataPasien['id_pasien'])){
            echo "Error: Data Pasien tidak ditemukan";
        }else{
            $noRm=sprintf("%07d", $id_pasien);
            $nik= $DataPasien['nik'];
            $nama= $DataPasien['nama'];
            $gender= $DataPasien['gender'];
            $tanggal_lahir= $DataPasien['tanggal_lahir'];
            $updatetime= $DataPasien['updatetime'];
?>
    <html>
        <Header>
            <title>Cetak Kartu</title>
            <style type="text/css">
                body{
                    font-family: <?php echo $NamaFornSettingKartuPasien;?>;
                    color: <?php echo "$WarnaFornSettingKartuPasien";?>;
                    font-size: <?php echo "$UkuranFornSettingKartuPasien";?>;
                }
                div.card{
                    border: 1px solid #999;
                    width: <?php echo "$PanjangSettingKartuPasien";?>;
                    height: <?php echo "$LebarSettingKartuPasien";?>;
                }
                div.inside{
                    margin-top: <?php echo "$MarginAtasSettingKartuPasien";?>;
                    margin-bottom: <?php echo "$MarginBawahKartuPasien";?>;
                    margin-left: <?php echo "$MarginKiriKartuPasien";?>;
                    margin-right: <?php echo "$MarginKananKartuPasien";?>;
                    font-size: <?php echo "$UkuranFornSettingKartuPasien";?>;
                }
                table tr td{
                    padding: 4px;
                    font-size: <?php echo "$UkuranFornSettingKartuPasien";?>;
                }
                table tr td.bordertop{
                    border-top: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingKartuPasien";?>;
                }
                table tr td.borderbottom{
                    border-bottom: 1px solid #999;
                    font-size: <?php echo "$UkuranFornSettingKartuPasien";?>;
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
                                    if($LogoKartuPasien=="Ya"){
                                        echo '<img src="../../images/'.$logo.'" width="'.$PanjangLogoKartuPasien.'" heigth="'.$LebarLogoKartuPasien.'"></img><br>';
                                    }
                                ?>
                                <b><?php echo "$nama_perusahaan";?></b><br>
                                <i><?php echo "$alamat";?></i><br>
                            </td>
                        </tr>
                        <tr>
                            <?php
                                if($BarcodeKartuPasien=="Ya"){
                                    echo ' <td align="center">';
                                    echo '      <img src="../../vendors/barcode/barcode_2.php?size='.$UkuranBarcodeKartuPasien.'&text='.$id_pasien.'"/>';
                                    echo ' </td>';
                                }
                            ?>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td><b>No.RM</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$id_pasien";?></td>
                        </tr>
                        <tr>
                            <td><b>Nik</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$nik";?></td>
                        </tr>
                        <tr>
                            <td><b>Nama</dt></td>
                            <td><b>:</dt></td>
                            <td><?php echo "$nama";?></td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <?php
                                if($KutipanBawahKartuPasien=="Ya"){
                                    echo ' <td align="center" class="bordertop">';
                                    echo '      <i>'.$IsiKutipanKartuPasien.'</i>';
                                    echo ' </td>';
                                }
                            ?>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
    </html>
<?php }} ?>