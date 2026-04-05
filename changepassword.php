        <title>3tSoftware @ change password</title>
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

        <form method="post" action="changepassword.php">
            <div>
            <center><input type="text" class="textbox" name="access" placeholder="new password" />
            </div>
            <center><input type="submit" name="submitbutton" value="change password"/></center>
        </form>


<?php
        require_once "config.php";

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
            echo '<font color="white"><center>you must write a new password<br>';
            }
            else update_code($access_code, $name); 
        }

        function update_code($access_code, $name)
        {
            global $con;
            $xdddd = password_hash($access_code, PASSWORD_BCRYPT);
            
            if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET `password` = ? WHERE username = ?"))) 
            {
                echo "Prepare_update failed: (" . $con->errno . ") " . $con->error;
            }
            $stmt->bind_param("ss", $xdddd, $name);
            if ($stmt->execute())
            {
                echo '<font color="white"><center><br>you have modified your password</p>';
                return true;
            }
            $stmt->close();
        }

?>