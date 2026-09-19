<?php
session_start();

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

// Jika valid, inisialisasi array session jika belum ada
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

// Simpan data anggota baru ke dalam session
$_SESSION['anggota'][] = [
    'nim' => $nim,
    'nama' => $nama,
    'tanggal' => $tanggal, 
    'prodi'   => $prodi,
    'email' => $email,
    'telepon' => $telepon,
    'alamat' => $alamat,
];

// Set pesan sukses dan pindah ke halaman daftar
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data anggota berhasil disimpan!'];
header('Location: list.php');
exit;