<?php session_start(); ?>
<html>

<head>
    <title>Login</title>
</head>

<body>

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
    $status = $_POST["status"];
    $RecommendToTeacher = $_POST["requestR"];
    if ($university == "" && $faculty == "" && $country == "") {
    ?>
        <script>
            alert("Enter details");
        </script>
    <?php
        header("Refresh:0; url=student.php");
    } else {
    ?><h1>Applying.........</h1>
    <?php
        echo "$name ,$dob ,$rollno applied for $faculty at $university in $country";
        // $entryQuery = "INSERT INTO recommedation (`uname`,`country`,`rollno`,`faculty`,`teacher`,`uniastatus`,`recstatus`,`recdate`) VALUES ('$university','$country','$rollno','$faculty','$RecommendToTeacher','$status','pending',NULL)";
        $entryQuery = "INSERT INTO recommedation (`rollno`,`teacher`,`recstatus`,`recdate`,`uname`,`country`,`faculty`,`uniastatus`) VALUES ('$rollno','$RecommendToTeacher','pending', NULL ,'$university','$country','$faculty','$status')";

        if($sqldb->query($entryQuery))
            {

            }
        else
        {
            echo "$entryQuery";
            echo " Entry Unsuccessful";
        }
        // header("Refresh:0.5; url=student.php");
        header("Refresh:1; url=student.php");
    }
    ?>
</body>

</html>