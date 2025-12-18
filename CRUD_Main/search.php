<?php
session_start(); // must be first line

include("config.php"); // Includes session start and DB connection

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$results = [];
$message = "";

if (isset($_GET['keyword'])) {
    $keyword = "%" . trim($_GET['keyword']) . "%";

    // Safe prepared search query
    $stmt = $conn->prepare("SELECT * FROM students 
                            WHERE name LIKE :keyword 
                               OR city LIKE :keyword 
                               OR course LIKE :keyword
                               OR batch LIKE :keyword");
    $stmt->bindParam(':keyword', $keyword);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) {
        $message = "No record found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Students</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input, button { padding: 8px; margin: 5px 0; }
        button { background-color: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
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
        p.message { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<a href="index.php" class="back-btn">Back to Dashboard</a>

<h3>Search Students</h3>

<form method="GET" action="">
    <input type="text" name="keyword" placeholder="Search by name, city, course or batch" required>
    <button type="submit">Search</button>
</form>

<?php if ($message != ""): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if (!empty($results)): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Course</th>
            <th>Batch</th>
            <th>City</th>
            <th>Year</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['course']) ?></td>
                <td><?= htmlspecialchars($row['batch']) ?></td>
                <td><?= htmlspecialchars($row['city']) ?></td>
                <td><?= htmlspecialchars($row['year']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
