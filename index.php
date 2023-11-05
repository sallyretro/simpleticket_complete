<?php
session_start();
	include("serverconnection.php");
	include("functions.php");
	$user_data = valid_login($con);
?>
<!DOCTYPE html>
<html>
<head>
	<title>SimpleTicket</title>
</head>
<body>

	
	<h1>Welcome To SimpleTicket!</h1>
	<br>
	Hi, <?php echo $user_data['username']; ?>. Would you like to create or find an event?
	<br>
	<br>
	<a href = "events.php"> Find Events </a>
	<br>
	<a href="createevent.php"> Create Events </a>
	<br>
	<a href = "mytickets.php"> View Tickets </a>
	<br>
	<a href = "logout.php"> Log Out </a>
	<br>
	<a href = "deleteaccount.php"> Delete Account </a>
</body>
</html>