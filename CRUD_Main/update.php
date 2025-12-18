<?php
session_start(); // must be first line

include("config.php"); // Database connection

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Initialize variables
$message = "";
$student = [
    'name' => '',
    'course' => '',
    'batch' => '',
    'city' => '',
    'year' => ''
];

// --- 1. Get student data if ID is provided ---
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($id <= 0) {
        die("Invalid student ID.");
    }

    $stmt = $conn->prepare("SELECT * FROM students WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        die("Student not found.");
    }
} else {
    die("No student ID provided.");
}

// --- 2. Handle update submission ---
if (isset($_POST['update'])) {
    $id     = (int)$_POST['id'];
    $name   = trim($_POST['name']);
    $course = trim($_POST['course']);
    $batch  = trim($_POST['batch']);
    $city   = trim($_POST['city']);
    $year   = trim($_POST['year']);

    // Validate input (optional but recommended)
    if ($id <= 0 || empty($name) || empty($course) || empty($batch) || empty($city) || empty($year)) {
        $message = "Please fill all fields.";
    } else {
        try {
            $stmt = $conn->prepare("
                UPDATE students 
                SET name = :name, course = :course, batch = :batch, city = :city, year = :year
                WHERE id = :id
            ");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':course', $course);
            $stmt->bindParam(':batch', $batch);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Redirect to read.php with success message
                header("Location: read.php?msg=updated");
                exit;
            } else {
                $message = "No changes made or invalid student ID.";
            }

        } catch (PDOException $e) {
            $message = "Update failed: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input, button { padding: 8px; margin: 5px 0; width: 300px; }
        button { background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
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
        p.message { font-weight: bold; color: green; }
    </style>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<a href="index.php" class="back-btn">Back to Dashboard</a>

<h3>Update Student</h3>

<?php if ($message != ""): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" placeholder="Name" required><br>
    <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>" placeholder="Course" required><br>
    <input type="text" name="batch" value="<?= htmlspecialchars($student['batch']) ?>" placeholder="Batch" required><br>
    <input type="text" name="city" value="<?= htmlspecialchars($student['city']) ?>" placeholder="City" required><br>
    <input type="text" name="year" value="<?= htmlspecialchars($student['year']) ?>" placeholder="Year" required><br>
    <button type="submit" name="update">Update Student</button>
</form>

</body>
</html>
