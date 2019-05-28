<?php 
/*create session variable stating user is logged in*/
$_SESSION['loggedin'] = 'true';
/*connect to database*/
include('includes/db.php');
/*load logged in header file*/
include('includes/carerheader.php');  
/*load page body*/
    if(!empty($_GET['p'])){
        require_once('pages/'.$_GET['p'].'.php');
    }else{
        /*if not page specified load homepage*/
        require_once('pages/carerarea.php');
    }
/*load footer file*/
include('includes/carerfooter.php');
?>