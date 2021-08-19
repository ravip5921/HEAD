<?php session_start() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="jquery-editable-select.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="jquery-editable-select.min.js"></script>

<html>

<head>
    <script src="../js/a.js"></script>
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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/student.css"> -->
    <style>
        <?php include '../css/student.css'; ?>
    </style>



</head>
<!--  *********************************************   HEAD END   ************************************************************************** -->

<body>
    <div class="header">
        <h1>Institute of Engineering</h1>
        <h2>Pulchowk Campus</h2>
        <div>
            <form class="logout" action="logout.php">
                <input type="submit" value="Log Out">
            </form>
        </div>
    </div>

    <div class="welcome_part">
        <?php
        include 'connect_todb.php';
        // $dep = $_GET['department'];
        // $name = $_GET['name'];
        $rollno = $_SESSION["rollno"];
        $name = $_SESSION["name"];
        $dob = $_SESSION["dob"];

        // Teacher info
        ?>
        <br>Welcome, <?php echo "$name"; ?>
        <br><br>Roll No. : <?php echo "$rollno"; ?>
        <br><br>Date of Birth : <?php echo "$dob"; ?>

        <!-- Search area for students -->

    </div>
    <div class="application-details">
        <h3>Enter Application details</h3>
    </div>


    <form method="POST" action="add_application.php">
        <div class="form-row">
            <input type="text" id="u" name="university" placeholder="University">
        </div>
        <div class="form-row">
            <div clas="form-col ">
                <input type="text" id="c" name="country" placeholder="Country">
            </div>
            <div class="form-col">
                <input type="text" id="f" name="faculty" placeholder="Faculty">
            </div>
        </div>
        <div clas="form-row">
            <input type="text" name="status" placeholder="Application Status">
        </div>
        <div class="form-row">
            <div class="form-col ">
                <h3>Request for Recommendation Letter</h3>
            </div>
            <div class="form-col ">
                <!-- <input type="text" name="requestR" placeholder="Request to"> -->
                <select id="editable_Select" name="RequestR">
                    <option>Aman</option>
                    <option>Bibha</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <input type="submit" value="Add Application">
        </div>
    </form>

    <?php
    // Display section for student's applications
    if (!$sqldb->select_db('higherEducationdb')) {
        die("not connected to database");
    }
    $sn = 1;
    $applicationQuery = "SELECT uname,country,faculty,status,id FROM university WHERE rollno='$rollno'";
    if ($vals = $sqldb->query($applicationQuery)) {

    ?>

        <table>
            <tr>
                <!-- <th>S.N.</th> -->
                <th>University</th>
                <th>Country</th>
                <th>Faculty</th>
                <th>Status</th>
            </tr>
            <?php

            if (mysqli_num_rows($vals) > 0) {

                while ($vals_row = mysqli_fetch_assoc($vals)) {
                    $unameT = $vals_row['uname'];
                    $countryT = $vals_row['country'];
                    $facultyT = $vals_row['faculty'];
                    $statusT = $vals_row['status'];
                    $id = md5($vals_row['id']);
            ?>

                    <tr>
                        <!-- <td>
                            <div>
                                php echo $sn
                            </div>
                        </td> -->
                        <td>
                            <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'uname','<?php echo $id ?>')"><?php echo $unameT; ?></div>
                        </td>
                        <td>
                            <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'faculty','<?php echo $id ?>')"><?php echo $facultyT; ?></div>
                        </td>
                        <td>
                            <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'country','<?php echo $id ?>')"><?php echo $countryT; ?></div>
                        </td>
                        <td>
                            <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'status','<?php echo $id ?>')"><?php echo $statusT; ?></div>
                        </td>


                    </tr>
        <?php
                    $sn = $sn + 1;
                }

                echo "</table>";
            }
        } else {
            echo "<br>Error running query";
        }

        ?>

        </table>
</body>

</html>


<!-- ALTER TABLE tableName ADD id MEDIUMINT NOT NULL AUTO_INCREMENT KEY -->

<!-- ALTER TABLE university DROP COLUMN id -->