<?php 
require "config.php";

$loader_keys = $_GET['key'];

if (!($stmt = mysqli_prepare($con, "SELECT * FROM `loader_keys` WHERE loader_keys = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $loader_keys);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

	if ($result->num_rows < 1)
    {
        die('0');
    }
    else
    {
    	die("1");
    }

?>