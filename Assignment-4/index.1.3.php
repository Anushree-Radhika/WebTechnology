<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odd Numbers Result</title>
</head>
<body>
    <?php 
    if (isset($_POST["number"])) {
        
        $number = (int)$_POST["number"]; 
        
        echo "Displaying the odd numbers present between 1 to " . $number . ":<br><br>";
        
        for ($i = 1; $i <= $number; $i++) {
            if ($i % 2 != 0) {
                echo $i . "<br>";
            }
        }
        
    } else {
        echo "Please submit a number from the form first.";
    }
    ?>
</body>
</html>
