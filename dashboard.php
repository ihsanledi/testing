<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>This is the dashboard. Only logged-in users can see this page.</p>
    </div>
</body>
</html>
