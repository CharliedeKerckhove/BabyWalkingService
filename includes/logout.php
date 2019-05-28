<?php
//Remove all Global Variables
$_SESSION = [];
//Start Session
session_start();
//Remove Set Variables
session_unset($_SESSION['carerData']);
session_unset($_SESSION['loggedin']);
//Destroy Session
session_destroy();
//Return Home
echo "<script> window.location.assign('../index.php?p=home'); </script>";
?>