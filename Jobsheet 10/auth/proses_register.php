<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi_password'] ?? '';

// Validasi Input Kosong
if (empty($nama) || empty($username) || empty($password)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Semua kolom wajib diisi!'];
    header('Location: register.php');
    exit;
}

// Validasi Password Cocok
if ($password !== $konfirmasi) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Password dan Konfirmasi Password tidak cocok!'];
    header('Location: register.php');
    exit;
}

try {
    //Cek apakah username sudah dipakai
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->fetch()) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah terdaftar, pilih yang lain!'];
        header('Location: register.php');
        exit;
    }

    // Enkripsi Password (WAJIB biar aman)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke Database
    $stmt = $pdo->prepare("INSERT INTO users (nama, username, password) VALUES (:nama, :username, :password)");
    $stmt->execute([
        'nama' => $nama,
        'username' => $username,
        'password' => $hashed_password
    ]);

    // Jika berhasil,di arahkan ke halaman Login
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil! Silakan Login.'];
    header('Location: login.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mendaftar: ' . $e->getMessage()];
    header('Location: register.php');
    exit;
}
?>