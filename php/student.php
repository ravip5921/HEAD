<?php session_start() ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<html>

<head>
    <script src="../js/a.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEAD-Student</title>
    <style>
        <?php include '../css/bootstrap.min.css'; ?><?php include '../css/student.css'; ?>
    </style>

</head>
<!--  *********************************************   HEAD END   ************************************************************************** -->

<body>
    <div class="header ">
        <div class=" top-text">
            <div class="text-top1">Institute of Engineering</div>
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
        <div class="application-details ">Enter Application details:</div>
        
        <form method="POST" action="add_application.php" class="main-form">
            <div class="form-row">
                <div class="form-group university">
                    <label for="inputuniversity4">University:</label>
                    <input type="text" id="u" name="university" placeholder="University" class="form-control">
                </div>
                <div class="form-group country">
                    <label for="inputcountry4">Country:</label>
                    <input type="text" id="c" name="country" placeholder="Country" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group faculty">
                    <label for="inputfaculty4">Faculty:</label>
                    <input type="text" id="f" name="faculty" placeholder="Faculty" class="form-control">
                </div>
            </div>
            <!-- <div class="form-row">
                <div class="form-group status">
                    <label for="inputstatus4">Application Status:</label>
                    <input type="text" id="f" name="status" placeholder="status" class="form-control">
                </div>
            </div> -->
            <?php
            
            if (!$sqldb->select_db('higherEducationdb')) {
                die("not connected to database");
            }
            $teacherQuery = "SELECT uname FROM teacher ORDER BY uname ASC";
            if ($valsT = $sqldb->query($teacherQuery)) {
            ?>
                <div class="form-row">
                    <div class="form-group recommendation-label">
                        <h3>Request for Recommendation Letter:</h3>
                    </div>
                    <div class="form-group dropBox  form-control">
                        <?php
                        if (mysqli_num_rows($valsT) > 0) {
                        ?>
                            <select id="editable_Select" name="requestR">
                                <?php
                                while ($vals_rowT = mysqli_fetch_assoc($valsT)) {
                                ?>
                                    <option><?php echo $vals_rowT['uname']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="form-row">
                <div class="form-group university">
                    <input class="btn btn-primary" type="submit" value="Add Application">
                </div>
            </div>
        </form>

        <?php
        // Display section for student's applications
        if (!$sqldb->select_db('higherEducationdb')) {
            die("not connected to database");
        }
        $sn = 1;
        $applicationQuery = "SELECT uname,country,faculty,uniastatus,recdate,id,teacher,recstatus FROM recommendation WHERE rollno='$rollno'";
        if ($vals = $sqldb->query($applicationQuery)) {

        ?>

            <table>
                <tr>
                    <!-- <th>S.N.</th> -->
                    <th>University</th>
                    <th>Country</th>
                    <th>Faculty</th>
                    <th>Status</th>
                    <th>Teacher</th>
                    <th>Recommendation</th>
                    <th>Date</th>
                </tr>
                <?php

                if (mysqli_num_rows($vals) > 0) {

                    while ($vals_row = mysqli_fetch_assoc($vals)) {
                        $unameT = $vals_row['uname'];
                        $countryT = $vals_row['country'];
                        $facultyT = $vals_row['faculty'];
                        $statusT = $vals_row['uniastatus'];
                        $teacherT = $vals_row['teacher'];
                        $recStatT = $vals_row['recstatus'];
                        $dateT = $vals_row['recdate'];
                        $id = $vals_row['id'];
                ?>

                        <tr>
                            <!-- <td>
                            <div>
                                php echo $sn
                            </div>
                        </td> -->
                            <!-- <td>
                                <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'uname','<?/*php echo $id */?>')"><?/*php echo $unameT;*/ ?></div>
                            </td>
                            <td>
                                <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'faculty','<?/*php echo $id*/ ?>')"><?/*php echo $facultyT;*/ ?></div>
                            </td>
                            <td>
                                <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'country','<?/*php echo $id*/ ?>')"><?/*php echo $countryT;*/ ?></div>
                            </td>
                            <td>
                                <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'uniastatus','<?/*php echo $id*/ ?>')"><?/*php echo $statusT;*/ ?></div>
                            </td>-->
                             <!-- <td>
                                <div contenteditable="false" onclick="activateVar(this)" onblur="editVar(this,'teacher','<?//php echo $id ?>')"><?//php echo $teacherT; ?></div>
                            </td> -->
                            <td>
                                <div contenteditable="false"><?php echo $unameT; ?></div>
                            </td>
                            <td>
                                <div contenteditable="false"><?php echo $facultyT; ?></div>
                            </td>
                            <td>
                                <div contenteditable="false"><?php echo $countryT; ?></div>
                            </td>
                            <!-- <td>
                                <div contenteditable="true" onclick="activateVar(this)" onblur="editVar(this,'uniastatus','<?php //echo $id ?>')"><?php //echo $statusT; ?></div>
                            </td> -->
                            <td>
                            <?php
            if (!$sqldb->select_db('higherEducationdb')) {
                die("not connected to database");
            }
            $teacherQuery = "SELECT id,status FROM universityStatus ORDER BY id ASC";
            if ($valsT = $sqldb->query($teacherQuery)) {
            ?>
                <div class="form-row">
                    <div class="form-group dropBox  form-control">
                        <?php
                        if (mysqli_num_rows($valsT) > 0) {
                        ?>
                            <select id="editable_Select_Uni" name="status" onChange = "editUniStat(<?php echo $id?>)">
                            <script>
                                function editUniStat(id) {
                                            console.log("bolayo");
                                            var myId = document.getElementById("editable_Select_Uni");
                                            
                                            var value = myId.options[myId.selectedIndex].value;
                                            
                                            $.ajax({
                                                url: "edit_application.php",
                                                type: "post",
                                                data: {
                                                value: value,
                                                column: 'uniastatus',
                                                id: id,
                                                },
                                                success: function (php_result) {
                                                console.log(php_result);
                                                
                                                },
                                            });
                                            }
                            </script>
                                <?php
                                while ($vals_rowT = mysqli_fetch_assoc($valsT)) {
                                ?>
                                    <option value="<?php echo $vals_rowT['id'];?>" <?php 
                                    if ($vals_rowT['id'] == $statusT) 
                                    {
                                        echo"selected";
                                    } 
                                    // else 
                                    // {
                                        
                                    // } 
                                    
                                    ?>><?php echo $vals_rowT['status']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
                    </td>
                            <td>
                                <div contenteditable="false"><?php echo $teacherT; ?></div>
                            </td>
                            <td>
                                <div contenteditable="false"><?php echo $recStatT; ?></div>
                            </td>
                            <td>
                                <div contenteditable="false"><?php echo $dateT; ?></div>
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
    </div>
</body>

</html>


<!-- ALTER TABLE tableName ADD id MEDIUMINT NOT NULL AUTO_INCREMENT KEY -->

<!-- ALTER TABLE university DROP COLUMN id -->
