<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 7 - Edit & Delete</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        button { padding: 6px 12px; cursor: pointer; }
        .btn-edit { background-color: #ffc107; border: none; border-radius: 3px; }
        .btn-delete { background-color: #dc3545; color: white; border: none; border-radius: 3px; }
        
        /* Modal Styling */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: #fff; margin: 10% auto; padding: 20px; width: 350px; border-radius: 5px; }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: block; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 6px; box-sizing: border-box; }
    </style>
</head>
<body onload="loadRecords()">

    <h2>CSB090 - Manage Records (Q7)</h2>
    <div id="status-message"></div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Books</th>
                <th>Expense Type</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-data">
            <!-- AJAX loaded records -->
        </tbody>
    </table>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit Record</h3>
            <input type="hidden" id="edit-id">
            <div class="form-group">
                <label>Course Code:</label>
                <input type="text" id="edit-cc">
            </div>
            <div class="form-group">
                <label>Course Name:</label>
                <input type="text" id="edit-cn">
            </div>
            <div class="form-group">
                <label>Books:</label>
                <input type="number" id="edit-bk">
            </div>
            <div class="form-group">
                <label>Expenses:</label>
                <input type="text" id="edit-ex">
            </div>
            <div class="form-group">
                <label>Amount ($):</label>
                <input type="number" step="0.01" id="edit-am">
            </div>
            <button onclick="saveEdit()">Save Changes</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
        function loadRecords() {
            fetch('fetch_actions.php')
                .then(r => r.text())
                .then(d => document.getElementById('table-data').innerHTML = d);
        }

        function deleteRecord(id) {
            if (!confirm('Are you sure you want to delete record #' + id + '?')) return;

            const formData = new FormData();
            formData.append('id', id);

            fetch('delete_data.php', { method: 'POST', body: formData })
                .then(r => r.text())
                .then(res => {
                    alert(res);
                    if (res.includes("Success")) loadRecords();
                });
        }

        function openEditModal(id, cc, cn, bk, ex, am) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-cc').value = cc;
            document.getElementById('edit-cn').value = cn;
            document.getElementById('edit-bk').value = bk;
            document.getElementById('edit-ex').value = ex;
            document.getElementById('edit-am').value = am;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function saveEdit() {
            const formData = new FormData();
            formData.append('id', document.getElementById('edit-id').value);
            formData.append('course_code', document.getElementById('edit-cc').value);
            formData.append('coursename', document.getElementById('edit-cn').value);
            formData.append('books', document.getElementById('edit-bk').value);
            formData.append('expenses', document.getElementById('edit-ex').value);
            formData.append('amount', document.getElementById('edit-am').value);

            fetch('update_data.php', { method: 'POST', body: formData })
                .then(r => r.text())
                .then(res => {
                    alert(res);
                    if (res.includes("Success")) {
                        closeModal();
                        loadRecords();
                    }
                });
        }
    </script>

</body>
</html>