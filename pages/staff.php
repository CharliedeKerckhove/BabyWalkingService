<?php
/*select child information*/
$query ='SELECT `FirstName`, `LastName`, `PhoneNumber`, `Email`, `Address`, `Postcode`, `FirstAid`, `DBSCheck` FROM `staff`';
$tableheader = false;
$smt = $DBH->prepare($query);
$smt->execute();
?>
<div class="tableContainer">
	<table class="staffTbl">
	<?php while($row=$smt->fetch(PDO::FETCH_ASSOC)){
		if($tableheader == false) {
				echo '<tr>';
				foreach($row as $key=>$value) {
					echo "<th>{$key}</th>";
				}
				echo '</tr>';
				$tableheader = true;
			}
			echo "<tr>";
			foreach($row as $value) {
				echo "<td>{$value}</td>";
			}
			echo "</tr>";
		}
	?>
	</table>
