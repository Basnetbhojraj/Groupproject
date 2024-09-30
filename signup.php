<?php
// Include database configuration file
require_once 'config.php';

// Initialize variables
$first_name = $last_name = $email = $password = $confirm_password = $phone_number = $address = $user_type = "";
$first_name_err = $last_name_err = $email_err = $password_err = $confirm_password_err = $user_type_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate first name
    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "Please enter your first name.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }
    
    // Validate last name
    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "Please enter your last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        // Prepare a select statement to check if the email is already taken
        $sql = "SELECT user_id FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);
            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate user type
    if (empty(trim($_POST["user_type"]))) {
        $user_type_err = "Please select a user type.";
    } else {
        $user_type = trim($_POST["user_type"]);
    }
    
    // Optional fields
    $phone_number = trim($_POST["phone_number"]);
    $address = trim($_POST["address"]);
    
    // Check input errors before inserting in database
    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($user_type_err)) {
        
        // Generate unique user ID
        $user_id = generate_user_id($first_name, $last_name);

        // Prepare an insert statement
        $sql = "INSERT INTO users (user_id, first_name, last_name, email, password_hash, phone_number, address, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_user_id, $param_first_name, $param_last_name, $param_email, $param_password_hash, $param_phone_number, $param_address, $param_user_type);
            
            // Set parameters
            $param_user_id = $user_id;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phone_number = $phone_number;
            $param_address = $address;
            $param_user_type = $user_type;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}

// Function to generate a unique user ID
function generate_user_id($first_name, $last_name) {
    // First name, first letter of the last name
    $user_id = $first_name . "_" . strtoupper(substr($last_name, 0, 1));
    
    // Append random number
    $user_id .= "_" . rand(10000, 99999); // Add random number to ensure uniqueness
    
    return $user_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - NepCourier</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <div class="form-container">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                    <span class="help-block"><?php echo $first_name_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                    <span class="help-block"><?php echo $last_name_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                </div>
                <div class="form-group <?php echo (!empty($user_type_err)) ? 'has-error' : ''; ?>">
                    <label>User Type</label>
                    <select name="user_type" class="form-control">
                        <option value="Personal" <?php echo ($user_type == 'Personal') ? 'selected' : ''; ?>>Personal</option>
                        <option value="Business" <?php echo ($user_type == 'Business') ? 'selected' : ''; ?>>Business</option>
                    </select>
                    <span class="help-block"><?php echo $user_type_err; ?></span>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-button">Submit</button>
                </div>
                <p>Already have an account? <a href="login.php">Login</a>.</p>
            </form>
        </div>
    </main>    
</body>
</html>
