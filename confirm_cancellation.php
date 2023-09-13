<!DOCTYPE html>
<html>
<head>
    <title>Confirmation</title>
</head>
<body>
    <h2>Cancel Appointment Confirmation</h2>
    <p>Are you sure you want to cancel this appointment?</p>
    <a href="cancel_appointment.php?id=<?php echo $_GET['id']; ?>">Yes, Cancel</a> |
    <a href="list_appointments.php">No, Go Back</a>
</body>
</html>
