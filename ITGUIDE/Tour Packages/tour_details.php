<?php
// Database connection details
$host = 'localhost';
$dbname = 'users';
$user = 'postgres';
$password = '9158856655';

// Connect to PostgreSQL database
$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

// Check if tour package ID is provided in the URL
if(isset($_GET['id'])) 
{
    $tour_id = $_GET['id'];

    // Fetch tour package details from the database based on ID
    $query = "SELECT * FROM tour_packages WHERE id = $tour_id";
    $result = pg_query($conn, $query); // Corrected $conn variable

    // Check if tour package exists
    if (pg_num_rows($result) == 1) 
    {
        $row = pg_fetch_assoc($result);

        // Extract tour package details
        $title = $row['title'];
        $location = $row['location'];
        $persons = $row['persons'];
        $price = $row['price'];
        $description = $row['description'];
        $details = $row['details'];
        $image_url = $row['image_url'];
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $title; ?> Details</title>
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
          <a class="nav-link" href="\ITGUIDE\Tour Packages\tour_packages.php">Tour Packages</a>
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
          <a class="nav-link" href="\ITGUIDE\Home\Cart.php">Cart</a>
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


            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo $image_url; ?>" class="img-fluid" alt="Tour Package Image">
                    </div>
                    <div class="col-md-6">
                        <h2><?php echo $title; ?></h2>
                        <p><strong>Location:</strong> <?php echo $location; ?></p>
                        <p><strong>Persons:</strong> <?php echo $persons; ?></p>
                        <p><strong>Price:</strong> <?php echo $price; ?></p>
                        <p><?php echo $description; ?></p>
                        <p><?php echo $details; ?></p>

                        <!-- Add to Cart Button -->
                        
                                <a href="\ITGUIDE\Tour Packages\add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Add to Cart</a>
                            


                    </div>
                </div>
            </div>

            <!-- Bootstrap JS and jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
<br><br>
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

        </html>
<?php
    } 
    else 
    {
        echo "Tour package not found.";
    }
} 
else
{
    echo "Tour package ID not provided.";
}
?>

