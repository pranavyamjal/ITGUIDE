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
<br><br>

<center>
<header>
    <h1>About Us</h1>
</header>
</center>

<br><br>
<div class="container">
    <p>Welcome to our tourist website! We specialize in providing memorable tour packages and offering a platform for tourism blogging.</p>

    <h2>Our Mission</h2>
    <p>Our mission is to make your travel experiences unforgettable. Whether you're looking for an adventurous getaway, a relaxing beach vacation, or a cultural exploration, we have the perfect package for you.</p>

    <h2>Why Choose Us?</h2>
    <ul>
        <li>Experienced professionals</li>
        <li>Customized tour packages</li>
        <li>Exceptional customer service</li>
        <li>Diverse selection of destinations</li>
    </ul>

    <h2>Contact Us</h2>
    <p>Have questions or want to learn more about our services? Feel free to contact us at <a href="mailto:zingu@zmail.com">ITGUIDE@gmail.com</a>.</p>
</div>

</body>
</html>

