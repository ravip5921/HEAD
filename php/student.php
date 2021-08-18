<?php session_start() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <!-- <title>Teacher</title> -->
</head>

<body>
    <h1>Institute of Engineering</h1>
    <h2>Pulchowk Campus</h2>





    <?php
    include 'connect_todb.php';
    // $dep = $_GET['department'];
    // $name = $_GET['name'];
    $rollno = $_SESSION["rollno"];
    $name = $_SESSION["name"];
    $dob = $_SESSION["dob"];
    // Teacher info
    echo "Welcome, $name<br>Roll No. = $rollno<br>Date of Birth = $dob";

    // Search area for students
    ?>

    <p>
    <h3>Enter Application details</h3>
    </p>
    <script>
        function isEmpty(element) {
            var val = element.innerText
            if (val == "")
                return true
            return false
        }

        function checkVals() {
            if (isEmpty("u") && isEmpty("c") && isEmpty("f")) {
                alert()
            }
        }
    </script>
    <form method="POST" action="add_application.php">
        <input type="text" id="u" name="university" placeholder="University"><br><br>
        <input type="text" id="c" name="country" placeholder="Country"><br><br>
        <input type="text" id="f" name="faculty" placeholder="Faculty"><br><br>
        <input type="text" name="status" placeholder="Application Status"><br><br>

        <h2>Request for Recommendation Letter</h2>
        <input type="text" name="requestR" placeholder="Request to"><br><br>
        <input type="submit" value="Add Application" onclick="checkVals()">
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

        <!-- <script>
        var btn = document.getElementById('editA.sn');
        btn.addEventListener('click', edit(this));
    </script> -->
</body>

</html>


<!-- ALTER TABLE tableName ADD id MEDIUMINT NOT NULL AUTO_INCREMENT KEY -->

<!-- ALTER TABLE university DROP COLUMN id -->