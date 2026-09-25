<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 3 - CSB090 Table Loader</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        button { padding: 10px 15px; font-size: 16px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>CSB090 Purchase Records (Q3)</h2>
    <button onclick="loadRecords()">Load Records</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>No. of Books</th>
                <th>Expenses</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody id="table-data">
            <!-- AJAX injects fetched rows here -->
        </tbody>
    </table>

    <script>
        function loadRecords() {
            fetch('server.3.1.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('table-data').innerHTML = data;
                })
                .catch(error => console.error('Error loading data:', error));
        }
    </script>

</body>
</html>