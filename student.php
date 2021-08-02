<?php session_start() ?>
<html>

<head>
    <title>Teacher</title>
</head>

<body>
    <h1>Institute of Engineering</h1>
    <h2>Pulchowk Campus</h2>
    <?php
    // $dep = $_GET['department'];
    // $name = $_GET['name'];
    $rollno = $_SESSION["rollno"];
    $name = $_SESSION["name"];
    $dob = $_SESSION["dob"];
    // Teacher info
    echo "Welcome, $name<br>Roll No. = $rollno<br>Date of Birth = $dob";

    // Search area for students
    echo "
    <form method=\"POST\" action=\"search_studentdb.php\" >
    <input type=\"text\" name=\"semester\" placeholder = \"Enter Semester\">
    <input type = \"submit\" value =\"Check\">
    </form>";
    ?>
</body>

</html>