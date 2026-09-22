<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

// Menangkap flash message untuk error validasi
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
    <section class="card border-0 shadow-sm rounded-4 mx-auto mb-5" style="max-width: 600px; overflow: hidden;">
        <!-- Header Section -->
        <div class="p-4 p-md-5 text-center text-white" style="background-color: #7a8c80;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#F4C430" class="bi bi-person-vcard mb-3" viewBox="0 0 16 16">
              <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z"/>
              <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z"/>
            </svg>
            <h3 class="fw-bold mb-1">Registrasi Anggota</h3>
            <p class="opacity-75 mb-0" style="font-size: 0.95rem;">Daftarkan pembaca atau mahasiswa baru</p>
        </div>

        <!-- Form Body -->
        <div class="card-body p-4 p-md-5">
            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3">
                    <?php echo $flash['pesan']; ?>
                </div>
            <?php endif; ?>

            <form id="form-tambah-anggota" method="post" action="proses_tambah.php">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nim" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">No. Anggota</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="nim" name="nim" placeholder="A00X" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Tanggal Bergabung</label>
                        <input type="date" class="form-control bg-light border-0 py-3 rounded-4 text-secondary" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    
                    <div class="col-12">
                        <label for="nama" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="nama" name="nama" required>
                    </div>
                    
                    <div class="col-12">
                        <label for="prodi" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Program Studi</label>
                        <select class="form-select bg-light border-0 py-3 rounded-4" id="prodi" name="prodi">
                            <option value="Sistem Informasi Bisnis (SIB)" selected>Sistem Informasi Bisnis (SIB)</option>
                            <option value="Teknik Informatika (TI)">Teknik Informatika (TI)</option>
                            <option value="Sistem Kelistrikan">Sistem Kelistrikan</option>
                            <option value="Lainnya">Lainnya...</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Email</label>
                        <input type="email" class="form-control bg-light border-0 py-3 rounded-4" id="email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="telepon" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">No. HP</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="telepon" name="telepon" required>
                    </div>
                    
                    <div class="col-12">
                        <label for="alamat" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Alamat</label>
                        <textarea class="form-control bg-light border-0 py-3 rounded-4" id="alamat" name="alamat" rows="2" required></textarea>
                    </div>
                    
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm d-flex justify-content-center align-items-center gap-2" style="background-color: #8FA396; font-size: 1.05rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                            </svg>
                            Simpan Data Anggota
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>