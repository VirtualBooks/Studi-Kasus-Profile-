<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once "koneksi.php";

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
    <script>window.location = 'dashboard.php'</script>
    ";
}

// Mengambil data mahasiswa berdasarkan NIM jika request method adalah GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $nim = $_GET['nim'];

    // Query untuk mendapatkan data mahasiswa
    $sql = "SELECT * FROM data_mahasiswa WHERE nim = '$nim'";
    $result = $koneksi->query($sql);
    $data = $result->fetch_assoc();
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
    <title>Ubah Mahasiswa</title>
</head>

<body>
    <?php
    // Menyisipkan template navbar
    include 'templates/navbar.php';
    ?>
    <div class="container">
        <!-- Form untuk mengubah data mahasiswa -->
        <form action="ubah_mahasiswa.php" method="POST" enctype="multipart/form-data">
            <div class="card">
                <h4>Ubah Data Mahasiswa</h4>
                <!-- Menampilkan informasi yang tidak dapat diubah -->
                <p class="locked-info"><?= htmlspecialchars($data['fullname']) ?></p>
                <p class="locked-info"><?= htmlspecialchars($data['nim']) ?></p>
                <input type="hidden" name="nim" value="<?= $data['nim'] ?>">

                <!-- Dropdown untuk memilih program studi -->
                <select name="prodi" id="prodi">
                    <option value="" disabled <?= empty($data['prodi']) ? 'selected' : '' ?>>Program Studi</option>
                    <option value="Informatika" <?= ($data['prodi'] ?? '') == 'informatika' ? 'selected' : '' ?>>Informatika</option>
                    <option value="Sistem Informasi" <?= ($data['prodi'] ?? '') == 'sistem_informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                </select>

                <!-- Input untuk mengunggah foto -->
                <input type="file" name="foto" id="foto" accept="image/*">

                <!-- Tombol aksi -->
                <div class="button">
                    <input type="button" value="Batal">
                    <input type="submit" value="Ubah">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
