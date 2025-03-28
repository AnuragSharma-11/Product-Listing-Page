<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Fetch subcategories for dropdown
$subcategoryQuery = "SELECT * FROM subcategories";
$subcategoryResult = mysqli_query($conn, $subcategoryQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subcategory_id = $_POST['subcategory_id'];
    $name = $_POST['name'];
    $slug = strtolower(str_replace(' ', '-', $name));

    // ✅ Subcategory slug fetch karna
    $subcategorySlugQuery = "SELECT slug FROM subcategories WHERE id = ?";
    $stmt = mysqli_prepare($conn, $subcategorySlugQuery);
    mysqli_stmt_bind_param($stmt, "i", $subcategory_id);
    mysqli_stmt_execute($stmt);
    $subcategorySlugResult = mysqli_stmt_get_result($stmt);
    $subcategoryData = mysqli_fetch_assoc($subcategorySlugResult);
    $subcategory_slug = $subcategoryData['slug'] ?? '';

    // ✅ Insert child category with subcategory_slug
    $sql = "INSERT INTO child_categories (subcategory_id, subcategory_slug, name, slug) 
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $subcategory_id, $subcategory_slug, $name, $slug);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: child-categories.php");
        exit;
    } else {
        echo "<p>Error inserting child category: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Child Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Add New Child Category</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Subcategory</label>
                <select name="subcategory_id" class="form-control" required>
                    <option value="">Select Subcategory</option>
                    <?php while ($subcategory = mysqli_fetch_assoc($subcategoryResult)) { ?>
                        <option value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Child Category Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Child Category</button>
            <a href="child-categories.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>