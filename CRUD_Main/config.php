<?php
// Database configuration
$host = "localhost";   // Usually localhost for XAMPP
$dbname = "college";
$user = "root";        // Default XAMPP MySQL user
$pass = "";            // Default XAMPP MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // No output here! Do not echo anything
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
