<?php session_start(); ?>
<html>
<style>
    <?php include '../css/search.css'; ?><?php include '../css/bootstrap.min.css'; ?>
</style>
<script>
    function displayToggle(ElementClass) {

        var x = document.getElementsByClassName(ElementClass);
        var elem;
        for (i = 1; i < x.length; i++) {
            console.log(x[i].style.display);
            // if (x[i] != element) {
            if (x[i].style.display == "none") {
                x[i].style.display = "table-row";
            } else {
                x[i].style.display = "none";
            }

            // }
        }
    }
</script>

<body>
   
    <div class="header form-row">
        <div class="navbar">
            <h1>Institute of Engineering</h1>
            <h2>Pulchowk Campus</h2>
        </div>
    </div>
     <div class="bg">
    <?php
    require 'connect_todb.php';

    if (isset($_POST['search_students'])) {
        if (!$sqldb->select_db('higherEducationdb')) {
            die("not connected to database");
        }

        $rollno = $_POST["rollno"];
        $name = $_POST["name"];
        $batch = $_POST["batch"];
        $department = $_POST["department"];

        $university = $_POST["university"];
        $faculty = $_POST["faculty"];
        $country = $_POST["country"];

        $search_criterias_student = array();
        $search_criterias_university = array();


        if ($rollno !== '') {
            $search_criterias_student[] = "`student`.`rollno` = '$rollno'";
        } else {
            if ($batch !== '') {
                $search_criterias_student[] = "`student`.`rollno` LIKE '$batch%'";
                $search_criterias_university[] = "`recommendation`.`rollno` LIKE '$batch%'";
            }
            if ($department !== '') {
                $search_criterias_student[] = "`student`.`rollno` LIKE '%$department%'";
                $search_criterias_university[] = "`recommendation`.`rollno` LIKE '%$department%'";
            }
        }
        if ($name !== '') {
            $search_criterias_student[] = "`student`.`name` = '$name'";
        }


        if ($university !== '') {
            $search_criterias_university[] = "`recommendation`.`uname` = '$university'";
        }
        if ($faculty !== '') {
            $search_criterias_university[] = "`recommendation`.`faculty` = '$faculty'";
        }
        if ($country !== '') {
            $search_criterias_university[] = "`recommendation`.`country` = '$country'";
        }

        //SELECT student.name, ... FROM student INNER JOIN university ON student.rollno = university.rollno

        //$search_query = "SELECT * FROM `student` , `university` WHERE ";

        $search_query = "SELECT * FROM student INNER JOIN recommendation ON student.rollno = recommendation.rollno WHERE ";

        $search_criteria = array_merge($search_criterias_student, $search_criterias_university);
        $search_criteria = implode(" AND ", $search_criteria);
        if ($search_criteria === '') {
            $search_criteria = '1';
        }

        $search_query .= $search_criteria . " ORDER BY student.rollno";
        // echo "<p>" . $search_query . "</p>";
        $flag = 1;
        $rn = "";
        if ($result = $sqldb->query($search_query)) {
            if (mysqli_num_rows($result) > 0) {
    ?>
                <div>
                    <h1>Student Applications</h1><br><br>
                    <table>
                        <tr>
                            <th style="text-align:center;">Roll No.</th>
                            <th style="text-align:center;">Name</th>
                            <th style="text-align:center;">Date of Birth</th>
                            <th style="text-align:center;">University</th>
                            <th style="text-align:center;">Faculty</th>
                            <th style="text-align:center;">Country</th>
                        </tr>
                        <?php
                        //create table afterwards
                        while ($result_row = mysqli_fetch_assoc($result)) {

                            $rollnoV = $result_row['rollno'];
                            $nameV = $result_row['name'];
                            $dobV = $result_row['dob'];
                            $unameV = $result_row['uname'];
                            $facultyV = $result_row['faculty'];
                            $countryV = $result_row['country'];
                            if ($rn != $rollnoV) {
                                $rn = $rollnoV;

                                echo "<tr><td style=\"text-align:center;\"><button class =\"$rollnoV btn btn-success\"  onclick=\"displayToggle('$rollnoV')\">$rollnoV</button></td></tr>";
                            }
                        ?>

                            <tr style="display:none" class="<?php echo "$rollnoV"; ?>">
                                <td style="text-align:center;"><?php echo "$rollnoV"; ?></td>
                                <td style="text-align:center;"><?php echo "$nameV"; ?></td>
                                <td style="text-align:center;"><?php echo "$dobV"; ?></td>
                                <td style="text-align:center;"><?php echo "$unameV"; ?></td>
                                <td style="text-align:center;"><?php echo " $facultyV"; ?></td>
                                <td style="text-align:center;"><?php echo "$countryV"; ?></td>
                            </tr>

                <?php
                            // echo "<p>" . $result_row['rollno'] . " | " . $result_row['name'] . " | " . " | " . $result_row['dob'] . " | "
                            //     . $result_row['uname'] . " | " . $result_row['faculty'] . " | " . $result_row['country'] . "</p>";
                        }
                        echo "</table></div>";
                    } else {
                        echo "<p>No result matching given criterias</p>";
                    }
                } else {
                    echo "<p>Couldn't search " . $sqldb->error . "</p>";
                }
            } else {
                echo "<p>No data recieved to search for student</p>";
            }

            if ($_SESSION["userType"] == "teacher") {
                // echo "Hi Teacher";
                ?><br><button class="btn btn-warning" id="returnButton">Return</button>
                <script>
                    var btn = document.getElementById('returnButton');
                    btn.addEventListener('click', function() {
                        document.location.href = 'teacher.php';
                    });
                </script><?php
                            // header("Refresh:1; url=teacher.php");
                        } else { //if ($_SESSION["userType"] == "admin") {
                            echo "Hi Admin";
                            // header("Refresh:1; url=teacher.php");
                        }
                            ?>
                            </div>
</body>

</html>
