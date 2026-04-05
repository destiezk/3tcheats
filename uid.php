<?php 
require_once "config.php";

$username = $_GET['username'];

if (!($stmt = mysqli_prepare($con, "SELECT `userid` FROM `users` WHERE username = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $username);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

	if ($result->num_rows > 0)
    {
        echo $row['userid']; // user exists, user id getting printed out
    }
    else
    {
    	die('userdoesntexist'); // user doesn't exist
    }


?>