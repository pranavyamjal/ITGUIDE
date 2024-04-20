<?php
// Start the session
session_start();

// Database connection parameters
$dbhost = "localhost";
$dbuser = "postgres";
$dbpass = "9158856655";
$dbname = "users";

// Connect to the PostgreSQL database
$conn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass");

// Check connection
if (!$conn) 
{
    die("Connection failed: " . pg_last_error());
}

// Fetch data from form
$blog_image_url = $_POST['blog_image_url'];
$blog_title = $_POST['blog_title'];
$blog_description = $_POST['blog_description'];
$blog_details = $_POST['blog_details'];


// Check if the user is logged in (assuming email is the user identifier)
if (isset($_SESSION['email'])) 
{
    $blog_creator = $_SESSION['email']; // Use the email from the session
} 
else 
{
    // Handle the case where the user is not logged in
    die("Error: User not logged in.");
}

// Insert data into the database
$query = "INSERT INTO blog (blog_image_url, blog_title, blog_description, blog_details, blog_creator) 
          VALUES ('$blog_image_url', '$blog_title', '$blog_description', '$blog_details', '$blog_creator')";
$result = pg_query($conn, $query);

if ($result) 
{
    echo "Blog created successfully!";
} 
else 
{
    echo "Error creating blog: " . pg_last_error();
}

// Close the database connection
pg_close($conn);
?>
