<?php
// Panggil satpam utama (Mencegah orang yang belum login)
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

// Jika yang login BUKAN admin, tendang balik ke halaman list!
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya Admin yang boleh menghapus data.'];
    header('Location: list.php');
    exit;
}

// Logika asli menghapus data (Hanya bisa dieksekusi jika lolos kedua satpam di atas)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data anggota berhasil dihapus.'];
}

header('Location: list.php');
exit;
?>