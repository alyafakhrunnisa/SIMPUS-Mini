<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';

// Menangkap flash message
$flash =$_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Mengambil data buku dari session
$daftarBuku =$_SESSION['buku'] ?? [];

// Fitur Pencarian Aktif
$search =$_GET['search'] ?? '';
if ($search !== '') {
    $daftarBuku = array_filter($daftarBuku, function($buku) use ($search) {
        $term = strtolower($search);
        // Mencari berdasarkan Judul atau Pengarang
        return strpos(strtolower($buku['judul']),$term) !== false || 
               strpos(strtolower($buku['pengarang']),$term) !== false;
    });
}
?>
    <section class="mx-auto mb-5" style="max-width: 1100px;">
        <!-- Header Banner -->
        <div class="card border-0 rounded-top-4 mb-4" style="background-color: #5d7062;">
            <div class="card-body p-4 text-white">
                <h4 class="card-title fw-bold mb-1 d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-book me-2" viewBox="0 0 16 16">
                      <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                    Katalog Buku
                </h4>
                <p class="card-text opacity-75 mb-0" style="font-size: 0.95rem;">Kelola koleksi literatur perpustakaan</p>
            </div>
        </div>

        <?php if ($flash): ?>
            <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3 shadow-sm mb-4">
                <?php echo $flash['pesan']; ?>
            </div>
        <?php endif; ?>

        <!-- Toolbar: Search & Buttons -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <!-- Form Pencarian -->
            <form method="GET" action="list.php" class="w-100" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-secondary rounded-start-pill ps-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-1 rounded-end-pill py-2" placeholder="Cari judul, pengarang..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
            </form>

            <!-- Aksi Buttons -->
            <div class="d-flex gap-2 w-100 justify-content-md-end">
                <button type="button" onclick="muatUlangBuku()" class="btn btn-light border text-secondary fw-medium rounded-pill px-4 py-2 shadow-sm text-nowrap" style="font-size: 0.9rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise me-1 mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                    </svg>
                    Muat Ulang
                </button>
                <a href="tambah.php" class="btn text-white fw-medium rounded-pill px-4 py-2 shadow-sm text-nowrap" style="background-color: #5d7062; font-size: 0.9rem;">
                    + Tambah Buku
                </a>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                        <thead>
                            <tr class="text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                                <th class="ps-4 py-4 border-bottom-0">JUDUL</th>
                                <th class="py-4 border-bottom-0">PENGARANG</th>
                                <th class="py-4 border-bottom-0">KATEGORI</th>
                                <th class="py-4 border-bottom-0">ISBN</th>
                                <th class="py-4 border-bottom-0">STOK</th>
                                <th class="text-center py-4 border-bottom-0 pe-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="border-top" id="tabel-buku">
                            <?php if (empty($daftarBuku)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    <?php echo $search !== '' ? 'Buku tidak ditemukan.' : 'Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".'; ?>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($daftarBuku as $index =>$buku): ?>
                                <tr>
                                    <td class="ps-4 py-3 fw-bold text-dark" style="font-size: 0.9rem;"><?php echo htmlspecialchars($buku['judul']); ?></td>
                                    <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?php echo htmlspecialchars($buku['pengarang']); ?></td>
                                    <td class="py-3 text-secondary fw-medium" style="font-size: 0.9rem;"><?php echo htmlspecialchars($buku['kategori']); ?></td>
                                    <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?php echo htmlspecialchars($buku['isbn'] ?? '-'); ?></td>
                                    <td class="py-3">
                                        <?php if ($buku['stok'] > 0): ?>
                                            <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-1" style="font-weight: 500; font-size: 0.8rem;"><?php echo htmlspecialchars($buku['stok']); ?> Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3 py-1" style="font-weight: 500; font-size: 0.8rem;">Habis</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center py-3 pe-4">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="edit.php?id=<?php echo $index; ?>" class="btn btn-sm btn-outline-warning rounded-pill px-3" style="font-size: 0.8rem; font-weight: 500;">Edit</a>
                                            <a href="detail.php?id=<?php echo $index; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-size: 0.8rem; font-weight: 500;">Detail</a>
                                            <a href="hapus.php?id=<?php echo $index; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" style="font-size: 0.8rem; font-weight: 500;" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Script JavaScript untuk memunculkan efek loading -->
    <script>
    function muatUlangBuku() {
        const tbody = document.getElementById('tabel-buku');
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-5 text-secondary" style="font-size: 0.95rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split me-2 mb-1" viewBox="0 0 16 16">
                      <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                    </svg>
                    Memuat data...
                </td>
            </tr>
        `;
        setTimeout(() => {
            window.location.href = 'list.php';
        }, 600);
    }
    </script>
<?php include __DIR__ . '/../includes/footer.php'; ?>