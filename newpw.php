<?php

$access_code = $_GET['access_code'];

echo password_hash($access_code, PASSWORD_BCRYPT);

?>