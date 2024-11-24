<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            padding: 5px;
            width: 100%;
            max-width: 400px;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        button.delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>CRUD Management</h1>
    <nav>
        <button onclick="loadData('students')">Students</button>
        <button onclick="loadData('registrations')">Registrations</button>
        <button onclick="loadData('Activities')">Activities</button>
        <button onclick="loadData('attendance')">Attendance</button>
    </nav>

    <h2 id="section-title">Manage Data</h2>
    <div id="form-container"></div>
    <table id="data-table"></table>

    <script>
        let currentTable = '';

        // Load data from the server
        function loadData(table) {
            currentTable = table;
            document.getElementById('section-title').innerText = `Manage ${capitalize(table)}`;
            fetch(`server.php?type=${table}`, { method: 'GET' })
                .then(response => response.json())
                .then(data => renderTable(data))
                .catch(error => console.error('Error loading data:', error));
        }

        // Render table dynamically
        function renderTable(data) {
            const table = document.getElementById('data-table');
            table.innerHTML = '';

            if (data.length > 0) {
                const headers = Object.keys(data[0]);
                const headerRow = document.createElement('tr');
                headers.forEach(header => {
                    const th = document.createElement('th');
                    th.innerText = header;
                    headerRow.appendChild(th);
                });
                headerRow.innerHTML += '<th>Actions</th>';
                table.appendChild(headerRow);

                data.forEach(row => {
                    const tr = document.createElement('tr');
                    headers.forEach(key => {
                        const td = document.createElement('td');
                        td.innerText = row[key];
                        tr.appendChild(td);
                    });
                    const actionsTd = document.createElement('td');
                    actionsTd.innerHTML = `
                        <button onclick="editData(${row[headers[0]]})">Edit</button>
                        <button class="delete" onclick="deleteData(${row[headers[0]]})">Delete</button>
                    `;
                    tr.appendChild(actionsTd);
                    table.appendChild(tr);
                });
            } else {
                table.innerHTML = '<tr><td colspan="100%">No data available</td></tr>';
            }

            renderForm();
        }

        // Render form dynamically based on the table
        async function renderForm() {
    const formContainer = document.getElementById('form-container');
    console.log('Rendering form for current table:', currentTable);
    formContainer.innerHTML = `
        <h3>Add or Update ${capitalize(currentTable)}</h3>
        <form onsubmit="submitData(event)">
            <input type="hidden" id="id">
            ${await getFormFields()}
            <button type="submit">Save</button>
        </form>
    `;

    const studentDropdown = document.getElementById('student_id');
    console.log('Student dropdown:', studentDropdown);

    if (studentDropdown) {
        console.log('Populating student dropdown...');
        await populateDropdown('students', 'student_id');
    }
}


        // Generate form fields dynamically
        function getFormFields() {
            switch (currentTable) {
                case 'students':
                    return `
                        <label for="students_id">Student ID</label>
                        <input type="text" id="students_id" required>
                        <label for="name">Name</label>
                        <input type="text" id="name" required>
                        <label for="class">Class</label>
                        <input type="text" id="class" required>
                        <label for="contact">Contact</label>
                        <input type="text" id="contact" required>
                        <label for="birth_date">Birth Date</label>
                        <input type="date" id="birth_date" required>
                    `;
                case 'registrations':
                    return `
                        <label for="students_id">Student</label>
                        <select id="students_id">${getOptions('students')}</select>
                        <label for="Activities_id">Activity</label>
                        <select id="Activities_id">${getOptions('Activities')}</select>
                        <label for="registration_date">Registration Date</label>
                        <input type="date" id="registration_date" required>
                        <label for="position">Position</label>
                        <input type="text" id="position" required>
                    `;
                case 'Activities':
                    return `
                        <label for="Activities_id">Activity ID</label>
                        <input type="text" id="activity_id" required>
                        <label for="name">Name</label>
                        <input type="text" id="name" required>
                        <label for="description">Description</label>
                        <input type="text" id="description" required>
                        <label for="schedule">Schedule</label>
                        <input type="text" id="schedule" required>
                        <label for="instructor">Instructor</label>
                        <input type="text" id="instructor" required>
                    `;
                case 'attendance':
                    return `
                        <label for="students_id">Student</label>
                        <select id="students_id">${getOptions('students')}</select>
                        <label for="Activities_id">Activity</label>
                        <select id="Activities_id">${getOptions('Activities')}</select>
                        <label for="attendance_date">Attendance Date</label>
                        <input type="date" id="attendance_date" required>
                        <label for="status">Status</label>
                        <select id="status">
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="bolos">Bolos</option>
                        </select>
                    `;
                default:
                    return '';
            }
        }
      
        async function getOptions(table) {
  try {
    console.log(`Fetching options for table: ${table}`);
    
    const response = await fetch(`server.php?type=${table}`);
    if (!response.ok) {
      throw new Error(`Failed to fetch data for ${table}`);
    }

    const data = await response.json();
    console.log(`Data fetched for ${table}:`, data);

    let options = `<option value="">-- Select --</option>`;
    data.forEach((row) => {
      console.log(`Processing row:`, row);
      options += `<option value="${row.student_id}">${row.name}</option>`;
    });

    console.log(`Generated options for ${table}:`, options);

    const dropdown = document.getElementById(`${table}_id`);
    if (!dropdown) {
      console.error(`Dropdown with ID ${table}_id not found!`);
      return;
    }

    console.log(`Populating dropdown ${table}_id with data from ${table}`);
    dropdown.innerHTML = options;
    console.log(`Dropdown ${table}_id populated with options:`, dropdown.innerHTML);
  } catch (error) {
    console.error(`Error fetching options for ${table}:`, error.message);
  }
}



        // Handle form submission
        function submitData(event) {
            event.preventDefault();
            const id = document.getElementById('id').value;
            const method = id ? 'PUT' : 'POST';
            const endpoint = `server.php?type=${currentTable}${id ? `&id=${id}` : ''}`;
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());

            fetch(endpoint, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(() => loadData(currentTable))
                .catch(error => console.error('Error saving data:', error));
        }

        // Edit data
        function editData(id) {
            fetch(`server.php?type=${currentTable}&id=${id}`, { method: 'GET' })
                .then(response => response.json())
                .then(data => {
                    Object.keys(data).forEach(key => {
                        const input = document.getElementById(key);
                        if (input) input.value = data[key];
                    });
                    document.getElementById('id').value = id;
                })
                .catch(error => console.error('Error loading data for edit:', error));
        }

        // Delete data
        function deleteData(id) {
            if (!confirm('Are you sure you want to delete this record?')) return;
            fetch(`server.php?type=${currentTable}&id=${id}`, { method: 'DELETE' })
                .then(() => loadData(currentTable))
                .catch(error => console.error('Error deleting data:', error));
        }

        // Capitalize table names
        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    </script>
</body>
</html>
