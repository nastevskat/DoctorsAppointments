<?php
$mysqli = new mysqli("localhost", "user", "password", "doctors_appointment");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$service = $_POST['service'];
$status = $_POST['status'];
$special_requirements = $_POST['special_requirements'];
$medical_condition = $_POST['medical_condition'];
$patient_contact_info = $_POST['patient_contact_info'];

$query = "INSERT INTO Appointments (StartTime, EndTime, Service, Status, SpecialRequirements, MedicalCondition, PatientContactInfo)
          VALUES ('$start_time', '$end_time', '$service', '$status', '$special_requirements', '$medical_condition', '$patient_contact_info')";

if ($mysqli->query($query) === TRUE) {
    echo "Appointment created successfully";
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book an Appointment</title>
    <script>
    function validateTime() {
        const selectedDate1 = new Date(document.getElementById("start_time").value);
        const selectedDate2 = new Date(document.getElementById("end_time").value);
        if (selectedDate1.getDay() === 0 || selectedDate1.getDay() === 6 || selectedDate2.getDay() === 0 || selectedDate2.getDay() === 6) {
            alert("Appointments are only available on weekdays (Monday to Friday).");
            return false;
        }
        
        const selectedTime1 = selectedDate1.getHours() * 60 + selectedDate1.getMinutes();
        const selectedTime2 = selectedDate2.getHours() * 60 + selectedDate2.getMinutes();
        if (selectedTime1 < 9 * 60 || selectedTime1 > 17 * 60 || selectedTime2 < 9 * 60 || selectedTime2 > 17 * 60) {
            alert("Appointments are only available from 9:00 AM to 5:00 PM.");
            return false;
        }
        
        return true;
    }
</script>

</head>
<body>
    <h2>Book an Appointment</h2>
    <form action="create_appointment.php" method="POST" onsubmit="return validateTime();">
        <label for="start_time">Start Time:</label>
        <input type="datetime-local" name="start_time" required><br>
        
        <label for="end_time">End Time:</label>
        <input type="datetime-local" name="end_time" required><br>
        
        <label for="service">Service:</label>
        <select name="service" required>
            <option value="Service 1">Service 1</option>
            <option value="Service 2">Service 2</option>
            <option value="Service 3">Service 3</option>
        </select><br>
        
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Scheduled" selected>Scheduled</option>
        </select><br>
        
        <label for="special_requirements">Special Requirements:</label>
        <textarea name="special_requirements"></textarea><br>
        
        <label for="medical_condition">Medical Condition:</label>
        <textarea name="medical_condition"></textarea><br>
        
        <label for="patient_contact_info">Patient's Contact Information:</label>
        <textarea name="patient_contact_info" required></textarea><br>
        
        <input type="submit" value="Book Appointment">
    </form>
    <a href="list_appointments.php">Go to All Appointments</a>
</body>
</html>
