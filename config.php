<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3t3rn";
    
// MySQL Details
// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}


// Error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

set_error_handler("myErrorHandler");
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    printf("$errstr in $errfile:$errline");
    //error_log("$errstr in $errfile:$errline");
    header('HTTP/1.1 500 Internal Server Error', TRUE, 500);
    // echo 'please retry later!';
    // exit;
}
?>
