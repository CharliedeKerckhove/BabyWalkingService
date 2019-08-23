<?php
/*link to database*/
require_once('../includes/db.php');

if($_POST['bookingID'] && $_POST['staffID']){
        /*insert child info to database*/
        $query="INSERT INTO `staffallocation` (StaffAllocationID,StaffID,BookingID) VALUES (NULL,:staffId,:bookingId)";
        $result = $DBH->prepare($query);
        $result->bindParam(':staffId', $_POST['staffID']);
        $result->bindParam(':bookingId', $_POST['bookingID']);
        $result->execute();
}
?>