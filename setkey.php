        <title>3tSoftware @ set license key</title>
        <link rel="icon" href="https://3tcheats.xyz/favicon.png" type="image/png" sizes="16x16">
        <meta property="og:type" content="website">
        <meta name="description" content="3tSoftware - Use the best cheats on the market.">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="3tSoftware - Use the best cheats on the market.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/assets/jquery.min.js"></script>
        <script src="/assets/bootstrap.min.js" type="0cb4f690815a3b6ce4413f33-text/javascript"></script>
        <script src="/assets/particles.min.js"></script>
        <script src="/assets/main.js" type="ea6ea3b2bbdf438d2fdee388-text/javascript"></script>
        <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="ea6ea3b2bbdf438d2fdee388-|49" defer=""></script>
        <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="0cb4f690815a3b6ce4413f33-|49" defer=""></script>
	<link rel="stylesheet" href="/assets/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/style.css" />
        <link rel="stylesheet" href="../css/animate.css"> 

        <div id="particles-js"></div>

        <div class="centered">
        <div class="main">
                <center><h1>3tSoftware</h1>

        <form method="post" action="setkey.php">
            <div>
            <center><input type="text" class="textbox" name="access" placeholder="license key" />
            </div>
<center><input type="submit" name="submitbutton" value="approve license key"/></center>

    </form>
    <br>

<?php
require_once "config.php";

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


        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }

        if ($_SESSION['loggedin'] != 1)
        {
            die(header('Location: index.php'));
        }
        if(!isset($_POST['access'])) $_POST['access']=0;
        $access_code = $_POST['access'];
        $name = $_SESSION['uname'];

        if (isset($_POST['submitbutton']))
        {
            if(empty($access_code))
            {
            echo '<center>you must write your license key<br>';
            }
            else update_code($access_code, $name); 
        }

        function update_code($access_code, $name)
        {
            global $con;
            $xdddd = $_SESSION['uname'];

            if (!($stmt = mysqli_prepare($con, "SELECT username FROM `loader_keys2` WHERE username = ?"))) 
            {
                echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
              $stmt->bind_param("s", $name);
              $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
              $result = $stmt->get_result();
              $row = $result->fetch_assoc();

            if ($result->num_rows > 0)
            {
               die("<font color='white'>you already have a sub. wait until it expires.");
            }
            
            $stmt->close();

            if (!($stmt = mysqli_prepare($con, "SELECT username FROM `loader_keys2` WHERE loader_keys = ?"))) 
            {
                echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
              $stmt->bind_param("s", $access_code);
              $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
              $result = $stmt->get_result();
              $row = $result->fetch_assoc();
            
            if ($row['username'] != NULL)
            {
              echo("<font color='white'>this license key has already been approved.");
              return false;
            }

            if (!($stmt = mysqli_prepare($con, "SELECT loader_keys FROM `loader_keys2` WHERE loader_keys = ?"))) 
            {
                echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
              $stmt->bind_param("s", $access_code);
              $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
              $result = $stmt->get_result();
              $row = $result->fetch_assoc();
            
            if ($result->num_rows < 1)
            {
                echo '<font color="white"><center>invalid license key!';
                return false;
            }

            if (!($stmt = mysqli_prepare($con, "UPDATE loader_keys2 SET `username` = ? WHERE loader_keys = ?"))) 
            {
                echo "Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
            $stmt->bind_param("ss", $xdddd, $access_code);
            if ($stmt->execute())
            {
                echo '<font color="white"><center>you have added your license key.</p>';
                return true;
            }
            $stmt->close();

            if (!($stmt = mysqli_prepare($con, "UPDATE users SET `cheat` = 1 WHERE username = ?"))) 
            {
                echo "Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
            $stmt->bind_param("s", $xdddd);
            $stmt->execute();
            $stmt->close();
        }


        //shit

        if (!($stmt = mysqli_prepare($con, "SELECT * FROM `loader_keys2` WHERE loader_keys = ?"))) 
        {
            echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
        }
            $stmt->bind_param("s", $access_code);
            $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $subscription_type = $row['sub_type'];

         if(empty($row['activated_at']) && empty($row['expires_at']))
            {
                if ($subscription_type == 1)
        {
            if(empty($row['activated_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET activated_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $today_date, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
            if(empty($row['expires_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET expires_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $expiration_final_date_3m, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
        }

        if ($subscription_type == 2)
        {
            if(empty($row['activated_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET activated_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $today_date, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
            if(empty($row['expires_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET expires_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $expiration_final_date_life, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
        }

        if ($subscription_type == 0)
        {
            if(empty($row['activated_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET activated_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $today_date, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
            if(empty($row['expires_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET expires_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $expiration_final_date_1m, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
        }

        if ($subscription_type == 3)
        {
            if(empty($row['activated_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET activated_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $today_date, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
            if(empty($row['expires_at']))
            {
                if (!($stmt = mysqli_prepare($con, "UPDATE `loader_keys2` SET expires_at = ? WHERE loader_keys = ?"))) 
                {
                        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
                }
                    $stmt->bind_param("ss", $expiration_final_date_1d, $access_code);
                    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                    $result = $stmt->get_result();
                    $stmt->close();
            }
        }
            }
?>