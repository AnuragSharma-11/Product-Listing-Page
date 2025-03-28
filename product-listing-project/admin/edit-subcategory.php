<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM subcategories WHERE id=$id";
$result = mysqli_query($conn, $sql);
$subcategory = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $slug = strtolower(str_replace(' ', '-', $name));

    $sql = "UPDATE subcategories SET name='$name', slug='$slug' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: subcategories.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subcategory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Subcategory</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Subcategory Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $subcategory['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Subcategory</button>
            <a href="subcategories.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
