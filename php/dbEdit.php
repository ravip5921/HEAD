<?php 
try{
$db = new pdo('mysql:host=localhost;dbname=highereducationdb;charset=utf8','root','');
}
catch(PDOException $e){
    die($e->getMessage());
}
