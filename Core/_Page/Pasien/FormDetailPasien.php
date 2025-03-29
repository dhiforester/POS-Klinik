<?php
    //connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_pasien'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <span class="text-danger">Maaf, ID Ruangan Tidak Dapat Di Tangkap Oleh Sistem!!</span>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-primary">';
        echo '  <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">';
        echo '      <i class="mdi mdi-close"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        //Tampilkan Data ruang inap
        $id_pasien = $_POST['id_pasien'];
        $sql = "SELECT * FROM pasien WHERE id_pasien='$id_pasien'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nik=$row['nik'];
        $nama=$row['nama'];
        $gender=$row['gender'];
        $tanggal_lahir=$row['tanggal_lahir'];
        $alamat=$row['alamat'];
        $kontak=$row['kontak'];
        $status=$row['status'];
        $updatetime=$row['updatetime'];
?>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <table class="" width="100%">
                    <tbody>
                        <tr>
                            <td><b>No.RM</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$id_pasien"; ?></td>
                        </tr>
                        <tr>
                            <td><b>NIK</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$nik"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama Lengkap</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$nama"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Gender</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$gender"; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="" width="100%">
                    <tbody>
                        <tr>
                            <td><b>Tanggal Lahir</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$tanggal_lahir"; ?></td>
                        </tr>
                        <tr>
                            <td><b>No. Kontak</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$kontak"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$status"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Updatetime</b></td>
                            <td><b>:</b></td>
                            <td><?php echo "$updatetime"; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="" width="100%">
                    <tbody>
                        <tr>
                            <td valign="top"><b>Alamat</b></td>
                            <td valign="top"><b>:</b></td>
                            <td valign="top"><?php echo "$alamat"; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" class="table table-responsive pre-scrollable bg-light">
                <b>Data Kunjungan Pasien</b>
                <table class="table table-bordered table-hover" width="100%">
                    <thead class="bg-dark">
                        <tr>
                            <th class="text-center text-light">No</th>
                            <th class="text-center text-light">Tanggal</th>
                            <th class="text-center text-light">Kunjungan</th>
                            <th class="text-center text-light">Dokter</th>
                            <th class="text-center text-light">Ruang/Kelas</th>
                            <th class="text-center text-light">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $jml_data = mysqli_num_rows(mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_pasien='$id_pasien'"));
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="6" class="text-center">';
                                echo '      <span class="text-danger">Data Kunjungan Pasien Belum Ada!!</span>';
                                echo '  </td>';
                            }else{
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT*FROM kunjungan WHERE id_pasien='$id_pasien' ORDER BY id_kunjungan DESC");
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_kunjungan = $data['id_kunjungan'];
                                    $id_pasien= $data['id_pasien'];
                                    $nama = $data['nama'];
                                    $tanggal = $data['tanggal'];
                                    $tujuan = $data['tujuan'];
                                    $dokter = $data['dokter'];
                                    $kelas = $data['kelas'];
                                    $ruangan = $data['ruangan'];
                                    $status = $data['status'];
                                    //Zero padding id_pasien
                                    $NoRm = sprintf('%05d', $id_pasien);
                                    if($status=="Terdaftar"){
                                        $LabelStatus='<span class="badge badge-primary">Terdaftar</span>';
                                    }else{
                                        if($status=="Meninggal"){
                                            $LabelStatus='<span class="badge badge-danger">Meninggal</span>';
                                        }else{
                                            if($status=="Pulang"){
                                                $LabelStatus='<span class="badge badge-success">Pulang</span>';
                                            }else{
                                                $LabelStatus='<span class="badge badge-secondary">None</span>';
                                            }
                                        }
                                    }
                                    if(empty($ruangan)){
                                        $ruangan="None";
                                    }else{
                                        $ruangan="$ruangan/$kelas";
                                    }
                                    echo '<tr>';
                                    echo '  <td class="text-center">'.$no.'</td>';
                                    echo '  <td>'.$tanggal.'</td>';
                                    echo '  <td>'.$tujuan.'</td>';
                                    echo '  <td>'.$dokter.'</td>';
                                    echo '  <td>'.$ruangan.'</td>';
                                    echo '  <td class="text-center">'.$LabelStatus.'</td>';
                                    echo '</tr>';
                                    $no++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-primary">
        <div class="row">
            <div class="form-group col-md-12 text-center">
                <a href="_Page/Pasien/CetakKartuPdf.php?id_pasien=<?php echo "$id_pasien";?>" target="_blank" class="btn btn-lg btn-rounded btn-dark mr-3">
                    <i class="mdi mdi-printer"></i> Cetak Kartu (PDF)
                </a>
                <a href="_Page/Pasien/CetakKartuHtml.php?id_pasien=<?php echo "$id_pasien";?>" target="_blank" class="btn btn-lg btn-rounded btn-dark mr-3">
                    <i class="mdi mdi-printer"></i> Cetak Kartu (HTML)
                </a>
                <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">
                    <i class="mdi mdi-close"></i> Tutup
                </button>
            </div>
        </div>
    </div>
<?php } ?>