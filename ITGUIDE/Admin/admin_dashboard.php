<?php
session_start();

// Include database connection
$host = 'localhost';
$dbname = 'users';
$user = 'postgres';
$password = '9158856655';

// Connect to PostgreSQL database
$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

// Handle adding new blog
if(isset($_POST['add_blog'])) 
{
    // Fetch form data
    $blog_title = $_POST['blog_title'];
    $blog_image_url = $_POST['blog_image_url'];
    $blog_description = $_POST['blog_description'];
    $blog_details = $_POST['blog_details'];

    // Add blog to the database
    $insert_query = "INSERT INTO blog (blog_title, blog_image_url, blog_description, blog_details) VALUES ('$blog_title', '$blog_image_url', '$blog_description', '$blog_details')";
    $insert_result = pg_query($conn, $insert_query);
    if($insert_result) 
    {
        // Blog added successfully
        header("Refresh:0"); // Refresh the page to reflect changes
        exit(); // Exit after redirecting to avoid further execution
    } 
    else 
    {
        // Failed to add blog
        echo "Error adding blog: " . pg_last_error();
    }
}


// Fetch all blogs from the database
$query_blogs = "SELECT * FROM blog";
$result_blogs = pg_query($conn, $query_blogs);

if (!$result_blogs) 
{
    die("Error fetching blogs: " . pg_last_error());
}

// Handle deleting blog
if(isset($_POST['delete_blog'])) 
{
    $blog_id = $_POST['blog_id'];
    $delete_query = "DELETE FROM blog WHERE blog_id=$blog_id";
    $delete_result = pg_query($conn, $delete_query);
    if($delete_result) 
    {
        // Blog deleted successfully
        header("Refresh:0"); // Refresh the page to reflect changes
    } 
    else 
    {
        // Failed to delete blog
        echo "Error deleting blog: " . pg_last_error();
    }
  }


// Fetch all users from the database
$query_users = "SELECT * FROM register";
$result_users = pg_query($conn, $query_users);

if (!$result_users) 
{
    die("Error fetching users: " . pg_last_error());
}


  
  

// Handle deleting user
if(isset($_POST['delete_user'])) 
{
  $user_id = $_POST['user_id'];
  $delete_query = "DELETE FROM register WHERE id=$user_id";
  $delete_result = pg_query($conn, $delete_query);
  if($delete_result) 
  {
      // User deleted successfully
      header("Refresh:0"); // Refresh the page to reflect changes
  } 
  else 
  {
      // Failed to delete user
      echo "Error deleting user: " . pg_last_error();
  }
}

// Handle adding new user
if(isset($_POST['add_user'])) 
{
  // Fetch form data
  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  
  // Add user to the database
  $insert_query = "INSERT INTO register (email, password, name) VALUES ('$email', '$password', '$name')";
  $insert_result = pg_query($conn, $insert_query);
  if($insert_result) 
  {
      // User added successfully
      header("Refresh:0"); // Refresh the page to reflect changes
  } 
  else 
  {
      // Failed to add user
      echo "Error adding user: " . pg_last_error();
  }
}

// Fetch all tour packages from the database
$query_packages = "SELECT * FROM tour_packages";
$result_packages = pg_query($conn, $query_packages);

if (!$result_packages) 
{
    die("Error fetching tour packages: " . pg_last_error());
}

// Handle deleting tour package
if(isset($_POST['delete_package'])) 
{
  $package_id = $_POST['package_id'];
  $delete_query = "DELETE FROM tour_packages WHERE id=$package_id";
  $delete_result = pg_query($conn, $delete_query);
  if($delete_result) 
  {
      // Package deleted successfully
      header("Refresh:0"); // Refresh the page to reflect changes
  }
    else 
    {
      // Failed to delete package
      echo "Error deleting package: " . pg_last_error();
  }
}

