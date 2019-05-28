<?php
require_once('../includes/db.php');

    //Delete carer information
    $query1 = "DELETE FROM child WHERE CarerID = :id";
	$result1 = $DBH->prepare($query1);
	$result1->bindParam(':id', $_SESSION['carerData']['CarerID']);
    $result1->execute();
    
    $query2 = "DELETE FROM carer WHERE CarerID = :id";
	$result2 = $DBH->prepare($query2);
	$result2->bindParam(':id', $_SESSION['carerData']['CarerID']);
    $result2->execute();
    
	echo "<script> window.location.assign('../index.php?p=home'); </script>";
?>
