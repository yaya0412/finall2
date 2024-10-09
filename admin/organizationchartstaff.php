
<?php
// Folder di mana gambar disimpan
$uploadDir = 'uploads/';

// Semak jika folder wujud
if (!is_dir($uploadDir)) {
    die("Folder gambar tidak wujud.");
}

// Paparkan semua gambar yang ada dalam folder uploads/
$images = array_diff(scandir($uploadDir), array('..', '.'));
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Gambar Organisasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://papayacare.com/wp-content/uploads/2023/09/Caring-for-the-Elderly-6-Things-to-Remember.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            overflow: hidden; /* Elak scrollbar */
        }
        h2 {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Ambil 80% ketinggian skrin */
            flex-wrap: wrap;
            text-align: center; /* Pusatkan kandungan secara vertikal */
        }
        img {
            max-width: 100%;
            max-height: 100%;
            border: 2px solid #ccc;
            padding: 5px;
            display: block;
            margin: 10px auto; /* Pusatkan gambar */
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>ORGANIZATION CHART</h2>
    <?php if (!empty($images)): ?>
        <div class="image-container">
            <?php foreach ($images as $image): ?>
                <img src="uploads/<?php echo $image; ?>" alt="<?php echo $image; ?>">
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Tiada gambar dimuat naik.</p>
    <?php endif; ?>
</body>
</html>
