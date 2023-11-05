 <?php
    session_start();
    include("serverconnection.php");
    include("functions.php");
    $user_data = valid_login($con);
    if (isset($_GET['event_id'])) {
         $event_id = $_GET['event_id'];
         $query = "SELECT tickets_available FROM events WHERE event_id = $event_id";
         $tickets = mysqli_query($con, $query);
         $row = mysqli_fetch_assoc($tickets);
         $current_tickets_available = $row['tickets_available'];
          if ($current_tickets_available > 1) {
            // Decrement the available tickets by 1
            $new_tickets_available = $current_tickets_available - 1;
            // Update the database with the new tickets_available value
            $update_sql = "UPDATE events SET tickets_available = $new_tickets_available WHERE event_id = $event_id";
            $update = mysqli_query($con, $update_sql);
            if ($update) {
                $user_id = $user_data['user_id'];
                $redemption_id = rand(1000000000, 9999999999);
                $redemption_date = date("Y-m-d H:i:s"); // Use the current date and time
                $redemption_sql = "INSERT INTO ticket_redemption (redemption_id, event_id, redemption_date, user_id) VALUES ('$redemption_id', '$event_id', '$redemption_date', '$user_id')";
                $redemption = mysqli_query($con, $redemption_sql);
                if(!$redemption){echo mysqli_error($con);}
                else{header("Location: index.php");}
            } else {
                echo "Error updating tickets_available";
            }
            } else {
                    $user_id = $user_data['user_id'];
                    $redemption_id = rand(1000000000, 9999999999);
                    $redemption_date = date("Y-m-d H:i:s"); // Use the current date and time
                    $redemption_sql = "INSERT INTO ticket_redemption (redemption_id, event_id, redemption_date, user_id) VALUES ('$redemption_id', '$event_id', '$redemption_date', '$user_id')";
                    $redemption = mysqli_query($con, $redemption_sql);
                    $delete_sql = "DELETE FROM events WHERE tickets_available = 0 LIMIT 1";
                    $delete_result = mysqli_query($con, $delete_sql);
                    header("Location: index.php");
                }

    } else {
        echo "Event not found.";
    }
  

?>