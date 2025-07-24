<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: ../index.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT name FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();

echo "<h1>Welcome, {$user['name']}</h1>";
echo "<a href='../logout.php'>Logout</a> | <a href='../index.php'>Home</a><br><br>";

// Show available doctors
echo "<h2>Available Doctors</h2>";
$doctors = $conn->query("SELECT id, name, specialization FROM users WHERE role='doctor'");
if ($doctors->num_rows == 0) {
    echo "<p>No doctors are currently available.</p>";
} else {
    while ($doc = $doctors->fetch_assoc()) {
        echo "<p><a href='../appointment/book.php?doctor_id={$doc['id']}'>{$doc['name']} ({$doc['specialization']})</a></p>";
    }
}

// Show booked appointments
echo "<h2>Your Appointments</h2>";
$appointments = $conn->query("
    SELECT a.*, d.name AS doctor_name, d.specialization FROM appointments a
    JOIN users d ON a.doctor_id = d.id
    WHERE a.patient_id = $user_id
");
if ($appointments->num_rows == 0) {
    echo "<p>You have no appointments booked.</p>";
} else {
    while ($row = $appointments->fetch_assoc()) {
        echo "<div>Doctor: Dr. {$row['doctor_name']} ({$row['specialization']})<br>
              Date: {$row['appointment_date']} | Time: {$row['appointment_time']}<br>
              Status: {$row['status']} | Link: <a href='{$row['teleconsultation_link']}' target='_blank'>Join</a></div><hr>";
    }
}
?>