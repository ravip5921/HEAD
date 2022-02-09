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
    
    $RecommendToTeacher = $_POST["requestR"];
    if ($university == "" or $faculty == "" or $country == "") {
    ?>
        <script>
            alert("Enter details");
        </script>
    <?php
        header("Refresh:0; url=student.php");
    } else {
    ?><h1>Applying.........</h1>
    <?php
        $statusQuery = "SELECT id from universityStatus WHERE status = 'Not Applied'";
        $stat = $sqldb->query($statusQuery);
        $statusRes = mysqli_fetch_assoc($stat);
        $statusId = $statusRes['id'];
        echo "$name ,$dob ,$rollno applied for $faculty at $university in $country and the application status is $statusId";
        // $entryQuery = "INSERT INTO recommedation (`uname`,`country`,`rollno`,`faculty`,`teacher`,`uniastatus`,`recstatus`,`recdate`) VALUES ('$university','$country','$rollno','$faculty','$RecommendToTeacher','$status','pending',NULL)";
        $entryQuery = "INSERT INTO recommendation (`rollno`,`teacher`,`recstatus`,`recdate`,`uname`,`country`,`faculty`,`uniastatus`) VALUES ('$rollno','$RecommendToTeacher','pending', NULL ,'$university','$country','$faculty',$statusId)";

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