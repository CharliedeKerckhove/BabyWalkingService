<?php
/*link to database*/
require_once('../includes/db.php');

    //Update carer first name
    $query = "SELECT FirstName, LastName, PhoneNumber, Email FROM carer WHERE CarerID = :id";
	$result = $DBH->prepare($query);
	$result->bindParam(':id', $_SESSION['carerData']['CarerID']);
    $result->execute();
    
    $Carer = $result->fetch(PDO::FETCH_ASSOC);
?>
       
<?php echo $Carer['PhoneNumber'] ?>
