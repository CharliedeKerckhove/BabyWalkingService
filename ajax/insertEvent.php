<?php
/*link to database*/
require_once('../includes/db.php');

/* Get childId by name */

/*select events*/
$query1 ='  INSERT INTO `booking` (BookingID, ServiceID, BookingDate, StartTime, EndTime, CollectionAddress, CollectionPostcode, ChildID)
            VALUES (NULL, :BookingService, :BookingDate, :StartTime, :EndTime, :CollectionAddress, :CollectionPostcode, 1)';
$smt1 = $DBH->prepare($query1);
$smt1->execute(
    array(
        ':BookingService' => $_POST['serviceid'],
        ':BookingDate' => $_POST['date'],
        ':StartTime' => $_POST['startTime'],
        ':EndTime' => $_POST['endTime'],
        ':CollectionAddress' => $_POST['address'],
        ':CollectionPostcode' => $_POST['postcode']
    )
);

?>