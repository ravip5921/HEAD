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

    $search_criterias_student = array();


    if ($rollno !== '') {
        $search_criterias_student[] = "`student`.`rollno` = '$rollno'";
    } else {
        if ($batch !== '') {
            if (substr($batch, 0, 1) != '0') {
                $batch = '0' . $batch;
            }
            $search_criterias_student[] = "`student`.`rollno` LIKE '$batch%'";
        }
        if ($department !== '') {
            $search_criterias_student[] = "`student`.`rollno` LIKE '%$department%'";
        }
    }
    if ($name !== '') {
        $search_criterias_student[] = "`student`.`name` = '$name'";
    }


    //SELECT student.name, ... FROM student INNER JOIN university ON student.rollno = university.rollno

    //$search_query = "SELECT * FROM `student` , `university` WHERE ";
    $search_query = "SELECT * FROM student WHERE ";

    $search_criteria = implode(" AND ", $search_criterias_student);
    if ($search_criteria === '') {
        $search_criteria = '1';
    }

    $search_query .= $search_criteria;
    $search_query .= " ORDER BY rollno";
    echo "<p>" . $search_query . "</p>";
    sleep(2);

    if ($result = $sqldb->query($search_query)) {
        if (mysqli_num_rows($result) > 0) {
            //create table afterwards
            while ($result_row = mysqli_fetch_assoc($result)) {
                echo "<p>" . $result_row['rollno'] . " | " . $result_row['name'] . " | " . " | " . $result_row['dob'] . "</p>";
            }
        } else {
            echo "<p>No result matching given criterias</p>";
        }
    } else {
        echo "<p>Couldn't search " . $sqldb->error . "</p>";
    }
} else {
    echo "<p>No data recieved to search for student</p>";
}
