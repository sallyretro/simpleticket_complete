<?php
session_start();
include("serverconnection.php");
include("functions.php");
$event_data = valid_login($con);
$username = $event_data['username'];

$queryuser = "SELECT username FROM users WHERE username = ? LIMIT 1";
$stmt = mysqli_prepare($con, $queryuser);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$resultuser = mysqli_stmt_get_result($stmt);


if ($resultuser) {
    $user_data = mysqli_fetch_assoc($resultuser);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Browser - Welcome, <?php echo $username; ?>!</title>
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
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .event {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .event-name {
            font-size: 24px;
            font-weight: bold;
        }

        .event-location {
            font-size: 18px;
            color: #777;
        }

        .tickets-available {
            font-size: 16px;
        }

        .redeem-link {
            display: block;
            margin-top: 10px;
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .redeem-link:hover {
            background-color: #258cd1;
        }

        .action-links {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Welcome To Event Browser, <?php echo $username; ?>!</h1>
    <div class="container">
        <?php
        $queryevent = "SELECT * from events GROUP BY event_id";
        $resultevent = mysqli_query($con, $queryevent);
        if ($resultevent) {
            while ($event_data = mysqli_fetch_assoc($resultevent)) {
                if ($event_data['tickets_available'] > 0) {
                    echo '<div class="event">';
                    echo '<div class="event-name">' . $event_data['name'] . '</div>';
                    echo '<div class="event-location">' . $event_data['location'] . '</div>';
                    echo '<div class="tickets-available">Tickets Available: ' . $event_data['tickets_available'] . '</div>';
                    echo '<a class="redeem-link" href="redeem.php?event_id=' . $event_data['event_id'] . '">Redeem Ticket</a>';
                    echo '</div>';
                }
            }
        }
        ?>
        <div class="action-links">
            <a href="index.php">Return</a> |
            <a href="createevent.php">Create Event</a> |
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</body>
</html>
