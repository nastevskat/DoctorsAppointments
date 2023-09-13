<?php

$mysqli = new mysqli("localhost", "user", "password", "doctors_appointment");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointmentId = $_POST['appointmentId'];
    $newStartTime = $_POST['new_start_time'];
    $newEndTime = $_POST['new_end_time'];

    $query = "UPDATE Appointments SET StartTime = ?, EndTime = ?, Status = 'Rescheduled' WHERE ID = ?";
    
    $stmt = $mysqli->prepare($query);
    
    if ($stmt === false) {
        die("Error: " . $mysqli->error);
    }
    
    $stmt->bind_param("ssi", $newStartTime, $newEndTime, $appointmentId);
    
    if ($stmt->execute()) {
        echo "Appointment rescheduled successfully";
         echo" <a href='list_appointments.php'>Go back to All Appointments</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$mysqli->close();
?>
