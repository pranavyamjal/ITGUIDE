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
if (!$db_connection) 
{
    echo "Failed to connect to the database.";
    exit;
}

// Fetch tour packages from the database
$query = "SELECT * FROM tour_packages";
$result = pg_query($db_connection, $query);

// Check if there are any tour packages
if (pg_num_rows($result) > 0) 
{
    $count = 0;
    while ($row = pg_fetch_assoc($result)) 
    {
        if ($count % 3 == 0) 
        {
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
                   
                                <a href="\ITGUIDE\Tour Packages\add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Add to Cart</a>
                           

                    
                   

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
    if ($count % 3 != 0) 
    {
        echo '</div></div>';
    }
} 
else 
{
    echo "No tour packages available.";
}
?>
</div>
</div>
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">