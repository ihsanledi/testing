<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once 'db.php';

// Get the flower ID from the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID bunga tidak ditemukan.";
    exit();
}

$flower_id = $_GET['id'];

// Fetch flower details from the database
$stmt = $pdo->prepare("SELECT * FROM flowers WHERE id = ?");
$stmt->execute([$flower_id]);
$flower = $stmt->fetch();

if (!$flower) {
    echo "Bunga tidak ditemukan.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Validate inputs
    if (empty($name) || empty($price) || empty($description)) {
        $error = "Semua bidang harus diisi.";
    } else {
        // Update flower in the database
        $stmt = $pdo->prepare("UPDATE flowers SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $flower_id]);

        // Redirect to the list page
        header("Location: price.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bunga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
    <div class="container mt-5">
        <h1 class="text-center text-white">Edit Bunga</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Bunga</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($flower['name']) ?>">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($flower['price']) ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($flower['description']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="price.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
