<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 6 - Array Stats & Grading</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        button { padding: 10px 15px; font-size: 15px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>CSB090 - Array Analytics & Grading (Q6)</h2>
    <button onclick="loadStats()">Calculate & Display Stats</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Amount ($)</th>
                <th>Expense Category / Grade</th>
            </tr>
        </thead>
        <tbody id="stats-data">
            <!-- AJAX populates calculation results & grades here -->
        </tbody>
    </table>

    <script>
        function loadStats() {
            fetch('server.6.2.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('stats-data').innerHTML = data;
                })
                .catch(error => console.error('Error fetching analytics:', error));
        }
    </script>

</body>
</html>