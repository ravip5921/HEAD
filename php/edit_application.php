<?php session_start(); ?>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Edit Application</h1>
    <?php

    include 'connect_todb.php';

    if (!$sqldb->select_db('higherEducationdb')) {
        die("not connected to database");
    }

    // Application Details

    // $unameE = $_SESSION["EditUname"];
    $facultyE = $_SESSION["EditFaculty"];
    $rollnoE = $_SESSION["rollno"];

    $unameE = $_GET["uname"];
    echo "$unameE $facultyE $rollnoE";

    $applicationQuery = "SELECT country,status,requestR FROM university WHERE uname='$unameE' AND faculty = '$facultyE'";
    if ($vals = $sqldb->query($applicationQuery)) {
        $vals_row = mysqli_fetch_assoc($vals);
        $statusE = $vals_row['status'];
        echo "$statusE";
    }
    // $entryQuery = "INSERT INTO university (`uname`,`country`,`rollno`,`faculty`,`recommReq`,`status`) VALUES ('$university','$country','$rollno','$faculty','$RecommendToTeacher','$status')";

    $sqldb->query($applicationQuery);
    // header("Refresh:0.5; url=student.php");

    echo "<br><button id=\"returnButton\">Return</button>
    <script>
        var btn = document.getElementById('returnButton');
        btn.addEventListener('click', function() {
            document.location.href = 'student.php';
        });
    </script>";

    ?>
</body>

</html>