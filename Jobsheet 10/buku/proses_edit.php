<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// Pastikan file ini cuma bisa diakses lewat form POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// Tangkap semua inputan dari form
$id = $_POST['id'] ?? '';
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? 0;
$kategori = $_POST['kategori'] ?? '';

// Validasi dasar, pastikan ID dan data penting tidak kosong
if (empty($id) || empty($judul) || empty($pengarang) || empty($tahun) || empty($stok)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Kolom bertanda * wajib diisi!'];
    header('Location: edit.php?id=' . $id);
    exit;
}

// Proses Update ke Database PostgreSQL
try {
    // Perhatikan: Kita pakai UPDATE, bukan INSERT INTO
    $stmt = $pdo->prepare("
        UPDATE buku 
        SET judul = :judul, 
            pengarang = :pengarang, 
            tahun = :tahun, 
            kategori = :kategori, 
            isbn = :isbn, 
            stok = :stok 
        WHERE id = :id
    ");

    $stmt->execute([
        'judul'     => $judul,
        'pengarang' => $pengarang,
        'tahun'     => (int)$tahun,
        'kategori'  => $kategori,
        'isbn'      => $isbn,
        'stok'      => (int)$stok,
        'id'        => $id
    ]);

    // Kalau sukses, lempar pesan hijau dan kembalikan ke list.php
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Mantap, data buku berhasil diperbarui!'];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    // Kalau database error, kembalikan ke halaman edit beserta pesan merah
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mengupdate data: ' . $e->getMessage()];
    header('Location: edit.php?id=' . $id);
    exit;
}
?>