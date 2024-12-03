<?php
include 'db.php';
session_start();

function logActivity($pdo, $userId, $action, $details) {
    $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, details) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $action, $details]);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM job_applications WHERE id = ?");
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($record) {
        // Delete
        $stmt = $pdo->prepare("DELETE FROM job_applications WHERE id = ?");
        $stmt->execute([$id]);

        // Logs
        $userId = $_SESSION['user_id'];
        $details = "Deleted job application for {$record['firstname']} {$record['lastname']} (Email: {$record['email']})";
        logActivity($pdo, $userId, 'Delete', $details);
    }

    header("Location: view.php");
    exit;
}
?>
