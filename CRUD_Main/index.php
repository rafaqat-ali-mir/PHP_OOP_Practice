<?php
session_start(); // Must be first line
require_once "config.php";

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        /* Reset some default styles */
        body, h2, h3, ul, li, a, p {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f8fa;
            color: #333;
            padding: 40px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        .logout {
            background-color: #dc3545;
            margin-top: 20px;
        }

        .logout:hover {
            background-color: #b52a37;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        ul li a {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>

    <h3>Manage Students</h3>
    <ul>
        <!-- <li><a href="create_user.php">Insert New Student</a></li> -->
        <li><a href="read.php">View All Students</a></li>
        <li><a href="insert.php">Insert New Data</a></li>
        <li><a href="search.php">Search Students</a></li>
        <!-- <li><a href="update.php">Update Student</a></li> -->
        <li><a href="delete.php">Update & Delete Student</a></li>
    </ul>

    <p><a href="logout.php" class="logout">Logout</a></p>
</div>

</body>
</html>
