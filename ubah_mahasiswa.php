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

// Proses penyimpanan data mahasiswa yang diubah
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'] ?? '';
    $prodi = $_POST['prodi'] ?? '';

    // Ambil data mahasiswa sebelumnya
    $query = "SELECT path_foto FROM data_mahasiswa WHERE nim = '$nim'";
    $result = $koneksi->query($query);
    if (!$result || $result->num_rows == 0) {
        echo "<script>alert('Data mahasiswa tidak ditemukan!')</script>";
        echo "<script>window.location = 'dashboard.php'</script>";
       
    }
    $data = $result->fetch_assoc();
    $path_foto = $data['path_foto']; // Default ke foto lama

    // Handle upload foto jika ada
    if (!empty($_FILES['foto']['name'])) {
        $file_foto = $_FILES['foto']['name'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($file_foto, PATHINFO_EXTENSION));
        $fileSize = $_FILES['foto']['size'];

        if (in_array($fileExtension, $allowedExtensions)) {
            if ($fileSize <= 2 * 1024 * 1024) { // 2 MB
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
                }

                $newFileName = uniqid('foto_', true) . '.' . $fileExtension;
                $newPathFoto = $uploadDir . $newFileName;

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $newPathFoto)) {
                    // Hapus foto lama jika bukan foto default
                    if ($path_foto != 'uploads/default.jpg') {
                        unlink($path_foto);
                    }
                    $path_foto = $newPathFoto; // Update path foto
                } else {
                    echo "<script>alert('Gagal mengupload foto baru.')</script>";
                    echo "<script>window.location = 'dashboard.php'</script>";
                   
                }
            } else {
                echo "<script>alert('Ukuran file foto tidak boleh lebih dari 2 MB.')</script>";
                echo "<script>window.location = 'dashboard.php'</script>";
               
            }
        } else {
            echo "<script>alert('Ekstensi file foto tidak diperbolehkan.')</script>";
            echo "<script>window.location = 'dashboard.php'</script>";
           
        }
    }

    // Query untuk update data mahasiswa
    $queryUpdate = "UPDATE data_mahasiswa 
                    SET prodi = '$prodi', path_foto = '$path_foto' 
                    WHERE nim = '$nim'";

    if ($koneksi->query($queryUpdate)) {
        echo "<script>alert('Data mahasiswa berhasil diubah.')</script>";
        echo "<script>window.location = 'dashboard.php'</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "')</script>";
        echo "<script>window.location = 'dashboard.php'</script>";
    }
}
?>
