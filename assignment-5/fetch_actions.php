<?php
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
            $id = $row['id'];
            echo "<tr id='row-$id'>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td class='cc'>" . htmlspecialchars($row['course_code']) . "</td>";
            echo "<td class='cn'>" . htmlspecialchars($row['coursename']) . "</td>";
            echo "<td class='bk'>" . htmlspecialchars($row['books']) . "</td>";
            echo "<td class='ex'>" . htmlspecialchars($row['expenses']) . "</td>";
            echo "<td class='am'>$" . number_format($row['amount'], 2) . "</td>";
            echo "<td>
                    <button class='btn-edit' onclick='openEditModal($id, \"".addslashes($row['course_code'])."\", \"".addslashes($row['coursename'])."\", {$row['books']}, \"".addslashes($row['expenses'])."\", {$row['amount']})'>Edit</button>
                    <button class='btn-delete' onclick='deleteRecord($id)'>Delete</button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found.</td></tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='7'>Database Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>