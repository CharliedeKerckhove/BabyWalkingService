<?php
/*link to database*/
require_once('../includes/db.php');

/* Get childId by name */

/* Get end date by startdate + service length */


/*select events*/
$query1 ='INSERT INTO `booking` (BookingID, ServiceID, StartDate, EndDate, CollectionAddress, CollectionPostcode, ChildID) VALUES (NULL, :service, :startdate, :enddate, :collectionaddress, :collectionpostcode, :child)';
$smt1 = $DBH->prepare($query1);
$smt1->execute(
    array(
        ':service' => $_POST['service'],
        ':startdate' => $_POST['startDate'],
        ':enddate' => $enddate,
        ':collectionaddress' => $_POST['address'],
        ':collectionpostcode' => $_POST['postcode'],
        ':child' => $childId
    )
);

?>