<?php
	$sqldb = new mysqli('localhost','root','') or die('Couldn\'t connect to the sql server');
	if ($sqldb->query("CREATE DATABASE higherEducationdb")){
		echo "<p>Created database higherEducationdb";
	}
	else{
		die('Couldn\'t create database');
	}
	$name_len = 30;
	$rollno_len = 9;
	$password_len = 20;
	$faculty_len = 50;
	$university_len = 50;
	$dep_alias_len = 3;
	$dep_len = 50;
	$post_alias_len = 3;
	$post_len = 50;
	$max_teacher_size = 4;
	$country_len = 50;
	$rec_status_len = 3;
	$university_status_len = 3;
	
	$sqldb->select_db("higherEducationdb");

	//University Status table
	$createtable = "CREATE TABLE universityStatus(id tinyint PRIMARY KEY,status varchar(50));";
	if ($sqldb->query($createtable)){
		//add elements 
		echo "<p>Created table universityStatus</p>";
	}
	else{
		die("Couldn\'t create table universityStatus");
	}
	//Teacher posts table
	$createtable = "CREATE TABLE teacherPosts(id tinyint PRIMARY KEY,status varchar(50));";
	if ($sqldb->query($createtable)){
		//add elements 
		echo "<p>Created table teacherPosts</p>";
	}
	else{
		die("Couldn\'t create table teacherPosts");
	}
	//department_alias table
	$createtable = "CREATE TABLE department_alias (alias varchar($dep_alias_len) PRIMARY KEY, name varchar($dep_len))";
	if ($sqldb->query($createtable)){
		//add elements 
		echo "<p>Created table department_alias</p>";
	}
	else{
		die("Couldn\'t create table department_alias");
	}


	//student table
	$createtable = "CREATE TABLE student (rollno varchar($rollno_len) PRIMARY KEY, name varchar($name_len), password varchar($password_len), dob date)";
	if ($sqldb->query($createtable)){
		echo "<p>Created table student";
	}
	else{
		die("Couldn\'t create table student");
	}
	
	//teacher table
	$createtable = "CREATE TABLE teacher (uname varchar($name_len) PRIMARY KEY, department_alias varchar($dep_alias_len), 
						post tinyint, password varchar($password_len), FOREIGN KEY (department_alias) references department_alias(alias),FOREIGN KEY (post) references teacherPosts(id))";
	if ($sqldb->query($createtable)){
		echo "<p>Created table teacher";
	}
	else{
		
		die("Couldn\'t create table teacher");
	}
	//recommendation table
	$createtable = "CREATE TABLE recommendation (id MEDIUMINT NOT NULL AUTO_INCREMENT KEY,rollno varchar($rollno_len), teacher varchar($name_len), recstatus varchar($rec_status_len), 
		recdate date, uname varchar($university_len),country varchar($country_len),faculty varchar($faculty_len), uniastatus tinyint, FOREIGN KEY (rollno) references student(rollno),FOREIGN KEY (teacher) references teacher(uname),FOREIGN KEY (uniastatus) references universityStatus(id))";
	if ($sqldb->query($createtable)){
		echo "<p>Created table recommendation</p>";
	}
	else{
		die("Couldn\'t create table recommendation");
	}
	
	
	
	/*
	The id is required to uniquely distinguish between different rows of the applications table in student.php 
	*/
	// $tableIdQuery = "ALTER TABLE recommmendation ADD id MEDIUMINT NOT NULL AUTO_INCREMENT KEY";
	// if ($sqldb->query($tableIdQuery)) {
	// 	echo "<p>Id added to table recommmedation";
	// } else {
	// 	die("Couldn\'t add id to table recommendation");
	// }

	/* //post_alias table
	$createtable = "CREATE TABLE post_alias (alias varchar($post_alias_len) PRIMARY KEY, name varchar($post_len))";
	if ($sqldb->query($createtable)){
		echo "<p>Created table post_alias</p>";
	}
	else{
		die("Couldn\'t create table post_alias");
	} */
	
	//university table
	/* $createtable = "CREATE TABLE university (uname varchar($university_len),country varchar($country_len),faculty varchar($faculty_len),
	                  rollno varchar($rollno_len), status varchar($university_status_len))";
	if ($sqldb->query($createtable)){
		echo "<p>Created table university</p>";
	}
	else{
		die("Couldn\'t create table university");
	} */

?>
