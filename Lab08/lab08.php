<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 8</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<body>
    
    
    <?php
        date_default_timezone_set("America/Toronto");
        if (date("G") >= 0 && date("G") < 13){
            $class = "morning";
            $greeting = "Good Morning!";
        }elseif (date("G") >= 13 && date("G") < 18){
            $class="afternoon";
            $greeting = "Good Afternoon!";
            
        }elseif (date("G") >= 18 && date("G") < 22){
            $class= "evening";
            $greeting = "Good Evening!";
            
        }else{
            $class = "night";
            $greeting = "Good Night!";
          
        }
        echo "<div class=\"$class greeting\"><h1>$greeting</h1></div>";
        
    if (isset($_POST["int1"]) && isset($_POST["int2"])){
        $first_int = $_POST["int1"];
        $second_int = $_POST["int2"];

        if ($first_int != null && $second_int != null && ($first_int < 3 || $first_int > 12 || $second_int < 3 || $second_int > 12)){
            echo "<h3 class=\"warning\">Integer entered must be between the range 3 to 12!</h3>";
        }
        else{
            echo "<table class=\"table\" border='1' cellpadding='5' cellspacing='0'>";
            
            
            for($i = 1; $i <= $first_int; $i++){
                echo "<tr>";
                for($j=1; $j <= $second_int; $j++){
                    echo "<td> " . $i*$j . " </td>";
                }
                echo "</tr>";
                
                
            }
            echo "</table>";

            
            
        }

        
            
        }
        
        

    
    ?>
    <h4>Generate Multiplication (m x n) Table:</h4>
    <form class="form1" action="lab08.php" method="post" >
        <label for="int1">Enter an integer: </label>
        <input type="text" name="int1" id="int1" required><br>
        <label for="int2">Enter an integer: </label>
        <input type="text" name="int2" id="int2" required><br>
        <button type="submit">Submit</button>
    </form>

    <h4>Choose an image of your choice: </h4>
    <form action="lab08.php" method="post">
        <div class="form2">
            <label>
                <input type="radio" name="images" id="mealprep" value="mealprep.gif">
                <img src="./assets/mealprep.gif" alt="meal prep image">
            </label><br>
            <label>
                <input type="radio" id="thanks6" name="images" value="thanks6.gif">
                <img src="./assets/thanks6.gif" alt="meal prep image">
            </label><br>
            <label>
                <input type="radio" id="thanks7" name="images" value="thanks7.gif">
                <img src="./assets/thanks7.gif" alt="meal prep image">
            </label><br>
            <label>
                <input type="radio" id="turkey6" name="images" value="turkey6.gif">
                <img src="./assets/turkey6.gif" alt="meal prep image">
            </label><br>
            <label>
                <input type="radio" id="pie" name="images" value="pie.gif">
                <label for="pie"><img src="./assets/pie.gif" alt="pie">
            </label><br>
        </div>
        <button class="btn2" type="submit">Save Your Choice!</button>
    </form>
    <?php 
        if (isset($_POST["images"])){
            $image = $_POST["images"];
            setcookie('favoriteChoice', $image, time() + 60 * 60 * 24);
            $_COOKIE['favoriteChoice'] = $image;
            
        }
        if ($class === "morning" || $class === "afternoon"){
            $colour = "dayclr";
        }
        else{
            $colour = "nightclr";
        }
        if (isset($_COOKIE['favoriteChoice'])){
            $visit = htmlspecialchars($_COOKIE['favoriteChoice']);
            echo "<div class=\"current-image $colour\"><p>Current image: $visit </p>";
            echo "<img class=\"favImg\" src=\"./assets/$visit\" alt=\"Favorite Image\"></div>";
        }
        else{
            echo "<p class=\"current-image $colour\">Welcome! Please choose your favorite thanks giving picture from below.</p>";
        }
            
    ?>
    <footer>Maitreyee Das © 2024, CPS530, Toronto Metropolitan University</footer>

    
</body>
</html>