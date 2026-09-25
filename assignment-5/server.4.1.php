<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Expenses Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 130px; font-weight: bold; }
        input[type="text"], input[type="number"], select { padding: 6px; width: 250px; }
        button { padding: 10px 15px; font-size: 15px; cursor: pointer; margin-top: 10px; }
        #message { margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Add New Course Record</h2>

    <form id="recordForm" onsubmit="submitForm(event)">
        <!-- Textbox: Course Code -->
        <div class="form-group">
            <label for="course_code">Course Code:</label>
            <input type="text" id="course_code" name="course_code" placeholder="e.g., CS3201" required>
        </div>

        <!-- Textbox: Course Name -->
        <div class="form-group">
            <label for="coursename">Course Name:</label>
            <input type="text" id="coursename" name="coursename" placeholder="e.g., Database Systems" required>
        </div>

        <!-- Radio Buttons (Option Button): Books Count -->
        <div class="form-group">
            <label>Books Count:</label>
            <input type="radio" name="books" value="1" required> 1
            <input type="radio" name="books" value="3"> 3
            <input type="radio" name="books" value="5"> 5
        </div>

        <!-- List Box (Dropdown): Expense Category -->
        <div class="form-group">
            <label for="expenses">Expense Type:</label>
            <select id="expenses" name="expenses" required>
                <option value="">Select Expense Type</option>
                <option value="Textbooks and notes">Textbooks and notes</option>
                <option value="Lab manual">Lab manual</option>
                <option value="Reference guides">Reference guides</option>
                <option value="Online subscription">Online subscription</option>
            </select>
        </div>

        <!-- Textbox: Expense Amount -->
        <div class="form-group">
            <label for="amount">Amount ($):</label>
            <input type="number" id="amount" name="amount" step="0.01" placeholder="e.g., 49.99" required>
        </div>

        <!-- Hidden Element -->
        <input type="hidden" name="hidden_token" value="SECURE_TOKEN_123">

        <button type="submit">Insert Record</button>
    </form>

    <div id="message"></div>

    <h2>Course Expenses Records</h2>
    <button onclick="loadRecords()">Load Records</button>

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
            <!-- AJAX rows load here -->
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

        function submitForm(event) {
            event.preventDefault();

            const form = document.getElementById('recordForm');
            const formData = new FormData(form);

            fetch('server.4.2.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                document.getElementById('message').innerHTML = result;
                if (result.includes("Success")) {
                    loadRecords();
                    form.reset();
                }
            })
            .catch(error => {
                document.getElementById('message').innerHTML = "<span style='color:red;'>AJAX Error occurred.</span>";
            });
        }
    </script>

</body>
</html>