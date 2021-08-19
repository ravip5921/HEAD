<?php
	$sqldb = new mysqli('localhost','root','') or die('Couldn\'t connect to the sql server');
	$sqldb->select_db('higherEducationdb') or die ("Couldnot find the database");
	
	function sanitizeString($str)
	{
		 $str = strip_tags($str);
		 $str = htmlentities($str);
		 return stripslashes($str);
	}
?>
 