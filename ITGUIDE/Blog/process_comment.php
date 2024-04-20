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

// Fetch data from the comment form
$blog_id = $_POST['blog_id'];
$comment = $_POST['comment'];
$commenter_name = $_SESSION['email']; 

// Insert the comment into the database
$query = "INSERT INTO blog_comments (blog_id, comment, commenter_name) 
          VALUES ($blog_id, '$comment', '$commenter_name')";
$result = pg_query($conn, $query);

if ($result) 
{
    // Comment inserted successfully
    header("Location: view_blog.php?blog_id=$blog_id"); // Redirect back to view_blog.php
    exit();
} 
else 
{
    // Error inserting comment
    die("Error inserting comment: " . pg_last_error());
}

// Close the database connection
pg_close($conn);
?>
