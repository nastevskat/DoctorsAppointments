<!DOCTYPE html>
<html>
<head>
    <title>Reschedule Appointment</title>
        <script>
    function validateTime() {
        const selectedDate1 = new Date(document.getElementById("new_start_time").value);
        const selectedDate2 = new Date(document.getElementById("new_end_time").value);
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
    <h2>Reschedule Appointment</h2>
    <form action="reschedule.php" method="POST" onsubmit="return validateTime();">
        <input type="hidden" name="appointmentId" value="<?php echo $_GET['id']; ?>">
        <label for="new_start_time">New Start Time:</label>
        <input type="datetime-local" name="new_start_time" required><br>
        
        <label for="new_end_time">New End Time:</label>
        <input type="datetime-local" name="new_end_time" required><br>
        
        <input type="submit" value="Reschedule Appointment">
    </form>
</body>
</html>
