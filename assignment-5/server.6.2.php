<?php
function processCourseStats() {
    $host     = 'localhost';
    $dbname   = 'school_db';
    $username = 'postgres';
    $password = 'Gaurang';

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT id, course_code, coursename, amount FROM csb090 ORDER BY id DESC");
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($records) === 0) {
            echo "<tr><td colspan='5'>No records found to calculate statistics.</td></tr>";
            return;
        }

        // Extract numeric column into a PHP array
        $amountsArray = array_column($records, 'amount');

        // Array calculations: Total and Average
        $totalAmount = array_sum($amountsArray);
        $averageAmount = $totalAmount / count($records);

        // Display rows with calculated category/grade based on condition (>80 = Grade A, >50 = Grade B, else Grade C)
        foreach ($records as $row) {
            $amt = (float)$row['amount'];
            
            if ($amt > 80) {
                $category = "<span style='color: green; font-weight: bold;'>Grade A (High)</span>";
            } else if ($amt > 50) {
                $category = "<span style='color: orange; font-weight: bold;'>Grade B (Medium)</span>";
            } else {
                $category = "<span style='color: red; font-weight: bold;'>Grade C (Low)</span>";
            }

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['course_code']) . "</td>";
            echo "<td>" . htmlspecialchars($row['coursename']) . "</td>";
            echo "<td>$" . number_format($amt, 2) . "</td>";
            echo "<td>" . $category . "</td>";
            echo "</tr>";
        }

        // Summary row displaying Total and Average calculated using PHP array methods
        echo "<tr style='background-color: #f9f9f9; font-weight: bold;'>";
        echo "<td colspan='3' style='text-align: right;'>TOTAL:</td>";
        echo "<td>$" . number_format($totalAmount, 2) . "</td>";
        echo "<td>Average Amount: $" . number_format($averageAmount, 2) . "</td>";
        echo "</tr>";

    } catch (PDOException $e) {
        echo "<tr><td colspan='5'>Database Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    }
}

// Call function
processCourseStats();
?>