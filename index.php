<?php
    // Check if the user is already logged in as a student
    if (isset($_COOKIE['student_regno'])) {
        header("Location: student_dashboard.php");
        exit();
    }
    
    // Check if the user is already logged in as a teacher
    if (isset($_COOKIE['teacher_username'])) {
        header("Location: teacher_dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="./index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="wrapper">
            <div class="title-text">
                <div class="title student">
                    Student
                </div>
                <div class="title teacher">
                    Teacher
                </div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="student" checked>
                    <input type="radio" name="slide" id="teacher">
                    <label for="student" class="slide student">Student</label>
                    <label for="teacher" class="slide teacher">Teacher</label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">

                    <form class="student" method="post" action="student.php">
                        <?php
                            if (isset($_GET['es'])) {
                                echo '<br />';
                                echo '<div class="red-box">';
                                echo '<div class="alert alert-danger text-center bg-red" role="alert">';
                                echo '<p>Register Number or Date of Birth invalid</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        ?> 
                        <div class="field">
                            <input type="number" placeholder="Register Number" name="regno" id="regno" required>
                        </div>
                        <div class="field">
                            <input type="date" placeholder="Date of Birth" name="dob" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Login">
                        </div>
                        <div class="teacher-link">
                            <a href="">Teacher login</a>
                        </div>
                    </form>
                    <form method="post" class="teacher" action="teacher.php">
                        <?php
                            if (isset($_GET['et'])) {
                                echo '<br />';
                                echo '<div class="red-box">';
                                echo '<div class="alert alert-danger text-center bg-red" role="alert">';
                                echo '<p>Username or password invalid</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        ?> 
                        <div class="field">
                            <input type="text" name="username" placeholder="USERNAME" required>
                        </div>
                        <div class="field">
                            <input type="password" placeholder="Password" name="password" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            const studentText = document.querySelector(".title-text .student");
            const studentForm = document.querySelector("form.student");
            const loginBtn = document.querySelector("label.student");
            const signupBtn = document.querySelector("label.teacher");
            const teacherLink = document.querySelector("form .teacher-link a");
            signupBtn.onclick = (() => {
                studentForm.style.marginLeft = "-50%";
                studentText.style.marginLeft = "-50%";
            });
            loginBtn.onclick = (() => {
                studentForm.style.marginLeft = "0%";
                studentText.style.marginLeft = "0%";
            });
            teacherLink.onclick = (() => {
                signupBtn.click();
                return false;
            });
        </script>
    </body>
</html>
