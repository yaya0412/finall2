<?php
// MySQL connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "residentdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display existing residents
$sql = "SELECT * FROM elderly_resident";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Residents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(173, 216, 230, 0.8);
            background-image: url('https://papayacare.com/wp-content/uploads/2023/09/Caring-for-the-Elderly-6-Things-to-Remember.jpg');
            background-size: cover;
            background-position: center;
            color: black;
            padding: 20px;
            position: relative;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button {
            margin-top: 20px;
            display: block;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            width: 150px;
            margin: 0 auto;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Existing Residents</h2>

<?php
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Past Disease</th>
                <th>Ongoing Disease</th>
                <th>Ability</th>
                <th>Treatment</th>
                <th>Medicine</th>
                <th>Staff in Charge</th>
                <th>Kategori</th>
                <th>Alamat</th>
                <th>Actions</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['age'] . "</td>
                <td>" . $row['past_disease'] . "</td>
                <td>" . $row['ongoing_disease'] . "</td>
                <td>" . $row['ability'] . "</td>
                <td>" . $row['treatment'] . "</td>
                <td>" . $row['medicine'] . "</td>
                <td>" . $row['staff_in_charge'] . "</td>
                <td>" . $row['kategori'] . "</td>
                <td>" . $row['alamat'] . "</td>
                <td>
                    <a href='edit_resident.php?id=" . $row['id'] . "'>Edit</a> | 
                    <a href='?delete_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No residents found.</p>";
}
?>

<!-- Back button to return to the main page -->
<a href="interfaceresident.php" class="back-button">Back to Insert Resident Data</a>

<?php
$conn->close();
?>

</body>
</html>
