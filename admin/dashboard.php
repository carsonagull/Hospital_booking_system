<?php
include('../config/db.php');
$result = $conn->query("
    SELECT a.*, p.name AS patient_name, d.name AS doctor_name
    FROM appointments a
    JOIN users p ON a.patient_id = p.id
    JOIN users d ON a.doctor_id = d.id
");
echo "<h1>Admin Dashboard</h1>";
while ($row = $result->fetch_assoc()) {
    echo "Patient: {$row['patient_name']} | Doctor: {$row['doctor_name']} | Date: {$row['appointment_date']} | Time: {$row['appointment_time']} | Link: {$row['teleconsultation_link']}<br>";
}
?>