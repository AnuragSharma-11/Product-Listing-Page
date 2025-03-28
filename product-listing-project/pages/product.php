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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .product-container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 25px;
            max-width: 800px;
            width: 100%;
        }
        .product-container:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }
        .product-image {
            border-radius: 10px;
            transition: transform 0.3s;
            max-width: 350px;
            height: auto;
        }
        .product-details {
            max-width: 400px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            transition: background 0.3s ease-in-out;
        }
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004080);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #495057, #343a40);
        }
    </style>
</head>
<body>
    <div class="product-container">
        <img src="../images/<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid product-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <div class="product-details">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            <h3 class="text-success">₹<?php echo number_format($product['price'], 2); ?></h3>
            <a href="#" class="btn btn-primary">Buy Now</a>
            <a href="child-category.php" class="btn btn-secondary">Back to Products</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
