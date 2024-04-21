<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment System - User Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Make an Appointment</h2>
        <form action="submit_appointment.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br><br>
            <label for="car_color">Car Color:</label>
            <input type="text" id="car_color" name="car_color" required><br><br>
            <label for="car_license">Car License Number:</label>
            <input type="text" id="car_license" name="car_license" required><br><br>
            <label for="car_engine">Car Engine Number:</label>
            <input type="text" id="car_engine" name="car_engine" required><br><br>
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required><br><br>
            <label for="mechanic">Desired Mechanic:</label>
            <select id="mechanic" name="mechanic" required>
                <option value="">Select Mechanic</option>
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

                    // Fetch mechanics from database
                    $sql = "SELECT id, name FROM mechanics";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </select><br><br>
            <input type="submit" value="Submit Appointment">
        </form>
    </div>
</body>
</html>
