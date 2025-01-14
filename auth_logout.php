<?php
require_once "koneksi.php";
session_unset();
session_destroy();

echo "<script>alert('Berhasil logout')
window.location = 'masuk.php'
</script>";

exit;
?>