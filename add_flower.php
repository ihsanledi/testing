<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once 'db.php';

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    // Validate inputs
    if ($name && $price && $description && $image['name']) {
        // Handle file upload
        $target_dir = "images/";
        $target_file = $target_dir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $target_file);

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO flowers (name, price, description, image) VALUES (:name, :price, :description, :image)");
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':description' => $description,
            ':image' => $image['name']
        ]);

        $message = "Item berhasil ditambahkan!";
    } else {
        $message = "Harap isi semua field!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk - Bloomris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body class="bg-secondary">
    <?php include 'navbarAdmin.php'; ?>

    <div class="container mt-4">
        <h1 class="text-center text-white">Tambah Produk Baru</h1>

        <?php if ($message): ?>
            <div class="alert alert-info text-center"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Bunga</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>
    </div>

    <footer class="text-center text-white mt-4 py-4" style="background-color: #210C28;">
        <p>&copy; 2024 Toko Bunga Online</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
