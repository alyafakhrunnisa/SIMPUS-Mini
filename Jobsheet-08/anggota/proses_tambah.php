<?php
session_start();
// Panggil koneksi database
require __DIR__ . '/../includes/koneksi.php';

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$tanggal = trim($_POST['tanggal'] ?? ''); 
$prodi = trim($_POST['prodi'] ?? '');
$email = trim($_POST['email'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');

$errors = [];
if ($nim === '') $errors[] = "NIM wajib diisi.";
if ($nama === '') $errors[] = "Nama wajib diisi.";
if ($email === '') $errors[] = "Email wajib diisi.";

// Jika ada error, kembali ke form tambah dengan membawa pesan error
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode('<br>', $errors)];
    header('Location: tambah.php');
    exit;
}

// Simpan semua data ke Database PostgreSQL
try {
    $stmt = $pdo->prepare(
        "INSERT INTO anggota (no_anggota, nama, tanggal, prodi, email, no_hp, alamat)
         VALUES (:no_anggota, :nama, :tanggal, :prodi, :email, :no_hp, :alamat)"
    );

    $stmt->execute([
        'no_anggota' => $nim,
        'nama'       => $nama,
        'tanggal'    => $tanggal,
        'prodi'      => $prodi,
        'email'      => $email,
        'no_hp'      => $telepon,
        'alamat'     => $alamat
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data anggota berhasil disimpan ke database!'];
} catch (PDOException $e) {
    // Tangkap error jika No. Anggota kembar
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menyimpan: No. Anggota (NIM) sudah terdaftar!'];
    header('Location: tambah.php');
    exit;
}

header('Location: list.php');
exit;