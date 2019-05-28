<?php
    //Remove all Global Variables
    $_SESSION = [];
    //Remove all Global Variables
    $_SESSION = [];
    //Start Session
    session_start();
    //Remove Set Variables
    session_unset($_SESSION['carerData']);
    session_unset($_SESSION['loggedin']);
    //Destroy Session
    session_destroy();
?>

<h1>You have changed your email!</h1><br>
<h2>Please log in with your new email to return to your personal area!</h2><br>
<h2>Relaxation starts now</h2><br> 
<img id = "registrationimg" src = "images/relaxation.jpg"/>
