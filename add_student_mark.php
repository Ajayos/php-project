<?php
// Check if the student is logged in
if (!isset($_COOKIE['teacher_username'])) {
    header("Location: index.php");
    exit();
}
?>
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected student ID from the form
    $selectedValue = $_POST['value'];

    // Redirect to the add_student_marks.php page with the selected student ID
    header("Location: add_student_marks.php?student_id=$selectedValue");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "student";
$conn = mysqli_connect($host, $user, $pass, $db);

// Check if the connection is successful
if (!$conn) {
    die("COULD NOT CONNECT! " . mysqli_connect_error());
}

// Fetch student data from the database
$sql = "SELECT id, regno, name, sex FROM students";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("QUERY FAILED! " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="stylesheet" href="./dashboard.css">
    <title>Student Marks</title>
</head>
<body>
    <div class="center-box">
        <h2>Student Marks</h2>
        <form method="post" action="add_mark.php">
            
                <label for="id">Select Student ID:</label>
                <select id="id" name="id">
                <option value='select student' selectedValue default>Select Student</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $studentId = $row['id'];
                        $regNo = $row['regno'];

                        echo "<option value='$studentId'>$regNo</option>";
                    }
                    ?>
                </select>
                <br /><br />
                <div>
                    <input type="submit" value="Submit"><input type="reset" value="Reset">
                </div>
        </form>
        <br /><br />
        <div>
            <button class="input_" onclick="location.href='teacher_dashboard.php'">Back</button>
        </div>
    </div>
</body>
</html>
