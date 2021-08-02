<?php session_start() ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Higher Education Management</title>
    <!-- google fonts cdn link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- custom css file link-->
    <link rel="stylesheet" href="style.css">
    <!-- <title>Teacher</title> -->
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