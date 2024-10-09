
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO elderly_resident (name, age, past_disease, ongoing_disease, ability, treatment, medicine, staff_in_charge) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssss", $name, $age, $past_disease, $ongoing_disease, $ability, $treatment, $medicine, $staff_in_charge);

    // Get form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $past_disease = $_POST['past_disease'];
    $ongoing_disease = $_POST['ongoing_disease'];
    $ability = $_POST['ability'];
    $treatment = $_POST['treatment'];
    $medicine = $_POST['medicine'];
    $staff_in_charge = $_POST['staff_in_charge'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('New resident added successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_stmt = $conn->prepare("DELETE FROM elderly_resident WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        echo "<script>alert('Resident deleted successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $delete_stmt->error . "');</script>";
    }
    $delete_stmt->close();
}

// Fetch and display existing residents
$sql = "SELECT * FROM elderly_resident";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Resident Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(173, 216, 230, 0.8); /* Soft blue background */
            background-image: url('https://papayacare.com/wp-content/uploads/2023/09/Caring-for-the-Elderly-6-Things-to-Remember.jpg');
            background-size: cover;
            background-position: center;
            color: black; /* Black font color */
            padding: 20px;
            position: relative;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
            color: #007BFF; /* Blue link color */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Insert Resident Data</h2>

<!-- HTML Form for Data Input -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    Name: <input type="text" name="name" required><br><br>
    Age: <input type="number" name="age" required><br><br>
    Past Disease: <input type="text" name="past_disease" required><br><br>
    Ongoing Disease: <input type="text" name="ongoing_disease" required><br><br>
    Ability: <input type="text" name="ability" required><br><br>
    Treatment: <input type="text" name="treatment" required><br><br>
    Medicine: <input type="text" name="medicine" required><br><br>
    Staff in Charge: <input type="text" name="staff_in_charge" required><br><br>
    <input type="submit" value="Submit">
</form>

<?php
if ($result->num_rows > 0) {
    echo "<h3>Existing Residents:</h3>";
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
                <td>
                    <a href='edit_resident.php?id=" . $row['id'] . "'>Edit</a> | 
                    <a href='?delete_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No residents found.";
}
$conn->close();
?>

</body>
</html>

