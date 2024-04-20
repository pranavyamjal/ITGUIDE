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

    // Check if email exists in the database
    $query = "SELECT * FROM register WHERE email = '$email'";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) 
    {
        // Email found, generate reset token and send reset link
        $reset_token = bin2hex(random_bytes(32)); // Generate a random token
        $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/reset_password.php?token=" . $reset_token;

        // Store the reset token in the database
        $query = "UPDATE register SET reset_token = '$reset_token' WHERE email = '$email'";
        pg_query($conn, $query);

        // Send the reset link to the user's email
        $to = $email;
        $subject = "Password Reset Link";
        $message = "Click the following link to reset your password: " . $reset_link;
        $headers = "From: pranavyamjal@gmail.com";

        if (mail($to, $subject, $message, $headers)) 
        {
            $success_message = "Password reset instructions have been sent to your email address.";
        } 
        else 
        {
            $error_message = "Failed to send password reset instructions. Please try again later.";
        }
    } 
    else 
    {
        $error_message = "Email not found in our records.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="login-form">
        <h2>Forgot Password</h2>
        <?php if (isset($success_message)) 
        { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php 
        } ?>
        
        <?php if (isset($error_message)) 
        { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php 
        } ?>
        
        <form id="forgotPasswordForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <p class="text-center mt-3">Remember your password? <a href="login.php">Login</a></p>
    </div>

    <script src="https://kit.fontawesome.com/yourfontawesomekey.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>