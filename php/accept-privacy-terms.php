<?php
include 'connection.php';
session_start();

// Gets user ID for MySQL query later
$userID = $_SESSION["Account"]["id"];

// Sets the privacy boolean to true in the database
$privacyQuery = "UPDATE Logins SET data_permission = 1 WHERE id = $userID;";
mysqli_query($dbc, $privacyQuery);

// Sends user to the homepage
header('location:homepage.php');

?>