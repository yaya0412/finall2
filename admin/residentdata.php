
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
    $stmt = $conn->prepare("INSERT INTO elderly_resident (name, age, past_disease, ongoing_disease, ability, treatment, medicine, staff_in_charge, kategori, alamat, jenis_alahan, lampin_pakai_buang, diet, barang_berharga) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssssssss", $name, $age, $past_disease, $ongoing_disease, $ability, $treatment, $medicine, $staff_in_charge, $kategori, $alamat, $jenis_alahan, $lampin_pakai_buang, $diet, $barang_berharga);

    // Get form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $past_disease = $_POST['past_disease'];
    $ongoing_disease = $_POST['ongoing_disease'];
    $ability = $_POST['ability'];
    $treatment = $_POST['treatment'];
    $medicine = $_POST['medicine'];
    $staff_in_charge = $_POST['staff_in_charge'];
    $kategori = $_POST['kategori'];
    $alamat = $_POST['alamat'];
    
    // Handle jenis alahan
    if ($_POST['jenis_alahan'] == "Lain-Lain") {
        $jenis_alahan = $_POST['jenis_alahan_lain'];
    } else {
        $jenis_alahan = $_POST['jenis_alahan'];
    }

    // Capture barang berharga
    if ($_POST['barang_berharga'] == "Lain-Lain") {
        $barang_berharga = $_POST['barang_berharga_lain']; // Capture input for "Lain-Lain"
    } else {
        $barang_berharga = $_POST['barang_berharga'];
    }

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

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], .view-button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover, .view-button:hover {
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

        .jenis-alahan-lain, .barang-berharga-lain {
            display: none; /* Hide the "lain-lain" input by default */
        }
    </style>
    <script>
        // Show/Hide input for "Lain-Lain" allergy
        function toggleLainLainInput() {
            var jenisAlahanSelect = document.getElementById("jenis_alahan");
            var lainLainInput = document.getElementById("lain-lain");
            if (jenisAlahanSelect.value === "Lain-Lain") {
                lainLainInput.style.display = "block";
            } else {
                lainLainInput.style.display = "none";
            }
        }

        // Show/Hide input for "Lain-Lain" barang berharga
        function toggleBarangLainInput() {
            var barangSelect = document.getElementById("barang_berharga");
            var barangLainInput = document.getElementById("barang-lain");
            if (barangSelect.value === "Lain-Lain") {
                barangLainInput.style.display = "block";
            } else {
                barangLainInput.style.display = "none";
            }
        }
    </script>
</head>
<body>

<h2>Insert Resident Data</h2>

<!-- HTML Form for Data Input -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    Name: <input type="text" name="name" required><br><br>
    Age: <input type="number" name="age" required><br><br>
    Past Disease: <input type="text" name="past_disease" required><br><br>
    Ongoing Disease: <input type="text" name="ongoing_disease" required><br><br>

    Ability: 
    <select name="ability" required>
        <option value="">--Select Ability--</option>
        <option value="Independent">Independent</option>
        <option value="Partially Dependent">Partially Dependent</option>
        <option value="Fully Dependent">Fully Dependent</option>
        <option value="Cognitively Impaired">Cognitively Impaired</option>
    </select>
    <br><br>

    Treatment: <input type="text" name="treatment" required><br><br>
    Medicine: <input type="text" name="medicine" required><br><br>
    Staff in Charge: <input type="text" name="staff_in_charge" required><br><br>

    <!-- Kategori dropdown -->
    Kategori: 
    <select name="kategori" required>
        <option value="">--Select Kategori--</option>
        <option value="Asnaf">Asnaf</option>
        <option value="Berbayar">Berbayar</option>
        <option value="Sihat">Sihat</option>
        <option value="Terlantar">Terlantar</option>
    </select>
    <br><br>

    Alamat: <input type="text" name="alamat" required><br><br> <!-- Medan alamat -->
    
    <!-- Jenis Alahan selection -->
    Jenis Alahan: 
    <select id="jenis_alahan" name="jenis_alahan" onchange="toggleLainLainInput()" required>
        <option value="">--Select--</option>
        <option value="Ada">Ada</option>
        <option value="Tiada">Tiada</option>
        <option value="Lain-Lain">Lain-Lain</option>
    </select>
    <br><br>

    <!-- Input for "Lain-Lain" allergy -->
    <div class="jenis-alahan-lain" id="lain-lain">
        Nyatakan: <input type="text" name="jenis_alahan_lain">
    </div>
    <br>

    <!-- Lampin Pakai Buang selection -->
    Lampin Pakai Buang: 
    <select name="lampin_pakai_buang" required>
        <option value="">--Select--</option>
        <option value="Ya">Ya</option>
        <option value="Tidak">Tidak</option>
    </select>
    <br><br>

    <!-- Diet selection -->
    Diet: 
    <select name="diet" required>
        <option value="">--Select--</option>
        <option value="Normal">Normal</option>
        <option value="Diet Khusus">Diet Khusus</option>
    </select>
    <br><br>

    <!-- Barang Berharga selection -->
    Barang Berharga: 
    <select id="barang_berharga" name="barang_berharga" onchange="toggleBarangLainInput()" required>
        <option value="">--Select--</option>
        <option value="Barang Kemas">Barang Kemas</option>
        <option value="Telefon Bimbit">Telefon Bimbit</option>
        <option value="Duit">Duit</option>
        <option value="Kad Bank">Kad Bank</option>
        <option value="Lain-Lain">Lain-Lain</option>
    </select>
    <br><br>

    <!-- Input for "Lain-Lain" barang berharga -->
    <div class="barang-berharga-lain" id="barang-lain">
        Nyatakan: <input type="text" name="barang_berharga_lain">
    </div>
    <br>

    <input type="submit" value="Submit">
</form>

<!-- Display existing residents -->
<h2>Existing Residents</h2>
<table>
    <tr>
        <th>ID</th>
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
        <th>Jenis Alahan</th>
        <th>Lampin Pakai Buang</th>
        <th>Diet</th>
        <th>Barang Berharga</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['past_disease'] . "</td>";
            echo "<td>" . $row['ongoing_disease'] . "</td>";
            echo "<td>" . $row['ability'] . "</td>";
            echo "<td>" . $row['treatment'] . "</td>";
            echo "<td>" . $row['medicine'] . "</td>";
            echo "<td>" . $row['staff_in_charge'] . "</td>";
            echo "<td>" . $row['kategori'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['jenis_alahan'] . "</td>";
            echo "<td>" . $row['lampin_pakai_buang'] . "</td>";
            echo "<td>" . $row['diet'] . "</td>";
            echo "<td>" . $row['barang_berharga'] . "</td>";
            echo "<td><a href='?delete_id=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='15'>No residents found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
