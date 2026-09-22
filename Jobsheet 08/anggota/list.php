<?php
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';

// 1. Panggil koneksi database
require __DIR__ . '/../includes/koneksi.php';

// Menangkap flash message
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// 2. Ambil data dari database. 
// Menggunakan trik "AS" agar nama kolom database (no_anggota, no_hp) berubah jadi (nim, telepon) saat ditarik ke array, sehingga HTML tabel di bawah tidak perlu diedit sama sekali!
$data_anggota = $pdo->query("SELECT no_anggota AS nim, nama, email, prodi, alamat, no_hp AS telepon, tanggal FROM anggota ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fitur Pencarian
$search = $_GET['search'] ?? '';
if ($search !== '') {
    $data_anggota = array_filter($data_anggota, function ($anggota) use ($search) {
        $nama_match = stripos($anggota['nama'] ?? '', $search) !== false;
        $email_match = stripos($anggota['email'] ?? '', $search) !== false;
        return $nama_match || $email_match;
    });
}
?>

<section class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <!-- Header Section -->
        <div class="p-4 p-md-5 text-white" style="background-color: #8FA396;">
            <div class="d-flex align-items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                </svg>
                <div>
                    <h3 class="fw-bold mb-0">Daftar Anggota</h3>
                    <p class="opacity-75 mb-0" style="font-size: 0.95rem;">Kelola data pembaca dan mahasiswa</p>
                </div>
            </div>
        </div>

        <!-- Body Section -->
        <div class="card-body p-4">
            <!-- Flash Message -->
            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3">
                    <?php echo $flash['pesan']; ?>
                </div>
            <?php endif; ?>

            <!-- Toolbar (Search & Buttons) -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
                <form method="get" action="list.php" class="w-100" style="max-width: 400px;">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0 rounded-start-pill ps-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#adb5bd" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>
                        <input type="text" name="search" class="form-control bg-light border-0 py-2 rounded-end-pill" placeholder="Cari nama, email..." value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                </form>

                <div class="d-flex gap-2 w-100 justify-content-md-end">
                    <a href="reset.php" class="btn btn-outline-danger rounded-pill px-4 py-2 d-flex align-items-center gap-2" onclick="return confirm('Yakin ingin mereset semua data anggota?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .471-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg>
                        Reset Data
                    </a>
                    <a href="list.php" class="btn btn-light border-0 text-secondary rounded-pill px-4 py-2 d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                        </svg>
                        Muat Ulang
                    </a>
                    <a href="tambah.php" class="btn text-white rounded-pill px-4 py-2 d-flex align-items-center gap-2" style="background-color: #8FA396;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Tambah Anggota
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">NO. ANGGOTA</th>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">NAMA LENGKAP</th>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">EMAIL</th>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">PRODI</th>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">ALAMAT</th>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">NO. HP</th>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">TGL BERGABUNG</th>
                            <th class="py-3 text-secondary" style="font-size: 0.85rem;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php if (count($data_anggota) > 0): ?>
                            <?php foreach ($data_anggota as $anggota): ?>
                                <tr>
                                    <td class="py-3 fw-bold text-dark" style="font-size: 0.9rem;"><?php echo htmlspecialchars($anggota['nim'] ?? '-'); ?></td>
                                    <td class="py-3 text-dark" style="font-size: 0.9rem;"><?php echo htmlspecialchars($anggota['nama'] ?? '-'); ?></td>
                                    <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?php echo htmlspecialchars($anggota['email'] ?? '-'); ?></td>
                                    <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?php echo htmlspecialchars($anggota['prodi'] ?? '-'); ?></td>
                                    <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?php echo htmlspecialchars($anggota['alamat'] ?? '-'); ?></td>
                                    <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?php echo htmlspecialchars($anggota['telepon'] ?? '-'); ?></td>
                                    <td class="py-3 text-secondary" style="font-size: 0.9rem;">
                                        <?php
                                        // Tampilkan tanggal yang diubah ke format "19 Sep 2026" jika datanya ada
                                        echo !empty($anggota['tanggal']) ? date('d M Y', strtotime($anggota['tanggal'])) : '-';
                                        ?>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-outline-warning rounded-pill px-3" style="font-size: 0.8rem;">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-size: 0.8rem;">Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#e9ecef" class="bi bi-folder2-open mb-3" viewBox="0 0 16 16">
                                        <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z" />
                                    </svg>
                                    <p class="mb-0">Belum ada data anggota.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>