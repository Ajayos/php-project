<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style.css">
    <title>View Students</title>
</head>
<body>
    <div class="container">
        <h2>View Students</h2>
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

            <?php
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "student";
            $conn = mysqli_connect($host, $user, $pass, $db);
            if (!$conn) {
                die("COULD NOT CONNECT! " . mysqli_connect_error());
            }

            // Retrieve student data from the database
            $sql = "SELECT * FROM students";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Output data of each student
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['regno'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['sex'] . "</td>";
                    echo "<td>" . $row['class'] . "</td>";
                    echo "<td>" . $row['phy'] . "</td>";
                    echo "<td>" . $row['che'] . "</td>";
                    echo "<td>" . $row['eng'] . "</td>";
                    echo "<td>" . $row['math'] . "</td>";
                    echo "<td>" . $row['total'] . "</td>";
                    echo "<td>" . $row['grade'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No students found.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </table>
        <br /><br /><br /><br /><br /><br /><br />
        <button onclick="goBack()">Back</button>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
