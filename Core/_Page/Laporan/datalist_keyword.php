<?php
    echo '<label>Order By</label>';
    echo '<select name="order_by" id="order_by" class="form-control border-dark">';
    echo '  <option value="">Semua Kategori</option>';
    include "../../_Config/Connection.php";
    $Query = mysqli_query($conn, "SELECT DISTINCT kategori FROM obat");
    while ($data = mysqli_fetch_array($Query)) {
        $kategori = $data['kategori'];
        if(!empty($data['kategori'])){
            echo '<option value="'.$kategori.'">'.$kategori.'</option>';
        }
    }
    echo '</select>';
?>