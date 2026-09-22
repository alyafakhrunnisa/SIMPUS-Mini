<?php
session_start();
// Panggil koneksi
require __DIR__ . '/../includes/koneksi.php';

// Eksekusi perintah SQL untuk menghapus semua baris di tabel anggota
$pdo->query("DELETE FROM anggota");

$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Seluruh data anggota berhasil dikosongkan dari database!'
];

header("Location: list.php");
exit;