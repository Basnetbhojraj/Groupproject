<?php
// Database credentials
define('DB_SERVER', 'localhost'); // Your database server (usually 'localhost')
define('DB_USERNAME', 'root');    // Your MySQL username
define('DB_PASSWORD', '');        // Your MySQL password (leave blank if none)
define('DB_NAME', 'nepcourier');  // Your database name

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
