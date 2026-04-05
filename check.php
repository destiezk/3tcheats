<?php 
require_once "config.php";

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$username = $_GET['username'];
$password = $_GET['password'];
$hwid_loader = $_GET['hwid'];

$today_date=date("Y-m-d h:i:s");

// 1 Month
$calculate_expiracy_1month=strtotime("+1 Months");
$expiration_final_date_1m=date("Y-m-d h:i:sa", $calculate_expiracy_1month);

//3 Months
$calculate_expiracy_3month=strtotime("+3 Months");
$expiration_final_date_3m=date("Y-m-d h:i:sa", $calculate_expiracy_3month);

//1 Day
$calculate_expiracy_1day=strtotime("+1 day");
$expiration_final_date_1d=date("Y-m-d h:i:sa", $calculate_expiracy_1day);

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
    else
    { 
        if (password_verify($password, $row['password']) && $row['is_banned'] == 0&& strcmp($row['hwid'], $hwid_loader) == 0)
		//if (password_verify($password, $row['password']) && $row['is_banned'] == 0)
        {
        	/*if(empty($row['activated_at']))
        	{
        		if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET activated_at = ? WHERE username = ?"))) 
	    		{
	       			 echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    		}
				    $stmt->bind_param("ss", $today_date, $username);
				    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
				    $result = $stmt->get_result();
				    $stmt->close();
		    }
		    if(empty($row['expires_at']))
        	{
        		if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET expires_at = ? WHERE username = ?"))) 
	    		{
	       			 echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    		}
				    $stmt->bind_param("ss", $expiration_final_date, $username);
				    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
				    $result = $stmt->get_result();
				    $stmt->close();
		    }*/
            echo('1'); // successful login
            if($row['is_admin'] == 1)
            {
                die('4');
            }

            if($row['cheat'] == 1)
            {
                echo('1');
            }
            elseif($row['cheat'] == 2)
            {
                echo('2');
            }
            elseif($row['cheat'] == 3)
            {
                echo('3');
            }
            elseif($row['cheat'] == 4)
            {
                echo('4');
            }
            else
            {
                echo('0');
            }
        }
        else if($row['is_banned'] == 1)
        {
           die('2'); // banned
        }
        else if (strcmp($row['hwid'], $hwid_loader) != 0)
        {
            die('3'); // incorrect hwid
        }
        else
        {
            die('4'); //incorrect details. either username or password is wrong.
        }
    }
    $stmt->close();

?>