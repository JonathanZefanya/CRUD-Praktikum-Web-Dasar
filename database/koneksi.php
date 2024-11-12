<?php
    //Koneksi database
    $server = "localhost";
    $user = "root";
    $password = "root";
    $database = "crud";

    //buat koneksi
    $koneksi = mysqli_connect($server, $user, $password, $database) or die ("Koneksi gagal");


?>