<h4>
    Input Transaksi/Kasir
</h4>
<p>
    Petugas kasir dapat mempergunakan berbagai fitur yang ada pada modul kasir. 
    Fitur-fitur tersebut diantaranya adalah:
    Tambah data rincian barang pada tabel rincian transaksi, 
    menambahkan rincian barang melalui scan barcode, 
    pengaturan PPN dan Diskon, 
    menambahkan supplier atau konsumen pada data transaksi dan menghitung jumlah kembalian. 
    Lebih jelas dapat dilihat pada uraian berikut ini.
</p>
<p>
    <b>Input Rincian Trasnaksi Pada Tabel Kasir</b><br>
    <ul>
        <li>Pilih menu <i>Kasir</i> pada navbar aplikasi.</li>
        <li>Pilih jenis transaksi yang akan anda input pada bagian atas halaman kasir.</li>
        <li>Jenis transaksi ini di bagi menjadi 2 bagian utama yaitu penjualan (PNJ) dan Pembelian (PMB).</li>
        <li>
            Pada halaman kasir, pilih tombol <i>Add</i>.<br>
            <img src="images/bantuan/tambah_rincian_kasir.jpg" alt="Tambah Rincian Kasir" width="100%">
        </li>
        <li>Pilih kategori harga yang akan digunakan untuk transaksi.</li>
        <li>
            Cari item barang dengan mengisi nama atau kode barang kemudian klik pada tombol 'Cari' atau tekan tombol enter.<br>
            <img src="images/bantuan/cari_item_rincian.jpg" alt="Tambah Rincian Kasir" width="100%">
        </li>
        <li>Pilih salah satu item kemudian isi 'Jumlah/Kuantitas'</li>
        <li>
            Pada jendela <i>Popup</i> tambah rincian transaksi ini anda bisa merubah kategori harga, satuan, harga dan jumlah rincian.
        </li>
        <li>
            Klik tombol tambahkan untuk memulai proses tambah data rincian.<br>
            <img src="images/bantuan/form_item_rincian.jpg" alt="Tambah Rincian Kasir" width="100%"><br>
            <b>Keterangan</b><br>
            1. Mode harga yang akan digunakan.<br>
            2. Satuan multi yang akan digunakan pada rincian <br>
            3. Harga per satuan rincian <br>
            4. Jumlah/Kuantitas barang/inventory yang akan ditambahkan.
        </li>
        <li>
            Apabila proses berhasil maka jendela <i>Popup</i> secara otomatis akan tertutup dan rincian tadi akan ditambahkan pada 
            tabel rincian kasir.
        </li>
    </ul>
    <b>Menambahkan Item melalui Scan Barcode</b><br>
    <img src="images/bantuan/form_scan_rincian.jpg" alt="Scan Barcode" width="100%"><br>
    <ul>
        <li>Masih pada halaman kasir, Pilih tombol <i>Scan</i> pada halaman kasir tersebut.</li>
        <li>Pastikan kursor berada pada form scan barcode.</li>
        <li>Jumlah kuantitas yang terhitung secara <i>Basic</i> bernilai '1'.</li>
        <li>Apabila anda ingin merubah standar harga, anda bisa memilih standar harga yang akan digunakaan melalui kolom 'kategori'.</li>
        <li>Lakukan pemindaian dengan menggunakan perangkat <i>Scaner</i> yang anda miliki.</li>
        <li>Apabila berhasil maka item barang akan masuk pada tabel daftar rincian transaksi</li>
    </ul>
    <b>Mengatur Potongan Harga (Diskon) Dan PPN</b><br>
    <img src="images/bantuan/seting_rincian.jpg" alt="Setting Rincian" width="100%"><br>
    <ul>
        <li>Masih pada halaman kasir, Pilih tombol <i>Setup</i> akan muncul jendela setting transakai.</li>
        <li>Yang perlu diperhatikan pada halaman ini adalah pada bagian standar harga anda bisa menetapkan jenis harga yang akan ditetapkan pada setiap anda menambahkan rincian.</li>
        <li>Pada bagian PPN, isi dengan nilai PPN dengan satuan persen (%) apabila tidak ada boleh dikosongkan saja</li>
        <li>Pada bagian diskon isi dengan nilai potongan harga (satuan persen %) apabila tidak ada boleh dikosongkan</li>
        <li>Apabila sudah yakin dengan pengaturan tersebut silahkan klik pada tombol simpan.</li>
    </ul>
    <b>Edit Dan Hapus Rincian Kasir</b><br>
    <img src="images/bantuan/edit_hapus_rincian.jpg" alt="Edit Dan Hapus Rincian" width="100%"><br>
    <ul>
        <li>Pada halaman ini anda masih bisa melakukan perubahan pada data rincian yang sudah ditambahkan.</li>
        <li>Pada bagian rincian transaksi, masing-masing baris disertai dengan tombol edit dan hapus.</li>
        <li>Untuk melakukan perubahan jumlah dan harga masing-masing rincian anda dapat memilih tombol berwarna kuning dengan logo pensil</li>
        <li>Untuk menghapus rincian anda bisa memilih tombol dengan logo <i>trash</i> berwarna merah.</li>
    </ul>
    <b>Simpan Transaksi</b>
    <img src="images/bantuan/simpan_transaksi.jpg" alt="Edit Dan Hapus Rincian" width="100%"><br>
    <ul>
        <li>Pilih tombol <i>Save</i> pada bagian atas halaman kasir.</li>
        <li>Apabila anda ingin menghitung jumlah uang kembalian, masukan nominalnya pada form jumlah uang.</li>
        <li>Apabila anda ingin melakukan input data transaksi dengan pembayaran Utang/Piutang pilih item tersebut dan form pembayaran akan aktif.</li>
        <li>Isikan jumlah nominal pembayaran dan secara otomatis sistem akan membacanya sebagai transaksi dengan pembayaran utang atasu piutang</li>
        <li>Apabila anda ingin menghubungkan transaksi tersebut dengan data kunjungan pasien, pilih salah satu data kunjungan pada kolom <i>Kunjungan pasien</i> dengan menceklist data tersebut.</li>
        <li>Khusus untuk transaksi pembelian (PMB) anda mungkin akan menghubungkan transaksi tersebut dengan data supplier.</li>
        <li>Pada bagian supplier anda dapat memilih supplier yang terlibat.</li>
        <li>
            Apabila anda sudah yakin dengan data yang anda input silahkan klik pada tombol 'Simpan'<br>
            <img src="images/bantuan/simpan_transaksi2.jpg" alt="Edit Dan Hapus Rincian" width="100%"><br>
        </li>
        <li>
            Setelah proses simpan transaksi selesai, anda bisa melakukan percetakan data transaksi tersebut pada <i>Popup</i> detail transaksi.
        </li>
    </ul>
</p>