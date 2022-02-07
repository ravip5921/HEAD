<?php
$sqldb = new mysqli('localhost', 'root', '');
if (!$sqldb) {
    die('Couldn\'t connect to the sql server');
} else {
    //  echo "<p>Connected to sql server";
}