<?php
session_start();
include("serverconnection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //prepared statements to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: login.php"); // Redirect to login page after successful registration
            die();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Please fill in both username and password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup for SimpleTicket</title>
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
            text-align: center;
            max-width: 300px;
        }

        #text, #button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #button {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #button:hover {
            background-color: #258cd1;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <h1>Signup for SimpleTicket</h1>
            <label for="username">Username</label>
            <input id="text" type="text" name="username" required>
            <label for="password">Password</label>
            <input id="text" type="password" name="password" required>
            <input id="button" type="submit" value="Signup">
            <p><a href="login.php">Click to Login</a></p>
        </form>
    </div>
</body>
</html>
