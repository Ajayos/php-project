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

// Check if the student is logged in
if (!isset($_COOKIE['student_regno'])) {
    header("Location: index.php");
    exit();
}

// Retrieve student information from the database
$regno = $_COOKIE['student_regno'];
$sql = "SELECT * FROM students WHERE regno = '$regno'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) != 1) {
    header("Location: index.php");
    exit();
}

$student = mysqli_fetch_assoc($result);

// Logout functionality
if (isset($_POST['logout'])) {
    // Clear the student cookie
    setcookie("student_regno", "", time() - 3600, "/");
    setcookie("student_dob", "", time() - 3600, "/");

    header("Location: index.php?lo=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="./dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $student['name']; ?>!</h1>
        
        <table>
            <tr>
                <th>Name</th>
                <th>Roll Number</th>
                <th>Registration Number</th>
                <th>Date of Birth</th>
                <th>Sex</th>
                <th>Physics</th>
                <th>Chemistry</th>
                <th>Mathematics</th>
                <th>English</th>
                <th>PSP</th>
                <th>Total Marks</th>
                <th>Grade</th>
            </tr>
            <tr>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['roll']; ?></td>
                <td><?php echo $student['reg']; ?></td>
                <td><?php echo $student['dob']; ?></td>
                <td><?php echo $student['sex']; ?></td>
                <td><?php echo $student['phy']; ?></td>
                <td><?php echo $student['che']; ?></td>
                <td><?php echo $student['maths']; ?></td>
                <td><?php echo $student['eng']; ?></td>
                <td><?php echo $student['psp']; ?></td>
                <td><?php echo $student['total']; ?></td>
                <td><?php echo $student['grade']; ?></td>
            </tr>
        </table>
        
        <form method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>
</body>
</html>
