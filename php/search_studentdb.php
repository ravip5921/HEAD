<?php session_start(); ?>
<html>
<style>
    <?php include '../css/search.css'; ?>
</style>
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
            $search_criterias_university[] = "`university`.`rollno` LIKE '$batch%'";
        }
        if ($department !== '') {
            $search_criterias_student[] = "`student`.`rollno` LIKE '%$department%'";
            $search_criterias_university[] = "`university`.`rollno` LIKE '%$department%'";
        }
    }
    if ($name !== '') {
        $search_criterias_student[] = "`student`.`name` = '$name'";
    }


    if ($university !== '') {
        $search_criterias_university[] = "`university`.`uname` = '$university'";
    }
    if ($faculty !== '') {
        $search_criterias_university[] = "`university`.`faculty` = '$faculty'";
    }
    if ($country !== '') {
        $search_criterias_university[] = "`university`.`country` = '$country'";
    }

    //SELECT student.name, ... FROM student INNER JOIN university ON student.rollno = university.rollno

    //$search_query = "SELECT * FROM `student` , `university` WHERE ";

    $search_query = "SELECT * FROM student INNER JOIN university ON student.rollno = university.rollno WHERE ";

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
                        <th>Roll No.</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>University</th>
                        <th>Faculty</th>
                        <th>Country</th>
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
                            if ($flag == 1) {
                                $flag = 0;
                            } else {
                                echo "</div>";
                            }
                            // echo "$rollnoV";
                            $rn = $rollnoV;

                            echo "<button onclick=\"displayToggle(this)\">$rollnoV</button>
                            <div id=\"$rollnoV\">";
                        }
                    ?>
                        <div>
                            <tr>
                                <td><?php echo "$rollnoV"; ?></td>
                                <td><?php echo "$nameV"; ?></td>
                                <td><?php echo "$dobV"; ?></td>
                                <td><?php echo "$unameV"; ?></td>
                                <td><?php echo " $facultyV"; ?></td>
                                <td><?php echo "$countryV"; ?></td>
                            </tr>
                        </div>
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
            ?><br><button id="returnButton">Return</button>
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

</html>