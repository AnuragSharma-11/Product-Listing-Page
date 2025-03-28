<?php
include '../config/db.php';

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $query = "SELECT * FROM subcategories WHERE category_id = '$category_id'";
    $result = mysqli_query($conn, $query);

    echo '<option value="">All Subcategories</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
}
?>
