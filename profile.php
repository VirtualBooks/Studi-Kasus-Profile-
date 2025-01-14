<?php
require_once "koneksi.php";

if(!isset($_SESSION['nim']))
{
    echo "
    <script>alert('Anda harus login terlebih dahulu')</script>
    <script>window.location = 'masuk.php'</script>
    ";
}

if ($_SESSION['role'] != 'user')
{
    echo "
    <script>alert('Anda tidak memiliki akses ke halaman ini')</script>
    <script>window.location = 'dashboard.php'</script>
    ";
}

$sql = "SELECT * FROM data_mahasiswa WHERE nim = '$_SESSION[nim]'";
$result = $koneksi->query($sql);
$data = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <title>Profile</title>
</head>

<body>
    <?php
    include "templates/navbar.php";
    ?>
    <div class="container">
        <header>
            <img src="<?= !empty($data['path_foto']) ? htmlspecialchars($data['path_foto']) : 'assets/img/user.png' ?>" alt="">
            <div>
                <h2><?= htmlspecialchars($data['fullname']) ?></h2>
                <p><?= htmlspecialchars($data['nim']) ?></p>
                <p><?= htmlspecialchars($data['prodi']) ?></p>
            </div>
        </header>
        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
            <main>
                <div class="row">
                    <div class="info">
                        <p>Nama Lengkap</p>
                        <div class="locked-info">
                            <p><?= htmlspecialchars($data['fullname']) ?></p>
                        </div>
                    </div>
                    <div class="info">
                        <p>NIM</p>
                        <div class="locked-info">
                            <p><?= htmlspecialchars($data['nim']) ?></p>
                        </div>
                    </div>
                    <div class="info">
                        <p>NIK</p>
                        <input type="number" name="nik" value="<?= !empty($data['nik']) ? htmlspecialchars($data['nik']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="info">
                        <p>Tempat Lahir</p>
                        <input type="text" name="tempat_lahir" value="<?= !empty($data['tempat_lahir']) ? htmlspecialchars($data['tempat_lahir']) : '' ?>">
                    </div>
                    <div class="info">
                        <p>Tanggal Lahir</p>
                        <input type="date" name="tanggal_lahir" value="<?= !empty($data['tanggal_lahir']) ? htmlspecialchars($data['tanggal_lahir']) : '' ?>">
                    </div>
                    <div class="info">
                        <p>No.KK</p>
                        <input type="number" name="no_kk" value="<?= !empty($data['no_kk']) ? htmlspecialchars($data['no_kk']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="info">
                        <p>Jenis Kelamin</p>
                        <select name="jenis_kelamin" id="jk">
                            <option value="pilih" disabled <?= empty($data['jenis_kelamin']) ? 'selected' : '' ?>>Pilih</option>
                            <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="info">
                        <p>Agama</p>
                        <select name="agama" id="agama">
                            <option value="" disabled <?= empty($data['agama']) ? 'selected' : '' ?>>Pilih</option>
                            <option value="islam" <?= $data['agama'] == 'islam' ? 'selected' : '' ?>>Islam</option>
                            <option value="kristen" <?= $data['agama'] == 'kristen' ? 'selected' : '' ?>>Kristen</option>
                            <option value="katolik" <?= $data['agama'] == 'katolik' ? 'selected' : '' ?>>Katolik</option>
                            <option value="hindu" <?= $data['agama'] == 'hindu' ? 'selected' : '' ?>>Hindu</option>
                            <option value="buddha" <?= $data['agama'] == 'buddha' ? 'selected' : '' ?>>Buddha</option>
                            <option value="konghuchu" <?= $data['agama'] == 'konghuchu' ? 'selected' : '' ?>>Konghuchu</option>
                        </select>
                    </div>
                    <div class="info">
                        <p>Kewarganegaraan</p>
                        <input type="text" nama="kewarganegaraan" value="<?= !empty($data['kewarganegaraan']) ? htmlspecialchars($data['kewarganegaraan']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="info-alamat">
                        <p>Jalan</p>
                        <input type="text" name="jalan" value="<?= !empty($data['jalan']) ? htmlspecialchars($data['jalan']) : '' ?>">
                    </div>
                    <div class="info-rtrw">
                        <p>RT</p>
                        <input type="number" name="rt" value="<?= !empty($data['rt']) ? htmlspecialchars($data['rt']) : '' ?>">
                    </div>
                    <div class="info-rtrw">
                        <p>RW</p>
                        <input type="number" name="rw" value="<?= !empty($data['rw']) ? htmlspecialchars($data['rw']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="info">
                        <p>Kelurahan</p>
                        <input type="text" name="kelurahan" value="<?= !empty($data['kelurahan']) ? htmlspecialchars($data['kelurahan']) : '' ?>">
                    </div>
                    <div class="info">
                        <p>Kecamatan</p>
                        <input type="text" name="kecamatan" value="<?= !empty($data['kecamatan']) ? htmlspecialchars($data['kecamatan']) : '' ?>">
                    </div>
                    <div class="info">
                        <p>Kode Pos</p>
                        <input type="number" name="kode_pos" value="<?= !empty($data['kode_pos']) ? htmlspecialchars($data['kode_pos']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="info">
                        <p>NISN</p>
                        <input type="number" name="nisn" value="<?= !empty($data['nisn']) ? htmlspecialchars($data['nisn']) : '' ?>">
                    </div>
                    <div class="info">
                        <p>NPWP</p>
                        <input type="number" name="npwp" value="<?= !empty($data['npwp']) ? htmlspecialchars($data['npwp']) : '' ?>">
                    </div>
                    <div class="info">
                        <p>No. BPJS</p>
                        <input type="number" name="no_bpjs" value="<?= !empty($data['no_bpjs']) ? htmlspecialchars($data['no_bpjs']) : '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="info-foto">
                        <p>Upload Foto</p>
                        <input type="file" id="" class="input-foto" name="file_foto" accept="image/*">
                    </div>
                </div>
            </main>
            <input type="submit" value="Simpan" class="simpan">
        </form>
    </div>
</body>

</html>