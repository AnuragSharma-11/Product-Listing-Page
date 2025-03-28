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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .dashboard-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn {
            padding: 12px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-container">
            <h2>Admin Dashboard</h2>
            <div class="btn-container">
                <a href="categories.php" class="btn btn-primary">Manage Categories</a>
                <a href="subcategories.php" class="btn btn-secondary">Manage Subcategories</a>
                <a href="child-categories.php" class="btn btn-success">Manage Child Categories</a>
                <a href="products.php" class="btn btn-warning">Manage Products</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
