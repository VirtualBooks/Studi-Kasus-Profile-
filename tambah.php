<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/input_admin.css">
    <title>Document</title>
</head>

<body>
    <?php
    include 'templates/navbar.php';
    ?>
    <div class="container">
        <div class="card">
            <h4>Tambah Data Mahasiswa</h4>
            <input type="text" name="nama" id="nama" placeholder="Nama Lengkap">
            <input type="number" name="nim" id="nim" placeholder="NIM">
            <select name="prodi" id="prodi">
                <option value="" disabled selected>Program Studi</option>
                <option value="informatika">Informatika</option>
            </select>
            <input type="file" name="foto" id="foto">
            <div class="button">
                <input type="button" value="Batal">
                <input type="submit" value="Tambah">
            </div>
        </div>
    </div>
</body>

</html>