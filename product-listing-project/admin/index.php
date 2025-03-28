<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Admin Dashboard</h2>
        <a href="categories.php" class="btn btn-primary">Manage Categories</a>
        <a href="subcategories.php" class="btn btn-secondary">Manage Subcategories</a>
        <a href="child-categories.php" class="btn btn-success">Manage Child Categories</a>
        <a href="products.php" class="btn btn-warning">Manage Products</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
