<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sort Numbers Result</title>
</head>
<body>
    <?php
    // Check if the request is POST and 'numbers' is provided
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['numbers'])) {
        
        // 1. Convert the comma-separated string into an array
        $inputString = $_POST['numbers'];
        $numbersArray = explode(',', $inputString);
        
        // 2. Clean up spaces and convert strings to integers
        $numbersArray = array_map('trim', $numbersArray);
        $numbersArray = array_map('intval', $numbersArray);
        
        // 3. Sort the array in ascending order
        sort($numbersArray);
        
        // 4. Display the sorted array
        echo "<h3>Sorted Array:</h3>";
        echo implode(", ", $numbersArray);
        
    } else {
        echo "<p>No numbers were submitted. Please go back to the form and try again.</p>";
    }
    ?>
</body>
</html>
