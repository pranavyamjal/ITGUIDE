<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Check if the tour package ID is provided
if (!isset($_GET['id'])) {
    header("Location: view_cart.php");
    exit();
}

// Remove item from cart
$tour_package_id = $_GET['id'];
if (isset($_SESSION['cart'][$tour_package_id])) {
    unset($_SESSION['cart'][$tour_package_id]);
}

// Redirect back to cart page
header("Location: view_cart.php");
exit();
?>
