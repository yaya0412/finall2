
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

// Fetch ability data
$sql = "SELECT ability, COUNT(*) as count FROM elderly_resident GROUP BY ability";
$result = $conn->query($sql);

$abilities = [];
$counts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $abilities[] = $row['ability'];
        $counts[] = $row['count'];
    }
} else {
    echo "No data found.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Abilities Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://www.griswoldcare.com/wp-content/uploads/2024/04/shutterstock_735361786.jpg');
            background-size: cover;
            background-position: center;
            padding: 20px;
            color: black; /* Warna teks hitam */
        }
        h2 {
            text-align: center;
            color: black; /* Warna teks hitam */
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7); /* Bayangan teks putih untuk lebih jelas */
        }
        canvas {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9); /* Latar belakang untuk kanvas */
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body>

<h2>Resident Abilities Pie Chart</h2>
<canvas id="abilityChart"></canvas>

<script>
    const ctx = document.getElementById('abilityChart').getContext('2d');
    const abilityChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($abilities); ?>,
            datasets: [{
                label: 'Number of Residents by Ability',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: 'black'  // Warna label legenda hitam
                    }
                },
                title: {
                    display: true,
                    text: 'Resident Abilities Distribution',
                    color: 'black'  // Warna tajuk hitam
                }
            }
        }
    });
</script>

</body>
</html>
