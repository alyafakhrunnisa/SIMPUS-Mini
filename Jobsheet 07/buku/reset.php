<?php
// wajib dimulai dengan session_start()
session_start();

// hanya menghapus sesi 'buku', sesi 'anggota' akan tetap aman
if (isset($_SESSION['buku'])) {
    unset($_SESSION['buku']);
}


$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Seluruh data buku berhasil dikosongkan!'
];

// kembalikan pengguna ke halaman daftar buku
header("Location: list.php");
exit;
?>