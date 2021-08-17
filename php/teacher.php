<?php session_start() ?>
<html>
<script>
    function displayToggle() {
        var x = document.getElementById("show_hide");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<style>
    .vis {
        display: none
    }

    button {
        background: lightgrey;
        /* border: none; */
        border: 1px solid #ccc;
        color: green;
    }
</style>

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
    <!-- <link rel="stylesheet" href="../css/teacher.css"> -->
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
    ?>
    <!-- Search area for searching students records -->

    <form method="POST" action="search_studentdb.php">
        <input type="text" name="name" id="name" placeholder="Enter Name">
        <br>
        <input type="text" name="rollno" placeholder="Enter Roll No.">
        <br>
        <input type="text" name="batch" placeholder="Enter Batch">
        <br>
        <input type="text" name="department" placeholder="Enter Department">
        <br>
        <h2>Applied To: </h2>
        <input type="text" name="country" placeholder="Enter Country">
        <br>
        <input type="text" name="faculty" placeholder="Enter Faculty">
        <br>
        <input type="text" name="university" placeholder="Enter University">
        <br>
        <input type="submit" name="search_students" value="Search">

    </form>
    <?php
    // Recommendation Letter
    echo "
    <h2>Recommendation Letter Requests</h2>";

    if (!$sqldb->select_db('higherEducationdb')) {
        die("not connected to database");
    }
    $name = $_SESSION['name'];
    $rollnoQuery = "SELECT rollno FROM university GROUP BY rollno HAVING COUNT(id) >=1";
    if ($vals = $sqldb->query($rollnoQuery)) {
    ?>
        <?php
        if (mysqli_num_rows($vals) > 0) {
            echo "<ol>";
            while ($vals_row = mysqli_fetch_assoc($vals)) {
                $sn = 1;
                $rollnoT = $vals_row['rollno'];

        ?>
                <button onclick="displayToggle()">
                    <li><?php echo "$rollnoT"; ?></li>
                </button>

                <div id="show_hide" class="visi">
                    <table>
                        <tr>
                            <th>S.N.</th>
                            <th>University</th>
                            <th>Country</th>
                            <th>Faculty</th>
                        </tr>

                        <?php
                        $rollnoT = $vals_row['rollno'];
                        $tableQuery = "SELECT uname,country,faculty FROM university WHERE rollno = '$rollnoT' AND recommReq='$name' AND status!='approved'";

                        if ($valsI = $sqldb->query($tableQuery)) {

                            if (mysqli_num_rows($valsI) > 0) {

                                while ($valsI_row = mysqli_fetch_assoc($valsI)) {
                                    $unameT = $valsI_row['uname'];
                                    $countryT = $valsI_row['country'];
                                    $facultyT = $valsI_row['faculty'];
                        ?>
                                    <tr>
                                        <td><?php echo "$sn"; ?></td>
                                        <td><?php echo "$unameT"; ?></td>
                                        <td><?php echo "$countryT"; ?></td>
                                        <td><?php echo "$facultyT"; ?></td>
                                    </tr>
            <?php
                                    $sn = $sn + 1;
                                }
                            }
                            echo "</table></div>";
                        } else {
                            echo "records not found for $rollnoT";
                        }
                    }
                    echo "</ol>";
                }
            } else {
                echo "<br>Error running query";
            }

            echo "<form method=\"POST\" action=\"recommend_letter.php\" >
    <input type =\"text\" name=\"rollno\" placeholder = \"Enter Roll No.\">
    <br>
    <input type = \"submit\" value =\"Generate Letter\">
    </form>
    ";
            ?>
</body>

</html>