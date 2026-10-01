<?php
require __DIR__ . '/includes/koneksi.php';

$jsonFile = __DIR__ . '/../jobsheet 06/data/buku.json'; 

if (!file_exists($jsonFile)) {
    die("File JSON tidak ditemukan di path: $jsonFile");
}

// Baca isi file JSON
$jsonData = file_get_contents($jsonFile);
$bukuArray = json_decode($jsonData, true);

if (empty($bukuArray)) {
    die("File JSON kosong atau format tidak valid.");
}

$successCount = 0;

// Siapkan prepared statement untuk memasukkan data ke PostgreSQL
$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, pengarang, kategori, isbn, stok) 
     VALUES (:judul, :pengarang, :kategori, :isbn, :stok)"
);

foreach ($bukuArray as $buku) {
    try {
        $stmt->execute([
            'judul'     => $buku['judul'] ?? 'Tanpa Judul',
            'pengarang' => $buku['pengarang'] ?? 'Anonim',
            'kategori'  => $buku['kategori'] ?? 'Umum',
            'isbn'      => $buku['isbn'] ?? '-',
            'stok'      => $buku['stok'] ?? 0
        ]);
        $successCount++;
    } catch (PDOException $e) {
        // Lewati jika terjadi error (misalnya duplikat)
        continue;
    }
}

echo "<h3>Migrasi Berhasil!</h3>";
echo "<p>Sebanyak <strong>$successCount</strong> data buku dari file JSON berhasil dipindahkan ke database PostgreSQL.</p>";
echo '<a href="buku/list.php">Lihat Daftar Buku &rarr;</a>';