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
    $dep = $_SESSION["department"];
    $name = $_SESSION["name"];
    // Teacher info
    echo "Welcome, $name<br>Department = $dep";

    // Search area for searching students records
    echo "
    <form method=\"POST\" action=\"search_studentdb.php\" >
    <input type =\"text\" name=\"name\" placeholder = \"Enter Name\">
    <br>
    <input type =\"text\" name=\"rollno\" placeholder = \"Enter Roll No.\">
    <br>
    <input type =\"text\" name=\"batch\" placeholder = \"Enter Batch\">
    <br>
    <input type =\"text\" name=\"department\" placeholder = \"Enter Department\"
    <br>
    <input type = \"submit\" value =\"Search\">
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