<div class="row">
        <div class="form-group col-sm-12 text-center">
            <h3>LAPORAN JUMLAH NILAI ASSET</h3>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12 text-center">
            <a href="<?php echo '_Page/Laporan/CetakAssetItemHtml.php?harga='.$harga.'&ShortBy='.$ShortBy.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-web"></i> HTML
            </a>
            <a href="<?php echo '_Page/Laporan/CetakAssetItemExcel.php?harga='.$harga.'&ShortBy='.$ShortBy.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
                <i class="mdi mdi-file-excel"></i> Excel
            </a>
            <a href="<?php echo '_Page/Laporan/CetakAssetItemPdf.php?harga='.$harga.'&ShortBy='.$ShortBy.'';?>" class="btn btn-rounded btn-outline-dark" target="_blank">
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
                            <th><b>No</b></th>
                            <th><b>Kode</b></th>
                            <th><b>Nama Barang</b></th>
                            <th><b>Kategori</b></th>
                            <th><b>Qty</b></th>
                            <th><b>Harga</b></th>
                            <th><b>Jumlah</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $JumlahAsset=0;
                            //KONDISI PENGATURAN MASING FILTER
                            $query = mysqli_query($conn, "SELECT*FROM obat ORDER BY nama $ShortBy");
                            while ($data = mysqli_fetch_array($query)) {
                                $id_obat = $data['id_obat'];
                                $kode = $data['kode'];
                                $NamaBarang = $data['nama'];
                                $kategori = $data['kategori'];
                                $satuan = $data['satuan'];
                                $stok = $data['stok'];
                                $harga_acuan = $data[$harga];
                                //Rp Harga
                                $RpHarga = "Rp ".number_format($harga_acuan,0,',','.');
                                $jumlah=$stok*$harga_acuan;
                                $RpJumlah = "Rp ".number_format($jumlah,0,',','.');
                                $JumlahAsset=$JumlahAsset+$jumlah;
                        ?>
                        <tr>
                            <td align="center"><?php echo "$no";?></td>
                            <td><?php echo "$kode";?></td>
                            <td><?php echo "$NamaBarang";?></td>
                            <td><?php echo "$kategori";?></td>
                            <td><?php echo "$stok $satuan";?></td>
                            <td align="right"><?php echo "$RpHarga";?></td>
                            <td align="right"><?php echo "$RpJumlah";?></td>
                        </tr>
                        <?php $no++;} ?>
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