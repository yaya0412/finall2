<?php
// Directory to save uploaded images
$uploadDir = 'uploads/';

// Check if the folder doesn't exist, create a new folder
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create folder with read-write permissions
}

// Image upload process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['gambar'])) {
        $fileName = basename($_FILES['gambar']['name']);
        $targetFile = $uploadDir . $fileName;

        // Ensure only image files are uploaded
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($imageFileType, $allowedTypes)) {
            // Upload image
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
                echo "Image uploaded successfully.";
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Only image files (JPG, JPEG, PNG, GIF) are allowed.";
        }
    }
}

// Process for deleting images
if (isset($_GET['delete'])) {
    $fileToDelete = $uploadDir . $_GET['delete'];

    if (file_exists($fileToDelete)) {
        unlink($fileToDelete); // Delete file
        echo "The picture was successfully deleted.";
    } else {
        echo "The picture does not exist.";
    }
}

// Display all images in the uploads/ folder
$images = array_diff(scandir($uploadDir), array('..', '.'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Chart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://papayacare.com/wp-content/uploads/2023/09/Caring-for-the-Elderly-6-Things-to-Remember.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center; /* Center text alignment */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* White background with some transparency */
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
        }
        h2 {
            font-size: 24px;
        }
        form {
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            display: inline-block;
            margin: 10px;
        }
        img {
            border: 2px solid #ccc;
            padding: 5px;
            width: 300px; /* Enlarge image to 300px */
            height: auto; /* Maintain aspect ratio */
            cursor: pointer; /* Change cursor when hovering over the image */
        }
        a {
            display: block;
            text-align: center;
            margin-top: 5px;
            color: #ff0000;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        /* Fullscreen image CSS */
        .fullscreen-img {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8); /* Dark background */
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .fullscreen-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Ensure image fits without changing aspect ratio */
        }
        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload a Picture</h2>
        <form action="organizationchart.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="gambar" accept="image/*" required>
            <input type="submit" value="Upload">
        </form>

        <h2>Organization Chart</h2>
        <?php if (!empty($images)): ?>
            <ul>
                <?php foreach ($images as $image): ?>
                    <li>
                        <img src="uploads/<?php echo $image; ?>" alt="<?php echo $image; ?>" onclick="openFullscreen(this)">
                        <a href="organizationchart.php?delete=<?php echo $image; ?>" onclick="return confirm('Are you sure you want to delete this picture?')">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No images uploaded.</p>
        <?php endif; ?>
    </div>

    <!-- Fullscreen image overlay -->
    <div id="fullscreenOverlay" class="fullscreen-img">
        <span class="close-btn" onclick="closeFullscreen()">×</span>
        <img id="fullscreenImage" src="">
    </div>

    <script>
        function openFullscreen(imgElement) {
            var imgSrc = imgElement.src;
            document.getElementById('fullscreenImage').src = imgSrc;
            document.getElementById('fullscreenOverlay').style.display = 'flex';
        }

        function closeFullscreen() {
            document.getElementById('fullscreenOverlay').style.display = 'none';
        }
    </script>
</body>
</html>
