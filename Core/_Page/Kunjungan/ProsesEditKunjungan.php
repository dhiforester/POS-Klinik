<?php
    //Conncetion
    include "../../_Config/Connection.php";
    include "../../_Config/SessionLogin.php";
    //Tangkap data
    if(empty($_POST['id_kunjungan'])){
        echo '<span class="text-danger">ID Kunjungan Tidak Boleh Kosong!!</span>';
    }else{
        //Tangkap data
        if(empty($_POST['id_pasien'])){
            echo '<span class="text-danger">ID Pasien Tidak Boleh Kosong!!</span>';
        }else{
            if(empty($_POST['nama'])){
                echo '<span class="text-danger">Nama Pasien Tidak Boleh Kosong!!</span>';
            }else{
                if(empty($_POST['tanggal'])){
                    echo '<span class="text-danger">Tanggal Kunjungan Tidak Boleh Kosong!!</span>';
                }else{
                    if(empty($_POST['tujuan'])){
                        echo '<span class="text-danger">Tujuan Kunjungan Tidak Boleh Kosong!!</span>';
                    }else{
                        if(empty($_POST['keluhan'])){
                            echo '<span class="text-danger">Keluhan Penyakit Tidak Boleh Kosong!!</span>';
                        }else{
                            if(empty($_POST['id_dokter'])){
                                echo '<span class="text-danger">ID Dokter Tidak Boleh Kosong!!</span>';
                            }else{
                                if(empty($_POST['id_diagnosa'])){
                                    echo '<span class="text-danger">ID Diagnosa Tidak Boleh Kosong!!</span>';
                                }else{
                                    if(empty($_POST['status'])){
                                        echo '<span class="text-danger">ID Diagnosa Tidak Boleh Kosong!!</span>';
                                    }else{
                                        $id_kunjungan = $_POST['id_kunjungan'];
                                        $id_pasien = $_POST['id_pasien'];
                                        $nama = $_POST['nama'];
                                        $tanggal = $_POST['tanggal'];
                                        $tujuan = $_POST['tujuan'];
                                        $keluhan = $_POST['keluhan'];
                                        $id_dokter = $_POST['id_dokter'];
                                        $id_diagnosa = $_POST['id_diagnosa'];
                                        $status = $_POST['status'];
                                        if(empty($_POST['id_ruang_inap'])){
                                            $id_ruang_inap="0";
                                        }else{
                                            $id_ruang_inap=$_POST['id_ruang_inap'];
                                        }
                                        if(empty($_POST['tanggal_pulang'])){
                                            $tanggal_pulang="";
                                        }else{
                                            $tanggal_pulang=$_POST['tanggal_pulang'];
                                        }
                                        if(empty($_POST['jam_pulang'])){
                                            $jam_pulang="";
                                        }else{
                                            $jam_pulang=$_POST['jam_pulang'];
                                        }
                                        $TanggalPulang="$tanggal_pulang $jam_pulang";
                                        //Buka dokter
                                        $sqlDokter = "SELECT * FROM dokter WHERE id_dokter='$id_dokter'";
                                        $resultDokter = mysqli_query($conn, $sqlDokter);
                                        $rowDokter = mysqli_fetch_assoc($resultDokter);
                                        $dokter = $rowDokter['dokter'];
                                        //Buka data ruangan
                                        $sqlRuang = "SELECT * FROM ruang_inap WHERE id_ruang_inap='$id_ruang_inap'";
                                        $resultRuang = mysqli_query($conn, $sqlRuang);
                                        $rowRuang = mysqli_fetch_assoc($resultRuang);
                                        $kelas = $rowRuang['kelas'];
                                        $ruangan = $rowRuang['ruangan'];
                                        //Simpan update kunjungan
                                        $sqlUpdateKunjungan = "UPDATE kunjungan SET 
                                            id_pasien='$id_pasien', 
                                            nama='$nama', 
                                            tanggal='$tanggal', 
                                            keluhan='$keluhan', 
                                            tujuan='$tujuan', 
                                            id_dokter='$id_dokter', 
                                            dokter='$dokter', 
                                            id_ruang_inap='$id_ruang_inap', 
                                            kelas='$kelas',
                                            ruangan='$ruangan',
                                            id_diagnosa='$id_diagnosa', 
                                            tanggal_keluar='$TanggalPulang',
                                            status='$status', 
                                            id_akses='$SessionIdAkses',
                                            nama_petugas='$SessionNama'
                                        WHERE id_kunjungan='$id_kunjungan'";
                                        $resultUpdateKunjungan = mysqli_query($conn, $sqlUpdateKunjungan);
                                        if($resultUpdateKunjungan){
                                            echo '<span class="text-success" id="NotifikasiEditKunjunganBerhasil">Berhasil</span>';
                                        }else{
                                            echo '<span class="text-danger">Kunjungan Gagal Disimpan!!</span>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>