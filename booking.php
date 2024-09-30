<?php
// Start the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Database connection details
$host = "localhost"; // Database host (usually localhost)
$user = "root"; // Database username (e.g., root)
$password = ""; // Database password (leave empty if no password)
$dbname = "nepcourier"; // Database name

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if both forms are filled
    if (!empty($_POST['booking_date']) && !empty($_POST['pickup_address']) && !empty($_POST['dropup_address']) && !empty($_POST['delivery_date']) && !empty($_POST['package_id']) && !empty($_POST['weight']) && !empty($_POST['dimensions_length']) && !empty($_POST['dimensions_width']) && !empty($_POST['dimensions_height']) && !empty($_POST['package_type'])) {
        
        // Get booking form data
        $booking_date = $_POST['booking_date'];
        $pickup_address = $_POST['pickup_address'];
        $dropup_address = $_POST['dropup_address'];
        $delivery_date = $_POST['delivery_date'];

        // Get package form data
        $package_id = $_POST['package_id'];
        $weight = $_POST['weight'];
        $dimensions_length = $_POST['dimensions_length'];
        $dimensions_width = $_POST['dimensions_width'];
        $dimensions_height = $_POST['dimensions_height'];
        $package_type = $_POST['package_type'];

        // Combine dimensions into a single string LxWxH
        $dimensions = $dimensions_length . 'x' . $dimensions_width . 'x' . $dimensions_height;

        // Insert data into the Booking table
        $sql_booking = "INSERT INTO Booking (user_id, booking_date, pickup_address, dropup_address, delivery_date) 
                        VALUES ('$user_id', '$booking_date', '$pickup_address', '$dropup_address', '$delivery_date')";

        if ($conn->query($sql_booking) === TRUE) {
            // Retrieve the last inserted booking ID
            $booking_id = $conn->insert_id;

            // Insert data into the PackageDetails table
            $sql_package = "INSERT INTO PackageDetails (booking_id, package_id, weight, dimensions, package_type) 
                            VALUES ('$booking_id', '$package_id', '$weight', '$dimensions', '$package_type')";

            if ($conn->query($sql_package) === TRUE) {
                // Redirect to confirmation page with booking and package details
                header("Location: booking_success.php?booking_id=$booking_id&user_id=$user_id&booking_date=$booking_date&pickup_address=$pickup_address&dropup_address=$dropup_address&delivery_date=$delivery_date&package_id=$package_id&weight=$weight&dimensions=$dimensions&package_type=$package_type");
                exit();
            } else {
                $message = "Error: " . $sql_package . "<br>" . $conn->error;
            }
        } else {
            $message = "Error: " . $sql_booking . "<br>" . $conn->error;
        }
    } else {
        $message = "Please fill in both booking and package details.";
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
    <title>Booking and Package Form</title>
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
        <h1 class="supscript">Booking and Package Form</h1>
        <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

        <!-- Display Booking and Package forms side by side -->
        <form method="POST" action="" class="form">
            <div style="display: flex; justify-content: space-between; gap: 20px;">
                <!-- Booking Form -->
                <section class="booking-form">
                    <h2>Booking Form</h2>
                    <label for="user_id">User ID:</label>
                    <input type="number" id="user_id" name="user_id" class="form-input" value="<?php echo $user_id; ?>" readonly required>

                    <label for="booking_date">Booking Date:</label>
                    <input type="date" id="booking_date" name="booking_date" class="form-input" required>

                    <label for="pickup_address">Pickup Address:</label>
                    <input type="text" id="pickup_address" name="pickup_address" class="form-input" required>

                    <label for="dropup_address">Dropup Address:</label>
                    <input type="text" id="dropup_address" name="dropup_address" class="form-input" required>

                    <label for="delivery_date">Delivery Date:</label>
                    <input type="date" id="delivery_date" name="delivery_date" class="form-input" required>
                </section>

                <!-- Package Form -->
                <section class="booking-form">
                    <h2>Package Form</h2>
                    <label for="package_id">Package ID:</label>
                    <input type="text" id="package_id" name="package_id" class="form-input" required>

                    <label for="weight">Weight (kg):</label>
                    <input type="number" id="weight" name="weight" class="form-input" step="0.01" required>

                    <label for="dimensions_length">Length (cm):</label>
                    <input type="number" id="dimensions_length" name="dimensions_length" class="form-input" required>

                    <label for="dimensions_width">Width (cm):</label>
                    <input type="number" id="dimensions_width" name="dimensions_width" class="form-input" required>

                    <label for="dimensions_height">Height (cm):</label>
                    <input type="number" id="dimensions_height" name="dimensions_height" class="form-input" required>

                    <label for="package_type">Package Type:</label>
                    <select id="package_type" name="package_type" class="form-input" required>
                        <option value="Fragile">Fragile</option>
                        <option value="Documents">Documents</option>
                        <option value="Other">Other</option>
                    </select>

                    <button type="submit" class="form-button">Submit</button>
                </section>

            </div>
        </form>
    </div>
    </main>
</body>
</html>
