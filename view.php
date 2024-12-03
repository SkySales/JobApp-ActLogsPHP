<?php
include 'db.php';

// Initialize search query
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $stmt = $pdo->prepare("SELECT * FROM job_applications WHERE 
        id LIKE :search OR 
        firstname LIKE :search OR 
        lastname LIKE :search OR 
        email LIKE :search OR 
        specialization LIKE :search OR 
        language LIKE :search
        ORDER BY timestamp DESC");
    $stmt->execute(['search' => '%' . $searchQuery . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM job_applications ORDER BY timestamp DESC");
}
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Job Applications</h1>

        <!-- Search Bar -->
        <form method="GET" action="" class="d-flex mb-4">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2" 
                placeholder="Search by Name, Email, Specialization, or Language" 
                value="<?php echo htmlspecialchars($searchQuery); ?>"
            >
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Specialization</th>
                    <th>Years of Experience</th>
                    <th>Language</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($applications) > 0): ?>
                    <?php foreach ($applications as $app): ?>
                    <tr>
                        <td><?php echo $app['id']; ?></td>
                        <td><?php echo $app['firstname']; ?></td>
                        <td><?php echo $app['lastname']; ?></td>
                        <td><?php echo $app['email']; ?></td>
                        <td><?php echo $app['specialization']; ?></td>
                        <td><?php echo $app['year_of_exp']; ?></td>
                        <td><?php echo $app['language']; ?></td>
                        <td><?php echo $app['timestamp']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $app['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $app['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
