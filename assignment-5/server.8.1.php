<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 8 - Column Header Sorting</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #e2e8f0; cursor: pointer; user-select: none; }
        th:hover { background-color: #cbd5e1; }
        .sort-icon { font-size: 12px; margin-left: 5px; color: #666; }
    </style>
</head>
<body onload="sortTable('id')">

    <h2>CSB090 - Interactive Column Sorting (Q8)</h2>
    <p><em>Click on any column header below to sort ASC / DESC dynamically without page reload.</em></p>

    <table>
        <thead>
            <tr>
                <th onclick="sortTable('id')">ID <span id="icon-id" class="sort-icon"></span></th>
                <th onclick="sortTable('course_code')">Course Code <span id="icon-course_code" class="sort-icon"></span></th>
                <th onclick="sortTable('coursename')">Course Name <span id="icon-coursename" class="sort-icon"></span></th>
                <th onclick="sortTable('books')">Books <span id="icon-books" class="sort-icon"></span></th>
                <th onclick="sortTable('expenses')">Expense Type <span id="icon-expenses" class="sort-icon"></span></th>
                <th onclick="sortTable('amount')">Amount ($) <span id="icon-amount" class="sort-icon"></span></th>
            </tr>
        </thead>
        <tbody id="table-data">
            <!-- AJAX sorted records load here -->
        </tbody>
    </table>

    <script>
        let currentColumn = '';
        let currentOrder = 'ASC';

        function sortTable(column) {
            // Toggle direction if clicking the same column
            if (currentColumn === column) {
                currentOrder = (currentOrder === 'ASC') ? 'DESC' : 'ASC';
            } else {
                currentColumn = column;
                currentOrder = 'ASC';
            }

            // Update header icons
            document.querySelectorAll('.sort-icon').forEach(span => span.innerHTML = '');
            document.getElementById('icon-' + column).innerHTML = (currentOrder === 'ASC') ? '▲' : '▼';

            // Fetch sorted data via AJAX
            fetch(`sort_data.php?column=${column}&order=${currentOrder}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('table-data').innerHTML = data;
                })
                .catch(error => console.error('Error sorting table:', error));
        }
    </script>

</body>
</html>