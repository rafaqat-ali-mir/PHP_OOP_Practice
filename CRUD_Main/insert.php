<?php
session_start(); // must be first line

include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$message = "";

if (isset($_POST['insert'])) {
    $name   = trim($_POST["name"]);
    $course = trim($_POST["course"]);
    $batch  = trim($_POST["batch"]);
    $city   = trim($_POST["city"]);
    $year   = trim($_POST["year"]);

    // Prepare statement safely
    $stmt = $conn->prepare("
        INSERT INTO students (name, course, batch, city, year)
        VALUES (:name, :course, :batch, :city, :year)
    ");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':course', $course);
    $stmt->bindParam(':batch', $batch);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':year', $year);

    if ($stmt->execute()) {
        $message = "Student added successfully!";
    } else {
        $message = "Failed to add student!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input, button { padding: 8px; margin: 5px 0; width: 300px; }
        button { width: 150px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #218838; }
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
        .message { margin: 15px 0; font-weight: bold; color: green; }
    </style>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<a href="index.php" class="back-btn">Back to Dashboard</a>


<h3>Add New Student</h3>

<?php if (!empty($message)) : ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Enter name" required><br>
    <input type="text" name="course" placeholder="Enter course" required><br>
    <input type="text" name="batch" placeholder="Enter batch" required><br>
    <input type="text" name="city" placeholder="Enter city" required><br>
    <input type="text" name="year" placeholder="Enter year" required><br>
    <button type="submit" name="insert">Add Student</button>
</form>

</body>
</html>
