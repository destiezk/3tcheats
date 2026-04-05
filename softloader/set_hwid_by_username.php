<?php 
require "config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_GET['username'];
$hwid = $_GET['hwid'];

if (!($stmt = mysqli_prepare($con, "SELECT * FROM `users` WHERE username = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $username);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

	if ($result->num_rows < 1)
    {
        die('-1'); // non existent user
    }

    if (empty($row['hwid']))
    {
        if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET hwid = ? WHERE username = ?"))) 
        {
            echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
        }

        $stmt->bind_param("ss", $hwid, $username);
        if($stmt->execute())
        {
            die("1"); // executed successfully
        }
        else
        {
            die("2"); // update query failed
        }
        $stmt->close();
    }
    $stmt->close();


?>