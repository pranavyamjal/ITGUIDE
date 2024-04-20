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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are correct
    $query = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) 
    {
        // Login successful
        session_start();
        $_SESSION['email'] = $email;
        header("Location: \ITGUIDE\Home\index.php"); // Redirect to dashboard or home page
        exit();
    } 
    else 
    {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="\ITGUIDE\CSS\styles1.css">
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <?php if (isset($error_message)) 
        { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php 
        } ?>
        
        <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-center mt-3"><a href="forgot_password.php">Forgot Password?</a></p>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="signup.html">Sign Up</a></p>
    </div>

    <script src="https://kit.fontawesome.com/yourfontawesomekey.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>