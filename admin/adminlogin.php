
<?php 
session_start(); // Start the session

// Initialize variables
$username = '';
$password = '';
$error = '';
$user_type = ''; // Store user type (admin or staff)

// Include database connection details
$host = 'localhost';
$db = 'staffmanagement';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user type and login credentials
    $user_type = $_POST['user_type'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Admin login
    if ($user_type === 'admin') {
        // Dummy admin credentials (replace with database query if needed)
        $valid_username = 'admin';
        $valid_password = 'password123';

        // Check admin credentials
        if ($username === $valid_username && $password === $valid_password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username; // Store username in session
            $_SESSION['user_type'] = 'admin'; // Store user type in session
            header('Location: homeadmin.php'); // Redirect to homeadmin.php in adminfeatures folder
            exit();
        } else {
            $error = 'Invalid admin username or password.';
        }
    } elseif ($user_type === 'staff') {
        // Query the database to verify staff credentials
        $stmt = $mysqli->prepare("SELECT * FROM staff WHERE username = ? AND PASSWORD = ?");
        $stmt->bind_param('ss', $username, $password); // Bind parameters
        $stmt->execute();
        $result = $stmt->get_result();

        // If staff is found in the database
        if ($result->num_rows === 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username; // Store username in session
            $_SESSION['user_type'] = 'staff'; // Store user type in session
            header('Location: dashboardstaff.php'); // Redirect to staff dashboard
            exit();
        } else {
            $error = 'Invalid staff username or password.';
        }
    } else {
        $error = 'Please select a user type.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Medical Operation - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('gambar/backround.jpg'); /* Update to use the correct path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            overflow: hidden;
        }
        .blur-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            filter: blur(8px);
            z-index: 0; /* Set background behind other content */
        }
        .container {
            position: relative;
            z-index: 1; /* Set the container in front of the blurred background */
            background-color: rgba(255, 255, 255, 0.8); /* White background with opacity */
            padding: 40px; /* Increase padding for larger form */
            border-radius: 8px; /* Optional: for rounded corners */
            max-width: 500px; /* Increase max width */
            margin: auto; /* Center the form */
            margin-top: 100px; /* Optional: space from the top */
        }
    </style>
</head>
<body>
    <div class="blur-background"></div>
    <div class="container">
        <h1 class="mt-3 text-center">Login</h1>
        
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="mt-3">
            <div class="form-group">
                <label for="user_type">Select User Type</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="" disabled selected>Select User Type</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <img src="gambar/profile.JPG" alt="User Icon" style="width: 20px; height: 20px;">
                        </span>
                    </div>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <img src="gambar/password.JPG" alt="Password Icon" style="width: 20px; height: 20px;">
                        </span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button> <!-- Make button full-width -->
        </form>
    </div>
</body>
</html>
