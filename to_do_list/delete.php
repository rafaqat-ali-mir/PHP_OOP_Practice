<?php
include 'db.php';
$id=$_GET['id'];

// Prepare DELETE statement with a placeholder for the ID
$sql= "DELETE FROM tasks WHERE id=?";

// prepare the ststement
$stmt= $conn->prepare($sql);

// Bind the ID parameter
$stmt->bind_param("i",$id); // "i" indicates the type of parameter: integer

// Execute the statement
if($stmt->execute()){
    header('Location: index.php');
}else{
    echo "Error: " .$stmt->error;

}
// close the ststement
$stmt->close();

// close the database connection
$conn->close();
?>