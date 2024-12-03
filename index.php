<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /login/login.php');
    exit;
}

function logActivity($pdo, $userId, $action, $details) {
    $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, details) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $action, $details]);
}

if (isset($_POST['submit'])) {
    include '/funcs/db.php';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $year_of_exp = $_POST['year_of_exp'];
    $language = $_POST['language'];

    $stmt = $pdo->prepare("INSERT INTO job_applications (firstname, lastname, email, specialization, year_of_exp, language) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $email, $specialization, $year_of_exp, $language]);

    $userId = $_SESSION['user_id'];
    $details = "Inserted a new job application for $firstname $lastname (Email: $email)";
    logActivity($pdo, $userId, 'Insert', $details);

    header('Location: ty.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Job Application Form</h1>
        <form action="" method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="specialization" class="form-label">Specialization</label>
                <input type="text" class="form-control" name="specialization" required>
            </div>
            <div class="mb-3">
                <label for="year_of_exp" class="form-label">Years of Experience</label>
                <input type="number" class="form-control" name="year_of_exp" required>
            </div>
            <div class="mb-3">
                <label for="language" class="form-label">Programming Language</label>
                <input type="text" class="form-control" name="language" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
