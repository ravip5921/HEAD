<?php session_start(); ?>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Applying.........</h1>
    <?php

    include 'connect_todb.php';

    if (!$sqldb->select_db('higherEducationdb')) {
        die("not connected to database");
    }
    // students details
    $name = $_SESSION["name"];
    $rollno = $_SESSION["rollno"];
    $dob = $_SESSION["dob"];

    // Application Details
    $university = $_POST["university"];
    $faculty = $_POST["faculty"];
    $country = $_POST["country"];

    echo "$name ,$dob ,$rollno applied for $faculty at $university in $country";
    $entryQuery = "INSERT INTO university (`uname`,`country`,`rollno`,`faculty`) VALUES ('$university','$country','$rollno','$faculty')";

    $sqldb->query($entryQuery);
    // header("Refresh:0.5; url=student.php");
    header("Refresh:1; url=student.php");
    ?>
</body>

</html>