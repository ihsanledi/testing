<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BLOOMRIS</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">

    <!-- <link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css"> -->
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


    <main>
        <section class="hero">
            <h3>Berikan Dia Cinta,Beri Dia Bunga</h3>
            <p>Dapatkan bunga segar setiap hari!</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Toko Bunga Bloomris</p>
    </footer>
</body>
</html>
