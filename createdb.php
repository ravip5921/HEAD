<?php
include 'connect_todb.php';
if ($sqldb->query("CREATE DATABASE higherEducationdb")) {
    echo "<p>Created database higherEducationdb";
} else {
    die('Couldn\'t create database');
}
$sqldb->select_db("higherEducationdb");
$createtable = "CREATE TABLE student (rollno varchar(9) PRIMARY KEY, name varchar(30), password varchar(20), dob date)";
if ($sqldb->query($createtable)) {
    echo "<p>Created table student";
} else {
    die("Couldn\'t create table student");
}
$createtable = "CREATE TABLE teacher (uname varchar(30) PRIMARY KEY, password varchar(20), department varchar(3))";
if ($sqldb->query($createtable)) {
    echo "<p>Created table teacher";
} else {
    die("Couldn\'t create table teacher");
}
$createtable = "CREATE TABLE university (name varchar(100),country varchar(50),rollno varchar(9),faculty varchar(100))";
if ($sqldb->query($createtable)) {
    echo "<p>Created table university";
} else {
    die("Couldn\'t create table university");
}
