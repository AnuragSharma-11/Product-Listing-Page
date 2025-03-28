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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-container {
            max-width: 500px;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        .dashboard-container h2 {
            margin-bottom: 25px;
            color: #007bff;
            font-weight: bold;
        }
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .btn {
            padding: 14px;
            font-size: 17px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.1s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>
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
</body>
</html>
