<!DOCTYPE html>

<head>
    <title>Saved Records</title>
    <style>
        @import url('../css/bootstrap.min.css');
        @import url("table.css");
    </style>
    <script src="savefromexcel.js"></script>
</head>

<body>
    <button class="btn-primary" style="margin:1%" onclick="downloadRecordTable()">Generate excel sheet for records</button>
    <a href="home.html"><button class="btn-primary" style="margin:1%">Back to main page</button></a>

    <?php
    require_once 'SimpleXLSX.php';
    require_once 'connect_todb.php';

    if (isset($_POST['save']) && $_POST['save'] == 'Save record') {
        $password_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . '0123456789';
        $maxlen_pass = 8;
        $userIsteacher = false;
        //extracting $_POST array elements into $frompost_ variables
        extract($_POST, EXTR_PREFIX_ALL, 'frompost');

        $input_error = "";

        $frompost_name_header = strtolower(sanitizeString($frompost_name_header));
        if ($frompost_user === "student") {
            $frompost_name_col = (int)sanitizeString($frompost_sname_col);
            $frompost_rollno_col = (int)sanitizeString($frompost_rollno_col);
            $frompost_dob_col = (int)sanitizeString($frompost_dob_col);
            if ($frompost_name_col <= 0 || $frompost_dob_col <= 0 || $frompost_rollno_col <= 0) {
                $input_error .= "<p>Column number must be greater or equal to 1</p>";
            }
        } else if ($frompost_user === "teacher") {
            $userIsteacher = true;
            $frompost_name_col = (int)sanitizeString($frompost_tname_col);
            $frompost_department_col = (int)sanitizeString($frompost_department_col);
            $frompost_post_col = (int)sanitizeString($frompost_post_col);
            if ($frompost_name_col <= 0 || $frompost_department_col <= 0 || $frompost_post_col <= 0) {
                $input_error .= "<p>Column number must be greater or equal to 1</p>";
            }
        } else {
            die("User not recognized");
        }


        $sheets = explode(",", sanitizeString($_POST['sheetnos']));
        $sheetnos =  array();
        foreach ($sheets as $sheet) {
            $sheetno = intval($sheet);
            if ($sheetno <= 0) {
                $input_error .= "Sheet number must be greater or equal to 1<br>";
                break;
            }
            $sheetnos[] = $sheetno;
        }

        if ($input_error != "") {
            die($input_error);
        }

        $data_entry_error = "";


        if ($xlsx = SimpleXLSX::parse($_FILES['xlfile']['tmp_name'])) {
            if (!$userIsteacher) {
                $record_table = "<table id = 'record_table'>
									<tr>
										<th>Rollno</th>
										<th>Name</th>
										<th>DOB</th>
										<th>Password</th>
									</tr>";

                foreach ($sheetnos as $sheetno) {
                    $dim = $xlsx->dimension($sheetno - 1);
                    $rows_no = $dim[1];
                    $cols_no = $dim[0];

                    $rows = $xlsx->rows($sheetno - 1);
                    for ($i = 0; $i < $rows_no; $i++) {

                        $student_name = strtolower($rows[$i][$frompost_sname_col - 1]);
                        $student_rollno = strtolower($rows[$i][$frompost_rollno_col - 1]);
                        $student_dob = $rows[$i][$frompost_dob_col - 1];
                        //echo "<br>$student_rollno  $student_name  $student_dob <br>";
                        if ($student_name === $frompost_name_header) {
                            echo "<p>header skipped</p>";
                            continue;
                        }

                        $query_check = "SELECT rollno FROM student WHERE rollno = '$student_rollno'";
                        $present = $sqldb->query($query_check);
                        if (mysqli_fetch_assoc($present)) {
                            $data_entry_error .= "<p>Data for $student_rollno already present</p>";
                            continue;
                        }
                        $password = substr(str_shuffle($password_chars), 0, $maxlen_pass);
                        $query_save = "INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES('$student_rollno', '$student_name', '$password', '$student_dob')";
                        //$query_save = "INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES (\'075bct058\', \'nikesh dc\', \'pass1\', \'2000-12-1\')";
                        //echo $query_save;
                        if (!$sqldb->query($query_save)) {
                            //$data_entry_error .="<p>couldn't store data for $student_rollno ". $sqldb->error."</p>";
                            $data_entry_error .= "<p>couldn't store data for $student_rollno </p>";
                        } else {
                            $student_name = ucwords($student_name);
                            //echo "<p>Successfully entered records of $student_rollno</p>";
                            $record_table .= "<tr>
													<td>$student_rollno</td>
													<td>$student_name</td>
													<td>$student_dob</td>
													<td>$password</td>
												  </tr>";
                        }
                    }
                }
            } else {
                $record_table = "<table id = 'record_table'>
										<tr>
											<th>Name</th>
											<th>Department</th>
											<th>Post</th>
											<th>Password</th>
										</tr>";

                foreach ($sheetnos as $sheetno) {
                    $dim = $xlsx->dimension($sheetno - 1);
                    $rows_no = $dim[1];
                    $cols_no = $dim[0];

                    $rows = $xlsx->rows($sheetno - 1);
                    for ($i = 0; $i < $rows_no; $i++) {

                        $teacher_name = $rows[$i][$frompost_tname_col - 1];
                        $teacher_department = $rows[$i][$frompost_department_col - 1];
                        $teacher_post = $rows[$i][$frompost_post_col - 1];

                        if (strtolower($teacher_name) === $frompost_name_header) {
                            echo "<p>header skipped</p>";
                            continue;
                        }

                        $query_check = "SELECT name FROM teacher WHERE name = '$teacher_name'";
                        $present = $sqldb->query($query_check);
                        if (mysqli_fetch_assoc($present)) {
                            $data_entry_error .= "<p>Data for $teacher_name already present</p>";
                            continue;
                        }
                        $password = substr(str_shuffle($password_chars), 0, $maxlen_pass);
                        $query_save = "INSERT INTO `teacher` (`name`, `department`, `post`, `password`) VALUES('$teacher_name', '$teacher_department', '$teacher_post', '$password')";

                        if (!$sqldb->query($query_save)) {
                            $data_entry_error .= "<p>Couldn't store data for $teacher_name </p>";
                        } else {
                            //echo "<p>Successfully entered records of $student_rollno</p>";
                            $record_table .= "<tr>
													<td>$teacher_name</td>
													<td>$teacher_department</td>
													<td>$teacher_post</td>
													<td>$password</td>
												  </tr>";
                        }
                    }
                }
            }

            $record_table .= "</table>";
            echo $record_table;
            if ($data_entry_error != "") {
                echo "<div id = 'error'><h2>Errors during storing values:</h2>";
                echo $data_entry_error . "</div>";
            }
        } else {
            die(SimpleXLSX::parseError());
        }
    } else {
        echo "<h1>404 not found</h1>";
    }

    ?>
</body>

</html>