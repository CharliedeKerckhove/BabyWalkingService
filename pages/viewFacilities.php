<?php
/*select facilities*/
$locationID = $_GET['i'];
$query ="SELECT LocationName, CityTown, Postcode, facility_name
          FROM `locations` 
          WHERE LocationID = '".$locationID."'";
$smt1 = $DBH->query($query);
while ($row = $smt1->fetch()): ?>

<h2><?php echo $row['LocationName'] ?></h2>
<table class="displayTable">
    <tr>
        <td><h4>Located:</h4></td>
        <td class="locationList">
            <?php echo $row['CityTown'] ?>, <?php echo $row['Postcode'] ?>
        </td>
    </tr>
    <tr class="facilities">
    <td><h4>Facilities available:</h4></td>
    <td class="facilitiesList">
        <?php 
            $facilities = explode(",", $row['facility_name']);
            foreach ($facilities as $facility):
        ?>
            <p><?php echo $facility; ?></p>
            <?php endforeach; ?>
    </td>
    </tr>
</table>
<?php endwhile; ?>
<button class='facilitiesBtn'><a href='admin.php?p=locations'>Back</a></button>
