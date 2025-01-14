<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once "koneksi.php";

// Mengecek apakah pengguna sudah login dengan sesi 'nim' dan memeriksa peran (role)
if (isset($_SESSION['nim']) && $_SESSION['role'] == 'user') {
    // Menampilkan pesan jika pengguna sudah login sebagai 'user' dan mengarahkan ke halaman profile
    echo "
    <script>alert('Anda sudah login')</script>
    <script>window.location = 'profile.php'</script>
    ";
}

// Mengecek apakah pengguna sudah login dengan sesi 'nim' dan memeriksa peran (role)
if (isset($_SESSION['nim']) && $_SESSION['role'] == 'admin') {
    // Menampilkan pesan jika pengguna sudah login sebagai 'admin' dan mengarahkan ke halaman dashboard
    echo "
    <script>alert('Anda sudah login')</script>
    <script>window.location = 'dashboard.php'</script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- Mendefinisikan karakter set untuk halaman ini -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Agar halaman responsif di perangkat mobile -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Menyambungkan ke server Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Menyambungkan ke server font Google untuk pengambilan font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet"> <!-- Menambahkan font Quicksand -->
    <link rel="stylesheet" href="assets/css/auth.css"> <!-- Menautkan file CSS untuk styling -->
    <title>Portal Mahasiswa</title> <!-- Judul halaman -->
</head>

<body>
    <!-- Form login untuk autentikasi pengguna -->
    <form action="auth_login.php" method="post" class="form">
        <header>
            <img src="assets/img/masuk.svg" alt=""> <!-- Gambar ikon login -->
            <h1>Masuk</h1> <!-- Judul form login -->
        </header>
        
        <!-- Input untuk NIM pengguna -->
        <input type="text" name="nim" id="" placeholder="NIM" required>
        
        <!-- Input untuk password pengguna -->
        <input type="password" name="password" id="" placeholder="Password" required>
        
        <!-- Tombol submit untuk login -->
        <input type="submit" value="Masuk">
        
        <!-- Link untuk pendaftaran akun baru -->
        <p>Belum punya akun? <a href="index.php">Daftar disini</a></p>
    </form>

    <!-- Gambar tambahan untuk sisi kanan halaman -->
    <img src="assets/img/reglog.png" alt="pic of portal" class="side-pic">
</body>

</html>
