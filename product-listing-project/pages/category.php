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
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Subcategories</h2>
        
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="card p-3 mb-3">';
                echo '<h4><a href="../subcategory/' . $row['slug'] . '" class="text-decoration-none">' . $row['name'] . '</a></h4>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
