<?php 
require "config.php";

/*
sub types:

0 - 1 month
1 - 3 months
2 - lifetime
3 - 1 day
*/

// Today's date
$today_date=date("Y-m-d h:i:s");

// 1 Month
$calculate_expiracy_1month=strtotime("+1 Months");
$expiration_final_date_1m=date("Y-m-d h:i:s", $calculate_expiracy_1month);

//3 Months
$calculate_expiracy_3month=strtotime("+3 Months");
$expiration_final_date_3m=date("Y-m-d h:i:s", $calculate_expiracy_3month);

//Lifetime
$calculate_expiracy_lt=strtotime("+10 Years");
$expiration_final_date_life=date("Y-m-d h:i:s", $calculate_expiracy_lt);

//1 Day
$calculate_expiracy_day=strtotime("+1 Day");
$expiration_final_date_1d=date("Y-m-d h:i:s", $calculate_expiracy_day);

$username = $_GET['username'];
$loader_keys = $_GET['key'];

$subscription_type = NULL;

if (!($stmt = mysqli_prepare($con, "SELECT loader_keys FROM `loader_keys2` WHERE username = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $username);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

    if ($_GET['key'] != $row['loader_keys'])
    {
        die("NO");
    }

if (!($stmt = mysqli_prepare($con, "SELECT * FROM `loader_keys2` WHERE loader_keys = ?"))) 
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
        if (!($stmt = mysqli_prepare($con, "SELECT * FROM `loader_keys2` WHERE loader_keys = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $loader_keys);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

            $subscription_type = $row['sub_type'];

            if(!empty($row['activated_at']) && !empty($row['expires_at']))
            {
                if($row['expires_at'] < $today_date)
                {
                    reset_sub($row['username']);
                    die("-1");
                }
                else
                {
                    die("1");
                }
            }
    }

    function reset_sub($username)
    {
        global $con;
        if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET activated_at = NULL WHERE username = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("s", $username);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
                    if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET expires_at = NULL WHERE username = ?"))) 
                    {
                            echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                    }
                        $stmt->bind_param("s", $username);
                        $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                        $result = $stmt->get_result();
                        $stmt->close();
                        if (!($stmt = mysqli_prepare($con, "DELETE FROM `loader_keys2` WHERE username = ?"))) 
                    {
                            echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                    }
                        $stmt->bind_param("s", $username);
                        $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                        $result = $stmt->get_result();
                        $stmt->close();
    }

?>