<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment System - Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Panel</h2>
        <h3>Appointments List</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Car License</th>
                    <th>Appointment Date</th>
                    <th>Mechanic</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "appointment_system";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch appointments from database
                    $sql = "SELECT * FROM appointments";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['car_license'] . "</td>";
                            echo "<td>" . $row['appointment_date'] . "</td>";
                            echo "<td>" . $row['mechanic'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No appointments found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
        <h3>Process List</h3>
        <form action="process_appointment.php" method="POST">
            <label for="appointment_id">Appointment ID:</label>
            <input type="text" id="appointment_id" name="appointment_id" required><br><br>
            <label for="new_date">New Date:</label>
            <input type="date" id="new_date" name="new_date" required><br><br>
            <label for="new_mechanic">New Mechanic:</label>
            <select id="new_mechanic" name="new_mechanic" required>
                <option value="">Select Mechanic</option>
                <?php
                    // Fetch mechanics from database
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id, name FROM mechanics";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No mechanics available</option>";
                    }
                    $conn->close();
                ?>
            </select><br><br>
            <input type="submit" value="Process Appointment">
        </form>
    </div>
</body>
</html>
