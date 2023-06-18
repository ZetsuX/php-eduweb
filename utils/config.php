<?php 
    $dotenvFile = __DIR__ . '/.env';

    if (file_exists($dotenvFile)) {
        $lines = file($dotenvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        foreach ($lines as $line) {
            putenv($line);
        }
    }

    $server = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
    $nama_database = getenv('DB_NAME');
    $port = getenv('DB_PORT');

    $dbConn = mysqli_connect($server, $user, $password, $nama_database, $port);

    if( !$dbConn ){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }
?>