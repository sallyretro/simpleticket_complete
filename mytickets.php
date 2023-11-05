<?php
session_start();
	include("serverconnection.php");
	include("functions.php");
	$user_data = valid_login($con);
	$user_id = $user_data['user_id'];
	$query = 
	     "SELECT tr.redemption_id, e.name, e.location
          FROM ticket_redemption tr
          JOIN events e ON tr.event_id = e.event_id
          WHERE tr.user_id = '$user_id'";
	$resulttickets = mysqli_query($con, $query);
	echo "<h1> Tickets</h1>";
	if($resulttickets){
		while ($row = mysqli_fetch_assoc($resulttickets)) {
			echo "Event Name: " . $row['name']. "<br>";
			echo "Event Location: " . $row['location'] . "<br>";
            echo "Redemption ID: " . $row['redemption_id'] . "<br> <br>";
		}
	}
	echo "<br>";
	echo "<a href = 'index.php'> Return </a> <br>";
	echo "<a href = 'createevent.php'> Create Event </a> <br>";
	echo "<a href = 'logout.php'> Log Out </a>";
?>
