<?php
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';

// Menangkap flash message untuk error validasi
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
    <section class="card border-0 shadow-sm rounded-4 mx-auto mb-5" style="max-width: 600px; overflow: hidden;">
        <!-- Header Section -->
        <div class="p-4 p-md-5 text-center text-white" style="background-color: #5d7062;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#F4C430" class="bi bi-journal-plus mb-3" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
              <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
              <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
            </svg>
            <h3 class="fw-bold mb-1">Tambah Buku Baru</h3>
            <p class="opacity-75 mb-0" style="font-size: 0.95rem;">Masukkan detail literatur ke dalam sistem</p>
        </div>

        <!-- Form Body -->
        <div class="card-body p-4 p-md-5">
            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3">
                    <?php echo $flash['pesan']; ?>
                </div>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_tambah.php">
                <div class="row g-4">
                    <div class="col-12">
                        <label for="judul" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Judul Buku</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="judul" name="judul" required>
                    </div>
                    <div class="col-12">
                        <label for="pengarang" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Pengarang</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="pengarang" name="pengarang" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tahun" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Tahun Terbit</label>
                        <input type="number" class="form-control bg-light border-0 py-3 rounded-4" id="tahun" name="tahun" min="1900" max="2026" required>
                    </div>
                    <div class="col-md-6">
                        <label for="isbn" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">ISBN</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="isbn" name="isbn">
                    </div>
                    <div class="col-md-6">
                        <label for="stok" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Stok</label>
                        <input type="number" class="form-control bg-light border-0 py-3 rounded-4" id="stok" name="stok" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kategori" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Kategori</label>
                        <select class="form-select bg-light border-0 py-3 rounded-4" id="kategori" name="kategori">
                            <option value="Fiksi">Fiksi</option>
                            <option value="Non-Fiksi">Non-Fiksi</option>
                            <option value="Referensi">Referensi</option>
                        </select>
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm d-flex justify-content-center align-items-center gap-2" style="background-color: #4b5e52; font-size: 1.05rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
                              <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                            Simpan Data Buku
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>