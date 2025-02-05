
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Image by Location and Date</title>
    <style>
        body {
            
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgb(126, 181, 232);
        }
        .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .image-container div {
            text-align: center;
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
        form{
            border: 5px dashed rgb(2, 89, 155);
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        .error{
            color: rgb(170, 74, 10);
            font-size: 2rem;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            background-color: rgb(2, 89, 155);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(0, 70, 120);
        }
    </style>
</head>
<body>
    <form action="lab09d.php" method="POST">
        <label for="locations">Choose location:</label>
        <select name="location" id="locations">
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

            // Fetch unique locations from the database
            $locationQuery = "SELECT DISTINCT location FROM photograph";
            $locationResult = mysqli_query($connect, $locationQuery);
            if ($locationResult) {
                while ($row = mysqli_fetch_assoc($locationResult)) {
                    echo '<option value="' . htmlspecialchars($row['location']) . '">' . htmlspecialchars($row['location']) . '</option>';
                }
            } else {
                echo '<option value="">No locations available</option>';
            }
            ?>
        </select>
        <br><br>
        <label>Date:</label><br>
        <?php
        // Fetch unique years from the database
        $dateQuery = "SELECT DISTINCT YEAR(date_taken) AS year FROM photograph ORDER BY year DESC";
        $dateResult = mysqli_query($connect, $dateQuery);
        if ($dateResult) {
            while ($row = mysqli_fetch_assoc($dateResult)) {
                echo '<input type="radio" name="date" value="' . htmlspecialchars($row['year']) . '">' . htmlspecialchars($row['year']) . '<br>';
            }
        } else {
            echo '<p>No dates available.</p>';
        }
        ?>
        <br>
        <button type="submit">Submit Your Choice!</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['location'], $_POST['date'])) {
        $location = mysqli_real_escape_string($connect, $_POST['location']);
        $date = mysqli_real_escape_string($connect, $_POST['date']);

        // Query to fetch images
        $query = "SELECT * FROM photograph WHERE location = '$location' AND YEAR(date_taken) = '$date'";
        $result = mysqli_query($connect, $query);

        if ($result && $result->num_rows > 0) {
            echo '<h2>Images from ' . htmlspecialchars($location) . ' (' . htmlspecialchars($date) . ')</h2>';
            echo '<div class="image-container">';
            while ($row = $result->fetch_assoc()) {
                echo '<div>';
                echo '<img src="' . htmlspecialchars($row['picture_url']) . '" alt="' . htmlspecialchars($row['subject']) . '">';
                echo '<p>' . htmlspecialchars($row['subject']) . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="error">No images found for the selected location and date.</p>';
        }
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</body>
</html>
