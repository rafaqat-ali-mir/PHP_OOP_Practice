<?php
include'db.php';
// Prepare the SQL statment
$sql="SELECT * FROM tasks";
$stmt= $conn->prepare($sql);
// Execute the Statment
$stmt->execute();
// Get result set
$result= $stmt->get_result();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>To-Do List</title>
    </head>
    <body>
        <h1>To-Do List</h1>
        <a href="create.php">Add New Task</a>
        <ul>
            <?php while($row=$result->fetch_assoc()):?>
                <li>
                    <h2><?php echo htmlspecialchars($row['title']);?></h2>
                    <p><?php echo htmlspecialchars($row['description']);?></p>
                    <a href="update.php?id=<?php echo $row['id'];?>">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id'];?>">Delete</a>
                </li>
                <?php endwhile;?>
        </ul>
    </body>
</html>
<?php
// Close statement
$stmt->close();
$conn->close();
?>