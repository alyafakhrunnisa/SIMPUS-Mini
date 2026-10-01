<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// Pastikan yang masuk ke sini adalah dari form POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi Input Kosong
if (empty($username) || empty($password)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username dan Password wajib diisi!'];
    header('Location: login.php');
    exit;
}

try {
    // Cari user di database berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cek apakah user ada DAN passwordnya cocok
    if ($user && password_verify($password, $user['password'])) {
        
        // Jika cocok, buat sesi login (kunci masuk)
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['role']      = $user['role'];
        $_SESSION['nama']      = $user['nama'];

        // Arahkan ke halaman utama SIMPUS-Mini
        header('Location: ../index.php');
        exit;
    } else {
        // Jika gagal, kembalikan ke halaman login dengan pesan error
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username atau Password salah!'];
        header('Location: login.php');
        exit;
    }

} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Terjadi kesalahan sistem: ' . $e->getMessage()];
    header('Location: login.php');
    exit;
}
?>