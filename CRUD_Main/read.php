<?php
session_start(); // must be first line

include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Fetch all students
$stmt = $conn->query("SELECT * FROM students ORDER BY id ASC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { margin-bottom: 10px; }
        a.back-btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        a.back-btn:hover { background-color: #0056b3; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<a href="index.php" class="back-btn">Back to Dashboard</a>

<h3>All Students</h3>
<?php if (count($students) > 0): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Course</th>
            <th>Batch</th>
            <th>City</th>
            <th>Year</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= htmlspecialchars($student['course']) ?></td>
                <td><?= htmlspecialchars($student['batch']) ?></td>
                <td><?= htmlspecialchars($student['city']) ?></td>
                <td><?= htmlspecialchars($student['year']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No students found.</p>
<?php endif; ?>

</body>
</html>
