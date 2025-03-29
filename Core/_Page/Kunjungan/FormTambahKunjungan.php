<?php
    //Connection
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
    <form action="javascript:void(0);" id="ProsesSimpanKunjungan">
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
                    <input type="date" name="tanggal" id="tanggal" class="form-control border-dark" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="tujuan">Tujuan</label>
                    <select name="tujuan" id="tujuan" class="form-control border-dark" required>
                        <option value="">Pilih</option>
                        <option value="Rajal">Rajal</option>
                        <option value="Ranap">Ranap</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="keluhan">Keluhan Penyakit</label>
                    <input type="text" name="keluhan" id="keluhan" class="form-control border-dark">
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
                                echo '<option value="'.$row['id_dokter'].'">'.$row['dokter'].'-'.$row['poliklinik'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="id_ruang_inap">Ruang Inap</label>
                    <select name="id_ruang_inap" id="id_ruang_inap" class="form-control border-dark">
                        <option value="">Pilih</option>
                        <?php
                            //tampilkan ruang_inap
                            $sql = "SELECT * FROM ruang_inap";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$row['id_ruang_inap'].'">'.$row['kelas'].'-'.$row['ruangan'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8"></div>
                <div class="input-group col-md-4" id="ProsesCariDiagnosa">
                    <input type="text" name="keyword_diagnosa" id="keyword_diagnosa" class="form-control form-control-md">
                    <button type="button" class="btn btn-md btn-secondary" id="ClcikCariDiagnosa">
                        Cari
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3" id="TabelPilihDiagnosa">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control border-dark" required>
                        <option value="">Pilih</option>
                        <option value="Terdaftar">Terdaftar</option>
                        <option value="Pulang">Pulang</option>
                        <option value="Meninggal">Meninggal</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label for="tanggal_pulang">Tanggal Pulang/Meninggal</label>
                    <input type="date" name="tanggal_pulang" id="tanggal_pulang" class="form-control border-dark">
                </div>
                <div class="col-md-3 mt-3">
                    <label for="jam_pulang">Jam Pulang/Meninggal</label>
                    <input type="time" name="jam_pulang" id="jam_pulang" class="form-control border-dark">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" id="NotifikasiSimpanKunjungan">
                    <span class="text-primary">Pastikan data yang input sudah sesuai</span>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-dark">
            <div class="row">
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-lg btn-rounded btn-primary mr-3">
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