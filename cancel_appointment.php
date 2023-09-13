
<?php
$mysqli = new mysqli("localhost", "user", "password", "doctors_appointment");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    $cancelQuery = "UPDATE Appointments SET Status = 'Cancelled' WHERE ID = ?";
    
    $stmt = $mysqli->prepare($cancelQuery);
    
    if ($stmt === false) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("i", $appointmentId);
    
    if ($stmt->execute()) {
        echo "Appointment cancelled successfully";
        echo" <a href='list_appointments.php'>Go back to All Appointments</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$mysqli->close();
?>
