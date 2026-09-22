<?php
// Konfigurasi Session & Path Root (Jangan dihapus!)
session_start(); 
$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

// Mengambil judul halaman dari variabel $page_title
$title = $page_title ?? 'SIMPUS-Mini';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .bg-aesthetic { background-color: #5d7062 !important; }
        .text-aesthetic { color: #5d7062 !important; }
        .border-aesthetic { border-color: #5d7062 !important; }
        /* Animasi halus saat menu di-hover */
        .navbar-nav .nav-link { transition: all 0.2s ease-in-out; }
        .navbar-nav .nav-link:hover { color: #ffffff !important; opacity: 1 !important; transform: translateY(-1px); }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-aesthetic mb-5 shadow-sm py-3">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="<?php echo $base; ?>index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F4C430" class="bi bi-book-half me-2" viewBox="0 0 16 16">
                    <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
                SIMPUS-Mini
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu Navigasi Dinamis -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3" style="font-size: 0.95rem;">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title === 'Beranda') ? 'fw-bold text-white' : 'text-white opacity-75'; ?>" href="<?php echo $base; ?>index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title === 'Daftar Buku') ? 'fw-bold text-white' : 'text-white opacity-75'; ?>" href="<?php echo $base; ?>buku/list.php">Daftar Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title === 'Tambah Buku') ? 'fw-bold text-white' : 'text-white opacity-75'; ?>" href="<?php echo $base; ?>buku/tambah.php">Tambah Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title === 'Daftar Anggota') ? 'fw-bold text-white' : 'text-white opacity-75'; ?>" href="<?php echo $base; ?>anggota/list.php">Daftar Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($title === 'Tambah Anggota') ? 'fw-bold text-white' : 'text-white opacity-75'; ?>" href="<?php echo $base; ?>anggota/tambah.php">Tambah Anggota</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Membuka container utama konten -->
    <div class="container pb-5">