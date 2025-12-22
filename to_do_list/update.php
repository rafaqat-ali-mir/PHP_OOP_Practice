<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid Task ID");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];

    // UPDATE statement
    $sql = "UPDATE tasks SET title=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

} else {

    // SELECT statement (for showing existing data)
    $sql = "SELECT * FROM tasks WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Task</title>
    </head>
    <body>
        <h1>Edit Task</h1>
        <form method="POST" action="">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title"
        value="<?php echo htmlspecialchars($task['title']); ?>"><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description"><?php 
        echo htmlspecialchars($task['description']); 
    ?></textarea><br><br>

    <input type="submit" value="Update Task">
</form>

    </body>
</html>
