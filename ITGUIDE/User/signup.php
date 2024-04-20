<?php
// Database connection details
$host = 'localhost';
$dbname = 'users';
$user = 'postgres';
$password = '9158856655';

// Connect to PostgreSQL database
$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) 
{
    echo "Error: Unable to connect to the database.";
    exit();
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$termsAccepted = isset($_POST['termsAccepted']);

// Validate password length
if (strlen($password) < 8) 
{
    echo "Password must be at least 8 characters long.";
    exit();
}

// Validate password confirmation
if ($password !== $confirmPassword) 
{
    echo "Passwords do not match.";
    exit();
}

// Validate terms and conditions
if (!$termsAccepted) 
{
    echo "You must accept the Terms & Conditions.";
    exit();
}

// Check if email already exists
$query = "SELECT * FROM register WHERE email = '$email'";
$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) 
{
    echo "Email already exists.";
    exit();
}

// Insert new user into the database
$query = "INSERT INTO register (name, email, password) VALUES ('$name', '$email', '$password')";
$result = pg_query($conn, $query);

if ($result) 
{   
    echo "Account Created Successfully";
    header("Location:\ITGUIDE\User\login.php");
    exit(); 

} 
else 
{
    echo "Error: Unable to create your account.";
}

// Close the database connection
pg_close($conn);
?>