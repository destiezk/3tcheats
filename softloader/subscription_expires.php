<?php
require "config.php";

$username = $_GET['username'];

if (!($stmt = mysqli_prepare($con, "SELECT expires_at FROM `loader_keys2` WHERE username = ?"))) {
    echo "Prepare failed: (" . $con->errno . ") " . $con->error;
  }
  
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if ($result->num_rows > 0)
  {
    if($row['expires_at'] == NULL)
    {
      $valid_until = "unknown";
    }
    else
    {
      $valid_until = $row['expires_at'];
    }
  }
  else
  {
    $valid_until = "no subscription";
  }
  $stmt->close();

  echo $valid_until;

?>