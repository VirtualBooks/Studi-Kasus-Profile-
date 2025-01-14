<?php
// Memulai sesi PHP untuk memungkinkan penggunaan variabel sesi di halaman lain
session_start();

// Mendefinisikan informasi koneksi ke database
$localhost = "localhost";  // Nama host server database
$username = "root";        // Nama pengguna untuk mengakses database (biasanya 'root' untuk localhost)
$password = "";            // Kata sandi untuk pengguna database (kosongkan jika tidak ada kata sandi)
$database = "mahasiswa";   // Nama database yang digunakan

// Membuat objek koneksi baru menggunakan MySQLi
$koneksi = new mysqli($localhost, $username, $password, $database);

// Mengecek apakah terjadi kesalahan saat menghubungkan ke database
if ($koneksi->connect_error) {
    // Jika terjadi kesalahan, tampilkan pesan error dan hentikan eksekusi script
    die("Koneksi Gagal: " . $koneksi->connect_error);
}
?>
