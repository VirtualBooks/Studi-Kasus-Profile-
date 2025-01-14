<?php
require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE nim = '$nim'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0)
    {
        $data = $result->fetch_assoc();
        if (password_verify($password, $data['password']))
        {
            session_start();
            $_SESSION['nim'] = $nim;
            $_SESSION['role'] = $data['role'];

            echo "
            <script>alert('Berhasil login')
            window.location = 'profile.php'</script>
            ";
        }
        else
        {
            echo "
            <script>alert('Gagal login')
            window.location = 'masuk.php'</script>
            ";
        }
    }
    else
    {
        echo "
        <script>alert('Gagal login')
        window.location = 'masuk.php'</script>
        ";
    }
}


?>