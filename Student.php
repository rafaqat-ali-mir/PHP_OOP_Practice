<?php
require_once 'config.php';

class Student
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

 public function getData()
{
    $stmt = $this->conn->prepare("SELECT * FROM students");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($result);
    echo "</pre>";
}

public function insertData()
{
    $sqlQuery = "INSERT INTO students (id, name, course, batch, city, year)
                 VALUES (NULL, 'bruce', 'MBA', 'Morning', 'Delhi', '2nd Year')";

    $stmt = $this->conn->prepare($sqlQuery);
    $result = $stmt->execute();

    if ($result) {
        echo "Data inserted";
    } else {
        echo "Operation failed";
    }
}
public function updateData()
{
    $sqlQuery = "UPDATE students SET
        name='bro',
        course='B.tech',
        batch='evening',
        city='Mirpur'
        WHERE id=25";

    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();

    echo "Rows affected: " . $stmt->rowCount();
}
public function deleteData()
{
    $sqlQuery = "DELETE FROM students WHERE id = 25";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
}
public function insertDatawithRequest($request){
    $name   = $request["name"];
    $course = $request["Course"];
    $batch  = $request["Batch"];
    $year   = $request["Year"];
    $city   = $request["City"];

    $sqlQuery = "INSERT INTO students (id, name, course, batch, city, year) 
                 VALUES (NULL, :name, :course, :batch, :city, :year)";

    $stmt = $this->conn->prepare($sqlQuery);

    // Bind parameters - names must match SQL placeholders exactly
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':course', $course);
    $stmt->bindParam(':batch', $batch);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':year', $year);

    if($stmt->execute()){
        echo "Data inserted successfully!";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Insert failed: " . $errorInfo[2];
    }
}



}

$student = new Student($conn);
// $student->getData();
// $student->insertData();
// $student->updateData();
// $student->deleteData();
if(isset($_POST['name'])){
    $student->insertDatawithRequest($_POST) ;

}

?>
