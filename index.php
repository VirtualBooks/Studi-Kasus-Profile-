<?php
require_once "koneksi.php";

if (isset($_SESSION['nim']) && $_SESSION['role'] == 'user')
{
    echo "
    <script>alert('Anda sudah login')</script>
    <script>window.location = 'profile.php'</script>
    ";
}

if (isset($_SESSION['nim']) && $_SESSION['role'] == 'admin')
{
    echo "
    <script>alert('Anda sudah login')</script>
    <script>window.location = 'dashboard.php'</script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/auth.css">
    <title>Portal Mahasiswa</title>
</head>

<body>
    <form action="auth_regis.php" method="post" class="form">
        <header>
            <img src="assets/img/daftar.svg" alt="">
            <h1>Daftar</h1>
        </header>
        <input type="text" name="fullname" id="" placeholder="Nama Lengkap" required>
        <input type="number" name="nim" id="" placeholder="NIM" required>
        <select name="prodi" id="prodi" required>
            <option value="" disabled selected>Program Studi</option>
            <option value="Informatika">Informatika</option>
        </select>
        <input type="password" name="password" id="" placeholder="Password" required>
        <input type="submit" value="Daftar">
        <p>Anda sudah punya akun? <a href="masuk.php">Masuk disini</a></p>
    </form>
    <img src="assets/img/reglog.png" alt="pic of portal" class="side-pic">

</body>

</html>