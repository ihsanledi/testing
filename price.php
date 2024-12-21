<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connect to database
$dsn = 'mysql:host=localhost;dbname=your_database';
$username = 'your_username';
$password = 'your_password';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch flowers from database
$stmt = $pdo->query("SELECT * FROM flowers");
$flowers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bloomris - Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body class="bg-secondary">
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h1 class="text-center text-white">Produk Unggulan Kami</h1>
        <p class="text-center text-light">Berikan Dia Cinta, Kirimkan Dia Bunga. Selamat berbelanja Bunga Cantik❤️</p>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($flowers as $flower): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="images/<?= htmlspecialchars($flower['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($flower['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($flower['name']) ?></h5>
                            <p class="card-text">Rp. <?= number_format($flower['price'], 2, ',', '.') ?></p>
                            <p class="card-text text-muted"> <?= htmlspecialchars(substr($flower['description'], 0, 100)) ?>...</p>
                        </div>
                        <div class="card-footer">
                            <a href="detail.php?id=<?= $flower['id'] ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="text-center text-white mt-4 py-4" style="background-color: #210C28;">
        <p>&copy; 2024 Toko Bunga Online</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>