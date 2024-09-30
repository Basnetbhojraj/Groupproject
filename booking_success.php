<?php
// Start the session
session_start();

// Check if the booking ID exists in the query string
if (!isset($_GET['booking_id'])) {
    header("Location: booking.php");
    exit();
}

// Retrieve booking and package details from the URL query string
$booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$booking_date = isset($_GET['booking_date']) ? $_GET['booking_date'] : '';
$pickup_address = isset($_GET['pickup_address']) ? $_GET['pickup_address'] : '';
$dropup_address = isset($_GET['dropup_address']) ? $_GET['dropup_address'] : '';
$delivery_date = isset($_GET['delivery_date']) ? $_GET['delivery_date'] : '';

$package_id = isset($_GET['package_id']) ? $_GET['package_id'] : '';
$weight = isset($_GET['weight']) ? $_GET['weight'] : '';
$dimensions = isset($_GET['dimensions']) ? $_GET['dimensions'] : '';
$package_type = isset($_GET['package_type']) ? $_GET['package_type'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="1.png" alt="NepCourier Logo">
        </div>
        <nav class="nav">
            <ul class="horizontal-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Account</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="container">
            <h1 class="supscript">Booking Successful!</h1>
            <p>Your booking has been successfully created with the following details:</p>

            <h2>Booking Details</h2>
            <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking_id); ?></p>
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
            <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking_date); ?></p>
            <p><strong>Pickup Address:</strong> <?php echo htmlspecialchars($pickup_address); ?></p>
            <p><strong>Dropup Address:</strong> <?php echo htmlspecialchars($dropup_address); ?></p>
            <p><strong>Delivery Date:</strong> <?php echo htmlspecialchars($delivery_date); ?></p>

            <h2>Package Details</h2>
            <p><strong>Package ID:</strong> <?php echo htmlspecialchars($package_id); ?></p>
            <p><strong>Weight:</strong> <?php echo htmlspecialchars($weight); ?> kg</p>
            <p><strong>Dimensions:</strong> <?php echo htmlspecialchars($dimensions); ?></p>
            <p><strong>Package Type:</strong> <?php echo htmlspecialchars($package_type); ?></p>

            <a href="index.php" class="form-button">Go to Home</a>
        </div>
    </main>
</body>
</html>
