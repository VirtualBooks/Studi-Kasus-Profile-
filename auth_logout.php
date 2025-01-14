<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once "koneksi.php";

// Menghapus semua variabel sesi yang ada (misalnya, informasi login pengguna)
session_unset();

// Menghancurkan sesi yang ada, yang berarti sesi pengguna akan berakhir
session_destroy();

// Menampilkan pesan sukses setelah logout dan mengarahkan pengguna kembali ke halaman login
echo "<script>alert('Berhasil logout');
window.location = 'masuk.php'
</script>";

// Menghentikan eksekusi script lebih lanjut setelah logout
exit;
?>
