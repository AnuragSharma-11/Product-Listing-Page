<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product data
    $productQuery = "SELECT * FROM products WHERE id = '$product_id'";
    $productResult = mysqli_query($conn, $productQuery);
    $product = mysqli_fetch_assoc($productResult);

    // Fetch categories, subcategories, and child categories for dropdown
    $categoryQuery = "SELECT * FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);

    $subcategoryQuery = "SELECT * FROM subcategories";
    $subcategoryResult = mysqli_query($conn, $subcategoryQuery);

    $childCategoryQuery = "SELECT * FROM child_categories";
    $childCategoryResult = mysqli_query($conn, $childCategoryQuery);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : $product['image']; // Keep the old image if new one is not uploaded
        $category_id = $_POST['category_id'];
        $subcategory_id = $_POST['subcategory_id'];
        $child_category_id = $_POST['child_category_id'];
        $slug = strtolower(str_replace(' ', '-', $name));

        // Move the uploaded image to the desired folder
        if ($_FILES['image']['name']) {
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        }

        $updateQuery = "UPDATE products SET name = '$name', description = '$description', price = '$price', image = '$image', category_id = '$category_id', subcategory_id = '$subcategory_id', child_category_id = '$child_category_id', slug = '$slug' WHERE id = '$product_id'";

        if (mysqli_query($conn, $updateQuery)) {
            header("Location: products.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Product</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" step="0.01" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                <p>Current Image: <img src="uploads/<?php echo $product['image']; ?>" width="100" height="100"></p>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php while ($category = mysqli_fetch_assoc($categoryResult)) { ?>
                        <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $product['category_id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Subcategory</label>
                <select name="subcategory_id" class="form-control" required>
                    <option value="">Select Subcategory</option>
                    <?php while ($subcategory = mysqli_fetch_assoc($subcategoryResult)) { ?>
                        <option value="<?php echo $subcategory['id']; ?>" <?php if ($subcategory['id'] == $product['subcategory_id']) echo 'selected'; ?>><?php echo $subcategory['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Child Category</label>
                <select name="child_category_id" class="form-control" required>
                    <option value="">Select Child Category</option>
                    <?php while ($childCategory = mysqli_fetch_assoc($childCategoryResult)) { ?>
                        <option value="<?php echo $childCategory['id']; ?>" <?php if ($childCategory['id'] == $product['child_category_id']) echo 'selected'; ?>><?php echo $childCategory['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Product</button>
            <a href="products.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
