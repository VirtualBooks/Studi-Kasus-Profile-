<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/profile.css">
    <title>Document</title>
</head>

<body>
    <?php
    include "templates/navbar.php";
    ?>
    <div class="container">
        <header>
            <img src="assets/img/user.png" alt="">
            <div>
                <h2>Andi Budiman</h2>
                <p>2300091010</p>
                <p>Informatika</p>
            </div>
        </header>
        <main>
            <div class="row">
                <div class="info">
                    <p>Nama Lengkap</p>
                    <div class="locked-info">
                        <p>Andi Budiman</p>
                    </div>
                </div>
                <div class="info">
                    <p>NIM</p>
                    <div class="locked-info">
                        <p>2300091010</p>
                    </div>
                </div>
                <div class="info">
                    <p>NIK</p>
                    <input type="number">
                </div>
            </div>
            <div class="row">
                <div class="info">
                    <p>Tempat Lahir</p>
                    <input type="text">
                </div>
                <div class="info">
                    <p>Tanggal Lahir</p>
                    <input type="date">
                </div>
                <div class="info">
                    <p>No.KK</p>
                    <input type="number">
                </div>
            </div>
            <div class="row">
                <div class="info">
                    <p>Jenis Kelamin</p>
                    <select name="jk" id="jk">
                        <option value="pilih" disabled selected>Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="info">
                    <p>Agama</p>
                    <select name="agama" id="agama">
                        <option value="pilih" disabled selected>Pilih</option>
                        <option value="islam">Islam</option>
                        <option value="kristen">Kristen</option>
                        <option value="katolik">Katolik</option>
                        <option value="hindu">Hindu</option>
                        <option value="buddha">Buddha</option>
                        <option value="konghuchu">Konghuchu</option>
                    </select>
                </div>
                <div class="info">
                    <p>Kewarganegaraan</p>
                    <input type="text">
                </div>
            </div>
            <div class="row">
                <div class="info-alamat">
                    <p>Jalan</p>
                    <input type="text">
                </div>
                <div class="info-rtrw">
                    <p>RT</p>
                    <input type="number">
                </div>
                <div class="info-rtrw">
                    <p>RW</p>
                    <input type="number">
                </div>
            </div>
            <div class="row">
                <div class="info">
                    <p>Kelurahan</p>
                    <input type="text">
                </div>
                <div class="info">
                    <p>Kecamatan</p>
                    <input type="text">
                </div>
                <div class="info">
                    <p>Kode Pos</p>
                    <input type="number">
                </div>
            </div>
            <div class="row">
                <div class="info">
                    <p>NISN</p>
                    <input type="number">
                </div>
                <div class="info">
                    <p>NPWP</p>
                    <input type="number">
                </div>
                <div class="info">
                    <p>No. BPJS</p>
                    <input type="number">
                </div>
            </div>
            <div class="row">
                <div class="info-foto">
                    <p>Upload Foto</p>
                    <input type="file" name="" id="" class="input-foto">
                </div>
            </div>
        </main>
        <input type="submit" value="Simpan" class="simpan">
    </div>
</body>

</html>