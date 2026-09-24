<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Form Result</title>
</head>
<body>
    <?php
    // Check if the form was actually submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h3>Server Feedback Received:</h3>";
        
        // Retrieve and sanitize text inputs. ?? '' prevents errors if a field is empty.
        echo "<strong>Username (Textbox):</strong> " . htmlspecialchars($_POST['username'] ?? '') . "<br>";
        
        echo "<strong>Password (Password field):</strong> " . htmlspecialchars($_POST['password'] ?? '') . "<br>";
        
        // If the user submits without clicking a radio button, default to 'Not selected'
        echo "<strong>Gender (Option button):</strong> " . htmlspecialchars($_POST['gender'] ?? 'Not selected') . "<br>";
        
        echo "<strong>Course (List box):</strong> " . htmlspecialchars($_POST['course'] ?? '') . "<br>";
        
        echo "<strong>Session Token (Hidden element):</strong> " . htmlspecialchars($_POST['session_token'] ?? '') . "<br>";
        
        // Safely check if a file was uploaded without errors
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
            $fileName = $_FILES['resume']['name'];
            $fileSize = $_FILES['resume']['size']; // Size in bytes
            echo "<strong>Uploaded File (File upload):</strong> " . htmlspecialchars($fileName) . " (" . $fileSize . " bytes)<br>";
        } else {
            echo "<strong>Uploaded File:</strong> No file uploaded or an error occurred.<br>";
        }
    } else {
        echo "<p>Please submit the form first.</p>";
    }
    ?>
</body>
</html>
