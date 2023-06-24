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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $phy = $_POST['phy'];
    $che = $_POST['che'];
    $eng = $_POST['eng'];
    $math = $_POST['maths'];

    // Calculate total marks
    $total = $phy + $che + $eng + $math;
    
    // Calculate grade
    $grade = "";
    if($total >= 90) {
        $grade = "S";
    } elseif ($total >= 80) {
        $grade = "A";
    } elseif ($total >= 60) {
        $grade = "B";
    } elseif ($total >= 40) {
        $grade = "C";
    } else {
        $grade = "D";
    }
    
    // Check if ID is present in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Update existing student data
        $sql = "UPDATE students SET phy = '$phy', che = '$che', eng = '$eng', math = '$math', total = '$total', grade = '$grade' WHERE id = $id";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: teacher_dashboard.php");
            exit();
        } else {
            echo " error " .sqli_error($conn);
            // header("Location: add_mark.php?e=1");
            // exit();
        }
    } else {
        echo "error no id";
            //header("Location: add_mark.php?e=1");
            //exit();
    }
} else {
    echo "no post";
    // header("Location: add_mark.php?e=1");
    // exit();
}

mysqli_close($conn);
