        <title>3tSoftware @ home</title>
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


                if (!($stmt = mysqli_prepare($con, "SELECT expires_at, loader_keys FROM `loader_keys2` WHERE username = ?"))) {
                  echo "Prepare failed: (" . $con->errno . ") " . $con->error;
                }

                $stmt->bind_param("s", $_SESSION['uname']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if ($result->num_rows > 0)
                {
                  $sub_key = $row['loader_keys'];

                  if($row['expires_at'] == NULL)
                  {
                    $valid_until = "unknown yet.";
                  }
                  else
                  {
                    $valid_until = $row['expires_at'];
                  }

                }
                else
                {
                  $valid_until = "you don't have an ongoing subscription.";
                  $sub_key = "no valid keys in use.";
                }
                $stmt->close();


                function function_alert($message) { 
                      
                    // Display the alert box  
                    echo "<script>alert('$message');</script>"; 
                } 

        ?>

<!doctype html>
<html>
    <head></head>
    <body>
    <center>
    <?php echo ('<p style="font-size: 17px; color:white">welcome, ' . $_SESSION['uname'] . "!<br>"); ?>
    <?php echo "your role: " . $role . "<br>" ?>
    <?php echo "your uid: " . $uid . "<br>" ?>
    <?php echo "your sub expires at: " . $valid_until . "<br>" ?>
    <?php //echo "your current license key: " . $sub_key . "<br>" ?>
    <br>
    <a href="sethwid.php">[set hwid (one time)]</a>
    <br>
    <a href="changepassword.php">[change your password]</a>
    <br>
    <a href="setkey.php">[validate your license key]</a>

<br>
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
        echo '<p style="font-size: 13px; color:white; font-family:Verdana">Invitation code: <br>' . $randomString;
        if (!($stmt = mysqli_prepare($con, "INSERT INTO `invite_codes` (code, is_used) VALUES (?, ?)"))) 
        {
            echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
        }
        $not_used = 0;
        $stmt->bind_param("si", $randomString, $not_used);
        $stmt->execute();
        $stmt->close();

    }
    /* if($_SESSION['is_admin'] == 1) 
    { 
    
        echo '<center><form method="post">
        <input type="submit" name="submitbutton" value="generate invitation code"/> 
        </form></center><br>';
    }
    if($_SESSION['is_admin'] == 1) 
    { 
    
        echo '<center><form method="post">
        <input type="submit" name="genlicensekey" value="generate license key"/> 
        </form></center>';
    }*/
    if($_SESSION['is_admin'] == 1) 
    { 
    
        echo '<div class="main2"><center><form method="post">
        <input type="submit" name="admincp" value="admin control panel"/> 
        </form></center></div>';
    }
    if (isset($_POST['submitbutton']))
        {
           echo(generateInviteCode());
        }

    if (isset($_POST['genlicensekey']))
    {
       echo(generateLicenseKey());
    }

    if (isset($_POST['admincp']))
    {
       header('Location: admincp.php');
    }

    ?>
    <br><br>
    <div class="main2">
            <form method='post' action="">
                    <input type="submit" value="logout" name="but_logout">
            </form>
    </div>