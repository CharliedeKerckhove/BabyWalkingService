<?php

$data = array();

/*link to database*/
require_once('../includes/db.php');

/*select events*/
$query1 ='  SELECT BookingDate, StartTime, EndTime, CollectionAddress, CollectionPostcode, ServiceName, `child`.FirstName, PhoneNumber 
            FROM `booking` 
            INNER JOIN `service`
            ON `booking`.ServiceID = `service`.ServiceID
            INNER JOIN `child`
            ON `booking`.ChildID = `child`.ChildID
            INNER JOIN `carer`
            ON `child`.CarerID = `carer`.CarerID
            WHERE `booking`.BookingID = :BookingID
        ';
$smt1 = $DBH->prepare($query1);
$smt1->execute(
    array(':BookingID' => $_POST['BookingID'])
);

$result = $smt1->fetch(PDO::FETCH_ASSOC);
$data =[
    'BookingDate' => $result['BookingDate'],
    'StartTime' => $result['StartTime'],
    'EndTime' => $result['EndTime'],
    'CollectionAddress' => $result['CollectionAddress'],
    'CollectionPostcode' => $result['CollectionPostcode'],
    'ServiceName' => $result['ServiceName'],
    'FirstName' => $result['FirstName'],
    'PhoneNumber' => $result['PhoneNumber']
];
echo json_encode($data);

?>