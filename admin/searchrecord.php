<?php session_start();?>
<!DOCTYPE html>

<head>
    <title>Saved Records</title>
    <style>
        @import url('../css/bootstrap.min.css');
        @import url("table.css");
    </style>
    <script src="savefromexcel.js"></script>
</head>

<body style = "background-color: #d4ffdf;">
    <button class="btn-primary" style="margin:1%" onclick="downloadRecordTable()">Generate excel sheet for records</button>
    <a href="home.html"><button class="btn-primary" style="margin:1%">Back to main page</button></a>

    <?php
    require 'connect_todb.php';

    $userIsteacher = false;
    $searchRecord = true;
    //extracting $_POST array elements into $frompost_ variables
    extract($_POST, EXTR_PREFIX_ALL, 'frompost');


    if (isset($frompost_delete)) {
        $searchRecord = false;
    }

    if (isset($frompost_user)) {
        if ($frompost_user == "student") {
            $userIsteacher = false;
        } else if ($frompost_user == "teacher") {
            $userIsteacher = true;
        } else {
            die("Unrecognized user");
        }
    } else {
        die("404 not found");
    }

    $data_entry_error = "";
    $record_table = "<table id = 'record_table'>";

    if (!$userIsteacher) { //user is student
        $frompost_rollno = strtolower(sanitizeString($frompost_rollno));
        $frompost_name = strtolower(sanitizeString($frompost_sname));
        $frompost_batch = strtolower(sanitizeString($frompost_batch));
        $frompost_department = strtolower(sanitizeString($frompost_department));

        $record_table .= "<tr>
									<th>Rollno</th>
									<th>Name</th>
									<th>DOB</th>
									<th>Password</th>
								</tr>";


        $search_criterias_student = array();


        if ($frompost_rollno !== '') {
            $search_criterias_student[] = "`student`.`rollno` = '$frompost_rollno'";
        } else {
            if ($frompost_batch !== '') {
                if (substr($frompost_batch, 0, 1) != '0') {
                    $frompost_batch = '0' . $frompost_batch;
                }
                $search_criterias_student[] = "`student`.`rollno` LIKE '$frompost_batch%'";
            }
            if ($frompost_department !== '') {
                $search_criterias_student[] = "`student`.`rollno` LIKE '%$frompost_department%'";
            }
        }
        if ($frompost_name !== '') {
            $search_criterias_student[] = "`student`.`name` = '$frompost_name'";
        }


        //SELECT student.name, ... FROM student INNER JOIN university ON student.rollno = university.rollno

        //$search_query = "SELECT * FROM `student` , `university` WHERE ";
        if ($searchRecord) {
            $search_query = "SELECT * FROM student WHERE ";
        } else {
            $search_query = "DELETE FROM student WHERE ";
        }

        $search_criteria = implode(" AND ", $search_criterias_student);
        if ($search_criteria === '') {
            if (!$searchRecord) {
                die("<p>Empty fields means to delete everything!!!</p>");
            }
            $search_criteria = '1';
        }

        $search_query .= $search_criteria;
        if ($searchRecord)
            $search_query .= " ORDER BY rollno";
        //echo "<p>".$search_query."</p>";

        if ($result = $sqldb->query($search_query)) {
            if ($searchRecord) {
                if (mysqli_num_rows($result) > 0) {
                    //create table afterwards
                    while ($resultrow = mysqli_fetch_assoc($result)) {
                        $record_table .= "<tr> 
													<td>{$resultrow['rollno']}</td> 
													<td>{$resultrow['name']}</td> 
													<td>{$resultrow['dob']}</td> 
													<td>{$resultrow['password']}</td> 
												</tr>";
                    }
                    $record_table .= "</table>";
                    echo $record_table;
                } else {
                    echo "<p>No result matching given criterias</p>";
                }
            } else {
                if (mysqli_affected_rows($sqldb) > 0) {
                    $deleted_message  = "";
                    if ($frompost_rollno !== '') {
                        $deleted_message .= "rollno: $frompost_rollno, ";
                    } else {
                        if ($frompost_batch !== '') {
                            if (substr($frompost_batch, 0, 1) != '0') {
                                $frompost_batch = '0' . $frompost_batch;
                            }
                            $deleted_message .= "batch: $frompost_batch, ";
                        }
                        if ($frompost_department !== '') {
                            $deleted_message .= "department: $frompost_department, ";
                        }
                    }
                    if ($frompost_name !== '') {
                        $deleted_message .= "name: $frompost_name";
                    }

                    if ($deleted_message == "")
                        echo "<p>Deleted everything</p>";
                    else
                        echo "<p>Deleted record of " . $deleted_message . "</p>";
                } else {
                    echo "<p>No record to delete </p>";
                }
            }
        } else {
            if ($searchRecord)
                echo "<p>Couldn't get to database </p>";
        }
    } else { //user is teacher
        $record_table .= "<tr>
									<th>Name</th>
									<th>Department</th>
									<th>Post</th>
									<th>Password</th>
								</tr>";
        $frompost_name = strtolower(sanitizeString($frompost_tname));
        $frompost_post = strtolower(sanitizeString($frompost_post));
        $frompost_department = strtolower(sanitizeString($frompost_department));

        $search_criterias_teacher = array();

        if ($frompost_name !== '') {
            $search_criterias_teacher[] = "name = '$frompost_name'";
        }
        if ($frompost_post !== '') {
            $search_criterias_teacher[] = "post = '$frompost_post'";
        }
        if ($frompost_department !== '') {
            $search_criterias_teacher[] = "department = '$frompost_department'";
        }

        if ($searchRecord) {
            $search_query = "SELECT * FROM teacher WHERE ";
        } else {
            $search_query = "DELETE FROM teacher WHERE ";
        }

        $search_criteria = implode(" AND ", $search_criterias_teacher);
        if ($search_criteria === '') {
            if (!$searchRecord) {
                die("<p>Empty fields means to delete everything!!!</p>");
            }
            $search_criteria = '1';
        }

        $search_query .= $search_criteria;
        if ($searchRecord)
            $search_query .= " ORDER BY name";
        //echo "<p>".$search_query."</p>";

        if ($result = $sqldb->query($search_query)) {
            if ($searchRecord) {
                if (mysqli_num_rows($result) > 0) {
                    //create table afterwards
                    while ($resultrow = mysqli_fetch_assoc($result)) {
                        $record_table .= "<tr>
													<td>{$resultrow['name']}</td>
													<td>{$resultrow['department']}</td>
													<td>{$resultrow['post']}</td>
													<td>{$resultrow['password']}</td>
												</tr>";
                    }
                    $record_table .= "</table>";
                    echo $record_table;
                } else {
                    echo "<p>No result matching given criterias</p>";
                }
            } else {
                $deleted_message  = "";
                if ($frompost_name !== '') {
                    $deleted_message .= "name: $frompost_name, ";
                }
                if ($frompost_department !== '') {
                    $deleted_message .= "name: $frompost_department, ";
                }
                if ($frompost_post !== '') {
                    $deleted_message .= "name: $frompost_post";
                }

                if ($deleted_message == "")
                    echo "<p>Deleted everything</p>";
                else
                    echo "<p>Deleted records of " . $deleted_message . "</p>";
            }
        } else {
            if ($searchRecord)
                echo "<p>Couldn't search </p>";
            else
                echo "<p>No record to delete </p>";
        }
    }
    ?>

</body>

</html>
