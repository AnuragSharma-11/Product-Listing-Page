<?php
include '../config/db.php';

// URL se product slug lena
$slug = $_GET['slug'] ?? '';

// Slug empty hai to error dikhaye
if (empty($slug)) {
    die("Error: Product slug is missing!");
}

// Product details fetch karna
$sql = "SELECT * FROM products WHERE slug='$slug'";
$result = mysqli_query($conn, $sql);

// Check if product exists
if (mysqli_num_rows($result) == 0) {
    die("Error: Product not found!");
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .product-container {
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background: #fff;
            transition: transform 0.3s ease-in-out;
        }
        .product-container:hover {
            transform: scale(1.02);
        }
        .product-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-info {
            padding: 20px;
        }
        .btn-custom {
            width: 150px;
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            transform: scale(0.9.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row product-container">
            <div class="col-md-6">
                <img src="../images/<?php echo htmlspecialchars($product['image']); ?>" class="product-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="col-md-6 product-info">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <h3 class="text-success">₹<?php echo number_format($product['price'], 2); ?></h3>
                <div class="mt-3">
                    <a href="#" class="btn btn-primary btn-custom">Buy Now</a>
                    <a href="products.php" class="btn btn-secondary btn-custom">Back to Products</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
