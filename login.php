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
                header("Location: test.php");
            } else {
                echo "<br>Login Unsuccessful";
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

                header("Location:test.php");
                // header("Location: teacher.php?department=$department&name=$username");
            } else {
                echo "<br>Login Unsuccessful";
            }
        } else {
            echo "<br>Error running query";
        }
    }
    // elseif ($userType == "admin") {
    //     echo "<br>Admin Profile";
    // }
    ?>
</body>

</html>