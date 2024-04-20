<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Clear cart
unset($_SESSION['cart']);

// Redirect back to cart page
header("Location: view_cart.php");
exit();
?>
