<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Medical Operation - Charts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #e6f7ff, #b3e0ff); /* Soft gradient background */
        }
        .header {
            background: url('https://ww2.kqed.org/app/uploads/sites/10/2021/07/WheelchairGeneric-1020x680.jpg') no-repeat center center;
            background-size: cover;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 5px solid #00aaff; /* Add a bottom border for contrast */
        }
        .header h1 {
            color: white;
            font-size: 3.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin: 0; /* Remove default margin */
        }
        .container {
            text-align: center;
            margin: 40px auto; /* Center the container */
            max-width: 900px; /* Limit the width */
            padding: 20px; /* Add padding for better spacing */
            background-color: rgba(255, 255, 255, 0.9); /* Slightly opaque background for readability */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1); /* Enhanced shadow */
        }
        .nav-card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            margin: 20px;
            display: inline-block;
            width: 250px;
            transition: transform 0.3s, box-shadow 0.3s; /* Animation effect */
            text-decoration: none; /* Remove underline */
            color: #333; /* Text color */
        }
        .nav-card:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Deeper shadow on hover */
        }
        .nav-card img {
            width: 100px;  /* Set width for icons */
            height: 100px; /* Set height for icons */
            margin-bottom: 10px; /* Space between image and text */
        }
        .nav-card h2 {
            font-size: 1.5em;
            font-weight: bold; /* Bold for emphasis */
        }
        p {
            font-size: 1.2em; /* Slightly larger font for welcome text */
            color: #333; /* Text color */
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <h1>Senior Medical Operation - Charts</h1>
    </div>

    <!-- Main Container for Navigation -->
    <div class="container">
        <p>Welcome to the Senior Medical Operation chart:</p>

        <!-- Link to Medication Prevalence Rate -->
        <a href="medication.php" class="nav-card">
            <img src="https://www.careworkshealthservices.com/wp-content/uploads/2020/04/senior-man-looking-at-medications.jpg" alt="Medication Prevalence Rate">
            <h2>Medication </h2>
        </a>
        
        <!-- Link to Prevalence of Diseases Rate -->
        <a href="DISEASES.php" class="nav-card">
            <img src="https://www.shutterstock.com/image-photo/caucasian-woman-elderly-asian-discuss-600nw-2459571037.jpg" alt="Prevalence of Diseases Rate">
            <h2>Disease</h2>
        </a>
        
        <!-- Link to Functional Ability Rate -->
        <a href="ability.php" class="nav-card">
            <img src="https://24373520.fs1.hubspotusercontent-na1.net/hubfs/24373520/Imported_Blog_Media/Cognitive-Games-for-Seniors-1.jpg" alt="Functional Ability Rate">
            <h2>Ability </h2>
        </a>
    </div>

</body>
</html>
