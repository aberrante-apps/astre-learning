<?php

// Variables
$server = 'deepblue.cs.camosun.bc.ca';
$user = 'Group03_dev';
$pswd = '246800D';
$db='ICS199Group03_dev';
// Create Connection
$link = mysqli_connect($server,$user,$pswd,$db);
// Check Connection
if (!$link) {
    die ('MySQL Error:' . mysqli_connect_error());
}
 else {
     print "Connecting to database " . $db . "<BR><BR>";
 }

?>
