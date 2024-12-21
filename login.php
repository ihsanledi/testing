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
    
        // Validasi role pengguna
        if ($_SESSION['role'] === 'customer') {
            header("Location: dashboardCustomer.php"); // Redirect ke dashboard customer
        } elseif ($_SESSION['role'] === 'admin') {
            header("Location: dashboardAdmin.php"); // Redirect ke dashboard admin
        } else {
            // Jika role tidak dikenali, arahkan ke halaman default atau error
            header("Location: unknownRole.php");
        }
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
    <!-- <link rel="stylesheet" type="text/css" href="css/styles.css"> -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">


</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">HOME</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Jika pengguna adalah admin -->
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li><a href="dashboardAdmin.php">DASHBOARD</a></li>
                    <li><a href="flowersAdmin.php">FLOWERS</a></li>
                <!-- Jika pengguna adalah customer -->
                <?php elseif ($_SESSION['role'] === 'customer'): ?>
                    <li><a href="dashboardCustomer.php">DASHBOARD</a></li>
                    <li><a href="flowersCustomer.php">FLOWERS</a></li>
                <?php endif; ?>
                <li><a href="logout.php">LOGOUT</a></li>
            <?php else: ?>
                <!-- Jika pengguna belum login -->
                <li><a href="login.php">LOGIN</a></li>
            <?php endif; ?>
        </ul>
    </nav>

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
