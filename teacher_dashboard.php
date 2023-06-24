<?php
// Check if the student is logged in
if (!isset($_COOKIE['teacher_username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="./dashboard.css">
</head>
<body>
    <div class="center_box">
        <div class="button-container">
            <a href="add_student.php" class="button">
                Add Student
            </a>
            <a href="add_student_mark.php" class="button">
                Add Student Mark
            </a>
            <a href="edit_student.php" class="button">
                Edit Student
            </a>
            <a href="view_student.php" class="button">
                View Student
            </a>
            <a href="print_student.php" class="button">
                Print Student
            </a>
            <a href="logout.php" class="button">
                Logout
            </a>
        </div>
    </div>
</body>
</html>
