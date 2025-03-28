<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $deleteQuery = "DELETE FROM products WHERE id = '$product_id'";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: products.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: products.php");
    exit;
}
?>
