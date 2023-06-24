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

// Check if student cookies are set
if (isset($_COOKIE['student_regno'])) {
    $regno = $_COOKIE['student_regno'];

    // Fetch student data from the database
    $sql = "SELECT * FROM students WHERE regno = '$regno'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1) {
        $student = mysqli_fetch_assoc($result);

        // Logout function
        function logout() {
            // Clear all cookies
            setcookie("student_regno", "", time() - 3600, "/");
            setcookie("student_id", "", time() - 3600, "/");
            
            // Redirect to index.php
            header("Location: index.php");
            exit();
        }

        // Check if the logout button is pressed
        if (isset($_POST['logout'])) {
            logout();
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <link rel="stylesheet" href="./style.css">
            <title>Student Information</title>
        </head>
        <body>
        <div class="container">
            <h2>Student Information</h2>
            <table>
                <tr>
                    <th>Register Number</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Sex</th>
                    <th>Class</th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>English</th>
                    <th>Mathematics</th>
                    <th>Total</th>
                    <th>Grade</th>
                </tr>
                <tr>
                    <td><?php echo $student['regno']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['dob']; ?></td>
                    <td><?php echo $student['sex']; ?></td>
                    <td><?php echo $student['class']; ?></td>
                    <td><?php echo $student['phy']; ?></td>
                    <td><?php echo $student['che']; ?></td>
                    <td><?php echo $student['eng']; ?></td>
                    <td><?php echo $student['math']; ?></td>
                    <td><?php echo $student['total']; ?></td>
                    <td><?php echo $student['grade']; ?></td>
                </tr>
            </table>
            <br /> <br />
            <form method="post" action="">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </body>
</html>
        <?php
    } else {
        echo "Student not found!";
    }
} else {
    header("Location: index.php");
    exit();
}

mysqli_close($conn);
?>
