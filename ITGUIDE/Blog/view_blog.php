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

// Fetch blog deta`ils based on blog_id passed through the URL
if(isset($_GET['blog_id'])) 
{
    $blog_id = $_GET['blog_id'];
    $query = "SELECT * FROM blog WHERE blog_id = $blog_id";
    $result = pg_query($conn, $query);

    if(!$result) 
    {
        die("Error fetching blog details: " . pg_last_error());
    }

    $blog = pg_fetch_assoc($result);
} 
else 
{
    die("Error: Blog ID not provided.");
}

// Fetch comments for the blog post
$query_comments = "SELECT * FROM blog_comments WHERE blog_id = $blog_id";
$result_comments = pg_query($conn, $query_comments);

if(!$result_comments) 
{
    die("Error fetching comments: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog</title>
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
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <img src="<?php echo $blog['blog_image_url']; ?>" class="card-img-top" alt="Blog Image">
                    <div class="card-body">
                    <h3 class="card-title"><?php echo $blog['blog_title']; ?></h3>
                        <h5 class="card-title"><?php echo $blog['blog_description']; ?></h5>
                        <p class="card-text"><?php echo $blog['blog_details']; ?></p>
                        <p class="card-text">Creator: <?php echo $blog['blog_creator']; ?></p>
                    </div>
                </div>

                <!-- Display Comments -->
                <h4 class="mt-4">Comments</h4>
                <?php while($comment = pg_fetch_assoc($result_comments)): ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="card-text"><?php echo $comment['comment']; ?></p>
                            <p class="card-text">Commenter: <?php echo $comment['commenter_name']; ?></p>
                            <p class="card-text">Time: <?php echo $comment['commenter_date']; ?></p>
                            
                        </div>
                    </div>
                <?php endwhile; ?>

                 

                <!-- Conditional Comment Form for Logged-in Users -->
                <?php if(isset($_SESSION['email'])): ?>
                <h4 class="mt-4">Add a Comment</h4>
                <form action="process_comment.php" method="post">
                    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                    <div class="form-group">
                        <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php else: ?>
                <!-- Show Sign In/Log In Button for Visitors -->
                <div class="mt-4">
                    <p>Please <a href="\ITGUIDE\User\login.php" class="btn btn-primary">Login In</a> or <a href="\ITGUIDE\User\signup.html" class="btn btn-primary">Sign Up</a> to leave a comment.</p>
                </div>
                <?php endif; ?>
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
