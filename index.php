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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            color: #e74c3c;
        }

        .delete-button {
            display: block;
            background-color: #e74c3c;
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin: 0 auto;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Welcome To SimpleTicket!</h1>
    <div class="container">
        <p>Hi, <?php echo $user_data['username']; ?>. Would you like to create or find an event?</p>
        <ul>
            <li><a href="events.php">Find Events</a></li>
            <li><a href="createevent.php">Create Events</a></li>
            <li><a href="mytickets.php">View Tickets</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
        <button class="delete-button" onclick="location.href='deleteaccount.php'">Delete Account</button>
    </div>
</body>
</html>
