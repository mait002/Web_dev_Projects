<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Random Image</title>
    <style>
        body {
            
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgb(126, 181, 232);
        }
        .image-container {
            margin-top: 50px;
        }
        img {
            margin-top:50px;
            border: 5px dashed rgb(2, 89, 155);
            max-width: 400px;
            max-height: 300px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .caption {
            font-size: 2rem;
            font-weight: bold;

        }
        .total-count {
            font-style: italic;
            margin-top: 30px;
            font-size: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    
    <?php
    $filePath = 'credentials.txt';

    // Check if the file exists
    if (file_exists($filePath)) {
        // Read the file into an array, each line becomes an array element
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        $credentials = [];
        foreach ($lines as $line) {
            // Split each line by the colon to separate keys and values
            list($key, $value) = explode(':', $line, 2);
            $credentials[trim($key)] = trim($value); // Store in an associative array
        }
    
        // Access the user ID and password
        $username = $credentials['username'] ?? null;
        $password = $credentials['password'] ?? null;
    
    } else {
        echo "Error: File does not exist.";
    }
    // Database credentials
    $host = 'localhost';
    $database = 'mdasurmi';
    
    // Establish database connection
    $connect = mysqli_connect($host, $username, $password, $database);
    if (!$connect) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Query to get a random image
    $randomImageQuery = "SELECT * FROM photograph ORDER BY RAND() LIMIT 1";
    $randomImageResult = mysqli_query($connect, $randomImageQuery);

    if ($randomImageResult && $randomImageResult->num_rows > 0) {
        $row = $randomImageResult->fetch_assoc();
        echo '<div class="image-container">';
        echo '<img src="' . htmlspecialchars($row['picture_url']) . '" alt="' . htmlspecialchars($row['subject']) . '">';
        echo '<p class="caption">' . htmlspecialchars($row['subject']) . '</p>';
        echo '</div>';
    } else {
        echo '<p>No images found in the database.</p>';
    }

    // Query to count the total number of images
    $totalCountQuery = "SELECT COUNT(*) AS total FROM photograph";
    $totalCountResult = mysqli_query($connect, $totalCountQuery);
    if ($totalCountResult) {
        $countRow = $totalCountResult->fetch_assoc();
        $totalCount = $countRow['total'];
        echo '<p class="total-count">Total number of images in the database: ' . $totalCount . '</p>';
    } else {
        echo '<p>Unable to fetch the total count of images.</p>';
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</body>
</html>
