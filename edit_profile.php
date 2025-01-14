<?php
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
if ($_SESSION['role'] != 'user') {
    echo "
    <script>alert('Anda tidak memiliki akses ke halaman ini')</script>
    <script>window.location = 'dashboard.php'</script>
    ";
    exit();
}

$nim = $_SESSION['nim'];

// Mengambil data mahasiswa berdasarkan NIM
$sql = "SELECT * FROM data_mahasiswa WHERE nim = '$nim'";
$result = $koneksi->query($sql);
$data = $result->fetch_assoc();

// Proses penyimpanan perubahan profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dengan default empty("") jika tidak ada
    $tempat_lahir = $_POST['tempat_lahir'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $no_kk = $_POST['no_kk'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $agama = $_POST['agama'] ?? '';
    $kewarganegaraan = $_POST['kewarganegaraan'] ?? '';
    $jalan = $_POST['jalan'] ?? '';
    $rt = $_POST['rt'] ?? '';
    $rw = $_POST['rw'] ?? '';
    $kelurahan = $_POST['kelurahan'] ?? '';
    $kecamatan = $_POST['kecamatan'] ?? '';
    $kode_pos = $_POST['kode_pos'] ?? '';
    $nisn = $_POST['nisn'] ?? '';
    $npwp = $_POST['npwp'] ?? '';
    $no_bpjs = $_POST['no_bpjs'] ?? '';
    $nik = $_POST['nik'] ?? '';

    // Menangani tanggal lahir, jika kosong set NULL
    $tanggal_lahir = empty($tanggal_lahir) ? NULL : $tanggal_lahir;

    // Handle upload foto jika ada
    $file_foto = $_FILES['file_foto']['name'];
    $path_foto = $data['path_foto']; // Tetap menggunakan foto lama jika tidak ada foto baru

    if (!empty($file_foto)) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($file_foto, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);  // Buat folder jika belum ada
            }

            $newFileName = uniqid('foto_', true) . '.' . $fileExtension;
            $path_foto = $uploadDir . $newFileName;

            if (!move_uploaded_file($_FILES['file_foto']['tmp_name'], $path_foto)) {
                echo "<script>alert('Gagal mengupload foto.')</script>";
            }else {
                // Mengambil path foto sebelumnya dengan query
                $sql = "SELECT path_foto FROM data_mahasiswa WHERE nim = '$nim'";
                $result = $koneksi->query($sql);
                $foto = $result->fetch_assoc();
                // Menghapus foto lama 
                if ($foto['path_foto'] != 'uploads/default.jpg') {
                    unlink($foto['path_foto']); // Hapus foto lama
                }
            }
        } else {
            echo "<script>alert('Ekstensi file foto tidak diperbolehkan.')</script>";
        }
    }

    // Query untuk update data mahasiswa (Jika tanggal lahir kosong jadikan null)
    $query = "UPDATE data_mahasiswa SET 
                tempat_lahir = '$tempat_lahir', 
                tanggal_lahir = " . ($tanggal_lahir ? "'$tanggal_lahir'" : "NULL") . ", 
                no_kk = '$no_kk', 
                nik = '$nik',
                jenis_kelamin = '$jenis_kelamin', 
                agama = '$agama', 
                kewarganegaraan = '$kewarganegaraan', 
                jalan = '$jalan', 
                rt = '$rt', 
                rw = '$rw', 
                kelurahan = '$kelurahan', 
                kecamatan = '$kecamatan', 
                kode_pos = '$kode_pos', 
                nisn = '$nisn', 
                npwp = '$npwp', 
                no_bpjs = '$no_bpjs', 
                path_foto = '$path_foto' 
              WHERE nim = '$nim'";

    if ($koneksi->query($query)) {
        echo "<script>alert('Data profil berhasil diperbarui!')</script>";
        echo "<script>window.location = 'profile.php'</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "')</script>";
    }
}
?>