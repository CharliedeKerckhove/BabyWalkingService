<?php

$data = array();

/*link to database*/
require_once('../includes/db.php');

/*select events*/
$query1 ='  SELECT BookingID, BookingDate, StartTime, EndTime, CollectionAddress, CollectionPostcode, ServiceName, `child`.FirstName, PhoneNumber 
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

/* Get Id for service */
$serviceName = $result['ServiceName'];
$query = "SELECT ServiceID FROM `service` WHERE ServiceName = '" . $serviceName . "'";
$service = $DBH->prepare($query);
$service->execute();
$serviceID = $service->fetch(PDO::FETCH_ASSOC);
$result = array_merge($result, $serviceID);

$data =[
    'BookingID' => $result['BookingID'],
    'BookingDate' => $result['BookingDate'],
    'StartTime' => $result['StartTime'],
    'EndTime' => $result['EndTime'],
    'CollectionAddress' => $result['CollectionAddress'],
    'CollectionPostcode' => $result['CollectionPostcode'],
    'ServiceName' => $result['ServiceID'],
    'FirstName' => $result['FirstName'],
    'PhoneNumber' => $result['PhoneNumber']
];
echo json_encode($data);

?>