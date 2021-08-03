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
    $dep = $_SESSION["department"];
    $name = $_SESSION["name"];
    // Teacher info
    echo "Welcome, $name<br>Department :$dep";

    // Search area for searching students records
    echo "
    <form method=\"POST\" action=\"search_studentdb.php\" >
    <input type =\"text\" name=\"name\" placeholder = \"Enter Name\">
    <br>
    <input type =\"text\" name=\"rollno\" placeholder = \"Enter Roll No.\">
    <br>
    <input type =\"text\" name=\"batch\" placeholder = \"Enter Batch\">
    <br>
    <input type =\"text\" name=\"department\" placeholder = \"Enter Department\">
    <br>
    <h2>Applied To: </h2>
    <input type =\"text\" name=\"country\" placeholder = \"Enter Country\">
    <br>
    <input type =\"text\" name=\"faculty\" placeholder = \"Enter Faculty\">
    <br>
    <input type =\"text\" name=\"university\" placeholder = \"Enter University\">
    <br>
    <input type = \"submit\" name=\"search_students\" value =\"Search\">
    
    </form>";

    // Recommendation Letter
    echo "
    <h2>Recommendation Letter</h2>
    <form method=\"POST\" action=\"recommend_letter.php\" >
    <input type =\"text\" name=\"rollno\" placeholder = \"Enter Roll No.\">
    <br>
    <input type = \"submit\" value =\"Generate Letter\">
    </form>
    ";
    ?>
</body>

</html>