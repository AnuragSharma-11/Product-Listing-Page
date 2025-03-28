<?php
include '../config/db.php';

// URL se child category slug lena
$slug = $_GET['slug'];

// Products fetch karna
$sql = "SELECT * FROM products WHERE child_category_id = 
        (SELECT id FROM child_categories WHERE slug = '$slug')";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2 class="text-center">Products</h2>
        
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="card p-3 mb-3">';
                echo '<img src="../images/' . $row['image'] . '" class="img-fluid mb-2">';
                echo '<h4><a href="../product/' . $row['slug'] . '" class="text-decoration-none">' . $row['name'] . '</a></h4>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<h5>$' . $row['price'] . '</h5>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
