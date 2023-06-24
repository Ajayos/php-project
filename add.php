<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "student";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("COULD NOT CONNECT! " . mysqli_connect_error());
}

// Select the student database
mysqli_select_db($conn, $dbname);

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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $regno = $_POST['regno'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $class = $_POST['class'];
    
    // Check if ID is present in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Update existing student data
        $sql = "UPDATE students SET regno = '$regno', name = '$name', dob = '$dob', sex = '$sex', class = '$class'  WHERE id = $id";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: teacher_dashboard.php");
            exit();
        } else {
            header("Location: add_student.php?e=1");
            exit();
        }
    } else {
        // Insert new student data
        $sql = "INSERT INTO students (regno, name, dob, sex, class) VALUES ('$regno', '$name', '$dob', '$sex', '$class')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: teacher_dashboard.php");
            exit();
        } else {
            header("Location: add_student.php?e=1");
            exit();
        }
    }
} else {
    header("Location: add_student.php?e=1");
    exit();
}

mysqli_close($conn);
