<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$waktu_tunggu = 60; 


if (isset($_SESSION['lockout_time'])) {
    $waktu_berlalu = time() - $_SESSION['lockout_time'];

    if ($waktu_berlalu < $waktu_tunggu) {
       
        $sisa_waktu = $waktu_tunggu - $waktu_berlalu;
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => "Akun dikunci sementara! Coba lagi dalam $sisa_waktu detik."];
        header('Location: login.php');
        exit;
    } else {
        unset($_SESSION['lockout_time']);
        $_SESSION['login_attempts'] = 0;
    }
}


if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username dan Password wajib diisi!'];
    header('Location: login.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['lockout_time']);

        $_SESSION['logged_in'] = true;
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['role']      = $user['role'];
        $_SESSION['nama']      = $user['nama'];

        header('Location: ../index.php');
        exit;
    } else {
        $_SESSION['login_attempts'] += 1;

        if ($_SESSION['login_attempts'] >= 3) {
            // Kena blokir! Catat waktu tepat saat kejadian
            $_SESSION['lockout_time'] = time();
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akun dikunci! Anda gagal 3 kali berturut-turut. Tunggu 1 menit.'];
        } else {
            $sisa = 3 - $_SESSION['login_attempts'];
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username atau Password salah! Sisa percobaan: ' . $sisa];
        }

        header('Location: login.php');
        exit;
    }

} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Terjadi kesalahan sistem: ' . $e->getMessage()];
    header('Location: login.php');
    exit;
}
?>