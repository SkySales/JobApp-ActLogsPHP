<?php
include 'db.php';
session_start();

// Check if the clear logs button is clicked
if (isset($_POST['clear_logs'])) {
    $stmt = $pdo->prepare("DELETE FROM activity_logs");
    $stmt->execute();

    // Optional: Redirect to refresh the page
    header("Location: act_logs.php");
    exit;
}

// Fetch activity logs with user names
$searchQuery = '';
$sql = "SELECT activity_logs.id, activity_logs.action, activity_logs.details, activity_logs.created_at, 
        users.username AS user_name 
        FROM activity_logs 
        JOIN users ON activity_logs.user_id = users.user_id ";

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    // Add parameters for each condition in WHERE clause
    $sql .= " WHERE users.username LIKE :search OR activity_logs.action LIKE :search OR activity_logs.details LIKE :search OR activity_logs.id LIKE :search";
} else {
    $sql .= " ORDER BY activity_logs.created_at DESC";
}

$sql .= " ORDER BY activity_logs.created_at DESC";

// Prepare and execute the query with the correct binding
$stmt = $pdo->prepare($sql);
$stmt->execute(['search' => "%" . $searchQuery . "%"]);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        .clear-logs-btn {
            background-color: #dc3545;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 200px;
            margin: 20px auto;
        }
        .clear-logs-btn:hover {
            background-color: #c82333;
        }
        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center mb-4">Activity Logs</h1>

        <!-- Clear All Logs Button -->
        <form method="POST" style="text-align: center;">
            <button type="submit" name="clear_logs" class="clear-logs-btn">Clear All Logs</button>
        </form>

        <!-- Search Bar -->
        <form method="GET" action="" class="d-flex mb-4">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2" 
                placeholder="Search by Name, Action, or Details" 
                value="<?= htmlspecialchars($searchQuery); ?>"
            >
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Activity Logs Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Details</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($logs) > 0): ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['id']) ?></td>
                            <td><?= htmlspecialchars($log['user_name']) ?></td>
                            <td><?= htmlspecialchars($log['action']) ?></td>
                            <td><?= htmlspecialchars($log['details']) ?></td>
                            <td><?= htmlspecialchars($log['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No logs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