// Handle adding new tour package
if(isset($_POST['add_tour_package'])) 
{
  // Fetch form data
  $title = $_POST['title'];
  $location = $_POST['location'];
  $persons = $_POST['persons'];
  $price = $_POST['price'];
  $days = $_POST['days'];
  $description = $_POST['description'];
  $details = $_POST['details'];
  $image = $_POST['image'];

  // Add tour package to the database
  $insert_query = "INSERT INTO tour_packages (title, location, persons, price, days, description, details, image) VALUES ('$title', '$location', $persons, $price, $days, '$description', '$details', '$image')";
  $insert_result = pg_query($conn, $insert_query);
  if($insert_result) 
  {
      // Tour package added successfully
      header("Refresh:0"); // Refresh the page to reflect changes
  } 
  else 
  {
      // Failed to add tour package
      echo "Error adding tour package: " . pg_last_error();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="\ITGUIDE\User\login.php">User Login</a>
                    <li class="nav-item">
                    <a class="nav-link" href="admin_logout.php">Logout</a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <!-- Add Tour Package Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Add Tour Package</h2>
                    </div>
                    <div class="card-body">
                        <form action="\ITGUIDE\Tour Packages\add_tour_package.php" method="POST">
                          <!-- Form fields for adding tour package -->
                          <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                          </div>
                          <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="persons">Persons:</label>
                              <input type="number" class="form-control" id="persons" name="persons" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="price">Price:</label>
                              <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="days">Days:</label>
                            <input type="number" class="form-control" id="days" name="days" required>
                          </div>
                          <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                          </div>

                          <div class="form-group">
                            <label for="details">Details:</label>
                            <textarea class="form-control" id="details" name="details" rows="4" required></textarea>
                          </div>

                          <div class="form-group">
                            <label for="image">Image URL:</label>
                            <input type="text" class="form-control" id="image" name="image" required>
                          </div>
                          <button type="submit" class="btn btn-primary btn-block" name="add_tour_package">Add Tour Package</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- View All Tour Packages Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2 class="mb-0">View All Tour Packages</h2>
                    </div>
                    <div class="card-body">
                        <!-- View all tour packages section -->
                        <div class="list-group">
                            <?php if (isset($result_packages) && pg_num_rows($result_packages) > 0): ?>
                            <?php while ($package = pg_fetch_assoc($result_packages)): ?>
                            <a href="#" class="list-group-item list-group-item-action">
                                <h5 class="mb-1"><?php echo $package['title']; ?></h5>
                                <p class="mb-1"><?php echo $package['location']; ?></p>
                                <small>Price: $<?php echo $package['price']; ?></small>
                                <form action="" method="POST" class="float-right">
                                    <input type="hidden" name="package_id" value="<?php echo $package['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" name="delete_package">Delete</button>
                                </form>
                            </a>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <p>No tour packages found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="btn btn-primary btn-block">View All Packages</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Blogs Card -->
        <div class="card mt-5">
            <div class="card-header bg-info text-white">
                <h2 class="mb-0">View Blogs</h2>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <?php while ($blog = pg_fetch_assoc($result_blogs)): ?>
                        <a href="#" class="list-group-item list-group-item-action">
                            <h5 class="mb-1"><?php echo $blog['blog_title']; ?></h5>
                            <img src="<?php echo $blog['blog_image_url']; ?>" alt="Blog Image" class="img-fluid mb-2">
                            <p class="mb-1"><?php echo $blog['blog_description']; ?></p>
                            <p class="mb-1"><?php echo $blog['blog_details']; ?></p>
                            <form action="" method="POST" class="float-right">
                                <input type="hidden" name="blog_id" value="<?php echo $blog['blog_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" name="delete_blog">Delete</button>
                            </form>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

<!-- Add Blog Card -->
<div class="card mt-5">
    <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Add Blog</h2>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="blog_title">Title:</label>
                <input type="text" class="form-control" id="blog_title" name="blog_title" required>
            </div>
            <div class="form-group">
                <label for="blog_image_url">Image URL:</label>
                <input type="text" class="form-control" id="blog_image_url" name="blog_image_url" required>
            </div>
            <div class="form-group">
                <label for="blog_description">Description:</label>
                <textarea class="form-control" id="blog_description" name="blog_description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="blog_details">Details:</label>
                <textarea class="form-control" id="blog_details" name="blog_details" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="add_blog">Add Blog</button>
        </form>
    </div>
</div>


        <!-- Manage Users Card -->
        <div class="card mt-5">
            <div class="card-header bg-warning text-white">
                <h2 class="mb-0">Manage Users</h2>
            </div>
            <div class="card-body">
                <!-- Form for adding and removing users -->
                <form action="" method="POST">
                <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="name" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
                </form>
                <!-- Display existing users and delete option -->
                <ul class="list-group mt-3">
                    <?php while ($user = pg_fetch_assoc($result_users)): ?>
                    <li class="list-group-item">
                        <?php echo $user['email']; ?>
                        <form action="" method="POST" class="float-right">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" name="delete_user">Delete</button>
                        </form>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
