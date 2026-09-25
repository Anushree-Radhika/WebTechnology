<?php
$host     = 'localhost';
$dbname   = 'school_db';
$username = 'postgres';
$password = 'Gaurang';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = (int)($_POST['id'] ?? 0);
    $course_code = trim($_POST['course_code'] ?? '');
    $coursename  = trim($_POST['coursename'] ?? '');
    $books       = (int)($_POST['books'] ?? 0);
    $expenses    = trim($_POST['expenses'] ?? '');
    $amount      = (float)($_POST['amount'] ?? 0);

    if ($id <= 0 || empty($course_code) || empty($coursename) || empty($expenses) || $amount <= 0) {
        echo "Failure: Invalid inputs";
        exit;
    }

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE csb090 
                SET course_code = :cc, coursename = :cn, books = :b, expenses = :e, amount = :a 
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':cc'   => $course_code,
            ':cn'   => $coursename,
            ':b'    => $books,
            ':e'    => $expenses,
            ':a'    => $amount,
            ':id'   => $id
        ]);

        echo "Success: Record updated";
    } catch (PDOException $e) {
        echo "Failure: " . htmlspecialchars($e->getMessage());
    }
}
?>