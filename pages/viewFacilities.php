<?php
/*select facilities*/
$locationID = $_GET['i'];
$query1 ='SELECT LocationName, CityTown, Postcode, facility_name
          FROM `locations` 
          WHERE LocationID = '.$locationID.'';
$smt1 = $DBH->prepare($query1);
$smt1->execute();
?>

<h1>Park Name</h1>

<div class="locationList">
    <h3>Located: </h3>
    <h3> Location</h3>
</div>

<h4>Facilities available:</h4>
