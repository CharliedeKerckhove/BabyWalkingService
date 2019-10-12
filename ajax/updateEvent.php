<?php
/*link to database*/
require_once('../includes/db.php');

/* Get childId by name */
$childQuery = ' SELECT `ChildID`
                FROM `child`
                INNER JOIN carer
                ON child.CarerID = carer.CarerID
                WHERE child.FirstName = :FirstName
                AND carer.PhoneNumber = :PhoneNumber';
$smt = $DBH->prepare($childQuery);
$smt->execute(
    array(
        ':FirstName' => $_POST['FirstName'],
        ':PhoneNumber' => $_POST['PhoneNumber'])
    );
$childId = $smt->fetch(PDO::FETCH_ASSOC);
$childId = $childId['ChildID'];

/*select events*/
$query1 ='  UPDATE `booking`
SET ServiceID = :BookingService, BookingDate = :BookingDate, StartTime = :StartTime, EndTime = :EndTime, CollectionAddress = :CollectionAddress, CollectionPostcode = :CollectionPostcode, ChildID = :Child
WHERE BookingID = :BookingID';
$smt1 = $DBH->prepare($query1);
$smt1->execute(
    array(
        ':BookingID' => $_POST['bookingid'],
        ':BookingService' => $_POST['serviceid'],
        ':BookingDate' => $_POST['date'],
        ':StartTime' => $_POST['startTime'],
        ':EndTime' => $_POST['endTime'],
        ':CollectionAddress' => $_POST['address'],
        ':CollectionPostcode' => $_POST['postcode'],
        ':Child' => $childId
    )
);

?>