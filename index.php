<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Booking System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .bg {
            background-image: url('https://images.unsplash.com/photo-1579154204601-01588f351e95?auto=format&fit=crop&w=1650&q=80');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="bg">
        <div class="content">
            <h1 class="mb-4">Welcome to Hospital Booking System</h1>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="patient/register.php" class="btn btn-primary btn-lg">Register as Patient</a>
                <a href="doctor/register.php" class="btn btn-primary btn-lg">Register as Doctor</a>
                <a href="patient/login.php" class="btn btn-success btn-lg">Patient Login</a>
                <a href="doctor/login.php" class="btn btn-success btn-lg">Doctor Login</a>
                <a href="admin/dashboard.php" class="btn btn-secondary btn-lg">Admin Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>