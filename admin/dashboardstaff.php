<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Retrieve username from session
$username = $_SESSION['username'] ?? 'User'; // Default to 'User' if username is not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Medical Operation Dashboard</title>
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('gambar/backround.jpg'); /* Update to use the correct path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            overflow: hidden;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Info Section */
        .info-container {
            position: absolute; /* Position the info container absolutely */
            top: 10px; /* Adjust the top position */
            right: 10px; /* Adjust the right position */
            color: white; /* Keep color white for better visibility */
            font-size: 0.8em; /* Make font size smaller */
            z-index: 1000; /* Ensure it's above other elements */
        }

        .info-icon {
            cursor: pointer;
            font-size: 16px; /* Smaller font size for the icon */
            text-decoration: underline;
            margin-right: 5px; /* Space between icon and text */
        }

        .info-description {
            display: none; /* Hidden by default */
            background-color: rgba(0, 0, 0, 0.7); /* Slightly dark background */
            color: white;
            padding: 5px; /* Smaller padding */
            border-radius: 5px;
            font-size: 0.8em; /* Smaller font size for description */
            position: absolute; /* Position the description absolutely */
            top: 25px; /* Position below the icon */
            right: 0; /* Align to the right */
            z-index: 1000; /* Ensure it's above other elements */
        }

        /* Header Section */
        .header {
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
            text-align: center;
        }

        .header h1 {
            color: black; /* Changed to black */
            font-size: 3em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .header .welcome-message {
            font-size: 1.8em;
            color: black; /* Changed to black */
            margin-top: 10px;
        }

        /* Navigation Bar */
        .nav {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 10px;
            text-align: center;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.2em;
            padding: 8px 15px;
            transition: background-color 0.3s ease;
        }

        .nav a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
        }

        .nav a.active {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
        }

        .container {
            text-align: center;
            margin: 30px auto;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .button {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
            width: 150px;
            position: relative;
        }

        .button img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .button h3 {
            font-size: 1.2em;
            color: #333;
        }

        .button:hover {
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .button-container {
                flex-direction: column;
                gap: 15px;
            }
            .button {
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <!-- Info Section -->
    <div class="info-container">
        <div class="info-icon" onclick="toggleDescription()">ℹ️ Info</div>
        <div class="info-description" id="infoDescription">
            This website is designed to monitor the number of diseases, medications, and abilities of residents at Darul Hanan.
        </div>
    </div>

    <!-- Header Section -->
    <div class="header">
        <h1>Senior Medical Operation</h1>
        <div class="welcome-message">
            Welcome, <?php echo htmlspecialchars($username); ?>!
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="nav">
        <?php
            // Get the current PHP script name to highlight active page
            $current_page = basename($_SERVER['PHP_SELF']);

            // Array of navigation links
            $nav_links = [
                "resident.php" => "Residents",
                "../chart/dashboardchart.php" => "Statistics",
                "organizationchart.php" => "Organization Chart"
            ];

            // Generate navigation links dynamically with active highlighting
            foreach ($nav_links as $page => $title) {
                $active_class = ($current_page == basename($page)) ? 'active' : '';
                echo "<a href='$page' class='$active_class'>$title</a>";
            }
        ?>
    </div>

    <!-- Button Container -->
    <div class="container">
        <div class="button-container">
            <!-- Resident Button -->
            <div class="button">
                <a href="staffmedic/resident.php">
                    <img src="gambar/list.png" alt="Senior Resident Interaction">
                    <h3>Resident</h3>
                </a>
            </div>

            <!-- Statistic Button -->
            <div class="button">
                <a href="chart/dashboardchart.php">
                    <img src="https://cdn3.vectorstock.com/i/1000x1000/96/57/statistic-graphic-isolated-icon-vector-17079657.jpg" alt="Statistics">
                    <h3>Statistic</h3>
                </a>
            </div>

            <!-- Organization Chart Button -->
            <div class="button">
                <a href="organizationchartstaff.php">
                    <img src="https://img.kyodonews.net/english/public/images/posts/7c65d61449699fe38d2f5191c0ff1149/cropped_image_l.jpg" alt="Organization Chart">
                    <h3>Organization Chart</h3>
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleDescription() {
            const description = document.getElementById('infoDescription');
            description.style.display = description.style.display === 'none' || description.style.display === '' ? 'block' : 'none';
        }
    </script>

</body>
</html>

