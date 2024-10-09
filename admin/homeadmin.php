
<?php
session_start();

// Ensure the user is logged in as an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: adminlogin.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Senior Medical Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('https://www.griswoldcare.com/wp-content/uploads/2024/04/shutterstock_735361786.jpg') no-repeat center center fixed;
            background-size: cover; /* Cover the whole page */
            color: white;
        }

        /* Overlay to darken the background for better text visibility */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            z-index: -1; /* Ensure the overlay stays behind the content */
        }

        .container {
            margin-top: 50px;
        }

        .card {
            margin-bottom: 30px;
            background-color: rgba(255, 255, 255, 0.9); /* Slight transparency for card */
            border: none;
            border-radius: 15px;
        }

        .card-body {
            padding: 40px;
        }

        .card-title {
            color: #333;
            font-size: 1.5em;
        }

        .card-text {
            color: #666;
            font-size: 1.1em;
        }

        .btn-primary, .btn-danger {
            font-size: 1.2em;
            padding: 15px 30px;
            border-radius: 10px;
        }

        .text-center {
            margin-top: 30px;
        }

        .card img {
            max-height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center mb-5">Admin Dashboard</h1>
        <div class="row justify-content-center">
            <!-- Manage Staff Account -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Manage Staff Account</h5>
                        <p class="card-text">Add, update and remove staff accounts.</p>
                        <img src="https://wytcote.com/wp-content/uploads/2022/02/Nursing-home-pana-e1645058917344.png" alt="Manage Staff Image" class="img-fluid mb-3">
                        <a href="staffmanagement.php" class="btn btn-primary">Manage Staff</a>
                    </div>
                </div>
            </div>

            <!-- Manage Resident -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Manage Resident</h5>
                        <p class="card-text">Add or update resident details.</p>
                        <img src="https://www.shutterstock.com/image-vector/elderly-senior-woman-making-heart-260nw-2366649321.jpg" alt="Manage Resident Image" class="img-fluid mb-3">
                        <a href="residentdata.php" class="btn btn-primary">Manage Resident</a>
                    </div>
                </div>
            </div>

            <!-- Manage Chart -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Manage Chart</h5>
                        <p class="card-text">View and generate statistics charts.</p>
                        <img src="https://media.istockphoto.com/id/1425719205/vector/organization-chart-cartoon-doodle-style-vector-illustration.jpg?s=612x612&w=0&k=20&c=TMT9J7avMU7Gx1GiAc2gBs615UOEUerKYJC5Z0kgiuU=" alt="Manage Chart Image" class="img-fluid mb-3">
                        <a href="organizationchart.php" class="btn btn-primary">View Chart</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="adminlogin.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

</body>
</html>

