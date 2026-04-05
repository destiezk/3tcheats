        <title>3tSoftware @ login</title>
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
                        <div id="div_login">
                            <div>
                                <input type="text" class="textbox" name="txt_uname" placeholder="username" />
                            </div>
                            <div>
                                <input type="password" class="textbox" name="txt_pwd" placeholder="password"/>
                            </div>
                            <div>
                <input type="submit" value="login" name="but_submit" id="but_submit" />
            </div>
            </div>
        



        <?php
require_once "config.php";

if(isset($_POST['but_submit']))
{
    if(empty($_POST['txt_uname']))
        echo '<center><span style="color:white">username cannot be empty<br>';

    if(empty($_POST['txt_pwd']))
        echo '<center><span style="color:white">password cannot be empty<br>';

    if (!($stmt = mysqli_prepare($con, "SELECT * FROM `users` WHERE username = ?"))) 
    {
        echo "<center>Prepare_update failed: (" . $con->errno . ") " . $con->error;
    }
    $stmt->bind_param("s", $_POST['txt_uname']);
    $stmt->execute(); // comment this for TESTING --> (I'm lazy to always overwrite is_used to 0)
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $current_ip = $_SERVER['REMOTE_ADDR']; // India

    if ($result->num_rows < 1)
    {
        echo '<center><span style="color:white">nonexistent user';
    }
    else
    {
        if (password_verify($_POST['txt_pwd'], $row['password']) && $row['is_banned'] == 0)
        {
            $_SESSION['uname'] = $_POST['txt_uname']; 
            header('Location: home.php');
            $_SESSION['loggedin'] = 1;
        }
        else if($row['is_banned'] == 1)
        {
            echo('<center><span style="color:white">your user is banned');
        }
        /*else if (strcmp($row['ip'], $current_ip) != 0)
        {
            die('<center>ip doesnt match. please contact an owner.');
        }*/
        else
        {
            echo('<center><span style="color:white">incorrect details');//header('Location: index.php');
        }
    }
    $stmt->close();

}

?>