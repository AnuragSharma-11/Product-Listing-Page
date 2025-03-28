<?php
include '../config/db.php';

// URL se category slug lena
$slug = $_GET['slug'];

// Pehle category id fetch karna using slug
$categoryQuery = "SELECT id FROM categories WHERE slug='$slug'";
$categoryResult = mysqli_query($conn, $categoryQuery);
$category = mysqli_fetch_assoc($categoryResult);

if (!$category) {
    die("Category not found!");
}

$category_id = $category['id'];

// Subcategories fetch karna
$sql = "SELECT * FROM subcategories WHERE category_id='$category_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcategories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f0f0, #d9e4f5);
            min-height: 100vh;
            display: flex;
            justify-content: center;
        }
        .container {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            text-align: center;
            padding: 20px;
        }
        .card {
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }
        .card a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Subcategories</h2>
        
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="card p-3 mb-3">';
                echo '<h4><a href="../subcategory/' . $row['slug'] . '">' . $row['name'] . '</a></h4>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
