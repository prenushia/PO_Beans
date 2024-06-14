<?php
// start the session
session_start();
// check if the user is not logged in, then redirect user to login page
if(!isset($_SESSION['user_name']) && ($_SESSION['user_name']) !== true)
{
	header('location: login.php');
	exit;
}
?>
