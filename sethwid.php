        <title>3tSoftware @ set your hwid</title>
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
        <form action="sethwid.php" method="post">
        <center><div>
        <center><input type="text" class="textbox" name="hwid" placeholder="your hwid"/>
        <center></div>
        <center>
        <center><input type="submit" name="submitbutton" value="submit"/>
        <center>

<?php
include "config.php";

if ($_SESSION['loggedin'] != 1)
{
    die(header('Location: index.php'));
}

if(!isset($_SESSION) || !isset($_SESSION['uname'])) 
{ 
    echo "<font color='white'>You must be logged in";
    exit();
}

if (isset($_POST['submitbutton']))
    {
        $hwid = $_POST['hwid'];

        if (!($stmt = mysqli_prepare($con, "SELECT has_sent_hwid FROM `users` WHERE username = ?"))) 
        {
                echo "<center>Prepare_check failed aaaaa: (" . $con->errno . ") " . $con->error;
                }
                        $stmt->bind_param("s", $_SESSION['uname']);
                        $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

        if ($row['has_sent_hwid'] == 1)
        {
                echo "<font color='white'>for a hwid reset contact an admin.";
                exit();
        }

        if (empty($hwid))
        {
            echo "<font color='white'>hwid must not be empty";
            exit();
        } 

        /*if (!is_numeric($hwid))
        {
                echo "hwid must be numbers only";
                exit();
        }*/

        $sent_by = $_SESSION['uname'];

        if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET hwid = ? WHERE username = ?"))) 
        {
            echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
        }

        $stmt->bind_param("ss", $hwid, $sent_by);
        $stmt->execute();
        $stmt->close();

        echo "<font color='white'><center>you have successfully authorized yourself.";


        if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET has_sent_hwid = 1 WHERE username = ?"))) 
                {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
        }
                $stmt->bind_param("s", $_SESSION['uname']);
                $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
                $stmt->close();

    }


?>