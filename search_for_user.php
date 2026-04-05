        <title>3tSoftware @ user details</title>
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
        <form method="post" action="search_for_user.php">
            <div>
            <center><input type="text" class="textbox" name="access" placeholder="search for user" />
            </div>
<center><input type="submit" name="submitbutton" value="search"/></center>

    </form>
    </center
   </div>
    <br>


    <?php
require_once "config.php";

if(empty($_GET['fn']))
{
    $_GET['fn'] = NULL;
}

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if ($_SESSION['loggedin'] != 1)
{
    die(header('Location: index.php'));
}

if($_SESSION['is_admin'] == 0) 
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
    echo '<center>you must write an user to search for<br>';
    }
        update_code($access_code); 
}

function update_code($username)
{
    global $con;

    if (!($stmt = mysqli_prepare($con, "SELECT * FROM `users` WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
      $stmt->bind_param("s", $username);
      $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      $_SESSION['selected_user'] = $row['username'];

    echo "<font color='white'>username: " . $row['username'];
    echo "<br>is admin: " . $row['is_admin'];
    if($row['is_banned'] == 0)
        echo "<br>is banned: " . $row['is_banned'] . ' <a href="search_for_user.php?fn=ban&name='.$row["username"].'" >[ban]</a>';
    else
        echo "<br>is banned: " . $row['is_banned'] . ' <a href="search_for_user.php?fn=unban&name='.$row["username"].'" >[unban]</a>';
    echo "<br>ip address: " . $row['ip'];
    echo "<br>register date: " . $row['register_date'];
    sub_expires($row['username']);
    echo "<br>user id: " . $row['userid'];
    if(!empty($row['hwid']))
        echo "<br>hwid: " . $row['hwid'] . ' <a href="search_for_user.php?fn=resethwid&name='.$row["username"].'" >[reset hwid]</a>';
    else   
        echo "<br>hwid: unknown yet.";
    if($row['is_admin'])
    {
        echo "<br>cheat access: 4";
    }
    else
        echo "<br>cheat access: " . $row['cheat'];
    echo "<br>---------------------------";
    echo '<form method="post" action="search_for_user.php">
    <div>
    <center><input type="text" class="textbox" name="changecheat" placeholder="cheat access code" />
    </div>';
    echo '<center><input type="submit" name="changecheatbutton" value="change cheat code"/></center>';
    echo "---------------------------";
    echo "<br>0 - access to NOTHING<br>1 - valorant<br>2 - csgo<br>3 - both cheats<br>4 - everything (staff build)";

}

if(!isset($_POST['changecheat'])) $_POST['changecheat']=1337;
$newcheat = $_POST['changecheat'];

if (isset($_POST['changecheatbutton']))
{
    if(empty($newcheat))
    {
    echo '<center>you must write a new cheat value<br>';
    }
        update_cheat_role($_SESSION['selected_user'], $newcheat); 
}

function sub_expires($username)
{
    global $con;

    if (!($stmt = mysqli_prepare($con, "SELECT expires_at FROM `loader_keys2` WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
      $stmt->bind_param("s", $username);
      $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

    echo '<br>sub expires at: ' . $row['expires_at'];
}

function update_cheat_role($username, $cheatcode)
{
    global $con;
    if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET cheat = ? WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
      $stmt->bind_param("ss", $cheatcode, $username);
      $stmt->execute();
      $result = $stmt->get_result();
      echo("<font color='white'>" . $username . "'s cheat code has been changed");
      $stmt->close();
}

if ($_GET['fn'] == "ban")
{
    if(!empty($_GET['name']))
    {
        ban($_GET['name']);
    }
    else
        print("error");
}
else
{
    printf("");
}

if ($_GET['fn'] == "unban")
{
    if(!empty($_GET['name']))
    {
        unban($_GET['name']);
    }
    else
        print("error");
}
else
{
    printf("");
}

if ($_GET['fn'] == "resethwid")
{
    if(!empty($_GET['name']))
    {
        reset_hwid($_GET['name']);
    }
    else
        print("error");
}
else
{
    printf("");
}

function ban($username)
{
    global $con;

    if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET is_banned = 1 WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      echo("<font color='white'>" . $username . " has been banned");
      $stmt->close();


}

function unban($username)
{
    global $con;

    if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET is_banned = 0 WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      echo("<font color='white'>" . $username . " has been unbanned");
      $stmt->close();

}

function reset_hwid($username)
{
    global $con;

    if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET hwid = NULL WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $stmt->close();

      if (!($stmt = mysqli_prepare($con, "UPDATE `users` SET has_sent_hwid = 0 WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      echo("<font color='white'>" . $username . "'s hwid has been reset");
      $stmt->close();


}

?>