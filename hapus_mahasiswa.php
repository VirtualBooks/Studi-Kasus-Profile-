<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once "koneksi.php";

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    echo "
    <script>alert('Anda harus login terlebih dahulu')</script>
    <script>window.location = 'masuk.php'</script>
    ";
    exit();
}

// Mengecek role pengguna
if ($_SESSION['role'] != 'admin') {
    echo "
    <script>alert('Anda tidak memiliki akses ke halaman ini')</script>
    <script>window.location = 'dashboard.php'</script>
    ";
    exit();
}

// Mengecek apakah ada parameter NIM
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Ambil data mahasiswa berdasarkan NIM
    $query = "SELECT path_foto FROM data_mahasiswa WHERE nim = '$nim'";
    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $path_foto = $data['path_foto'] ?? '';

        // Hapus foto jika path_foto tidak kosong
        if (!empty($path_foto)) {
            if (file_exists($path_foto)) {
                unlink($path_foto);
            }
        }

        // Hapus data dari tabel data_mahasiswa
        $queryDeleteMahasiswa = "DELETE FROM data_mahasiswa WHERE nim = '$nim'";
        if ($koneksi->query($queryDeleteMahasiswa)) {
            // Hapus data dari tabel users
            $queryDeleteUsers = "DELETE FROM users WHERE nim = '$nim'";
            if ($koneksi->query($queryDeleteUsers)) {
                echo "<script>alert('Data mahasiswa berhasil dihapus.')</script>";
                echo "<script>window.location = 'dashboard.php'</script>";
            } else {
                echo "<script>alert('Gagal menghapus data dari tabel users: " . $koneksi->error . "')</script>";
                echo "<script>window.location = 'dashboard.php'</script>";
            }
        } else {
            echo "<script>alert('Gagal menghapus data dari tabel data_mahasiswa: " . $koneksi->error . "')</script>";
            echo "<script>window.location = 'dashboard.php'</script>";
        }
    } else {
        echo "<script>alert('Data mahasiswa tidak ditemukan.')</script>";
        echo "<script>window.location = 'dashboard.php'</script>";
    }
} else {
    echo "<script>alert('Parameter NIM tidak ditemukan.')</script>";
    echo "<script>window.location = 'dashboard.php'</script>";
}
?>
