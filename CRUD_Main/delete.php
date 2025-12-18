<?php
session_start(); // must be first line

include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Handle deletion
if (isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $stmt = $conn->prepare("DELETE FROM students WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $message = "Record deleted successfully.";
    } else {
        $message = "Failed to delete record.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        a, button { padding: 6px 12px; text-decoration: none; border-radius: 4px; }
        a { background-color: #007BFF; color: white; }
        a:hover { background-color: #0056b3; }
        button { background-color: #dc3545; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #b52a37; }
        .message { margin: 15px 0; font-weight: bold; color: green; }
    </style>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<a href="index.php" class="back-btn">Back to Dashboard</a>


<?php if (!empty($message)) : ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<h3>Student Records</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Course</th>
        <th>Batch</th>
        <th>City</th>
        <th>Year</th>
        <th>Actions</th>
    </tr>
    <?php
    $stmt = $conn->query("SELECT * FROM students ORDER BY id ASC");
    while ($student = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= htmlspecialchars($student['course']) ?></td>
            <td><?= htmlspecialchars($student['batch']) ?></td>
            <td><?= htmlspecialchars($student['city']) ?></td>
            <td><?= htmlspecialchars($student['year']) ?></td>
            <td>
                <a href="update.php?id=<?= $student['id'] ?>">Edit</a>
                <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                    <input type="hidden" name="delete_id" value="<?= $student['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
