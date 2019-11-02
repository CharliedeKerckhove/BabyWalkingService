<?php

date_default_timezone_set('Europe/London');
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
        'start' => $row['BookingDate'] . " " . $row['StartTime'],
        'end' => $row['BookingDate'] . " " . $row['EndTime']
    );
}

$unavailable = [];


foreach ($data as $daytime) {
    $start = new DateTime($daytime['start']);
    $end = new DateTime($daytime['end']);
    $interval = new DateInterval('PT15M');

    $period = new DatePeriod($start, $interval, $end);
    foreach ($period as $dt) {
        $unavailable[] = $dt->format('Y-m-d');
    }
}

echo json_encode($unavailable);

?>