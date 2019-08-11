<?php 
/*create session variable stating user is logged in*/
$_SESSION['loggedin'] = 'true';
/*connect to database*/
include('includes/db.php');
/*load logged in header file*/
include('includes/adminheader.php');  
/*load page body*/
    if(!empty($_GET['p'])){
        require_once('pages/'.$_GET['p'].'.php');
    }else{
        /*if not page specified load homepage*/
        require_once('pages/adminarea.php');
    }
/*load footer file*/
include('includes/adminfooter.php');
?>