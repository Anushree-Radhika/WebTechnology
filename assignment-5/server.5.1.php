<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 5 - Live Search Table</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .search-box { margin-bottom: 20px; }
        .search-box input { padding: 10px; width: 300px; font-size: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body onload="liveSearch('')">

    <h2>CSB090 - Live Record Search (Q5)</h2>

    <!-- Live Search Input -->
    <div class="search-box">
        <label for="search"><strong>Search Records:</strong> </label>
        <input type="text" id="search" placeholder="Type course code, name, or expense..." oninput="liveSearch(this.value)">
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Books</th>
                <th>Expense Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody id="table-data">
            <!-- Dynamic search results loaded here via AJAX -->
        </tbody>
    </table>

    <script>
        function liveSearch(query) {
            fetch('server.5.2.php?query=' + encodeURIComponent(query))
                .then(response => response.text())
                .then(data => {
                    document.getElementById('table-data').innerHTML = data;
                })
                .catch(error => console.error('Error searching records:', error));
        }
    </script>

</body>
</html>