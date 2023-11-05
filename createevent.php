<?php
session_start();
	include("serverconnection.php");
	include("functions.php");
	$user_data = valid_login($con);
	if ($_SERVER['REQUEST_METHOD'] == "POST"){

		$name =$_POST['name'];
		$location =$_POST['location'];
		$tickets_available = $_POST['tickets_available'];

		if(!empty($name) && !empty($location) && !empty($tickets_available)){
			$query = "INSERT INTO events (name, location, tickets_available) values('$name', '$location', '$tickets_available')";
			mysqli_query($con, $query);
			header("Location: index.php");
			die;
		}
		else{
			echo "Not an accepted combination";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Create an event!</title>
</head>
<body>

<style type="text/css">
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 30px;margin: 10px;color: blue;">Login to Simpleticket!</div>
			<p> Event Name </p>
			<input id="text" type="text" name="name"><br><br>
			<p> Event Location </p>
			<input id="text" type="text" name="location"><br><br>
			<p> # of Attendees? </p>
			<input id="number" type="number" name="tickets_available"><br><br>
			<input id="button" type="submit" value="Login"><br><br>
			<a href="index.php">Click to return to main page!</a><br><br>

</body>
</html>