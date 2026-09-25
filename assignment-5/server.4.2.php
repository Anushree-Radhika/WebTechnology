<?php
function insertRecord() {
    $host     = 'localhost';
    $dbname   = 'school_db';
    $username = 'postgres';
    $password = 'Gaurang';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $course_code = trim($_POST['course_code'] ?? '');
        $coursename  = trim($_POST['coursename'] ?? '');
        $books       = (int)($_POST['books'] ?? 0);
        $expenses    = trim($_POST['expenses'] ?? '');
        $amount      = (float)($_POST['amount'] ?? 0);

        if (empty($course_code) || empty($coursename) || empty($expenses) || $amount <= 0) {
            echo "<span style='color: red;'>Failure: All fields are required.</span>";
            return;
        }

        try {
            $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO csb090 (course_code, coursename, books, expenses, amount) 
                    VALUES (:course_code, :coursename, :books, :expenses, :amount)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':course_code' => $course_code,
                ':coursename'  => $coursename,
                ':books'        => $books,
                ':expenses'     => $expenses,
                ':amount'       => $amount
            ]);

            echo "<span style='color: green;'>Success: Record inserted successfully!</span>";

        } catch (PDOException $e) {
            echo "<span style='color: red;'>Failure: " . htmlspecialchars($e->getMessage()) . "</span>";
        }
    }
}

insertRecord();
?>