<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crud_praktikum';

$toll = mysqli_connect($host, $username, $password, $database);

if (!$toll) {
    echo "Database gagal tersambung, cek koneksi database Anda";
}
