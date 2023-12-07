<?php
session_start();
include("serverconnection.php");
include("functions.php");
$user_data = valid_login($con);
$user_id = $user_data['user_id'];
$query = "SELECT tr.redemption_id, e.name, e.location
          FROM ticket_redemption tr
          JOIN events e ON tr.event_id = e.event_id
          WHERE tr.user_id = '$user_id'";
$resulttickets = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Tickets - Welcome, <?php echo $user_data['username']; ?>!</title>
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

        .ticket {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: space-between; /* Add this to use white space for QR code */
        }

        .ticket-details {
            width: 70%; /* Adjust the width as needed */
        }

        .event-name {
            font-size: 24px;
            font-weight: bold;
        }

        .event-location {
            font-size: 18px;
            color: #777;
        }

        .redemption-id {
            font-size: 16px;
        }

        .remove-ticket-form {
            width: 30%; /* Adjust the width as needed */
            text-align: right;
        }

        .action-links {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>My Tickets - Welcome, <?php echo $user_data['username']; ?>!</h1>
    <div class="container">
        <?php
        if ($resulttickets) {
            while ($row = mysqli_fetch_assoc($resulttickets)) {
                echo '<div class="ticket">';
                echo '<div class="ticket-details">';
                echo '<div class="event-name">' . $row['name'] . '</div>';
                echo '<div class="event-location">' . $row['location'] . '</div>';
                echo '<div class="redemption-id">Redemption ID: ' . $row['redemption_id'] . '</div>';
                echo '</div>';

                echo '<div class="remove-ticket-form">';
                echo '<form method="post" action="remove_ticket.php">';
                echo '<input type="hidden" name="redemption_id" value="' . $row['redemption_id'] . '">';
                echo '<input type="submit" value="Remove Ticket">';
                echo '</form>';
                echo '</div>';
                
                echo '</div>';
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
