<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Result</title>
</head>
<body>
    <?php 
    if (isset($_POST["name"]) && isset($_POST["marks"])) {
        
        echo "Welcome " . htmlspecialchars($_POST["name"]) . "<br>";
        
        $marks = $_POST["marks"]; 
        
        if($marks >= 90){
            echo "Grade is :- A+";
        }
        else if($marks >= 80){
            echo "Grade is :- A";
        }
        else if($marks >= 70){
            echo "Grade is :- B+";
        }
        else if($marks >= 60){
            echo "Grade is :- C";
        }
        else if($marks >= 50){
            echo "Grade is :- D";
        }
        else {
            echo "Grade is :- F";
        }
        
    } else {
        // What to show if the page is opened directly
        echo "Please submit the form first.";
    }
    ?>
</body>
</html>
