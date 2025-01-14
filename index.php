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
    <!-- Form pendaftaran untuk pengguna baru -->
    <form action="auth_regis.php" method="post" class="form">
        <header>
            <img src="assets/img/daftar.svg" alt=""> <!-- Gambar ikon daftar -->
            <h1>Daftar</h1> <!-- Judul form pendaftaran -->
        </header>

        <!-- Input untuk nama lengkap pengguna -->
        <input type="text" name="fullname" id="" placeholder="Nama Lengkap" required>
        
        <!-- Input untuk NIM pengguna -->
        <input type="number" name="nim" id="" placeholder="NIM" required>

        <!-- Dropdown untuk memilih program studi -->
        <select name="prodi" id="prodi" required>
            <option value="" disabled selected>Program Studi</option>
            <option value="Informatika">Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
        </select>

        <!-- Input untuk password pengguna -->
        <input type="password" name="password" id="" placeholder="Password" required>
        
        <!-- Tombol submit untuk pendaftaran -->
        <input type="submit" value="Daftar">

        <!-- Link untuk pengguna yang sudah memiliki akun untuk masuk -->
        <p>Anda sudah punya akun? <a href="masuk.php">Masuk disini</a></p>
    </form>

    <!-- Gambar tambahan untuk sisi kanan halaman -->
    <img src="assets/img/reglog.png" alt="pic of portal" class="side-pic">
</body>

</html>
