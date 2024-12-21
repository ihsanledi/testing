<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // nentuin query yang mau dieksekusi
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    // ngasih nilai pada parameter email
    $stmt->bindParam(':email', $email);
    // Menjalankan querynya
    $stmt->execute();

    // menyimpan nilai stmt ke user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Menyimpan informasi pengguna di sesi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php"); // Redirect ke halaman selamat datang
        exit();
    } else {
        echo "Email atau password salah!";
    }

    // Tutup koneksi setelah digunakan
    closeConnection();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php require 'navbar.php'?>


    <div class="container justify-content-center">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
