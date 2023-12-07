<?php
session_start();
include("serverconnection.php");
include("functions.php");
$user_data = valid_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $tickets_available = $_POST['tickets_available'];

    if (!empty($name) && !empty($location) && !empty($tickets_available)) {
        $query = "INSERT INTO events (name, location, tickets_available) VALUES (?, ?, ?)";
        
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sss", $name, $location, $tickets_available);
        mysqli_stmt_execute($stmt);

        header("Location: index.php");
        die;
    } else {
        echo "Not an accepted combination";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create an event!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #box {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        #box h2 {
            font-size: 24px;
            color: #3498db;
            margin: 0;
            padding-bottom: 10px;
        }

        #box form {
            margin-top: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #button {
            padding: 10px;
            width: 100%;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #box a {
            display: block;
            text-decoration: none;
            font-size: 16px;
            color: #3498db;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="box">
        <h2>Create an Event!</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="location">Event Location</label>
                <input type="text" id="location" name="location">
            </div>
            <div class="form-group">
                <label for="tickets_available"># of Attendees</label>
                <input type="number" id="tickets_available" name="tickets_available">
            </div>
            <button id="button" type="submit">Create Event</button>
            <a href="index.php">Click to return to the main page</a>
        </form>
    </div>
</body>
</html>
