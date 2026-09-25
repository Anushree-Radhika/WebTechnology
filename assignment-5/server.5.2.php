<?php
function searchRecords() {
    $host     = 'localhost';
    $dbname   = 'school_db';
    $username = 'postgres';
    $password = 'Gaurang';

    $query = trim($_GET['query'] ?? '');

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL search across course_code, coursename, and expenses
        $sql = "SELECT id, course_code, coursename, books, expenses, amount 
                FROM csb090 
                WHERE course_code ILIKE :q 
                   OR coursename ILIKE :q 
                   OR expenses ILIKE :q 
                ORDER BY id DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':q' => "%$query%"]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($records) > 0) {
            foreach ($records as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['course_code']) . "</td>";
                echo "<td>" . htmlspecialchars($row['coursename']) . "</td>";
                echo "<td>" . htmlspecialchars($row['books']) . "</td>";
                echo "<td>" . htmlspecialchars($row['expenses']) . "</td>";
                echo "<td>$" . number_format($row['amount'], 2) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>No matching records found.</td></tr>";
        }

    } catch (PDOException $e) {
        echo "<tr><td colspan='6'>Database Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    }
}

// Call function
searchRecords();
?>