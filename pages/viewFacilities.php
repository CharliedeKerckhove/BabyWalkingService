<?php
/*select facilities*/
$locationID = $_GET['i'];
$query ="SELECT LocationName, CityTown, Postcode, facility_name
          FROM `locations` 
          WHERE LocationID = '".$locationID."'";
$smt1 = $DBH->query($query);
while ($row = $smt1->fetch()): ?>

<h2><?php echo $row['LocationName'] ?></h2>

<div class="locationList">
    <h4>Located:</h4>
    <h4><?php echo $row['CityTown'] ?>, <?php echo $row['Postcode'] ?></h4>
</div>
<div class="facilities">
<h4>Facilities available:</h4>
<div class="facilitiesList">
    <?php 
        $facilities = explode(",", $row['facility_name']);
        foreach ($facilities as $facility):
    ?>
    <p><?php echo $facility; ?></p>
        <?php endforeach; ?>
        </div>
</div>

<?php endwhile; ?>
<button class='facilitiesBtn'><a href='admin.php?p=locations'>Back</a></button>
