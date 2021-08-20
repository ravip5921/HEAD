<?php session_start(); ?>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <?php

    include 'connect_todb.php';

    $userType = $_POST["usercat"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!$sqldb->select_db('higherEducationdb')) {
        die("not connected to database");
    }
    $_SESSION["userType"] = $userType;
    if ($username == "" || $password == "") {
        if ($username == "" && $password != "") {
    ?><script>
                alert("Enter Username!");
            </script>
        <?php
            header("Refresh:0;url=logout.php");
            // header("Location:logout.php");
        } else  if ($password == "" && $username != "") {
        ?><script>
                alert("Enter Password!");
            </script>
        <?php
            header("Refresh:0;url=logout.php");
            // header("Location:logout.php");
        } else {
        ?><script>
                alert("Enter Username and Password!");
            </script>
            <?php
            header("Refresh:0;url=logout.php");
            // header("Location:logout.php");
        }
    } else {

        if ($userType == "student") {
            echo "<br>Student profile";
            if ($vals = $sqldb->query("SELECT name,dob FROM student WHERE password = '$password' AND rollno = '$username'")) {

                if ($vals_row = mysqli_fetch_assoc($vals)) {
                    $name = $vals_row['name'];
                    // $_SESSION['username'] = $_POST["username"];
                    $dob = $vals_row['dob'];
                    echo "<br>$name $dob  logged in";


                    $_SESSION["name"] = $name;
                    $_SESSION["dob"] = $dob;
                    $_SESSION["rollno"] = $username;
                    header("Location: student.php");
                } else {
            ?>
                    <script>
                        alert("Username or password incorrect!")
                    </script>
                    <!-- echo "<br>Login Unsuccessful"; -->
                <?php
                    header("Refresh:0;url=logout.php");
                }
            } else {
                echo "<br>Error running query";
            }
        } elseif ($userType == "teacher") {
            echo "<br>Teacher Profile";
            if ($vals = $sqldb->query("SELECT department FROM teacher WHERE password = '$password' AND uname = '$username'")) {

                if ($vals_row = mysqli_fetch_assoc($vals)) {
                    $department = $vals_row['department'];

                    echo "<br>$department  logged in";
                    $_SESSION["name"] = $username;
                    $_SESSION["department"] = $department;
                    // Passing info to profile page

                    header("Location: teacher.php");
                    // header("Location: teacher.php?department=$department&name=$username");
                } else {
                ?>
                    <script>
                        alert("Username or password incorrect!")
                    </script>
                    <!-- echo "<br>Login Unsuccessful"; -->
    <?php
                    header("Refresh:0;url=logout.php");
                    // echo "<br>Login Unsuccessful";
                }
            } else {
                echo "<br>Error running query";
            }
        }
        // elseif ($userType == "admin") {
        //     echo "<br>Admin Profile";
        // }
    }
    ?>
</body>

</html>