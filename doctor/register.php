<?php
include('../config/db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, specialization) VALUES (?, ?, ?, 'doctor', ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $specialization);
    $stmt->execute();
    echo "Doctor registered! <a href='login.php'>Login</a>";
}
?>
<form method="POST">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Specialization: <input type="text" name="specialization" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>