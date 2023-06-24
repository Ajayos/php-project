<?php
// Check if the student is logged in
if (!isset($_COOKIE['teacher_username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="stylesheet" href="./dashboard.css">
    <title>Add Student</title>
</head>
<body>
    <div class="center-box">
        <h2>Add Student</h2>
        <form method="post" action="<?php echo isset($_POST['id']) ? 'add.php?id=' . $_POST['id'] :  "add.php"; ?>">
            <?php
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                
                $host = "localhost";
                $user = "root";
                $pass = "";
                $db = "student";
                $conn = mysqli_connect($host, $user, $pass, $db);
                if (!$conn) {
                    die("COULD NOT CONNECT! " . mysqli_connect_error());
                }
                
                $sql = "SELECT * FROM students WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $regno = $row['regno'];
                    $name = $row['name'];
                    $dob = $row['dob'];
                    $sex = $row['sex'];
                    $class = $row['class'];
                }
                
                mysqli_close($conn);
            } else {
                $id = "";
                $regno = "";
                $name = "";
                $dob = "";
                $sex = "";
                $class = "";
            }
            ?>
            <?php
                if (isset($_POST['e'])) {
                    echo '<br />';
                    echo '<div class="red-box">';
                    echo '<div class="alert alert-danger text-center bg-red" role="alert">';
                    echo '<p>Error the data not inserted</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<br />';
                    echo '<br />';
                }
            ?> 

            <?php 
                if (isset($_POST['id'])) {
                    echo "<label for='id'>ID:</label>";
                    echo "<input type='text' id='id' name='id' value='$id' disabled required>";
                }
            ?>

            <label for="regno">Register Number:</label>
            <input type="text" id="regno" name="regno" value="<?php echo $regno; ?>" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required>

            <label for="sex">Sex:</label>
            <div class="radio-container">
                <input type="radio" id="male" name="sex" value="male" <?php if ($sex === "male") echo "checked"; ?> required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="sex" value="female" <?php if ($sex === "female") echo "checked"; ?> required>
                <label for="female">Female</label>
                <input type="radio" id="other" name="sex" value="other" <?php if ($sex === "other") echo "checked"; ?> required>
                <label for="other">Other</label>
            </div>

            <label for="class">Class:</label>
            <input type="text" id="class" name="class" value="<?php echo $class; ?>" required>

            <input type="submit" value="<?php echo ($id) ? 'Update Student' : 'Add Student'; ?>">
        </form>
    </div>
</body>
</html>