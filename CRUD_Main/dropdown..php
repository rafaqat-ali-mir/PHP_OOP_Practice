<?php
include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Fetch students
$stmt = $conn->query("SELECT id, name FROM students ORDER BY name ASC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Student</title>
</head>
<body>

<h2>Select a Student</h2>

<select name="student_id">
    <option value="">-- Select Name --</option>
    <?php foreach ($students as $student) : ?>
        <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
    <?php endforeach; ?>
</select>

</body>
</html>
