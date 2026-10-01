<?php
$page_title = "Edit Anggota";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
    header('Location: list.php');
    exit;
}
?>
    <section class="card border-0 shadow-sm rounded-4 mx-auto mb-5" style="max-width: 600px; overflow: hidden;">
        <div class="p-4 p-md-5 text-center text-white" style="background-color: #8FA396;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-lines-fill mb-3" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
            </svg>
            <h3 class="fw-bold mb-1">Edit Data Anggota</h3>
            <p class="opacity-75 mb-0" style="font-size: 0.95rem;">Perbarui informasi keanggotaan perpustakaan</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3">
                    <?php echo $flash['pesan']; ?>
                </div>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_edit.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($anggota['id']); ?>">

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="no_anggota" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Nomor Anggota (NIM)</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="no_anggota" name="no_anggota" value="<?php echo htmlspecialchars($anggota['no_anggota']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="nama" name="nama" value="<?php echo htmlspecialchars($anggota['nama']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Email</label>
                        <input type="email" class="form-control bg-light border-0 py-3 rounded-4" id="email" name="email" value="<?php echo htmlspecialchars($anggota['email']); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="prodi" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Program Studi</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="prodi" name="prodi" value="<?php echo htmlspecialchars($anggota['prodi'] ?? ''); ?>" placeholder="Contoh: Sistem Informasi Bisnis">
                    </div>
                    <div class="col-12">
                        <label for="no_hp" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">No. HP / Telepon</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-4" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($anggota['no_hp'] ?? ''); ?>">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Alamat</label>
                        <textarea class="form-control bg-light border-0 py-3 rounded-4" id="alamat" name="alamat" rows="3"><?php echo htmlspecialchars($anggota['alamat'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm d-flex justify-content-center align-items-center gap-2" style="background-color: #8FA396; font-size: 1.05rem;">
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