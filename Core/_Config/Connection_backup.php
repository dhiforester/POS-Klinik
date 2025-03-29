<?php
    //Ini adalah halaman untuk melakukan konfigurasi database
    $servername = "localhost";
    $username = "nosy6556_dhiforester";
    $password = "YbQKzkQ5Z5Y2U3r";
    $db = "nosy6556_db_apotek";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>