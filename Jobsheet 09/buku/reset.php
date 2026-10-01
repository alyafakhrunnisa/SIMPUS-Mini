<?php
session_start();
// Panggil koneksi
require __DIR__ . '/../includes/koneksi.php';

// Eksekusi perintah SQL untuk menghapus semua baris di tabel buku
$pdo->query("DELETE FROM buku");

$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Seluruh data buku berhasil dikosongkan dari database!'
];

header("Location: list.php");
exit;