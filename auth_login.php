<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once "koneksi.php";

// Mengecek apakah form telah disubmit menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Mengambil data yang dikirimkan melalui form (NIM dan password)
    $nim = $_POST['nim'];          // NIM pengguna
    $password = $_POST['password']; // Password pengguna

    // Query untuk mencari data pengguna berdasarkan NIM
    $sql = "SELECT * FROM users WHERE nim = '$nim'";
    // Menjalankan query untuk mencari data pengguna
    $result = $koneksi->query($sql);

    // Mengecek apakah data pengguna ditemukan di database
    if ($result->num_rows > 0) {
        // Mengambil data pengguna yang ditemukan
        $data = $result->fetch_assoc();

        // Mengecek apakah password yang dimasukkan sesuai dengan yang ada di database
        if (password_verify($password, $data['password'])) {
            // Jika password valid, menyimpan informasi pengguna ke dalam sesi
            $_SESSION['nim'] = $nim;            // Menyimpan NIM pengguna dalam sesi
            $_SESSION['role'] = $data['role'];  // Menyimpan role pengguna dalam sesi

            // Mengecek apakah pengguna memiliki role 'admin'
            if ($data['role'] == 'admin') {
                // Jika role 'admin', arahkan pengguna ke halaman dashboard
                echo "<script>alert('Berhasil login sebagai admin');
                window.location = 'dashboard.php'
                </script>";
            } else {
                // Jika role 'user', arahkan pengguna ke halaman profile
                echo "<script>alert('Berhasil login sebagai user');
                window.location = 'profile.php'
                </script>";
            }
        } else {
            // Jika password tidak sesuai, tampilkan pesan gagal login
            echo "
            <script>alert('Gagal login');
            window.location = 'masuk.php'</script>
            ";
        }
    } else {
        // Jika NIM tidak ditemukan di database, tampilkan pesan gagal login
        echo "
        <script>alert('Gagal login');
        window.location = 'masuk.php'</script>
        ";
    }
}
?>
