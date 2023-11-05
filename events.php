<?php
session_start();
	include("serverconnection.php");
	include("functions.php");
	$event_data = valid_login($con);
	$username = $event_data['username'];
	$queryuser = "SELECT username FROM users WHERE username = '$username' LIMIT 1";
	$resultuser = mysqli_query($con, $queryuser);
	if($resultuser){
		$user_data = mysqli_fetch_assoc($resultuser);
	}
	echo "<h1>Welcome To Event Browser, $username!</h1>";
	$queryevent = "SELECT * from events GROUP BY event_id";
	$resultevent = mysqli_query($con, $queryevent);
	if($resultevent){
		while($event_data = mysqli_fetch_assoc($resultevent)){
				$index = 1;	
				echo "Event Name: ". $event_data['name']. "<br>";
				echo "Event Location: ". $event_data['location']. "<br>";
				echo "Tickets Available: ". $event_data['tickets_available']."<br>";
				echo '<a href="redeem.php?event_id=' . $event_data['event_id'] . '">' . "Redeem Ticket" . '</a><br><br>';

			}
	}
	echo "<br>";
	echo "<a href = 'index.php'> Return </a> <br>";
	echo "<a href = 'createevent.php'> Create Event </a> <br>";
	echo "<a href = 'logout.php'> Log Out </a>";
?>
