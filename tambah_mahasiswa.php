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

// Proses penyimpanan data mahasiswa baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['fullnama'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $prodi = $_POST['prodi'] ?? '';

    // Mengecek apakah NIM sudah ada di database
    $checkQuery = "SELECT nim FROM users WHERE nim = '$nim'";
    $checkResult = $koneksi->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        echo "<script>alert('NIM sudah ada, silakan gunakan NIM yang berbeda.')</script>";
        echo "<script>window.location = 'dashboard.php'</script>";
        exit();
    }

    // Handle upload foto jika ada
    $file_foto = $_FILES['foto']['name'] ?? '';
    $path_foto = NULL; // Memberikan nilai kosong jika tidak ada foto

    if (!empty($file_foto)) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($file_foto, PATHINFO_EXTENSION));
        $fileSize = $_FILES['foto']['size'];

        if (in_array($fileExtension, $allowedExtensions)) {
            if ($fileSize <= 2 * 1024 * 1024) { // ukuran file maksimal 2 MB
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
                }

                $newFileName = uniqid('foto_', true) . '.' . $fileExtension;
                $path_foto = $uploadDir . $newFileName;

                if (!move_uploaded_file($_FILES['foto']['tmp_name'], $path_foto)) {
                    echo "<script>alert('Gagal mengupload foto.')</script>";
                    echo "<script>window.location = 'dashboard.php'</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Ukuran file foto tidak boleh lebih dari 2 MB.')</script>";
                echo "<script>window.location = 'dashboard.php'</script>";
                exit();
            }
        } else {
            echo "<script>alert('Ekstensi file foto tidak diperbolehkan.')</script>";
            echo "<script>window.location = 'dashboard.php'</script>";
            exit();
        }
    }

    // Query untuk memasukkan data mahasiswa baru ke dalam database
    $queryUser = "INSERT INTO users (nim, password, role) VALUES ('$nim', '" . password_hash($nim, PASSWORD_DEFAULT) . "', 'user')";

    if ($koneksi->query($queryUser)) {
        $queryMahasiswa = "INSERT INTO data_mahasiswa (nim, fullname, prodi, path_foto) 
                           VALUES ('$nim', '$nama', '$prodi', '$path_foto')";

        if ($koneksi->query($queryMahasiswa)) {
            echo "<script>
            alert('Berhasil menambahkan data mahasiswa baru');
            window.location = 'dashboard.php';
            </script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data mahasiswa: " . $koneksi->error . "')</script>";
            echo "<script>window.location = 'dashboard.php'</script>";
        }
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data pengguna: " . $koneksi->error . "')</script>";
        echo "<script>window.location = 'dashboard.php'</script>";
    }
}
?>
