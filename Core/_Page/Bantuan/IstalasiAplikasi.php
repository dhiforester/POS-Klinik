<h4>
    Instalasi Aplikasi dan Webserver
</h4>
<p>
    Sistem yang dibangun merupakan aplikasi berbasis web sehingga membutuhkan webserver baik diimplementasikan secara online
    maupun offline pada komputer lokal. Sebelum lebih jauh memahami cara melakukan instalasi aplikasi ini maka 
    dibutuhkan spesifikasi minimum yang memenuhi syarat dalam menunjang berjalannya aplikasi ini.
</p>
<p>
    <ul>
        <li>Aplikasi Webservice Lokal (Wamp Server, Xampp, Apache, dll).</li>
        <li>Menggunakan Versi PHP 7.0.3.3.</li>
        <li>DBMS Versi MySql 5.7.24</li>
        <li>Sistem Operasi Minimum Win 7 32/64 bit</li>
        <li>Browser App (Direkomendasikan menggunakan mozila firefox versi terbaru)</li>
    </ul>
</p>
<p>
    Setelah perangkat anda memenuhi syarat instalasi, berikut ini langkah-langkah melakukan instalasi.
</p>
<p>
    <ul class="">
        <li>
            Untuk pemasangan pada komputer lokal, silahkan download aplikasi webserver terlebih dahulu. 
            Bagi anda yang ingin menggunakan Wamp Server Bisa di download pada link <a href="https://www.wampserver.com/en/">berikut ini</a>. 
            Atau bagi anda yang ingin menggunakan Xampp silahkan download pada link <a href="https://www.apachefriends.org/download.html">berikut ini.</a>
        </li>
        <li>Pilih diantara aplikasi tersebut dan lakukan download hingga selesai, kemudian instal pada komputer lokal anda</li>
        <li>
            Extract file aplikasi ini kemudian beri nama sesuai keinginan anda. 
            Simpan pada directory public html yang sudah disediakan baik oleh wamp server atau xampp. 
            Misalnya anda menggunakan Xampp, biasanya directory webapp nya berada di <b>"C:/xampp/htdocs/".</b> 
            Apabila anda menggunakan 
            Wamp Server, biasanya directory webapp nya berada di <b>"C:/wamp/www/".</b>
        </li>
        <li>Jalankan aplikasi dan lakukan running pada semua service (Apache dan MySql)</li>
        <li>
            Buka Browser dan lakukan akses ke halaman phpmyadmin, caranya pada address bar isikan dengan
            <b>"http://localhost/phpmyadmin/".</b>
        </li>
        <li>Lakukan login dengan mengisi username : root dan password : [kosong]</li>
        <li>
            Pada halaman utama, pilih menu import. Masukan file database yang sudah kami sediakan pada folder 
            "db" kemudian klik import.
        </li>
        <li>
            Apabila proses import berhasil, silahan lakukan browsing ke alamat <b>"http://localhost/nama_aplikasi"</b>
        </li>
        <li>
            Lakukan login dengan mengisi username : admin@email.com dan password : admin
        </li>
    </ul>
</p>
