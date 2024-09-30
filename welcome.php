<?php
// Initialize the session
session_start();

// Check if the logout action is confirmed
if (isset($_POST['confirm_logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page or a logged-out message page
    header("location: login.php"); // You can change this to any page you'd like after logout
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout Confirmation</title>
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .confirmation-box {
            display: inline-block;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .confirmation-box h2 {
            margin: 0 0 15px;
        }
        .btn-logout, .btn-cancel {
            color: white;
            background-color: #dc3545;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }
        .btn-cancel {
            background-color: #6c757d;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="confirmation-box">
        <h2>Do you want to logout?</h2>
        <form method="post" action="">
            <button type="submit" name="confirm_logout" class="btn-logout">Yes, Logout</button>
            <a href="index.php" class="btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
