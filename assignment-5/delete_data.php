<?php
$host     = 'localhost';
$dbname   = 'school_db';
$username = 'postgres';
$password = 'Gaurang';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0) {
        echo "Failure: Invalid ID";
        exit;
    }

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM csb090 WHERE id = :id");
        $stmt->execute([':id' => $id]);

        echo "Success: Record deleted";
    } catch (PDOException $e) {
        echo "Failure: " . htmlspecialchars($e->getMessage());
    }
}
?>