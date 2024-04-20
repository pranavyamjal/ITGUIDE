<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) 
{
    header("Location: admin_login.php");
    exit;
}

// Database connection
$conn = pg_connect("host=localhost dbname='users' user='postgres' password='9158856655'");

// Get form data
$title = $_POST['title'];
$location = $_POST['location'];
$persons = $_POST['persons'];
$price = $_POST['price'];
$days = $_POST['days'];
$description = $_POST['description'];
$details = $_POST['details'];
$image_url = $_POST['image'];

// Insert data into the database
$query = "INSERT INTO tour_packages (title, location, persons, price,days, description,details, image_url) VALUES ('$title', '$location', $persons, $price,$days, '$description','$details', '$image_url')";
$result = pg_query($conn, $query);

// Check if insertion was successful
if ($result) 
{
    echo "Tour package added successfully!";
} 
else 
{
    echo "Error: Unable to add tour package.";
}

// Close connection
pg_close($conn);
?>



