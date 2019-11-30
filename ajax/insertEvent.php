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

if(empty($childId)) {
    echo json_encode("No Child Found Matching Carer Phone Number");
    return;
}

$formattedDate = $_POST['date'];
$formattedDate = explode("/",$formattedDate);
$formattedDate = $formattedDate[2] . "-" . $formattedDate[1] . "-" . $formattedDate[0];

/*select events*/
$query1 ='  INSERT INTO `booking` (BookingID, ServiceID, BookingDate, StartTime, EndTime, CollectionAddress, CollectionPostcode, ChildID)
            VALUES (NULL, :BookingService, :BookingDate, :StartTime, :EndTime, :CollectionAddress, :CollectionPostcode, :Child)';
$smt1 = $DBH->prepare($query1);
$smt1->execute(
    array(
        ':BookingService' => $_POST['serviceid'],
        ':BookingDate' => $formattedDate,
        ':StartTime' => $_POST['startTime'],
        ':EndTime' => $_POST['endTime'],
        ':CollectionAddress' => $_POST['address'],
        ':CollectionPostcode' => $_POST['postcode'],
        ':Child' => $childId
    )
);

echo json_encode("Booking Added Successfully");
return;

?>