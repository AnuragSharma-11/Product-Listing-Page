<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Fetch the existing child category details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM child_categories WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $childCategory = mysqli_fetch_assoc($result);
}

// Handle the update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $slug = strtolower(str_replace(' ', '-', $name));
    
    $updateQuery = "UPDATE child_categories SET name = '$name', slug = '$slug' WHERE id = '$id'";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: child-categories.php");
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
    <title>Edit Child Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Child Category</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Child Category Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $childCategory['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update Child Category</button>
            <a href="child-categories.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
