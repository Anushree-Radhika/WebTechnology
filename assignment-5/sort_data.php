<?php
$host     = 'localhost';
$dbname   = 'school_db';
$username = 'postgres';
$password = 'Gaurang';

// Whitelist allowed columns for security
$allowed_cols = ['id', 'course_code', 'coursename', 'books', 'expenses', 'amount'];
$column = $_GET['column'] ?? 'id';
$order  = strtoupper($_GET['order'] ?? 'ASC');

if (!in_array($column, $allowed_cols)) {
    $column = 'id';
}
if ($order !== 'ASC' && $order !== 'DESC') {
    $order = 'ASC';
}

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, course_code, coursename, books, expenses, amount FROM csb090 ORDER BY $column $order";
    $stmt = $pdo->query($sql);
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
?>