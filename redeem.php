<?php
session_start();
include("serverconnection.php");
include("functions.php");
$user_data = valid_login($con);

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $user_id = $user_data['user_id'];
    
    // Check if the user has already redeemed 2 tickets for the same event
    $query = "SELECT COUNT(*) AS redeemed_tickets_count FROM ticket_redemption WHERE event_id = '$event_id' AND user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $redeemed_tickets_count = $row['redeemed_tickets_count'];
    
    if ($redeemed_tickets_count >= 2) {
    echo '<div style="text-align: center; margin-top: 20px; font-size: 18px; color: #3498db;">You have already redeemed the maximum number of tickets for this event.</div>';
    echo '<div style="text-align: center; margin-top: 10px;"><a href="index.php" style="text-decoration: none; font-size: 16px; color: #3498db;">Return to Main Page</a></div>';
    } else {
        // Continue with the redemption logic
        $query = "SELECT tickets_available FROM events WHERE event_id = $event_id";
        $tickets = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($tickets);
        $current_tickets_available = $row['tickets_available'];
        
        if ($current_tickets_available > 0) {
            // Decrement the available tickets by 1
            $new_tickets_available = $current_tickets_available - 1;
            // Update the database with the new tickets_available value
            $update_sql = "UPDATE events SET tickets_available = $new_tickets_available WHERE event_id = $event_id";
            $update = mysqli_query($con, $update_sql);
            // If query completes, update database with new data
            if ($update) {
                $redemption_id = generateUniqueRedemptionID($con);
                $redemption_date = date("Y-m-d H:i:s"); // Use the current date and time
                $redemption_sql = "INSERT INTO ticket_redemption (redemption_id, event_id, redemption_date, user_id) VALUES ('$redemption_id', '$event_id', '$redemption_date', '$user_id')";
                $redemption = mysqli_query($con, $redemption_sql);
                if (!$redemption) {
                    echo mysqli_error($con);
                } else {
                    header("Location: index.php");
                }
            } else {
                echo "Error updating tickets_available";
            }
        } else {
            echo "No available tickets for this event. <a href='index.php'>Return to Index</a>";
        }
    }
} else {
    echo "Event not found. <a href='index.php'>Return to Index</a>";
}
?>
