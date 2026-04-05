<?php 
require "config.php";


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
        if (!($stmt = mysqli_prepare($con, "INSERT INTO `loader_keys` (loader_keys) VALUES (?)"))) 
        {
            echo "Prepare_insert failed: (" . $con->errno . ") " . $con->error;
        }
        $stmt->bind_param("s", $randomString);
        $stmt->execute();
        $stmt->close();

    }

    echo(generateInviteCode());


?>