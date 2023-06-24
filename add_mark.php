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
    <title>Add Mark</title>
</head>
<body>
    <div class="center-box">
        <h2>Add Mark</h2>
        <form method="post" action="<?php echo isset($_POST['id']) ? 'mark.php?id=' . $_POST['id'] :  "mark.php"; ?>">
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
                    $regno = isset($row['regno']) ? $row['regno'] : "";
                    $name = isset($row['name']) ? $row['name'] : "";
                    $phy = isset($row['phy']) ? $row['phy'] : "";
                    $che = isset($row['che']) ? $row['che'] : "";
                    $eng = isset($row['eng']) ? $row['eng'] : "";
                    $maths = isset($row['math']) ? $row['math'] : "";
                } else {
                    $regno = "";
                    $name = "";
                    $phy = "";
                    $che = "";
                    $eng = "";
                    $maths = "";
                }
                
                
                mysqli_close($conn);
            }
            ?>

            <?php
            if (isset($_POST['e'])) {
                echo '<br />';
                echo '<div class="red-box">';
                echo '<div class="alert alert-danger text-center bg-red" role="alert">';
                echo '<p>Error: The data was not inserted.</p>';
                echo '</div>';
                echo '</div>';
                echo '<br />';
                echo '<br />';
            }
            ?> 

            <label for='id'>ID:</label>
            <input type='text' id='id' name='id' value="<?php echo $id; ?>" disabled required>

            <label for="regno">Register Number:</label>
            <input type="text" id="regno" name="regno" value="<?php echo $regno; ?>" disabled required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" disabled required>

            <label for="phy">Physics:</label>
            <input type="number" id="phy" name="phy" value="<?php echo $phy; ?>" required>

            <label for="che">Chemistry:</label>
            <input type="number" id="che" name="che" value="<?php echo $che; ?>" required>

            <label for="eng">English:</label>
            <input type="number" id="eng" name="eng" value="<?php echo $eng; ?>" required>

            <label for="maths">Mathematics:</label>
            <input type="number" id="maths" name="maths" value="<?php echo $maths; ?>" required>
            <br /><br />
            <input type="submit" value="<?php echo ($id) ? 'Update Marks' : 'Add Marks'; ?>">
        </form>
    </div>
</body>
</html>
