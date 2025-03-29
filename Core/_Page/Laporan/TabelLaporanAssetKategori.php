<div class="row">
        <div class="form-group col-sm-12 text-center">
            <h3>LAPORAN JUMLAH NILAI ASSET</h3>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12 text-center">
            <a href="<?php echo '_Page/Laporan/CetakAssetKategoriHtml.php?mode_laporan='.$mode_laporan.'&ShortBy='.$ShortBy.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-web"></i> Html
            </a>
            <a href="<?php echo '_Page/Laporan/CetakAssetKategoriExcel.php?mode_laporan='.$mode_laporan.'&ShortBy='.$ShortBy.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-file-excel"></i> Excel
            </a>
            <a href="<?php echo '_Page/Laporan/CetakAssetKategoriPdf.php?mode_laporan='.$mode_laporan.'&ShortBy='.$ShortBy.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-file-pdf"></i> PDF
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="table-responsive" style="height: 400px; overflow-y: scroll;">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th align="center"><b>No</b></th>
                            <th align="center"><b>Kategori</b></th>
                            <th align="center"><b>Jumlah</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $JumlahAsset=0;
                            $QryKategori = mysqli_query($conn, "SELECT DISTINCT kategori FROM obat ORDER BY kategori $ShortBy");
                            while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                                $kategori= $DataKategori['kategori'];
                                $JumlahAssetByategori=0;
                                //KONDISI PENGATURAN MASING FILTER
                                $query = mysqli_query($conn, "SELECT*FROM obat WHERE kategori='$kategori' ORDER BY nama $ShortBy");
                                while ($data = mysqli_fetch_array($query)) {
                                    $stok = $data['stok'];
                                    $harga_acuan = $data[$harga];
                                    $jumlah=$stok*$harga_acuan;
                                    $JumlahAssetByategori=$JumlahAssetByategori+$jumlah;
                                }
                                $JumlahAsset=$JumlahAsset+$JumlahAssetByategori;
                        ?>
                            <tr>
                                <td align="center"><?php echo "$no";?></td>
                                <td><?php echo "$kategori";?></td>
                                <td align="right"><?php echo "Rp " . number_format($JumlahAssetByategori,0,',','.'); ?></td>
                            </tr>
                        <?php 
                            $no++;} 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <b>JUMLAH ASSET/NOMINAL</b>
        </div>
        <div class="col-md-6 text-right">
            <?php echo "Rp " . number_format($JumlahAsset,0,',','.'); ?>
        </div>
    </div>
</div>