<?php
// Database connection details
$host = 'localhost';
$dbname = 'users';
$user = 'postgres';
$password = '9158856655';

// Connect to PostgreSQL database
$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    echo "Error: Unable to connect to the database.";
    exit();
}

// Check if the password reset token is provided
if (isset($_GET['token'])) {
    $reset_token = $_GET['token'];

    // Check if the reset token is valid
    $query = "SELECT * FROM register WHERE reset_token = $1";
    $result = pg_query_params($conn, $query, array($reset_token));

    if ($result && pg_num_rows($result) > 0) {
        // Token is valid, display the reset password form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the new password from the form
            $new_password = $_POST['new_password'];

            // Update the password in the database
            $update_query = "UPDATE register SET password = $1, reset_token = NULL WHERE reset_token = $2";
            $update_result = pg_query_params($conn, $update_query, array($new_password, $reset_token));

            if ($update_result) {
                $success_message = "Your password has been reset successfully. You can now <a href='login.php'>login</a> with your new password.";

                // Send password reset confirmation email
                $to = 'pranavyamjal@gmail.com';
                $subject = 'Password Reset Confirmation';
                $message = 'Your password has been reset successfully.';
                $headers = 'From: yamjal0188@gmail.com' . "\r\n" .
                           'Reply-To: yamjal0188@gmail.com' . "\r\n" .
                           'X-Mailer: PHP/' . phpversion();

                if (mail($to, $subject, $message, $headers)) {
                    $email_success_message = 'Password reset confirmation email sent successfully';
                } else {
                    $email_error_message = 'Failed to send password reset confirmation email';
                }
            } else {
                $error_message = "Failed to reset password. Please try again later.";
            }
        }
    } else {
        $error_message = "Invalid or expired reset token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="login-form">
        <h2>Reset Password</h2>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($email_success_message)): ?>
            <div class="alert alert-success"><?php echo $email_success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($email_error_message)): ?>
            <div class="alert alert-danger"><?php echo $email_error_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($reset_token) && !isset($error_message) && !isset($success_message)): ?>
            <form id="resetPasswordForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?token=" . $reset_token);?>">
                <div class="form-group">
                    <label for="new_password"><i class="fas fa-lock"></i> New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://kit.fontawesome.com/yourfontawesomekey.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
