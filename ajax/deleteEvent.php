<?php
/*link to database*/
require_once('../includes/db.php');

/*select events*/
$query1 ='  DELETE FROM `booking`
            WHERE BookingID = '.$_POST['bookingid'];
$smt1 = $DBH->prepare($query1);
$smt1->execute();

?>