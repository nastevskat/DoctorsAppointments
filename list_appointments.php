<!DOCTYPE html>
<html>
<head>
    <title>List Appointments</title>
</head>
<body>
    <h2>List Appointments</h2>
    <table>
        <thead>
            <tr>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Service</th>
                <th>Status</th>
                <th>Special Requirements</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

<?php
$mysqli = new mysqli("localhost", "user", "password", "doctors_appointment");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM Appointments";

$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['StartTime'] . "</td>";
        echo "<td>" . $row['EndTime'] . "</td>";
        echo "<td>" . $row['Service'] . "</td>";
        echo "<td>" . $row['Status'] . "</td>";
        echo "<td>" . $row['SpecialRequirements'] . "</td>";
        echo "<td>";
        
        if ($row['Status'] == "Scheduled") {
            echo "<a href='confirm_cancellation.php?id=" . $row['ID'] . "'>Cancel</a> | ";
             echo "<a href='reschedule_appointment.php?id=" . $row['ID'] . "'>Reschedule</a>";
        } 
        else if ($row['Status'] == "Rescheduled") {
            echo "<a href='confirm_cancellation.php?id=" . $row['ID'] . "'>Cancel</a> | ";
             echo "<a href='reschedule_appointment.php?id=" . $row['ID'] . "'>Reschedule</a>";
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "No appointments found";
}

?>

        </tbody>
    </table>
</body>
</html>
