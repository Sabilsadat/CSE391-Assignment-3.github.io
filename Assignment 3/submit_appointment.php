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

// Form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$car_color = $_POST['car_color'];
$car_license = $_POST['car_license'];
$car_engine = $_POST['car_engine'];
$appointment_date = $_POST['appointment_date'];
$mechanic = $_POST['mechanic'];

// Check if appointment already exists for the given date and mechanic
$sql = "SELECT * FROM appointments WHERE appointment_date = '$appointment_date' AND mechanic = '$mechanic'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "You already have an appointment with this mechanic on this date.";
    echo "<script>
    setTimeout(function() {
        window.history.go(-1);
    }, 5000); // 5000 milliseconds = 5 seconds
</script>"; // JavaScript to go back to the previous page
} else {
    // Insert new appointment into database
    $sql = "INSERT INTO appointments (name, phone, car_color, car_license, car_engine, appointment_date, mechanic) 
            VALUES ('$name', '$phone', '$car_color', '$car_license', '$car_engine', '$appointment_date', '$mechanic')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Appointment made successfully!";
        echo "<script>
        setTimeout(function() {
            window.history.go(-1);
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>"; // JavaScript to go back to the previous page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
