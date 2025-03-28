<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Fetch all child categories with subcategory name
$sql = "SELECT child_categories.*, subcategories.name AS subcategory_name 
        FROM child_categories 
        JOIN subcategories ON child_categories.subcategory_id = subcategories.id";

$result = mysqli_query($conn, $sql);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM child_categories WHERE id = '$delete_id'";
    
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: child-categories.php"); // Redirect after deletion
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #343a40;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 15px;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
            padding: 12px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .btn {
            padding: 12px 18px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.08);
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: black;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .btn-warning:hover, .btn-danger:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Child Categories</h2>
        <div class="btn-container">
            <a href="add-child-category.php" class="btn btn-success"><i class="fas fa-plus"></i> Add Child Category</a>
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subcategory</th>
                    <th>Child Category</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['subcategory_name']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['slug']; ?></td>
                        <td>
                            <!-- Edit button -->
                            <a href="edit-child-category.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            
                            <!-- Delete button -->
                            <a href="child-categories.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this child category?')"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
