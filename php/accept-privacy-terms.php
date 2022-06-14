<?php
include 'connection.php';
session_start();

// Gets user ID for MySQL query later
$userID = $_SESSION["Account"]["id"];

// Sets the privacy boolean to true in the database and in the session
$privacyQuery = "UPDATE Logins SET data_permission = 1 WHERE id = $userID;";
mysqli_query($dbc, $privacyQuery);
$_SESSION['Account']['data_permission'] = 1;

// Sends user to the homepage
header('location:homepage.php');

?>