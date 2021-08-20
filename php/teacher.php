<?php session_start() ?>
<html>

<head>
    <title>HEAD-Teacher</title>
</head>
<script>
    function displayToggle(element) {
        var x = element.nextElementSibling;
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<style>
    .visi {
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
    <style>
        <?php include '../css/bootstrap.min.css'; ?><?php include '../css/teacher.css'; ?>
    </style>

    <!-- <title>Teacher</title> -->
</head>

<body>
    <div class="header form-row">

        <div class=" top-text form-group col-md-8">
            <h1>Institute of Engineering</h1>
            <h2>Pulchowk Campus</h2>
        </div>
        <div>
            <form class="logout form-group col-md-4" action="logout.php">
                <input class=" btn btn-primary btn-lg float-right" type="submit" value="Log Out">
                <a class="btn btn-primary btn-lg active change_p" href="changePassword.php">Change Password</a>
            </form>
        </div>
    </div>
    <div class="bg">
        <div class="welcome_part col-md-8">
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
        </div>


        <div class="generateLetter" contenteditable="true">
            <h2 style="background-color:rgb(16, 141, 214);width:65%">Generate Letter For:</h2>
            <form method="POST" action="recommendLetter.php">
                <input type="text" name="rollno" placeholder="Roll No.">
                <br>
                <br>
                <input class="btn btn-primary" type="submit" value="Generate Letter">
            </form>
        </div>

        <div class="application-details col-md-10" style="width: 50%; float: left;">
            <h2>Enter Application details:</h2>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>


        <form method="POST" action="search_studentdb.php">
            <div class="Appli-form" style="width:50%; float:left;">
                <div class=" form-row1">
                    <label for="name">name:</label><br>
                    <input type="text" name="name" id="name" placeholder="Enter Name">
                </div>
                <div class="form-row1">
                    <label for="rollno">rollno:</label><br>
                    <input type="text" name="rollno" placeholder="Enter Roll No.">
                </div>
                <div class="form-row1">
                    <label for="batch">Country:</label><br>
                    <input type="text" name="batch" placeholder="Enter Batch">
                </div>
                <div class="form-row1">
                    <label for="department">Country:</label><br>
                    <input type="text" name="department" placeholder="Enter Department">
                </div>
            </div>
            <div class="applied" style="width:50%; float:right;">
                <h2>Applied To: </h2>
                <div class=" form-row2">
                    <label for="country">Country:</label><br>
                    <input type="text" name="country" placeholder="Enter Country">
                </div>
                <div class="form-row2">
                    <label for="faculty">Country:</label><br>
                    <input type="text" name="faculty" placeholder="Enter Faculty">
                </div>
                <div class="form-row2">
                    <label for="university">Country:</label><br>
                    <input type="text" name="university" placeholder="Enter University">
                </div>
                <div class="form-row2">
                    <input class="btn btn-success btn-lg active submitB" type="submit" name="search_students" value="Search">
                </div>
            </div>
        </form>


        <br>
        <div class="Letter" style="position:relative;width:50%; float:left;">
            <h2>Recommendation Letter Requests</h2>


            <?php
            // Recommendation Letter//


            if (!$sqldb->select_db('higherEducationdb')) {
                die("not connected to database");
            }
            $name = $_SESSION['name'];
            $rollnoQuery = "SELECT rollno FROM university GROUP BY rollno HAVING COUNT(id) >=1";
            if ($vals = $sqldb->query($rollnoQuery)) {
            ?>
                <?php
                if (mysqli_num_rows($vals) > 0) {
                    echo "<ul>";
                    while ($vals_row = mysqli_fetch_assoc($vals)) {

                        $rollnoT = $vals_row['rollno'];

                ?>
                        <div class="olContainer">
                            <br>
                            <button class="btn btn-success" onclick="displayToggle(this)">

                                <li> <?php echo "$rollnoT"; ?></li>
                            </button>
                            <div class="visi">
                                <table>
                                    <tr>

                                        <th>University</th>
                                        <th>Country</th>
                                        <th>Faculty</th>
                                    </tr>

                                    <?php
                                    $rollnoT = $vals_row['rollno'];
                                    $tableQuery = "SELECT uname,country,faculty FROM university WHERE rollno = '$rollnoT' AND recommReq='$name' AND status!='approved' AND recStatus='pending'";

                                    if ($valsI = $sqldb->query($tableQuery)) {

                                        if (mysqli_num_rows($valsI) > 0) {

                                            while ($valsI_row = mysqli_fetch_assoc($valsI)) {
                                                $unameT = $valsI_row['uname'];
                                                $countryT = $valsI_row['country'];
                                                $facultyT = $valsI_row['faculty'];
                                    ?>
                                                <tr>

                                                    <td><?php echo "$unameT"; ?></td>
                                                    <td><?php echo "$countryT"; ?></td>
                                                    <td><?php echo "$facultyT"; ?></td>
                                                </tr>
                        <?php

                                            }
                                        }
                                        echo "</table></div></div>";
                                    } else {
                                        echo "records not found for $rollnoT";
                                    }
                                }
                                echo "</ul>";
                            }
                        } else {
                            echo "<br>Error running query";
                        }
                        ?>
                        <button class="btn btn-info" onclick="displayToggle(this)">Approved Requests</button>
                        <div class="Approved" style="display:none">
                            <?php
                            $tableQuery = "SELECT rollno,uname,country,faculty FROM university WHERE recommReq='$name' AND status!='approved' AND recStatus='approved' ORDER BY rollno";
                            ?><table>
                                <tr>
                                    <th>Roll No.</th>
                                    <th>University</th>
                                    <th>Country</th>
                                    <th>Faculty</th>
                                </tr><?php
                                        if ($valsI = $sqldb->query($tableQuery)) {

                                            if (mysqli_num_rows($valsI) > 0) {

                                                while ($valsI_row = mysqli_fetch_assoc($valsI)) {
                                                    $unameT = $valsI_row['uname'];
                                                    $rollnoVt = $valsI_row['rollno'];
                                                    $countryT = $valsI_row['country'];
                                                    $facultyT = $valsI_row['faculty'];
                                        ?>
                                            <tr>
                                                <td><?php echo "$rollnoVt"; ?></td>
                                                <td><?php echo "$unameT"; ?></td>
                                                <td><?php echo "$countryT"; ?></td>
                                                <td><?php echo "$facultyT"; ?></td>
                                            </tr>
                                <?php
                                                }
                                            }
                                            echo "</table></div></div>";
                                        } else {
                                            echo "records not found for $rollnoT";
                                        }
                                ?>
                            </table>
                        </div><?php
                                ?>
                            </div>



</body>

</html>