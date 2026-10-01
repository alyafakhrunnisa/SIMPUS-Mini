<?php
// Cek sesi ala dosen (mencegah error session already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus variabel memori dan hancurkan sesi
session_unset();
session_destroy();

// Nyalakan sesi baru KHUSUS buat ngirim notif hijau ke halaman login
session_start();
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anda berhasil logout.'];

// Lempar ke halaman login
header('Location: login.php');
exit;