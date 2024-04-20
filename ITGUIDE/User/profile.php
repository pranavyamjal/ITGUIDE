<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) 
{
    header("Location: login.php");
    exit();
}

// Database connection parameters
$host = "localhost";
$dbname = "users";
$user = "postgres";
$password_db = "9158856655";

// Connect to PostgreSQL
$dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$password_db");

if (!$dbconn) 
{
    die("Connection failed: " . pg_last_error());
}

$email = $_SESSION['email'];

// Fetch user data from the database
$query = "SELECT * FROM register WHERE email=$1";
$result = pg_query_params($dbconn, $query, array($email));

if (!$result) 
{
    die("Query failed: " . pg_last_error());
}

$row = pg_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];

// Update profile information
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['update_profile'])) 
    {
        $new_name = $_POST['name'];
        $new_email = $_POST['email'];

        // Update user information in the database
        $update_query = "UPDATE register SET name=$1, email=$2 WHERE email=$3";
        $update_result = pg_query_params($dbconn, $update_query, array($new_name, $new_email, $email));

        if (!$update_result) 
        {
            die("Query failed: " . pg_last_error());
        }

        // Update session data if email is updated
        if ($new_email !== $email) 
        {
            $_SESSION['email'] = $new_email;
        }
        
        // Update displayed name
        $name = $new_name;

        echo "Profile updated successfully!";
    }

    // Change password (without hashing)
    if (isset($_POST['change_password'])) 
    {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        // Update password in the database
        $update_password_query = "UPDATE register SET password=$1 WHERE email=$2";
        $update_password_result = pg_query_params($dbconn, $update_password_query, array($new_password, $email));

        if (!$update_password_result) 
        {
            die("Query failed: " . pg_last_error());
        }

        echo "Password changed successfully!";
    }
}

// Close database connection
pg_close($dbconn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<style>
    /* Custom CSS */
    body 
    {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .container 
    {
        max-width: 600px;
    }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="\ITGUIDE\Home\index.php">Travel Website</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="\ITGUIDE\Home\logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Profile Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Profile</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
    </form>

    <hr>

    <!-- Change Password Section -->
    <h2 class="text-center mb-4">Change Password</h2>
    <form method="post">
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
    </form>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

