<?php
	require 'connect_todb.php';
	
if(isset($_POST['save']) && $_POST['save'] == 'Save record')
{
	$password_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789';
	$len_pass = 8;
	
	$name = $_POST['name'];
	$rollno = $_POST['rollno'];
	$dob = $_POST['dob'];
	
	if(!$sqldb->select_db('higherEducationdb')){
		die ("not connected to database");
	}
	
	$query_check = "SELECT *FROM student WHERE rollno = '$rollno'";
	$present = $sqldb->query($query_check);
	if (mysqli_fetch_assoc($present)){
		die ("<p>data for $rollno already present</p>");
	}
	$password = substr(str_shuffle($password_chars),0,$len_pass);
	$query_save = "INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES('$rollno', '$name', '$password', '$dob')";
	//$query_save = "INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES (\'075bct058\', \'nikesh dc\', \'pass1\', \'2000-12-1\')";
	//echo $query_save;
	if (!$sqldb->query($query_save)){
		echo ("<p>couldn't store data for $rollno ". $sqldb->error."</p>");
	}
	else{
		echo "<p>Successfully entered records of $rollno</p>";
	}
}

?>