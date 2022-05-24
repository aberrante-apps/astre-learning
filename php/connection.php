<?php

// Variables
$server = 'deepblue.cs.camosun.bc.ca';
$user = 'Group03_dev';
$pswd = '246800D';
$db='ICS199Group03_dev';

// Create Connection
$dbc = mysqli_connect($server,$user,$pswd,$db);

// Check Connection
if (!$dbc) {
    die ('MySQL Error:' . mysqli_connect_error());
}
// Note from Matthew: When we get to the final production stages, we will need to get rid of this else statement.
// Otherwise, it will show up on screen, which will be weird for the user.
 else {
     print "Connecting to database " . $db . "<BR><BR>";
 }

?>

