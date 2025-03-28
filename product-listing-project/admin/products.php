<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$filter_category = $_GET['category'] ?? '';
$filter_subcategory = $_GET['subcategory'] ?? '';
$filter_name = $_GET['name'] ?? '';
$filter_price = $_GET['price'] ?? '';

$sql = "SELECT products.*, categories.name AS category_name, subcategories.name AS subcategory_name, child_categories.name AS child_category_name
        FROM products
        JOIN categories ON products.category_id = categories.id
        JOIN subcategories ON products.subcategory_id = subcategories.id
        JOIN child_categories ON products.child_category_id = child_categories.id
        WHERE 1=1";

if ($filter_category) {
    $sql .= " AND categories.id = '$filter_category'";
}
if ($filter_subcategory) {
    $sql .= " AND subcategories.id = '$filter_subcategory'";
}
if ($filter_name) {
    $sql .= " AND products.name LIKE '%$filter_name%'";
}
if ($filter_price) {
    $sql .= " AND products.price = '$filter_price'";
}

$result = mysqli_query($conn, $sql);

$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

$subcategoryQuery = "SELECT * FROM subcategories";
$subcategoryResult = mysqli_query($conn, $subcategoryQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
            cursor: pointer;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
    <script>
        function applyFilters() {
            let category = document.getElementById('categoryFilter').value;
            let subcategory = document.getElementById('subcategoryFilter').value;
            let name = document.getElementById('nameFilter').value;
            let price = document.getElementById('priceFilter').value;
            window.location.href = `products.php?category=${category}&subcategory=${subcategory}&name=${name}&price=${price}`;
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Product Management</h2>
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="nameFilter" class="form-control" placeholder="Search Product Name" value="<?php echo $filter_name; ?>">
            </div>
            <div class="col-md-2">
                <input type="number" id="priceFilter" class="form-control" placeholder="Search Price" value="<?php echo $filter_price; ?>">
            </div>
            <div class="col-md-3">
                <select id="categoryFilter" class="form-control">
                    <option value="">All Categories</option>
                    <?php while ($cat = mysqli_fetch_assoc($categoryResult)) { ?>
                        <option value="<?php echo $cat['id']; ?>" <?php if ($filter_category == $cat['id']) echo 'selected'; ?>><?php echo $cat['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select id="subcategoryFilter" class="form-control">
                    <option value="">All Subcategories</option>
                    <?php while ($subcat = mysqli_fetch_assoc($subcategoryResult)) { ?>
                        <option value="<?php echo $subcat['id']; ?>" <?php if ($filter_subcategory == $subcat['id']) echo 'selected'; ?>><?php echo $subcat['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary" onclick="applyFilters()">Filter</button>
            </div>
        </div>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="product-card" onclick="window.location.href='product-detail.php?slug=<?php echo $row['slug']; ?>'">
                        <img src="../images/<?php echo $row['image']; ?>" 
                             alt="Product Image" 
                             onerror="this.onerror=null; this.src='no-image.png';">
                        <h5 class="mt-2"><?php echo $row['name']; ?></h5>
                        <p><?php echo $row['description']; ?></p>
                        <p><strong>Price:</strong> ₹<?php echo $row['price']; ?></p>
                        <p><strong>Category:</strong> <?php echo $row['category_name']; ?></p>
                        <p><strong>Subcategory:</strong> <?php echo $row['subcategory_name']; ?></p>
                        <a href="edit-product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete-product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <a href="add-product.php" class="btn btn-success">Add Product</a>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</body>
</html>
