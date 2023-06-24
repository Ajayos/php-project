<?php
$host = "localhost";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("COULD NOT CONNECT! " . mysqli_connect_error());
}

// Create the student database if it doesn't exist
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS student");

// Select the student database
mysqli_select_db($conn, "student");

// Create the students table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regno INT NOT NULL,
    dob DATE NOT NULL,
    name VARCHAR(255) NOT NULL,
    sex VARCHAR(10),
    class VARCHAR(10),
    phy INT,
    che INT,
    eng INT,
    math INT,
    total INT,
    grade VARCHAR(2)
)";

mysqli_query($conn, $createTableQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regno = $_POST['regno'];
    $dob = $_POST['dob'];
    $sql = "SELECT * FROM students WHERE regno = '$regno' AND dob = '$dob'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) >= 1) {
        $student = mysqli_fetch_assoc($result);
        $studentId = $student['id'];
        $regno = $student['regno'];
    
        // Set login information in cookie
        setcookie("student_regno", $regno, time() + (86400 * 30), "/"); // 30 days expiration
        setcookie("student_id", $studentId, time() + (86400 * 30), "/"); // 30 days expiration

        header("Location: student_view.php?id=$studentId");
        exit();
    } else {
        header("Location: index.php?es=1");
        exit();
    }
} else {
    header("Location: index.php?es=1");
    exit();
}
?>
