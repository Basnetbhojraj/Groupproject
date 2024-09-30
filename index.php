<?php
// Start session
session_start();

// Check if the user is logged in
$logged_in = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NepCourier - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <div class="logo">
            <img src="1.png" alt="NepCourier Logo">
        </div>
        <nav>
            <ul class="horizontal-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if ($logged_in): ?>
                    <!-- If user is logged in, show the Logout link -->
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <!-- If user is not logged in, show the Login and Sign Up links -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="main">
        <div>
            <!-- Personalized welcome message -->
            <h1>Welcome to NepCourier, <?php echo isset($_SESSION['first_name']) ? htmlspecialchars($_SESSION['first_name']) : 'Guest'; ?></h1>
            <div class="buttons">
                <a href="booking.php">Book a Service</a>
                <a href="pricing.php">Pricing</a>
            </div>
        </div>
    </div>

    <div class="track-section">
        <h2>Track Your Shipment</h2>
        <form action="track.php" method="post">
            <input type="text" name="tracking_id" placeholder="Enter Tracking ID">
            <input type="submit" value="Track">
        </form>
    </div>

    <div class="services">
        <h2>Our Services</h2>
        <div class="service-list">
            <div class="service-item">
                <h3>Express Delivery</h3>
                <p>Fast delivery within the same day.</p>
            </div>
            <div class="service-item">
                <h3>Standard Delivery</h3>
                <p>Affordable rates for less urgent items.</p>
            </div>
            <div class="service-item">
                <h3>International Shipping</h3>
                <p>We deliver packages worldwide.</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 NepCourier. All Rights Reserved.</p>
    </footer>

</body>
</html>
