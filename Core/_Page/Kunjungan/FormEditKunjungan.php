<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_kunjungan'])){
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
        $id_kunjungan = $_POST['id_kunjungan'];
        $sql = "SELECT * FROM kunjungan WHERE id_kunjungan='$id_kunjungan'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id_pasien=$row['id_pasien'];
        $tanggal=$row['tanggal'];
        $tujuan=$row['tujuan'];
        $keluhan=$row['keluhan'];
        $id_ruang_inap=$row['id_ruang_inap'];
        $id_dokter=$row['id_dokter'];
        $tanggal_keluar=$row['tanggal_keluar'];
        $id_diagnosa=$row['id_diagnosa'];
        $status=$row['status'];
        //Explode $tanggal_keluar
        $tanggal_keluar_explode = explode(" ", $tanggal_keluar);
        $tanggal_pulang = $tanggal_keluar_explode[0];
        $jam_pulang = $tanggal_keluar_explode[1];
        //Buka data pasien
        $sql2 = "SELECT * FROM pasien WHERE id_pasien='$id_pasien'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $nama=$row2['nama'];
        //Buka Diagnosa
        $sql3 = "SELECT * FROM diagnosa WHERE id_diagnosa='$id_diagnosa'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $kode_diagnosa=$row3['kode'];
        $short_des=$row3['short_des'];
        $versi=$row3['versi'];
?>
    <form action="javascript:void(0);" id="ProsesEditKunjungan">
        <input type="hidden" name="id_kunjungan" id="id_kunjungan" value="<?php echo "$id_kunjungan"; ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3 mt-3">
                    <label for="id_pasien">No.RM</label>
                    <input type="text" readonly name="id_pasien" id="id_pasien" class="form-control border-dark" value="<?php echo "$id_pasien"; ?>">
                </div>
                <div class="col-md-3 mt-3">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control border-dark" value="<?php echo "$nama"; ?>" required>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control border-dark" value="<?php echo "$tanggal"; ?>" required>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="tujuan">Tujuan</label>
                    <select name="tujuan" id="tujuan" class="form-control border-dark" required>
                        <option <?php if($tujuan==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($tujuan=="Rajal"){echo "selected";} ?> value="Rajal">Rajal</option>
                        <option <?php if($tujuan=="Ranap"){echo "selected";} ?> value="Ranap">Ranap</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="keluhan">Keluhan Penyakit</label>
                    <input type="text" name="keluhan" id="keluhan" class="form-control border-dark" value="<?php echo "$keluhan"; ?>">
                </div>
                <div class="col-md-3 mt-3">
                    <label for="id_dokter">Dokter</label>
                    <select name="id_dokter" id="id_dokter" class="form-control border-dark" required>
                        <option value="">Pilih</option>
                        <?php
                            //tampilkan dokter
                            $sql = "SELECT * FROM dokter WHERE status='Aktif'";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                if($row['id_dokter']==$id_dokter){
                                    echo '<option selected value="'.$row['id_dokter'].'">'.$row['dokter'].'-'.$row['poliklinik'].'</option>';
                                }else{
                                    echo '<option value="'.$row['id_dokter'].'">'.$row['dokter'].'-'.$row['poliklinik'].'</option>';
                                }
                                
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="id_ruang_inap">Ruang Inap</label>
                    <select <?php if($tujuan=="Rajal"){echo "disabled";} ?> name="id_ruang_inap" id="id_ruang_inap" class="form-control border-dark">
                        <option value="">Pilih</option>
                        <?php
                            //tampilkan ruang_inap
                            $sql = "SELECT * FROM ruang_inap";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                if($id_ruang_inap==$row['id_ruang_inap']){
                                    echo '<option selected value="'.$row['id_ruang_inap'].'">'.$row['kelas'].'-'.$row['ruangan'].'</option>';
                                }else{
                                    echo '<option value="'.$row['id_ruang_inap'].'">'.$row['kelas'].'-'.$row['ruangan'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8"></div>
                <div class="input-group col-md-4" id="ProsesCariDiagnosa">
                    <input type="text" name="keyword_diagnosa2" id="keyword_diagnosa2" class="form-control form-control-md">
                    <button type="button" class="btn btn-md btn-secondary" id="ClcikCariDiagnosa2">
                        Cari
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3" id="TabelPilihDiagnosa2">
                    <div class="row mb-3">
                        <div class="col-md-12 bg-white" style="height: 350px; overflow-y: scroll;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Short Des</th>
                                            <th>Versi</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr for="">
                                            <td class="text-center">1</td>
                                            <td class="text-left"><?php echo "$kode_diagnosa";?></td>
                                            <td class="text-left"><?php echo "$short_des";?></td>
                                            <td class="text-center"><?php echo "$versi";?></td>
                                            <td align="center" valign="center" class="text-center" width="10%">
                                                <input class="form-check-input" checked type="radio" name="id_diagnosa" id="id_diagnosa" value="<?php echo "$id_diagnosa";?>">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control border-dark" required>
                        <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                        <option <?php if($status=="Terdaftar"){echo "selected";} ?> value="Terdaftar">Terdaftar</option>
                        <option <?php if($status=="Pulang"){echo "selected";} ?> value="Pulang">Pulang</option>
                        <option <?php if($status=="Meninggal"){echo "selected";} ?> value="Meninggal">Meninggal</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="tanggal_pulang">Tanggal Pulang/Meninggal</label>
                    <input type="date" name="tanggal_pulang" id="tanggal_pulang" class="form-control border-dark" value="<?php echo "$tanggal_pulang";?>">
                </div>
                <div class="col-md-3 mt-3">
                    <label for="jam_pulang">Jam Pulang/Meninggal</label>
                    <input type="time" name="jam_pulang" id="jam_pulang" class="form-control border-dark" value="<?php echo "$jam_pulang";?>">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" id="NotifikasiEditKunjungan">
                    <span class="text-primary">Pastikan data yang input sudah sesuai</span>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-primary">
            <div class="row">
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-lg btn-rounded btn-dark mr-3">
                        <i class="mdi mdi-floppy"></i> Simpan
                    </button>
                    <button class="btn btn-lg btn-rounded btn-secondary" data-dismiss="modal">
                        <i class="mdi mdi-close"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </form>
<?php } ?>