<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Animals Result</title>
</head>
<body>
    <?php
    // Check if the form was submitted and animal_count exists
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['animal_count'])) {
        
        $n = (int)$_POST['animal_count'];
        
        // Array of animals
        $animals = ["Lion", "Tiger", "Elephant", "Giraffe", "Zebra", "Monkey", "Dog", "Cat", "Kangaroo", "Panda"];
        
        echo "<h3>First $n Animals:</h3>";
        
        if ($n > 0) {
            echo "<ul>";
            // Loop N times to display the animals
            for ($i = 0; $i < $n; $i++) {
                // Check if N exceeds our array size to prevent errors
                if (isset($animals[$i])) {
                    echo "<li>" . $animals[$i] . "</li>";
                }
            }
            echo "</ul>";
            
            // Optional: Tell the user if they asked for more animals than we have
            if ($n > count($animals)) {
                echo "<p><em>Note: We only have " . count($animals) . " animals in our list.</em></p>";
            }
        } else {
            echo "<p>Please enter a number greater than 0.</p>";
        }
        
    } else {
        echo "<p>No data received. Please submit the form first.</p>";
    }
    ?>
</body>
</html>
