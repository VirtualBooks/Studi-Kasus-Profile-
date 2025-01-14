<?php
// Menghubungkan dengan file koneksi.php untuk mengakses database
require_once 'koneksi.php';

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    echo "
    <script>alert('Anda harus login terlebih dahulu')</script>
    <script>window.location = 'masuk.php'</script>
    ";
}

// Mengecek role pengguna
if ($_SESSION['role'] != 'admin') {
    echo "
    <script>alert('Anda tidak memiliki akses ke halaman ini')</script>
    <script>window.location = 'profile.php'</script>
    ";
}

// Inisialisasi variabel untuk pencarian, pengurutan, dan pagination
$search = $_GET['search'] ?? ''; // Menerima kata kunci pencarian dari parameter URL
$sort = $_GET['sort'] ?? 'asc';  // Default: urutkan A-Z
$page = $_GET['page'] ?? 1;      // Halaman saat ini, default halaman 1
$limit = 5;                      // Jumlah data per halaman
$offset = ($page - 1) * $limit;  // Menghitung offset untuk query SQL

// Query untuk menghitung total data
$totalQuery = "SELECT COUNT(*) as total FROM data_mahasiswa WHERE fullname LIKE '%$search%'";
$totalResult = $koneksi->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalData = $totalRow['total']; // Total jumlah data

// Menghitung jumlah halaman
$totalPages = ceil($totalData / $limit);

// Query utama untuk mengambil data mahasiswa sesuai filter dan pagination
$sql = "SELECT * FROM data_mahasiswa 
        WHERE fullname LIKE '%$search%' 
        ORDER BY fullname $sort 
        LIMIT $limit OFFSET $offset";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <title>Dashboard Admin</title>
</head>

<body>
    <?php include 'templates/navbar.php'; ?>

    <div class="container">
        <!-- Search bar -->
        <form class="search-bar" method="get" action="">
            <button type="submit"><img src="assets/img/search.svg" alt=""></button>
            <input type="text" name="search" id="search" placeholder="Cari data mahasiswa" value="<?= htmlspecialchars($search); ?>">
        </form>

        <!-- Data container -->
        <div class="container-data">
            <div class="header-data">
                <h4>Manajemen Data Mahasiswa</h4>
                <div class="add-sort">
                    <a href="tambah.php" class="tambah">Tambah Data</a>
                    <!-- Sorting dropdown -->
                    <select name="sort" id="sort" onchange="window.location.href='dashboard.php?sort=' + this.value + '&search=<?= $search; ?>'">
                        <option value="asc" <?= $sort === 'asc' ? 'selected' : ''; ?>>A-Z</option>
                        <option value="desc" <?= $sort === 'desc' ? 'selected' : ''; ?>>Z-A</option>
                    </select>
                </div>
            </div>

            <!-- Table untuk menampilkan data -->
            <table>
                <tr class="header-table">
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>NIM</th>
                    <th>PROGRAM STUDI</th>
                    <th>AKSI</th>
                </tr>

                <?php
                // Jika data ditemukan, tampilkan dalam tabel
                if ($result->num_rows > 0) {
                    $no = $offset + 1; // Nomor urut berdasarkan halaman
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <div class="nama">
                                    <div class="container-img">
                                        <img src="<?= $row['path_foto'] ? $row['path_foto'] : 'assets/img/user.png'; ?>" alt="<?= htmlspecialchars($row['fullname']); ?>">
                                    </div>
                                    <p><?= htmlspecialchars($row['fullname']); ?></p>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($row['nim']); ?></td>
                            <td><?= htmlspecialchars($row['prodi']); ?></td>
                            <td>
                                <div class="action">
                                    <a href="ubah.php?nim=<?= $row['nim']; ?>" class="ubah">Ubah</a>
                                    <a href="hapus_mahasiswa.php?nim=<?= $row['nim']; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="5" style="text-align: center;">Tidak ada data ditemukan.</td></tr>';
                }
                ?>
            </table>
        </div>

        <!-- Pagination -->
        <div class="container-pagination">
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1; ?>&search=<?= $search; ?>&sort=<?= $sort; ?>" class="btn-pagination">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 7l-5 5l5 5" />
                        </svg>
                    </a>
                <?php endif; ?>

                <p>Halaman <?= $page; ?> dari <?= $totalPages; ?></p>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1; ?>&search=<?= $search; ?>&sort=<?= $sort; ?>" class="btn-pagination">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <g transform="translate(24 0) scale(-1 1)">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 7l-5 5l5 5" />
                            </g>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
