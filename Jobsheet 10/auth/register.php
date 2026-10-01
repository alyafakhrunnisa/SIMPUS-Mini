<?php
$page_title = "Registrasi Akun";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 mx-auto overflow-hidden" style="max-width: 500px;">
        <!-- Header Hijau Khas SIMPUS-Mini -->
        <div class="p-4 p-md-5 text-center text-white" style="background-color: #5d7062;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#F4C430" class="bi bi-person-badge mb-3" viewBox="0 0 16 16">
              <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
            </svg>
            <h3 class="fw-bold mb-1">Registrasi Akun</h3>
            <p class="opacity-75 mb-0" style="font-size: 0.95rem;">Daftar untuk mengelola SIMPUS-Mini</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3">
                    <?php echo $flash['pesan']; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="proses_register.php">
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control bg-light border-0 py-3 rounded-4" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Username</label>
                    <input type="text" name="username" class="form-control bg-light border-0 py-3 rounded-4" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Password</label>
                    <input type="password" name="password" class="form-control bg-light border-0 py-3 rounded-4" required>
                </div>
                <div class="mb-5">
                    <label class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Konfirmasi Password</label>
                    <input type="password" name="konfirmasi_password" class="form-control bg-light border-0 py-3 rounded-4" required>
                </div>
                
                <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm" style="background-color: #4b5e52; font-size: 1.05rem;">
                    Daftar 
                </button>

                <div class="text-center mt-4">
                    <p class="text-secondary mb-0" style="font-size: 0.9rem;">Sudah punya akun? <a href="login.php" style="color: #4b5e52; font-weight: 600; text-decoration: none;">Login di sini</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>