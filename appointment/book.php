<?php
include('../config/db.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: ../index.php");
    exit;
}
$patient_id = $_SESSION['user_id'];
$doctor_id = $_GET['doctor_id'] ?? null;

// Handle booking request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $link = $_POST['teleconsultation_link'];

    // Check doctor availability
    $check = $conn->prepare("SELECT * FROM appointments WHERE doctor_id = ? AND appointment_date = ? AND appointment_time = ?");
    $check->bind_param("iss", $doctor_id, $date, $time);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>Doctor is not available at that time. Please choose another slot.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, teleconsultation_link, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("iisss", $patient_id, $doctor_id, $date, $time, $link);
        $stmt->execute();
        echo "<p style='color:green;'>Appointment booked successfully!</p>";
    }
}
?>

<h2>Book Appointment</h2>
<form method="POST">
    <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
    Date: <input type="date" name="date" required><br>
    Time: <input type="time" name="time" required><br>
    Teleconsultation Link: <input type="url" name="teleconsultation_link" placeholder="https://meet.google.com/xyz-1234-abc" required><br>
    <button type="submit">Book Appointment</button>
</form>