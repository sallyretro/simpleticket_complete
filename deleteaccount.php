<?php
include("serverconnection.php");
include("functions.php");
session_start();
$user_data = valid_login($con);
$username = $user_data['username'];
$user_id = $user_data['user_id'];
if(isset($_SESSION['user_id'])){
	echo "made";
	$query = "DELETE FROM users WHERE username = '$username' LIMIT 1";;
	mysqli_query($con, $query);
	$ticket_query = "DELETE FROM ticket_redemption WHERE user_id = '$user_id'";
	mysqli_query($con, $ticket_query);
}

header("Location: index.php");
?>
