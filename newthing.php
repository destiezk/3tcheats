<?php 
require "config.php";


$username = $_GET['user'];
$key = $_GET['key'];

if (!($stmt = mysqli_prepare($con, "SELECT loader_keys FROM `loader_keys2` WHERE username = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $username);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

    if ($key != $row['loader_keys'])
    {
        echo 'The GIVEN key does not match with DB key';
    }
    else
    {
        echo 'the GIVEN key matches with DB key';
    }

?>