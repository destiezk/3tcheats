<?php 
require "config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_GET['username'];

$key = $_GET['key'];

$sub_type = 0;

$one = 1;


/*
keys:
0 - 1 month
1 - 3 months
2 - 1 day 
*/

// Today's date
$today_date=date("Y-m-d h:i:s");

// 1 Month
$calculate_expiracy_1month=strtotime("+1 Months");
$expiration_final_date_1m=date("Y-m-d h:i:sa", $calculate_expiracy_1month);

//3 Months
$calculate_expiracy_3month=strtotime("+3 Months");
$expiration_final_date_3m=date("Y-m-d h:i:sa", $calculate_expiracy_3month);

if (!($stmt = mysqli_prepare($con, "SELECT * FROM `keys2` WHERE invite = ?"))) 
	    {
	        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
	    }
		    $stmt->bind_param("s", $key);
		    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
		    $result = $stmt->get_result();
		    $row = $result->fetch_assoc();

$sub_type = $row['sub_type'];

if ($sub_type == 0)
{
    if(empty($row['activated_at']))
    {
        if (!($stmt = mysqli_prepare($con, "UPDATE `expiration` SET activated_at = ? WHERE user = ?"))) 
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
        if (!($stmt = mysqli_prepare($con, "UPDATE `expiration` SET expires_at = ? WHERE user = ?"))) 
        {
                echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
        }
            $stmt->bind_param("ss", $expiration_final_date_1m, $username);
            $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
            $result = $stmt->get_result();
            $stmt->close();
    }
    if (!($stmt = mysqli_prepare($con, "UPDATE `keys2` SET is_used = ? WHERE invite = ?"))) 
        {
                echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
        }
            $stmt->bind_param("ss", $one, $key);
            $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
            $result = $stmt->get_result();
            $stmt->close();
            if (!($stmt = mysqli_prepare($con, "UPDATE `expiration` SET sub_type = ? WHERE user = ?"))) 
            {
                    echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
                $stmt->bind_param("ss", $sub_type, $username);
                $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                $result = $stmt->get_result();
                $stmt->close();
}

if ($sub_type == 1)
{
    if(empty($row['activated_at']))
    {
        if (!($stmt = mysqli_prepare($con, "UPDATE `expiration` SET activated_at = ? WHERE user = ?"))) 
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
        if (!($stmt = mysqli_prepare($con, "UPDATE `expiration` SET expires_at = ? WHERE user = ?"))) 
        {
                echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
        }
            $stmt->bind_param("ss", $expiration_final_date_3m, $username);
            $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
            $result = $stmt->get_result();
            $stmt->close();
    }
    if (!($stmt = mysqli_prepare($con, "UPDATE `expiration` SET sub_type = ? WHERE user = ?"))) 
        {
                echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
        }
            $stmt->bind_param("ss", $sub_type, $username);
            $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
            $result = $stmt->get_result();
            $stmt->close();
            if (!($stmt = mysqli_prepare($con, "UPDATE `keys2` SET is_used = ? WHERE invite = ?"))) 
            {
                    echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
                $stmt->bind_param("ss", $one, $key);
                $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                $result = $stmt->get_result();
                $stmt->close();
                if (!($stmt = mysqli_prepare($con, "UPDATE `expiration` SET sub_type = ? WHERE user = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $sub_type, $username);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
}


?>