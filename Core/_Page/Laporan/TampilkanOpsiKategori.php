<div class="table table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include "../../_Config/Connection.php";
            $no=1;
            $Query = mysqli_query($conn, "SELECT DISTINCT kategori FROM obat");
            while ($data = mysqli_fetch_array($Query)) {
                $kategori = $data['kategori'];
                if(!empty($data['kategori'])){
                    echo "<tr>";
                    echo "  <td align='center'>".$no."</td>";
                    echo "  <td>".$kategori."</td>";
                    echo "  <td align='center'>";
                    echo '      <input type="checkbox" name="pilih_kategori[]" id="pilih_kategori[]" value="'.$kategori.'"/>';
                    echo "  </td>";
                    echo "</tr>";
                }
                $no++;
            }
        ?>
        </tbody>
    </table>
</div>
