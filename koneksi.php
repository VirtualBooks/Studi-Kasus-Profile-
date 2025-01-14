<?php
session_start();

$localhost = "localhost";
$username = "root";
$password = "";
$database = "mahasiswa";


$koneksi = new mysqli($localhost, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

?>