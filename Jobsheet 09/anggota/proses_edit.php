<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// Tangkap inputan form
$id = $_POST['id'] ?? '';
$no_anggota = trim($_POST['no_anggota'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');

// Validasi dasar
if (empty($id) || empty($no_anggota) || empty($nama)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Nomor Anggota dan Nama wajib diisi!'];
    header('Location: edit.php?id=' . $id);
    exit;
}

try {
    $stmt = $pdo->prepare("
        UPDATE anggota 
        SET no_anggota = :no_anggota, 
            nama = :nama, 
            email = :email, 
            prodi = :prodi, 
            no_hp = :no_hp, 
            alamat = :alamat 
        WHERE id = :id
    ");

    $stmt->execute([
        'no_anggota' => $no_anggota,
        'nama'       => $nama,
        'email'      => $email,
        'prodi'      => $prodi,
        'no_hp'      => $no_hp,
        'alamat'     => $alamat,
        'id'         => $id
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Mantap, data anggota berhasil diperbarui!'];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mengupdate data: ' . $e->getMessage()];
    header('Location: edit.php?id=' . $id);
    exit;
}
?>