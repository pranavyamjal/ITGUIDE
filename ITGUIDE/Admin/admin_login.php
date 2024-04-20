<?php
session_start();


// Database connection details
$host = 'localhost';
$dbname = 'users';
$user = 'postgres';
$password = '9158856655';

// Connect to PostgreSQL database
$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password if needed, for example if stored hashed in the database
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM admin_table WHERE email = '$email' AND password = '$password'";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) == 1) 
    {
        $_SESSION['email'] = $email;
        header("Location: admin_dashboard.php");
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
    <title>Admin Login</title>
    
    <style>
        body 
        {
            background-color: #9370DB;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container 
        {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .login-container h2 
        {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container form 
        {
            display: flex;
            flex-direction: column;
        }

        .login-container label 
        {
            margin-bottom: 5px;
        }

        .login-container input 
        {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-container button 
        {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #9370DB;
            color: #fff;
            cursor: pointer;
        }

        .login-container .additional-links 
        {
            text-align: center;
            margin-top: 15px;
        }

        .login-container .additional-links a 
        {
            color: #9370DB;
            text-decoration: none;
            margin-left: 5px;
        }
    </style>
    
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error_message)): ?>
            <div style="color: red; margin-bottom: 10px;"><?= $error_message ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>
      
    </div>
</body>
</html>
