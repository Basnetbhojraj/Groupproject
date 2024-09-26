<?php
// You can add any PHP code here, such as session management or backend processing.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing - NepCourier</title>
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
                <li><a href="login.php">Account</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="pricing-section">
        <h2>Delivery Options</h2>
        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Delivery Time</th>
                    <th>Price (Per kg)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Standard Delivery</td>
                    <td>3-5 Business Days</td>
                    <td>$5</td>
                </tr>
                <tr>
                    <td>Express Delivery</td>
                    <td>1-2 Business Days</td>
                    <td>$10</td>
                </tr>
                <tr>
                    <td>Same Day Delivery</td>
                    <td>Same Day</td>
                    <td>$20</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="cost-calculator">
        <h2>Calculate Your Delivery Cost</h2>
        <form id="cost-form">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" min="0" step="0.1" required>
            <label for="distance">Distance (km):</label>
            <input type="number" id="distance" name="distance" min="0" required>
            <label for="service">Select Service:</label>
            <select id="service" name="service">
                <option value="5">Standard Delivery - $5/kg</option>
                <option value="10">Express Delivery - $10/kg</option>
                <option value="20">Same Day Delivery - $20/kg</option>
            </select>
            <button type="button" onclick="calculateCost()">Calculate</button>
        </form>
        <p id="result"></p>
    </section>

    <script src="script.js"></script>
</body>
</html>
