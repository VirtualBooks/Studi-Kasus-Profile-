<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once 'koneksi.php';

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    echo "
    <script>alert('Anda harus login terlebih dahulu')</script>
    <script>window.location = 'masuk.php'</script>
    ";
}

// Mengecek role pengguna
if ($_SESSION['role'] != 'admin') {
    echo "
    <script>alert('Anda tidak memiliki akses ke halaman ini')</script>
    <script>window.location = 'profile.php'</script>
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
    <link rel="stylesheet" href="assets/css/input_admin.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <title>Tambah Mahasiswa</title>
</head>

<body>
    <?php
    // Menyisipkan template navbar
    include 'templates/navbar.php';
    ?>
    <div class="container">
        <!-- Form untuk menambah data mahasiswa -->
        <form action="tambah_mahasiswa.php" method="post" enctype="multipart/form-data">
            <div class="card">
                <h4>Tambah Data Mahasiswa</h4>

                <!-- Input untuk nama lengkap -->
                <input type="text" name="fullnama" id="nama" placeholder="Nama Lengkap" required>

                <!-- Input untuk NIM -->
                <input type="number" name="nim" id="nim" placeholder="NIM" required>

                <!-- Dropdown untuk memilih program studi -->
                <select name="prodi" id="prodi" required>
                    <option value="" disabled selected>Program Studi</option>
                    <option value="Informatika">Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                </select>

                <!-- Input untuk mengunggah foto -->
                <input type="file" name="foto" id="foto">

                <!-- Tombol aksi -->
                <div class="button">
                    <input type="button" value="Batal">
                    <input type="submit" value="Tambah">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
