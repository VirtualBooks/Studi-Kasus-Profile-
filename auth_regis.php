<?php
require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nim = $_POST['nim'];
    $fullname = $_POST['fullname'];
    $prodi = $_POST['prodi'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nim, password, role) VALUES ('$nim', '$password', 'user')";
    $result = $koneksi->query($sql);

    $sql = "INSERT INTO data_mahasiswa (nim, fullname,prodi) VALUES ('$nim', '$fullname', '$prodi')";
    $result = $koneksi->query($sql);

    if ($result)
    {
        echo "
        <script>alert('Berhasil registrasi')
        window.location = 'masuk.php'</script>
        ";
    }
    else
    {
        echo "
        <script>alert('Gagal registrasi')
        window.location = 'index.php'
        </script>

        ";
    }
}




?>