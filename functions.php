<?php
	function valid_login($con){
		// Checks user_id of page to check login
		if(isset($_SESSION['user_id'])){
			$id = $_SESSION['user_id'];
			$query = "SELECT * 
			FROM USERS 
			WHERE user_id = '$id' 
			LIMIT 1";
			$result = mysqli_query($con,$query);
			if($result && mysqli_num_rows($result) > 0){

				$user_data = mysqli_fetch_assoc($result);
				return $user_data;

			}
		}

		//Failed! Redirection to login
		header("Location: login.php");
		die;
	}

	function generateUniqueRedemptionID($con) {
    // Generate a random redemption ID
    $redemption_id = mt_rand(10000000, 99999999);

    // Check if the generated ID already exists in the database
    $query = "SELECT redemption_id FROM ticket_redemption WHERE redemption_id = '$redemption_id'";
    $result = mysqli_query($con, $query);

    // If the ID already exists, generate a new one until it's unique
    while (mysqli_num_rows($result) > 0) {
        $redemption_id = mt_rand(10000000, 99999999);
        $query = "SELECT redemption_id FROM ticket_redemption WHERE redemption_id = '$redemption_id'";
        $result = mysqli_query($con, $query);
    	}

    return $redemption_id;
	}

?>
