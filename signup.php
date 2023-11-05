<?php
	session_start();
	include("serverconnection.php");
	include("functions.php");
	
	if ($_SERVER['REQUEST_METHOD'] == "POST"){

		$username =$_POST['username'];
		$password =$_POST['password'];

		if(!empty($username) && !empty($password)){
			$user_id = random_int(1, 9999);
			$query = "INSERT INTO users (user_id, username, password) values('$user_id', '$username', '$password')";
			mysqli_query($con, $query);
			header("Location: login.php");
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
	<title>Signup to SimpleTicket!</title>
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
			<div style="font-size: 30px;margin: 10px;color: blue;">Signup for SimpleTicket!</div>
			<p> Username </p>
			<input id="text" type="text" name="username"><br><br>
			<p> Password </p>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login!</a><br><br>

</body>
</html>