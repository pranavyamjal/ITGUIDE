<?php
// Start the session


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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
      <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="\ITGUIDE\Home\index.php">ITGuide</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="\ITGUIDE\Home\index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="\ITGUIDE\Blog\view_all_blogs.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="\ITGUIDE\Tour Packages\itour_packages.php">Tour Packages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="\ITGUIDE\Home\About_us.php">About Us</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="\ITGUIDE\Admin\admin_login.php">ADMIN</a>
        </li>
        
        <?php
session_start();
if(isset($_SESSION['email'])) 
{
    echo '<li class="nav-item">
            <a class="nav-link" href="\ITGUIDE\User\profile.php">Profile</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="view_cart.php">Cart</a>
        </li>
          <li class="nav-item">
            <a class="btn btn-primary mr-2" href="\ITGUIDE\Blog\input_blog.php">Create Blog</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="logout.php">Logout</a>
          </li>';
} 
else 
{
    echo '<li class="nav-item">
            <a class="btn btn-primary mr-2" href="\ITGUIDE\User\signup.html">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="\ITGUIDE\User\login.php">Login</a>
          </li>';
}
?>



      </ul>
    </div>
  </div>
</nav>

    <!-- Content -->
    <div class="container mt-5">
        <div class="row">
            <?php
            // Database connection details
            $host = 'localhost';
            $dbname = 'users';
            $user = 'postgres';
            $password = '9158856655';

            // Connect to PostgreSQL database
            $conn_string = "host=$host dbname=$dbname user=$user password=$password";
            $db_connection = pg_connect($conn_string);

            // Check for successful connection
            if (!$db_connection) {
                echo "Failed to connect to the database.";
                exit;
            }

            // Fetch tour packages from the database
            $query = "SELECT * FROM tour_packages";
            $result = pg_query($db_connection, $query);

            // Check if there are any tour packages
            if (pg_num_rows($result) > 0) {
                $count = 0;
                while ($row = pg_fetch_assoc($result)) {
                    if ($count % 3 == 0) {
                        // Start a new row for every third card
                        echo '<div class="container mt-5"><div class="row">';
                    }
                    ?>

                    <!-- Tour Package Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="Tour Package Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-text">
                                    <strong>Location:</strong> <?php echo $row['location']; ?><br>
                                    <strong>Persons:</strong> <?php echo $row['persons']; ?><br>
                                    <strong>Price:</strong> <span class="text-danger"><?php echo $row['price']; ?></span><br>
                                    <?php echo $row['description']; ?>
                                </p>
                                <a href="\ITGUIDE\Tour Packages\tour_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                               
                                 <!-- Add to Cart Button -->
                                 <?php if(isset($_SESSION['email'])): ?>
                                <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Add to Cart</a>
                            <?php endif; ?>
                            

                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                    if ($count % 3 == 0) {
                        // Close the row after every third card
                        echo '</div></div>';
                    }
                }
                // Close the row if the number of cards is not a multiple of 3
                if ($count % 3 != 0) {
                    echo '</div></div>';
                }
            } else {
                echo "No tour packages available.";
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
  <footer class="bg-dark text-light text-center py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>About Us</h5>
          <p>ITGuide is a premier travel agency dedicated to providing unforgettable experiences worldwide.</p>
        </div>
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="\ITGUIDE\Home\index.php" class="text-light">Home</a></li>
            <li><a href="\ITGUIDE\Blog\view_blog.php" class="text-light">Blog</a></li>
            <li><a href="\ITGUIDE\Tour Packages\tour_details.php" class="text-light">Tour Packages</a></li>
            <li><a href="\ITGUIDE\Home\About_us.php" class="text-light">About Us</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Follow Us</h5>
          <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <p class="mt-3">&copy; 2024 ITGuide. All Rights Reserved.          @TeamZingu</p>
  </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
