<?php
include 'connection.php';
session_start();

// Gets user ID for MySQL query later
$userID = $_SESSION["Account"]["id"];

// Sets the privacy boolean to false in the database
$privacyQuery = "UPDATE Logins SET data_permission = 0 WHERE id = $userID;";
mysqli_query($dbc, $privacyQuery);

// Logs out the user
session_destroy();
header('location:homepage.php');
?>