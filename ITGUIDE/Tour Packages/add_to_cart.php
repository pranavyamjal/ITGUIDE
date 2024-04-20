<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
   
    header("Location: \ITGUIDE\User\login.php");
    exit();
}

// Check if tour package ID is provided
if (!isset($_GET['id'])) {
    header("Location: itour_packages.php");
    exit();
}

// Database connection parameters
$dbhost = "localhost";
$dbuser = "postgres";
$dbpass = "9158856655";
$dbname = "users";

// Connect to the PostgreSQL database
$conn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Fetch tour package details
$tour_package_id = $_GET['id'];
$query = "SELECT * FROM tour_packages WHERE id=$tour_package_id";
$result = pg_query($conn, $query);

if (!$result) {
    die("Error fetching tour package details: " . pg_last_error());
}

$row = pg_fetch_assoc($result);

// Create or update cart session variable
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add tour package to cart
$_SESSION['cart'][$tour_package_id] = $row;

// Redirect back to tour packages page
header("Location: itour_packages.php");
exit();
?>
