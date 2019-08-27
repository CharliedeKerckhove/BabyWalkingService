<?php

$data = array();

/*link to database*/
require_once('../includes/db.php');

/*select events*/
$query1 ='SELECT * FROM `allbookings`';
$smt1 = $DBH->prepare($query1);
$smt1->execute();

$result = $smt1->fetchAll();

foreach($result as $row){
    $data[] = array(
        'id' => $row['BookingID'],
        'start' => $row['BookingDate'] . " " . $row['BookingTime'],
        'title' => $row['Length'] . "Hr " . $row['ServiceName']
    );

}
echo json_encode($data);

?>