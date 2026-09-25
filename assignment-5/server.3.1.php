<?php
// Function to connect to PostgreSQL and fetch records
function fetchRecords() {
    $host     = 'localhost';
    $dbname   = 'school_db';
    $username = 'postgres';
    $password = 'Gaurang';

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT id, course_code, coursename, books, expenses, amount FROM csb090 ORDER BY id DESC");
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
            echo "<tr><td colspan='6'>No records found.</td></tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='6'>Database Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    }
}

// Call function
fetchRecords();
?>