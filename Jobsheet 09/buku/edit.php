<?php
$page_title = "Edit Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Ambil ID dari URL (contoh: edit.php?id=3)[cite: 3]
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

// Tarik data lama dari database berdasarkan ID[cite: 3]
$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

// Kalau bukunya udah nggak ada, tendang balik ke list[cite: 3]
if (!$buku) {
    header('Location: list.php');
    exit;
}
?>
    <section class="card border-0 shadow-sm rounded-4 mx-auto mb-5" style="max-width: 600px; overflow: hidden;">
        <!-- Header Section -->
        <div class="p-4 p-md-5 text-center text-white" style="background-color: #5d7062;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#F4C430" class="bi bi-pencil-square mb-3" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            <h3 class="fw-bold mb-1">Edit Data Buku</h3>
            <p class="opacity-75 mb-0" style="font-size: 0.95rem;">Perbarui informasi literatur perpustakaan</p>
        </div>

        <!-- Form Body -->
        <div class="card-body p-4 p-md-5">
            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3">
                    <?php echo $flash['pesan']; ?>
                </div>
            <?php endif; ?>

            <!-- Perhatikan form action-nya mengarah ke proses_edit.php -->
            <form id="form-tambah" method="post" action="proses_edit.php">
                
                <!-- INI PENTING: Input tersembunyi buat bawa ID[cite: 3] -->
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($buku['id']); ?>">

                <div class="row g-4">
                    <div class="col-12">
                        <label for="judul" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Judul Buku</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="judul" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="pengarang" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Pengarang</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="pengarang" name="pengarang" value="<?php echo htmlspecialchars($buku['pengarang']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tahun" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Tahun Terbit</label>
                        <input type="number" class="form-control bg-light border-0 py-3 rounded-4" id="tahun" name="tahun" min="1900" max="2026" value="<?php echo htmlspecialchars($buku['tahun'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="isbn" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">ISBN</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="isbn" name="isbn" value="<?php echo htmlspecialchars($buku['isbn'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="stok" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Stok</label>
                        <input type="number" class="form-control bg-light border-0 py-3 rounded-4" id="stok" name="stok" min="0" value="<?php echo htmlspecialchars($buku['stok']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kategori" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Kategori</label>
                        <select class="form-select bg-light border-0 py-3 rounded-4" id="kategori" name="kategori">
                            <?php 
                            $kategori_list = ['Fiksi', 'Non-Fiksi', 'Referensi'];
                            foreach ($kategori_list as $kat): 
                                // Cek apakah kategori lama sama dengan opsi ini. Kalau sama, tambahkan atribut 'selected'[cite: 3]
                                $selected = ($buku['kategori'] === $kat) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $kat; ?>" <?php echo $selected; ?>><?php echo $kat; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm d-flex justify-content-center align-items-center gap-2" style="background-color: #4b5e52; font-size: 1.05rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                              <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>