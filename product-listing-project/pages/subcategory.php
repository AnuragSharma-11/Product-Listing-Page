<?php
include '../config/db.php';

// URL se subcategory slug lena
$slug = $_GET['slug'];

// Child categories fetch karna
$sql = "SELECT * FROM child_categories WHERE subcategory_id = (SELECT id FROM subcategories WHERE slug = '$slug')";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background: linear-gradient(135deg, #ffffff, #f2f2f2);
            text-align: center;
            padding: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card a {
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
            text-decoration: none;
        }
        .card a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Child Categories</h2>
        
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="card">';
                echo '<h4><a href="../child-category/' . $row['slug'] . '">' . $row['name'] . '</a></h4>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
