<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Fetch categories, subcategories, and child categories for dropdown
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

$subcategoryQuery = "SELECT * FROM subcategories";
$subcategoryResult = mysqli_query($conn, $subcategoryQuery);

$childCategoryQuery = "SELECT * FROM child_categories";
$childCategoryResult = mysqli_query($conn, $childCategoryQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $subcategory_id = mysqli_real_escape_string($conn, $_POST['subcategory_id']);
    $child_category_id = mysqli_real_escape_string($conn, $_POST['child_category_id']);
    $slug = strtolower(str_replace(' ', '-', $name));

    // Image Upload Handling
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Check if "images" folder exists, if not create it
    if (!is_dir("../images")) {
        mkdir("../images", 0777, true);
    }
    
    // Generate a unique name for the image
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $image_name = time() . "_" . uniqid() . "." . $image_ext;
    
    // Move image to images folder
    move_uploaded_file($image_tmp, "../images/" . $image_name);

    // Insert into database
    $sql = "INSERT INTO products (name, description, price, image, category_id, subcategory_id, child_category_id, slug) 
            VALUES ('$name', '$description', '$price', '$image_name', '$category_id', '$subcategory_id', '$child_category_id', '$slug')";

    if (mysqli_query($conn, $sql)) {
        header("Location: products.php");
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
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Add New Product</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
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
                <label class="form-label">Subcategory</label>
                <select name="subcategory_id" class="form-control" required>
                    <option value="">Select Subcategory</option>
                    <?php while ($subcategory = mysqli_fetch_assoc($subcategoryResult)) { ?>
                        <option value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Child Category</label>
                <select name="child_category_id" class="form-control" required>
                    <option value="">Select Child Category</option>
                    <?php while ($childCategory = mysqli_fetch_assoc($childCategoryResult)) { ?>
                        <option value="<?php echo $childCategory['id']; ?>"><?php echo $childCategory['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add Product</button>
            <a href="products.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
