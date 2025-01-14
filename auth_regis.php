<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once "koneksi.php";

// Mengecek apakah form telah disubmit menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Mengambil data yang dikirimkan melalui form (nama, NIM, program studi, dan password)
    $nim = $_POST['nim'];          // NIM pengguna
    $fullname = $_POST['fullname']; // Nama lengkap pengguna
    $prodi = $_POST['prodi'];      // Program studi pengguna
    $password = $_POST['password']; // Password pengguna

    // Mengenkripsi password sebelum disimpan ke database menggunakan algoritma bcrypt
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data pengguna (NIM, password, dan role) ke tabel 'users'
    $sql = "INSERT INTO users (nim, password, role) VALUES ('$nim', '$password', 'user')";
    // Menjalankan query untuk memasukkan data pengguna ke dalam tabel
    $result = $koneksi->query($sql);

    // Query untuk memasukkan data mahasiswa (NIM, nama lengkap, dan program studi) ke tabel 'data_mahasiswa'
    $sql = "INSERT INTO data_mahasiswa (nim, fullname, prodi) VALUES ('$nim', '$fullname', '$prodi')";
    // Menjalankan query untuk memasukkan data mahasiswa ke dalam tabel
    $result = $koneksi->query($sql);

    // Mengecek apakah kedua query berhasil dijalankan
    if ($result) {
        // Jika berhasil, tampilkan pesan sukses dan arahkan pengguna ke halaman login
        echo "
        <script>alert('Berhasil registrasi');
        window.location = 'masuk.php'</script>
        ";
    } else {
        // Jika gagal, tampilkan pesan error dan arahkan pengguna kembali ke halaman pendaftaran
        echo "
        <script>alert('Gagal registrasi');
        window.location = 'index.php'
        </script>
        ";
    }
}
?>
