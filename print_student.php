<?php
$filename = 'student_data.txt';

// Clear the contents of the file
file_put_contents($filename, '');

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

// Retrieve student data from the database
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

// Insert student data into the file
while ($row = mysqli_fetch_assoc($result)) {
    $studentData = array_values($row);
    $studentData = array_map(function ($data) {
        return $data ?? 'null';
    }, $studentData);
    $row = implode(' | ', $studentData) . PHP_EOL;
    file_put_contents($filename, $row, FILE_APPEND);
}

// Close the database connection
mysqli_close($conn);

// Read the contents of the file and display as a table
$contents = file_get_contents($filename);
$lines = explode(PHP_EOL, $contents);

// Set appropriate headers for file download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Expires: 0');

// Output the file content
readfile($filename);

//header("Location: student_dashboard.php");
//exit();
?>
