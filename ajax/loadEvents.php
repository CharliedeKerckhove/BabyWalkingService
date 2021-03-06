<?php

$data = array();

/*link to database*/
require_once('../includes/db.php');

/*select events*/
$query1 ='  SELECT * 
            FROM `booking` 
            INNER JOIN `service`
            ON `booking`.ServiceID = `service`.ServiceID
        ';
$smt1 = $DBH->prepare($query1);
$smt1->execute();

$result = $smt1->fetchAll();

foreach($result as $row){
    $data[] = array(
        'id' => $row['BookingID'],
        'start' => $row['BookingDate'] . " " . $row['StartTime'],
        'end' => $row['BookingDate'] . " " . $row['StartTime'],
        'title' => $row['ServiceName'],
        'overlap' => false
    );

}
echo json_encode($data);

?>