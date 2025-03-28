<?php 
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Categories fetch karna dropdown ke liye
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $name = trim($_POST['name']); // Extra spaces hataye
    $slug = strtolower(str_replace(' ', '-', $name));

    // ✅ Ensure slug is unique
    $originalSlug = $slug;
    $counter = 1;

    while (true) {
        $checkSlugQuery = "SELECT id FROM subcategories WHERE slug = '$slug'";
        $result = mysqli_query($conn, $checkSlugQuery);

        if (mysqli_num_rows($result) == 0) {
            // Slug unique hai, loop se bahar niklo
            break;
        } else {
            // Slug already hai, new unique slug banaye
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
    }

    // ✅ Insert new subcategory with unique slug
    $sql = "INSERT INTO subcategories (category_id, name, slug) VALUES ('$category_id', '$name', '$slug')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: subcategories.php");
        exit;
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subcategory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Add New Subcategory</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php while ($category = mysqli_fetch_assoc($categoryResult)) { ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Subcategory Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Subcategory</button>
            <a href="subcategories.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>