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
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Child Categories</h2>
        <table class="table table-bordered">
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
                            <a href="edit-child-category.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Delete button -->
                            <a href="child-categories.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this child category?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <!-- Back to Dashboard link -->
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
        
        <!-- Add New Child Category link -->
        <a href="add-child-category.php" class="btn btn-success">Add Child Category</a>
    </div>
</body>
</html>
