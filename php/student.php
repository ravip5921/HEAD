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
    <link rel="stylesheet" href="../style.css">
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

    <p><h3>Apply to University</h3></p>
    <form method=\"POST\" action=\"add_application.php\" >
    <input type=\"text\" name=\"university\" placeholder = \"Enter University\"><br><br>
    <input type=\"text\" name=\"country\" placeholder = \"Enter Country\"><br><br>
    <input type=\"text\" name=\"faculty\" placeholder = \"Enter Faculty\"><br><br>
    <h2>Request for Recommendation Letter</h2>
    <input type=\"text\" name=\"requestR\" placeholder = \"Request to\"><br><br>
    <input type = \"submit\" value =\"Apply\">
    </form>";

    // Display section for student's applications
    echo "
    <p>
    need to search db and display</p>
    ";
    ?>
</body>

</html>