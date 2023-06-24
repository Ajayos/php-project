<?php
// Remove teacher cookie
setcookie('teacher_username', '', time() - 3600, '/');
setcookie('teacher_password', '', time() - 3600, '/');

// Redirect to the login page
header('Location: index.php');
exit;
?>