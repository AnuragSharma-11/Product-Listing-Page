<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id=$id";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $slug = strtolower(str_replace(' ', '-', $name));

    $sql = "UPDATE categories SET name='$name', slug='$slug' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: categories.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Category</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $category['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="categories.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
