<?php 
    $server = "localhost";
    $user = "root";
    $password = "";
    $nama_database = "eduweb";

    $dbConn = mysqli_connect($server, $user, $password, $nama_database);

    if( !$dbConn ){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }
?>