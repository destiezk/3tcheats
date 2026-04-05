        <title>3tSoftware @ admincp</title>
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
                <center><h1>3tSoftware</h1>

        <?php
                include "config.php";
                //session_start();

                if(!isset($_SESSION)) 
                { 
                    session_start(); 
                }

                if ($_SESSION['loggedin'] != 1)
                {
                    die(header('index.php'));
                }

                if($_SESSION['is_admin'] == 0) 
                { 
                      die(header('Location: index.php'));
                }

                // Check user login or not
                if(!isset($_SESSION['uname'])){
                    header('Location: index.php');
                }

                // logout
                if(isset($_POST['but_logout'])){
                    session_destroy();
                    header('Location: index.php');
                }



                if (!($stmt = mysqli_prepare($con, "SELECT * FROM `users` WHERE username = ?"))) {
                    echo "Prepare failed: (" . $con->errno . ") " . $con->error;
                }

                $stmt->bind_param("s", $_SESSION['uname']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $_SESSION['is_admin'] = $row['is_admin'];
                $uid = $row['userid'];
                $stmt->close();

                if($_SESSION['is_admin'] == 1)
                {
                    $role = '<font color="red">admin</font>';
                }
                else
                {
                    $role = '<font color="red">user</font>';
                }


                function function_alert($message) { 
                      
                    // Display the alert box  
                    echo "<script>alert('$message');</script>"; 
                } 

                echo "<font color='white'>welcome, " . $_SESSION['uname'] . "!<br><br>";

        ?>
<br>

        <?php 
            function generateInviteCode($length = 45) 
            {
                global $con;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                echo '<center><p style="font-size: 13px; color:white; font-family:Verdana">invite code: <br>' . $randomString;
                if (!($stmt = mysqli_prepare($con, "INSERT INTO `invite_codes` (code, is_used) VALUES (?, ?)"))) 
                {
                    echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
                }
                $not_used = 0;
                $stmt->bind_param("si", $randomString, $not_used);
                $stmt->execute();
                $stmt->close();

            }
            function generateLicenseKey1Day($length = 45) 
            {
                global $con;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                echo '<center><p style="font-size: 13px; color:white; font-family:Verdana">license key [1day]: <br>' . $randomString;
                if (!($stmt = mysqli_prepare($con, "INSERT INTO `loader_keys2` (loader_keys, sub_type) VALUES (?, 3)"))) 
                {
                    echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
                }
                $stmt->bind_param("s", $randomString);
                $stmt->execute();
                $stmt->close();;

            }
            function generateLicenseKey1Month($length = 45) 
            {
                global $con;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                echo '<center><p style="font-size: 13px; color:white; font-family:Verdana">license key [1month]: <br>' . $randomString;
                if (!($stmt = mysqli_prepare($con, "INSERT INTO `loader_keys2` (loader_keys, sub_type) VALUES (?, 0)"))) 
                {
                    echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
                }
                $stmt->bind_param("s", $randomString);
                $stmt->execute();
                $stmt->close();;

            }
            function generateLicenseKey3Months($length = 45) 
            {
                global $con;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                echo '<center><p style="font-size: 13px; color:white; font-family:Verdana">license key [3months]: <br>' . $randomString;
                if (!($stmt = mysqli_prepare($con, "INSERT INTO `loader_keys2` (loader_keys, sub_type) VALUES (?, 1)"))) 
                {
                    echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
                }
                $stmt->bind_param("s", $randomString);
                $stmt->execute();
                $stmt->close();;

            }
            function generateLicenseKeyLifetime($length = 45) 
            {
                global $con;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                echo '<center><p style="font-size: 13px; color:white; font-family:Verdana">license key [lifetime]: <br>' . $randomString;
                if (!($stmt = mysqli_prepare($con, "INSERT INTO `loader_keys2` (loader_keys, sub_type) VALUES (?, 2)"))) 
                {
                    echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
                }
                $stmt->bind_param("s", $randomString);
                $stmt->execute();
                $stmt->close();;

            }
            if($_SESSION['is_admin'] == 1) 
            { 
            
                echo '<div class="main2"><center><form method="post">
                <input type="submit" name="submitbutton" value="generate invitation code"/> 
                </form></center></div><br><br>';
            }
            ?>
    <style>
.dropbtn {
  background-color: transparent;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: transparent;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: transparent;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: transparent;}
</style>
    <?php 
    if($_SESSION['is_admin'] == 1) 
    { 
        echo '<div class="main2"><center><form method="post">
        <input type="submit" name="userdetails" value="search for user"/> 
        </form></center></div><br><br>';
        echo '<div class="main2"><center><form method="post">
        <input type="submit" name="admincp" value="user control panel"/> 
        </form></center></div><br>';
    }

    if (isset($_POST['userdetails']))
        {
           header('Location: search_for_user.php');
        }

    if (isset($_POST['submitbutton']))
        {
           echo(generateInviteCode());
        }

    if (isset($_POST['genlicensekey1d']))
    {
       echo(generateLicenseKey1Day());
    }

    if (isset($_POST['genlicensekey1m']))
    {
       echo(generateLicenseKey1Month());
    }

    if (isset($_POST['genlicensekey3m']))
    {
       echo(generateLicenseKey3Months());
    }

    if (isset($_POST['genlicensekeylt']))
    {
       echo(generateLicenseKeyLifetime());
    }

    if (isset($_POST['admincp']))
    {
       header('Location: home.php');
    }

    if($_SESSION['is_admin'] == 1) 
    { 
        echo '<center>
    <div class="dropdown">
  <button class="dropbtn">generate license keys [hover]</button>
  <div class="dropdown-content">
    <div class="main3"><form method="post">
        <input type="submit" name="genlicensekey1d" value="generate license key [1day]"/> 
        </form>
    <form method="post">
        <input type="submit" name="genlicensekey1m" value="generate license key [1month]"/> 
        </form>
    <form method="post">
        <form method="post">
        <input type="submit" name="genlicensekey3m" value="generate license key [3months]"/> 
        </form>
        <form method="post">
        <input type="submit" name="genlicensekeylt" value="generate license key [lifetime]"/> 
        </form></div>
  </div>
</div>';
        /*echo '<center><form method="post">
        <input type="submit" name="genlicensekey1d" value="generate license key [1day]"/> 
        </form></center>';
        echo '<br><center><form method="post">
        <input type="submit" name="genlicensekey1m" value="generate license key [1month]"/> 
        </form></center>';
        echo '<br><center><form method="post">
        <input type="submit" name="genlicensekey3m" value="generate license key [3months]"/> 
        </form></center>';
        echo '<br><center><form method="post">
        <input type="submit" name="genlicensekeylt" value="generate license key [lifetime]"/> 
        </form></center>';*/
    }

    ?>

    <br><br>
    <div class="main2">
            <form method='post' action="">
                    <input type="submit" value="logout" name="but_logout">
            </form>
    </div>