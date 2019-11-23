<?php

date_default_timezone_set('Europe/London');
$data = array();

/*link to database*/
require_once('../includes/db.php');

/* covert date */
$postedDate = $_POST['date'];
$date = explode("/", $postedDate);
$date = $date[2] . "-". $date[1] . "-". $date[0];
/*select events*/
$query1 ="  SELECT * 
            FROM `booking`
            WHERE BookingDate = '$date'
        ";
$smt1 = $DBH->prepare($query1);
$smt1->execute();

$result = $smt1->fetchAll();

foreach($result as $row){
    $data[] = array(
        'start' => $row['StartTime'],
        'end' => $row['EndTime']
    );
}

$unavailable = [];


$availableStart = new DateTime('08:00');
$availableEnd = new DateTime('19:45');
$availableInterval = new DateInterval('PT15M');

$availablePeriod = new DatePeriod($availableStart, $availableInterval, $availableEnd);
foreach($availablePeriod as $availableTime) {
    $availableTimes[] = $availableTime->format('H:i');
}

foreach ($data as $time) {
    $start = new DateTime($time['start']);
    $end = new DateTime($time['end']);
    $end = $end->modify('+30 minutes');
    $interval = new DateInterval('PT15M');

    $period = new DatePeriod($start, $interval, $end);
    foreach ($period as $unavailableTime) {
        $unavailableTimes[] = $unavailableTime->format('H:i');
    }
}

$available = array_diff($availableTimes, $unavailableTimes);
//$available = implode(",", $available);


echo json_encode(array_values($available));

?>