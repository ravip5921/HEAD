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
    <link rel="stylesheet" href="../css/teacher.css">
    <!-- <title>Teacher</title> -->
</head>

<body>
    <h1>Institute of Engineering</h1>
    <h2>Pulchowk Campus</h2>
    <?php
    include 'connect_todb.php';


    // $dep = $_GET['department'];
    // $name = $_GET['name'];
    $dep = $_SESSION["department"];
    $name = $_SESSION["name"];
    // Teacher info
    echo "<br>Welcome, $name<br>Department :$dep";

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
    <h2>Recommendation Letter Requests</h2>";

    if (!$sqldb->select_db('higherEducationdb')) {
        die("not connected to database");
    }
    $name = $_SESSION['name'];
    $sn = 1;
    $tableQuery = "SELECT rollno,uname,country,faculty FROM university WHERE recommReq='$name' AND status!='approved'";
    if ($vals = $sqldb->query($tableQuery)) {
        echo "<table>
        <tr>
        <th>S.N.</th>
        <th>Roll no</th>
        <th>University</th>
        <th>Country</th>
        <th>Faculty</th>
        </tr>";
        if (mysqli_num_rows($vals) > 0) {

            while ($vals_row = mysqli_fetch_assoc($vals)) {
                $rollnoT = $vals_row['rollno'];
                $unameT = $vals_row['uname'];
                $countryT = $vals_row['country'];
                $facultyT = $vals_row['faculty'];
                echo "
                <tr>
                <td>$sn</td>
                <td>$rollnoT</td>
                <td>$unameT</td>
                <td>$countryT</td>
                <td>$facultyT</td>
                </tr>";
                $sn = $sn + 1;
            }
        }
    } else {
        echo "<br>Error running query";
    }


    ?>
    <?php
    echo "<form method=\"POST\" action=\"recommend_letter.php\" >
    <input type =\"text\" name=\"rollno\" placeholder = \"Enter Roll No.\">
    <br>
    <input type = \"submit\" value =\"Generate Letter\">
    </form>
    ";
    ?>
</body>

</html>