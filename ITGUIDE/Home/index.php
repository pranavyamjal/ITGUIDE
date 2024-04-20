<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ITGuide</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  
  <style>
    /* Custom CSS */
    body 
    {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .navbar 
    {
      background-color: #2c3e50 !important;
    }
    .navbar-brand, .navbar-nav .nav-link 
    {
      color: #ffffff !important;
    }
    .navbar-nav .nav-link:hover 
    {
      color: #e67e22 !important;
    }
    .card 
    {
      border: none;
      transition: all 0.3s ease;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .card:hover 
    {
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .card-img-top 
    {
      transition: opacity 0.3s ease;
    }
    .card-title 
    {
      font-weight: 600;
    }
    .btn-primary 
    {
      background-color: #e67e22;
      border-color: #e67e22;
    }
    .btn-primary:hover 
    {
      background-color: #d35400;
      border-color: #d35400;
    }
    footer 
    {
      background-color: #2c3e50;
      color: #ffffff;
    }
  </style>

  <!-- Font Awesome -->
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


</head>
<body>

  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">ITGuide</a>
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


 <!-- Popular Tour Packages Section -->
<section class="popular-tour-packages">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mt-5 mb-4">Popular Tour Packages</h2>
            </div>
        </div>
        <!-- Include tour_packages.php content here -->
        <?php include 'C:\xampp\htdocs\ITGUIDE\Tour Packages\tour_packages.php'; ?>
    </div>
</section>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<?php
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

// Retrieve blog entries from the database
$query = "SELECT * FROM blog";
$result = pg_query($conn, $query);

// Check if query was successful
if (!$result) 
{
    die("Error executing query: " . pg_last_error());
}

// Fetch blog entries and store them in an array
$blogEntries = array();
while ($row = pg_fetch_assoc($result)) 
{
    $blogEntries[] = $row;
}

// Close the database connection
pg_close($conn);
?>




  <!-- Blog Cards Section -->
<section class="blogs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mt-5 mb-4">BLOGS</h2>
            </div>
        </div>
        <div class="row">
            <!-- Loop through blog entries and generate cards dynamically -->
            <?php foreach ($blogEntries as $entry) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <img src="<?php echo $entry['blog_image_url']; ?>" class="card-img-top" alt="Blog Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $entry['blog_description']; ?></h5>
                            <h5 class="card-title"><?php echo $entry['blog_title']; ?></h5>
                            <p class="card-text">Creator: <?php echo $entry['blog_creator']; ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="\ITGUIDE\Blog\view_blog.php?blog_id=<?php echo $entry['blog_id']; ?>" class="btn btn-primary">View Blog</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>




</body>
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
            <li><a href="\ITGUIDE\Blog\view_all_blogs.php" class="text-light">Blog</a></li>
            <li><a href="\ITGUIDE\Tour Packages\itour_packages.php" class="text-light">Tour Packages</a></li>
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