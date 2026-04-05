<?php 
require_once "config.php";

$hwid = $_GET['hwid'];

if (!($stmt = mysqli_prepare($con, "SELECT username FROM `users` WHERE hwid = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $hwid);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

	if ($result->num_rows > 0)
    {
        echo $row['username']; // non existent user
    }
    else
    {
    	echo "No user with this hwid is found.";
    }

?>