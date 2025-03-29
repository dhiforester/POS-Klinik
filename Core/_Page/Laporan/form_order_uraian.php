<label>Username</label>
<select name="id_akses" id="id_akses" class="form-control border-dark">
    <?php
        //Connection
        include "../../_Config/Connection.php";
        $Query = mysqli_query($conn, "SELECT*FROM akses");
        while ($data = mysqli_fetch_array($Query)) {
            $id_akses = $data['id_akses'];
            $nama = $data['nama'];
            if(!empty($data['id_akses'])){
                echo '<option value="'.$id_akses.'">'.$id_akses.' '.$nama.'</option>';
            }
        }
    ?>
</select>