<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "student";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("COULD NOT CONNECT! " . mysqli_connect_error());
}

// Create the student database if it doesn't exist
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $dbname");

// Select the student database
mysqli_select_db($conn, $dbname);

// Create the teachers table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

mysqli_query($conn, $createTableQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM teachers WHERE username = '$username' AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Set login information in cookie
        setcookie("teacher_username", $username, time() + (86400 * 30), "/"); // 30 days expiration
        setcookie("teacher_password", $password, time() + (86400 * 30), "/"); // 30 days expiration

        header("Location: teacher_dashboard.php");
        exit();
    } else {
        header("Location: index.php?et=1");
        exit();
    }
} else {
    header("Location: index.php?et=1");
    exit();
}
?>
