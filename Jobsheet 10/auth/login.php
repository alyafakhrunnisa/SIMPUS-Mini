<?php
$page_title = "Login Akun";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 mx-auto overflow-hidden" style="max-width: 450px;">
        <!-- Header Hijau Khas SIMPUS-Mini -->
        <div class="p-4 p-md-5 text-center text-white" style="background-color: #5d7062;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#F4C430" class="bi bi-box-arrow-in-right mb-3" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
              <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
            <h3 class="fw-bold mb-1">Login Sistem</h3>
            <p class="opacity-75 mb-0" style="font-size: 0.95rem;">Masuk untuk mengelola SIMPUS-Mini</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <!-- Tempat nampilin pesan sukses dari register -->
            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3 shadow-sm mb-4">
                    <?php echo $flash['pesan']; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="proses_login.php">
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Username</label>
                    <input type="text" name="username" class="form-control bg-light border-0 py-3 rounded-4" required>
                </div>
                <div class="mb-5">
                    <label class="form-label fw-bold text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Password</label>
                    <input type="password" name="password" class="form-control bg-light border-0 py-3 rounded-4" required>
                </div>
                
                <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm" style="background-color: #4b5e52; font-size: 1.05rem;">
                    Masuk
                </button>

                <div class="text-center mt-4">
                    <p class="text-secondary mb-0" style="font-size: 0.9rem;">Belum punya akun? <a href="register.php" style="color: #4b5e52; font-weight: 600; text-decoration: none;">Daftar di sini</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>