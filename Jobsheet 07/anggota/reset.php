<?php
// wajib dimulai dengan session_start()
session_start();

if (isset($_SESSION['anggota'])) {
    unset($_SESSION['anggota']);
}


$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Seluruh anggota buku berhasil dikosongkan!'
];

header("Location: list.php");
exit;
?>