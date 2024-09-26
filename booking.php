<?php
// Database connection details
$host = "localhost"; // Database host (usually localhost)
$user = "root"; // Database username (e.g., root)
$password = ""; // Database password (leave empty if no password)
$dbname = "nepcourier"; // Database name (matches the one created in the SQL file)

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $user_id = $_POST['user_id'];
    $booking_date = $_POST['booking_date'];
    $pickup_address = $_POST['pickup_address'];
    $dropup_address = $_POST['dropup_address'];
    $delivery_date = $_POST['delivery_date'];

    // Insert data into the database
    $sql = "INSERT INTO Booking (user_id, booking_date, pickup_address, dropup_address, delivery_date) 
            VALUES ('$user_id', '$booking_date', '$pickup_address', '$dropup_address', '$delivery_date')";

    if ($conn->query($sql) === TRUE) {
        $message = "Booking successfully created!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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
            <h1 class="supscript">Booking Form</h1>
            <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
            <section class="booking-form">
                <form method="POST" action="" class="form">
                    <label for="user_id">User ID:</label>
                    <input type="number" id="user_id" name="user_id" class="form-input" required>

                    <label for="booking_date">Booking Date:</label>
                    <input type="date" id="booking_date" name="booking_date" class="form-input" required>

                    <label for="pickup_address">Pickup Address:</label>
                    <input type="text" id="pickup_address" name="pickup_address" class="form-input" required>

                    <label for="dropup_address">Dropup Address:</label>
                    <input type="text" id="dropup_address" name="dropup_address" class="form-input" required>

                    <label for="delivery_date">Delivery Date:</label>
                    <input type="date" id="delivery_date" name="delivery_date" class="form-input" required>

                    <button type="submit" class="form-button">Submit</button>
                </form>
            </section>
        </div>
    </main>

    
</body>
</html>
