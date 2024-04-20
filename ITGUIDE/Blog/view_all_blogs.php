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

// Fetch all blog posts from the database
$query = "SELECT * FROM blog";
$result = pg_query($conn, $query);

if (!$result) 
{
    die("Error fetching blog posts: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs</title>
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
          <a class="nav-link" href="\ITGUIDE\Tour Packages\view_cart.php">Cart</a>
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
            <div class="col-md-8 offset-md-2">
                <h2>All Blogs</h2>
                <ul class="list-group">
                    <?php while ($row = pg_fetch_assoc($result)) : ?>
                        <li class="list-group-item">
                        <a href="view_blog.php?blog_id=<?php echo $row['blog_id']; ?>">
    <h3><?php echo $row['blog_title']; ?></h3>
</a>

                            <img src="<?php echo $row['blog_image_url']; ?>" alt="Blog Image" style="max-width: 100%;">
                            <p><strong>Description:</strong> <?php echo $row['blog_description']; ?></p>
                            <p><strong>Details:</strong> <?php echo $row['blog_details']; ?></p>
                            <p><strong>Creator:</strong> <?php echo $row['blog_creator']; ?></p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
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
// Close the database connection
pg_close($conn);
?>
