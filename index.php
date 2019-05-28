<?php 
/*connect to database*/
include('includes/db.php');
/*load header file*/
include('includes/header.php');
/*load page body*/
    if(!empty($_GET['p'])){
        require_once('pages/'.$_GET['p'].'.php');
    }else{
        /*if not page specified load homepage*/
        require_once('pages/home.php');
    }
/*load footer file*/
include('includes/footer.php');
?>