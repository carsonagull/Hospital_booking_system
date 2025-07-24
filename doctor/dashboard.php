<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
    header("Location: ../index.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT name, specialization FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();

echo "<h1>Welcome Dr. {$user['name']}</h1>";
echo "<h3>Specialization: {$user['specialization']}</h3>";
echo "<a href='../logout.php'>Logout</a> | <a href='../index.php'>Home</a><br><br>";

// Show appointments for this doctor
echo "<h2>Your Booked Appointments</h2>";
$appointments = $conn->query("
    SELECT a.*, p.name AS patient_name FROM appointments a
    JOIN users p ON a.patient_id = p.id
    WHERE a.doctor_id = $user_id
    ORDER BY a.appointment_date, a.appointment_time
");
if ($appointments->num_rows == 0) {
    echo "<p>No appointments booked yet.</p>";
} else {
    while ($row = $appointments->fetch_assoc()) {
        echo "<div>Patient: {$row['patient_name']}<br>
              Date: {$row['appointment_date']} | Time: {$row['appointment_time']}<br>
              Link: <a href='{$row['teleconsultation_link']}' target='_blank'>Join</a><br>
              Status: {$row['status']}</div><hr>";
    }
}
?>