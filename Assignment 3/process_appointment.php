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

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $appointment_id = $_POST['appointment_id'];
    $new_date = $_POST['new_date'];
    $new_mechanic = $_POST['new_mechanic'];

    // Update appointment with new date and mechanic
    $sql = "UPDATE appointments SET appointment_date = '$new_date', mechanic = '$new_mechanic' WHERE id = '$appointment_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment updated successfully!";
        echo"<script>
        setTimeout(function() {
            window.history.go(-1);
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>";
        
        // Remove processed appointment from the database
        $sql_delete = "DELETE FROM appointments WHERE id = '$appointment_id'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<br>Appointment removed from the list.";
            echo"<script>
            setTimeout(function() {
                window.history.go(-1);
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>";
        } else {
            echo "<br>Error removing appointment: " . $conn->error;
        }
    } else {
        echo "Error updating appointment: " . $conn->error;
    }
}

$conn->close();
?>
