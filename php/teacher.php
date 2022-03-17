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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    
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
    <div class="header ">
        <div class=" top-text">
            <div class="text-top1">Institute Of Engineering</div>
            <div class="text-top2">Pulchowk Campus</div>
        </div>
        <div>
            <form class="logout" action="logout.php">
                <input class=" btn btn-primary btn-lg " type="submit" value="Log Out">
                <a class="btn btn-primary btn-lg change_p" href="changePassword.php">Change Password</a>
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
        
        <div class="application-details">Enter Application details:</div>
        <form method="POST" action="search_studentdb.php">
            <div class="Appli-form" >
                <div class="form-row1">
                    <label for="name">name:</label><br>
                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control">
                </div>
                <div class="form-row1">
                    <label for="rollno">rollno:</label><br>
                    <input type="text" name="rollno" placeholder="Enter Roll No." class="form-control">
                </div>
                <div class="form-row1">
                    <label for="batch">Batch:</label><br>
                    <input type="text" name="batch" placeholder="Enter Batch" class="form-control">
                </div>
                <div class="form-row1">
                    <label for="department">Department:</label><br>
                    <input type="text" name="department" placeholder="Enter Department" class="form-control">
                </div>
            </div>

            <div class="applied">
                <div class="applied-text">Applied To: </div>
                <div class=" form-row2">
                    <label for="country">Country:</label><br>
                    <input type="text" name="country" placeholder="Enter Country" class="form-control">
                </div>
                <div class="form-row2">
                    <label for="faculty">Faculty:</label><br>
                    <input type="text" name="faculty" placeholder="Enter Faculty" class="form-control">
                </div>
                <div class="form-row2">
                    <label for="university">University:</label><br>
                    <input type="text" name="university" placeholder="Enter University" class="form-control">
                </div>
                <div>
                    <?php
                    if (!$sqldb->select_db('higherEducationdb')) {
                    die("not connected to database");
                    }
                    $statusQuery = "SELECT id,status FROM universityStatus ORDER BY id ASC";
                    if ($valsT = $sqldb->query($statusQuery)) {
                    ?>
                        <div class="form-row">
                            <div class="form-group dropBox  form-control">
                                <?php
                                if (mysqli_num_rows($valsT) > 0) {
                                ?>
                                    <select id="editable_Select_Uni" name="status" onChange = "editUniStat(<?php echo $id?>)">
                                    <?php
                                while ($vals_rowT = mysqli_fetch_assoc($valsT)) {
                                ?>
                                    <option value="<?php echo $vals_rowT['id'];?>" <?php 
                                    // if ($vals_rowT['id'] == $statusT) 
                                    // {
                                    //     echo"selected";
                                    // } 
                                    ?>><?php echo $vals_rowT['status']; ?></option>
                                <?php
                                }
                            }
                        }
                                ?>
                                </select>
                            </div>
                        </div>

                    
                </div>
                <div class="form-row2">
                    <input class="btn btn-success btn-lg active submitB" type="submit" name="search_students" value="Search" class="form-control">
                </div>
            </div>
        </form>

        <div class="generateLetter" contenteditable="true">
            <div class="generate-label">Generate Letter For:</div>
            <form method="POST" action="recommendLetter.php">
                <input type="text" name="rollno" placeholder="Roll No." class="form-control">
                <input type="text" name="university" placeholder="University" class="form-control">
                <input type="hidden" name="teacher" value ="<?php $_SESSION["name"];?>">
                <input type="hidden" name="recdate" value ="zd">
                <input class="btn btn-primary" type="submit" value="Generate Letter">
                
            </form>
        </div>
        <br>
        <div class="Letter">
            <h2>Recommendation Letter Requests:</h2>
            <?php
            // Recommendation Letter//

            if (!$sqldb->select_db('higherEducationdb')) {
                die("not connected to database");
            }
            $name = $_SESSION['name'];
            $rollnoQuery = "SELECT `rollno` FROM `recommendation` WHERE 1 GROUP BY `rollno`";
            
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
                                    $tableQuery = "SELECT uname,country,faculty FROM recommendation WHERE rollno = '$rollnoT' AND teacher='$name' AND uniastatus!='approved' AND recstatus='pending'";

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
                            $tableQuery = "SELECT rollno,uname,country,faculty,recdate FROM recommendation WHERE teacher='$name' AND uniastatus!='approved' AND recstatus='approved' ORDER BY rollno";
                            ?><table>
                                <tr>
                                    <th>Roll No.</th>
                                    <th>University</th>
                                    <th>Country</th>
                                    <th>Faculty</th>
                                    <th>Approved Date</th>
                                </tr><?php
                                        if ($valsI = $sqldb->query($tableQuery)) {

                                            if (mysqli_num_rows($valsI) > 0) {

                                                while ($valsI_row = mysqli_fetch_assoc($valsI)) {
                                                    $unameT = $valsI_row['uname'];
                                                    $rollnoVt = $valsI_row['rollno'];
                                                    $countryT = $valsI_row['country'];
                                                    $facultyT = $valsI_row['faculty'];
                                                    $recApprovDateT = $vals_row['recdate'];
                                        ?>
                                            <tr>
                                                <td><?php echo "$rollnoVt"; ?></td>
                                                <td><?php echo "$unameT"; ?></td>
                                                <td><?php echo "$countryT"; ?></td>
                                                <td><?php echo "$facultyT"; ?></td>
                                                <td><?php echo "$recApprovDateT"; ?></td>
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
