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

// Close the MySQLi connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="stylesheet" href="./dashboard.css">
    <title>Add Student Marks</title>
</head>
<body>
    <div class="center-box">
        <h2>Add Student Marks</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="value">Select Student ID:</label>
                <select id="value" name="value">
                    <?php
                    // Display options with student register IDs
                    while ($row = mysqli_fetch_assoc($result)) {
                        $studentId = $row['id'];
                        $regNo = $row['regno'];

                        echo "<option value='$studentId'>$regNo</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>

        <button onclick="location.href='edit_details.php'">Edit Details</button>
    </div>
</body>
</html>
