<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';

// Panggil koneksi database
require __DIR__ . '/includes/koneksi.php';

// Mengambil jumlah total data langsung dari PostgreSQL
$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
?>
    <!-- Welcoming Section -->
    <section class="card border-0 shadow-sm rounded-4 mb-4 bg-aesthetic position-relative overflow-hidden">
        <!-- Dekorasi lingkaran tipis di background -->
        <div class="position-absolute rounded-circle" style="width: 300px; height: 300px; background: rgba(255,255,255,0.05); top: -50px; right: -50px;"></div>
        <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: rgba(255,255,255,0.05); bottom: -150px; right: 10%;"></div>
        
        <div class="card-body p-4 p-lg-5 position-relative z-1 text-start">
            <span class="badge bg-white text-aesthetic rounded-pill px-3 py-2 mb-3 shadow-sm" style="font-weight: 500; letter-spacing: 0.5px;">
                ✨ Dashboard Admin
            </span>
            <h2 class="card-title fw-bold text-white mb-3">Halo, Penggerak Literasi! ✨</h2>
            <p class="card-text text-white opacity-75 mb-0" style="font-size: 1.05rem; max-width: 600px;">
                Kelola katalog perpustakaan, pantau sirkulasi peminjaman, dan bangun ekosistem membaca yang lebih modern dengan sentuhan estetika. Semua dalam kendalimu hari ini.
            </p>
        </div>
    </section>

    <!-- Ringkasan Data -->
    <section class="mb-5">
        <h5 class="mb-3 fw-bold text-aesthetic">Ringkasan Sistem</h5>
        <div class="row g-3 text-center">
            <div class="col-6 col-lg-3">
                <div class="p-4 rounded-4 shadow-sm bg-white border-top border-4 border-aesthetic">
                    <h3 class="h6 text-secondary fw-semibold">Total Buku</h3>
                    <!-- Menampilkan variabel $totalBuku dari database -->
                    <p class="fs-2 fw-bold mb-0 text-aesthetic"><?php echo $totalBuku; ?></p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-4 rounded-4 shadow-sm bg-white border-top border-4" style="border-color: #8FA396 !important;">
                    <h3 class="h6 text-secondary fw-semibold">Total Anggota</h3>
                    <!-- Menampilkan variabel $totalAnggota dari database -->
                    <p class="fs-2 fw-bold mb-0" style="color: #8FA396;"><?php echo $totalAnggota; ?></p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-4 rounded-4 shadow-sm bg-white border-top border-4" style="border-color: #D4A373 !important;">
                    <h3 class="h6 text-secondary fw-semibold">Dipinjam</h3>
                    <p class="fs-2 fw-bold mb-0" style="color: #D4A373;">3</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-4 rounded-4 shadow-sm bg-white border-top border-4" style="border-color: #CB8A8A !important;">
                    <h3 class="h6 text-secondary fw-semibold">Terlambat</h3>
                    <p class="fs-2 fw-bold mb-0" style="color: #CB8A8A;">1</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Terbaru -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-aesthetic m-0">Katalog Terbaru</h5>
        <a href="buku/list.php" class="text-decoration-none small fw-medium" style="color: #8FA396;">Lihat Semua &rarr;</a>
    </div>
    <div class="table-responsive rounded-4 border-0 shadow-sm mb-5 bg-white">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-secondary">
                <tr>
                    <th class="ps-4 py-3 border-bottom-0">JUDUL BUKU</th>
                    <th class="py-3 border-bottom-0">PENGARANG</th>
                    <th class="py-3 border-bottom-0 text-center">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ps-4 py-3 fw-medium">Laskar Pelangi</td>
                    <td class="text-secondary">Andrea Hirata</td>
                    <td class="text-center"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Tersedia</span></td>
                </tr>
                <tr>
                    <td class="ps-4 py-3 fw-medium">Bumi Manusia</td>
                    <td class="text-secondary">Pramoedya Ananta Toer</td>
                    <td class="text-center"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Tersedia</span></td>
                </tr>
                <tr>
                    <td class="ps-4 py-3 fw-medium">Filosofi Teras</td>
                    <td class="text-secondary">Henry Manampiring</td>
                    <td class="text-center"><span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Dipinjam</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Kutipan Literasi -->
    <div class="card border-0 shadow-sm rounded-4 mb-3" style="background-color: #ffffff;">
        <div class="card-body p-4 text-center">
            <p class="fst-italic text-secondary mb-3 fs-5">"Selalu ada harapan bagi mereka yang sering berdoa. Selalu ada jalan bagi mereka yang sering berusaha."</p>
            <span class="badge bg-secondary-subtle text-secondary border border-secondary rounded-pill px-4 py-2">— Tere Liye (Komet)</span>
        </div>
    </div>

<?php include __DIR__ . '/includes/footer.php'; ?>