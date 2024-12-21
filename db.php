<?php
$host = 'localhost';
$db = 'Toko_bunga_bloomris';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi berhasil"; // Pesan ini untuk memastikan koneksi berhasil
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    die();
}

// Fungsi untuk menutup koneksi
function closeConnection() {
    global $pdo;
    $pdo = null;
}

// Jangan lupa untuk menutup koneksi setelah selesai digunakan
// closeConnection();
?>
