<?php
	require_once 'connect_todb.php';
	
	$userIsteacher = false;
	$saveRecord = false;
	$newdata = true;
	//extracting $_POST array elements into $frompost_ variables
	extract($_POST, EXTR_PREFIX_ALL, 'frompost');
	
	if (isset($frompost_update))
	{
		//echo "update";
		$saveRecord = false;
	}
	else if (isset($frompost_save)) 
	{
		//echo "insert";
		$saveRecord = true;
	}
	else
	{
		die("404 not found");
	}
	if ($frompost_user === "student")
	{
		$frompost_sname = strtolower(sanitizeString($frompost_sname));
		$frompost_rollno = strtolower(sanitizeString($frompost_rollno));
		$frompost_dob = sanitizeString($frompost_dob);
		/* echo $frompost_dob;
		echo $frompost_sname;
		echo $frompost_rollno;
		echo "student"; */
		if( empty($frompost_sname)  || empty($frompost_rollno) || empty($frompost_dob))
		{
			echo("Blank input fields present");
			exit();
		}
		else if (strlen($frompost_rollno) != 9)
		{ echo("Invalid roll number given! must be of format 075bct001"); exit();}
	}
	else if ($frompost_user === "teacher")
	{
		$userIsteacher = true;
		$frompost_tname = strtolower(sanitizeString($frompost_tname));
		$frompost_department = strtolower(sanitizeString($frompost_department));
		$frompost_post = strtolower(sanitizeString($frompost_post));
		if(empty($frompost_tname) or empty($frompost_department) or empty($frompost_post))
		{
			echo("Blank input fields present");
			exit();
		}
	}
	else
	{
		echo("User not recognized");
		exit();
	}
	
	//$data_entry_error = "";
	
	if ($userIsteacher)
	{
		$query_check = "SELECT *FROM teacher WHERE name = '$frompost_tname'";
	}
	else
	{
		$query_check = "SELECT *FROM student WHERE rollno = '$frompost_rollno'";
	}
	$present = $sqldb->query($query_check);
	if (mysqli_num_rows($present) > 0){
		//echo "old record";
		$newdata = false;
	}
	
	if (!$newdata && $saveRecord)
	{
		echo("Record already present");
		exit();
	}
	else if ($newdata && !$saveRecord)
	{
		echo("Record not present");
		exit();
	}
	//echo $newdata;
	
	if($newdata)
	{
		$password_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789';
		$len_pass = 8;
		$password = substr(str_shuffle($password_chars),0,$len_pass);
		if($userIsteacher)
		{
			$query_save = "INSERT INTO `teacher` ( `name`, `department`, `post`, `password`) VALUES('$frompost_tname', '$frompost_department', '$frompost_post', '$password')";
			if (!$sqldb->query($query_save))
			{
				echo "Couldn't store data for $frompost_tname";
			}
			else
			{
				echo "Successfully entered record of $frompost_tname";
			}
		}
		else
		{
			$query_save = "INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES('$frompost_rollno', '$frompost_sname', '$password', '$frompost_dob')";
			if (!$sqldb->query($query_save))
			{
				echo "Couldn't store data for $frompost_rollno";
			}
			else
			{
				echo "Successfully entered record of $frompost_rollno";
			}
		}
	}
	else
	{
		if($userIsteacher)
		{
			$query_update= "UPDATE  `teacher` SET `department` = '$frompost_department', `post` = '$frompost_post' WHERE name = '$frompost_tname'";
			if (!$sqldb->query($query_update))
			{
				echo "Couldn't update data for $frompost_tname";
			}
			else
			{
				echo "Successfully updated record of $frompost_tname";
			}
		}
		else
		{
			$query_update = "UPDATE `student` SET `name` = '$frompost_sname', `dob` = '$frompost_dob' WHERE rollno = '$frompost_rollno'";
			if (!$sqldb->query($query_update))
			{
				echo "Couldn't update data for $frompost_rollno";
			}
			else
			{
				echo "Successfully updated record of $frompost_rollno";
			}
		}
	}

?>