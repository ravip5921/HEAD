<?php
	require 'SimpleXLSX.php';
	require 'connect_todb.php';
	
if(isset($_POST['save']) && $_POST['save'] == 'Save record')
{
	$password_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789';
	$maxlen_pass = 8;
	
	
	$name_col = (int)$_POST['name_col'];
	$rollno_col = (int)$_POST['rollno_col'];
	$dob_col = (int)$_POST['dob_col'];
	//$header_present = $_POST['header_present'];
	//$overwrite
	$sheets = explode(",",$_POST['sheetnos']);
	$sheetnos =  array();
	foreach($sheets as $sheet){
		$sheetnos[] = intval($sheet);
	}
	
	/*if($header_present == 'yes'){
		unset($)
	}*/
	if(!$sqldb->select_db('higherEducationdb')){
		die ("not connected to database");
	}
	
	if ( $xlsx = SimpleXLSX::parse($_FILES['stu_xlfile']['tmp_name'])){
		foreach($sheetnos as $sheetno)
		{
			$dim = $xlsx->dimension($sheetno - 1);
			$rows_no = $dim[1];
			$cols_no = $dim[0];
			
			$rows = $xlsx->rows($sheetno - 1);
			
			for($i = 0; $i<$rows_no; $i++){
				
				$student_name = $rows[$i][$name_col-1];
				$student_rollno = $rows[$i][$rollno_col-1];
				$student_dob = $rows[$i][$dob_col-1];
				//echo "<br>$student_rollno  $student_name  $student_dob <br>";
				if (strtolower($student_name) === 'name'){
					echo "<p>header skipped</p>";
					continue;
				}
				
				$query_check = "SELECT *FROM student WHERE rollno = '$student_rollno'";
				$present = $sqldb->query($query_check);
				if ($present){
					if (mysqli_num_rows($present) > 0){
						echo ("<p>data for $student_rollno already present</p>");
						continue;
					}
				}
				$password = substr(str_shuffle($password_chars),0,$maxlen_pass);
				$query_save = "INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES('$student_rollno', '$student_name', '$password', '$student_dob')";
				//$query_save = "INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES (\'075bct058\', \'nikesh dc\', \'pass1\', \'2000-12-1\')";
				//echo $query_save;
				if (!$sqldb->query($query_save)){
					echo ("<p>couldn't store data for $student_rollno ". $sqldb->error."</p>");
				}
				else{
					echo "<p>Successfully entered records of $student_rollno</p>";
				}
			}
		}
	}
	else{
		echo SimpleXLSX::parseError();
	}
}

?>