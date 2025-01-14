<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <title>Document</title>
</head>

<body>
    <?php
    include 'templates/navbar.php';
    ?>
    <div class="container">
        <div class="search-bar">
            <img src="assets/img/search.svg" alt="">
            <input type="text" name="search" id="search" placeholder="Cari data mahasiswa">
        </div>
        <div class="container-data">
            <div class="header-data">
                <h4>Manajemen Data Mahasiswa</h4>
                <div class="add-sort">
                    <a href="tambah.php" class="tambah">Tambah Data</a>
                    <select name="sort" id="sort">
                        <option value="">A-Z</option>
                        <option value="">Z-A</option>
                    </select>
                </div>
            </div>
            <table>
                <tr class="header-table">
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>NIM</th>
                    <th>PROGRAM STUDI</th>
                    <th>AKSI</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        <div class="nama">
                            <div class="container-img">
                                <img src="assets/img/2309106060.png" alt="ifnu ganteng">
                            </div>
                            <p>Ifnu Umar</p>
                        </div>
                    </td>
                    <td>1234567890</td>
                    <td>Informatika</td>
                    <td>
                        <div class="action">
                            <a href="ubah.php" class="ubah">Ubah</a>
                            <a href="" class="hapus">Hapus</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="container-pagination">
            <div class="pagination">
                <button type="button" class="btn-pagination">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m14 7l-5 5l5 5" />
                    </svg>
                </button>
                <p>1 dari 2</p>
                <button type="button" class="btn-pagination">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m14 7l-5 5l5 5" />
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</body>

</html>