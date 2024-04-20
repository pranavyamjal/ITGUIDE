<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Check if the cart is empty
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "Your cart is empty.";
    exit();
}

// Calculate total amount
$totalAmount = 0;
foreach ($_SESSION['cart'] as $tour_package) {
    $totalAmount += $tour_package['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Your Cart</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Persons</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $id => $tour_package): ?>
                <tr>
                    <td><?php echo $tour_package['title']; ?></td>
                    <td><?php echo $tour_package['location']; ?></td>
                    <td><?php echo $tour_package['persons']; ?></td>
                    <td><?php echo $tour_package['price']; ?></td>
                    <td>
                        <a href="remove_from_cart.php?id=<?php echo $id; ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-6">
            <h4>Total Amount to be Paid: ₹<?php echo $totalAmount; ?></h4>
        </div>
        <div class="col-md-6">
            <a href="Thankyou.html" class="btn btn-primary float-right">Proceed to Payment</a>
        </div>
    </div>
    <a href="clear_cart.php" class="btn btn-warning">Clear Cart</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

