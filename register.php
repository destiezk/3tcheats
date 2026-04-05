	
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
        <div class="centered2">
        </div>
        <div class="main">
                <h1>3tSoftware</h1>
                <form method="post" action="">
                <form method="post" action="">
                    <div id="div_login">
                        <div>
                            <input type="text" class="textbox" name="username" placeholder="username" />
                        </div>
                        <div>
                            <input type="password" class="textbox" name="password" placeholder="password"/>
                        </div>
                        <div>
                            <input type="password" class="textbox" name="invite" placeholder="invitation code"/>
                        </div>
                    <div>
                <input type="submit" value="register" name="submitbutton" id="but_submit" />
            </div>
        </div>
    </form>
           
        <?php
require "config.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['submitbutton']))
{
    $username = $_POST['username'];
    $invite = $_POST['invite'];
    $password = $_POST['password'];
    $current_ip = $_SERVER['REMOTE_ADDR'];

    $is_input_valid = true;
    if(empty($username))
    {
        $is_input_valid = false;
        echo '<span style="color:white">username is missing<br>';
    }
    if(empty($password))
    {
        $is_input_valid = false;
        echo '<span style="color:white">password is missing<br>';
    }
    if(empty($invite))
    {
        $is_input_valid = false;
        echo '<span style="color:white">invite is missing<br>';
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password))
    {
         $is_input_valid = false;
        echo '<span style="color:white">symbols can not be used in password<br>';
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username))
      {
           $is_input_valid = false;
          echo '<span style="color:white">symbols can not be used in username<br>';
      }
    $is_input_valid &= check_invitation_code($invite);   
    if($is_input_valid)
    {
        register($username, $password, $invite);
    }
}

function register($username, $password, $invite)
{
    global $con; // DO NOT EVER FORGET THIS FUCKING LINE BEFORE QUERY IN A FUNCTION

    if (!($stmt = mysqli_prepare($con, "SELECT * FROM `users` WHERE username = ?"))) 
    {
        echo "<center>Prepare_check failed aaaaa: (" . $con->errno . ") " . $con->error;
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // printf("Number of rows in result: %d.", $result->num_rows);
    if ($result->num_rows > 0)
    {
        echo '<span style="color:white">please choose another username<br>';
        return false;
    }

    if (!($stmt = mysqli_prepare($con, "UPDATE `invite_codes` SET is_used = 1 WHERE code = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
    $stmt->bind_param("s", $invite);
    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
    $stmt->close();

    $original_ip = $_SERVER['REMOTE_ADDR'];
    $latest_ip = $_SERVER['REMOTE_ADDR'];
    $registered_at = date("m/d/Y h:i:s a", time());
    $hwid = "0";

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $is_admin = "0";
    $is_banned = "0";
    $is_beta = "0";
    if (!($stmt = mysqli_prepare($con, "INSERT INTO `users` (username, password, is_admin, is_banned, ip, register_date, has_sent_hwid) VALUES (?, ?, ?, ?, ?, ?, ?)"))) 
    {
        echo "<center>Prepare_insert failed: (" . $con->errno . ") " . $con->error;
    }
    $stmt->bind_param("ssiissi", $username, $hashed_password, $is_admin, $is_banned, $original_ip, $registered_at, $is_beta);
    if ($stmt->execute())
        echo '<center>successfully registered. please log in now';
    $stmt->close();
}

function check_invitation_code($invite)
{
    global $con; // DO NOT EVER FORGET THIS FUCKING LINE BEFORE QUERY IN A FUNCTION

    if (!($stmt = mysqli_prepare($con, "SELECT is_used FROM `invite_codes` WHERE code = ?"))) 
    {
        echo "<center>Prepare_check failed aaaaa: (" . $con->errno . ") " . $con->error;
    }
    
    $stmt->bind_param("s", $invite);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // printf("Number of rows in result: %d.", $result->num_rows);
    if ($result->num_rows < 1)
    {
        echo '<span style="color:white">invalid invitation code<br>';
        return false;
    }
    
    $row = $result->fetch_assoc();
    // printf("is_used = '%d'", $row['is_used']);
    if ($row['is_used'] == 1)
    {
        echo '<span style="color:white">this invite code has already been used.<br>';
        return false;
    }
    $stmt->close();
    return true;
}


?>