<?php

$data = array();

/*link to database*/
require_once('../includes/db.php');

/*select events*/
$query1 ='  SELECT * 
            FROM `booking`
        ';
$smt1 = $DBH->prepare($query1);
$smt1->execute();

$result = $smt1->fetchAll();

foreach($result as $row){
    $data[] = array(
        'id' => $row['BookingID'],
        'start' => $row['BookingDate'] . " " . $row['StartTime'],
        'end' => $row['BookingDate'] . " " . $row['StartTime'],
        'overlap' => false,
        'rendering' => 'background',
        'color' => '#ff9f89'
    );

}
echo json_encode($data);

?>