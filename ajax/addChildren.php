<?php
/*link to database*/
require_once('../includes/db.php');

if($_POST['childname'] && $_POST['age'] && $_POST['carer']){
        /*insert child info to database*/
        $query="INSERT INTO `child` (ChildID, CarerID, FirstName, Age, Allergies) VALUES (NULL, :carer, :name, :age, :allergy)";
        $result = $DBH->prepare($query);
        $result->bindParam(':carer', $_POST['carer']);
        $result->bindParam(':name', $_POST['childname']);
        $result->bindParam(':age', $_POST['age']);
        $result->bindParam(':allergy', $_POST['allergy']);
        $result->execute();

    echo "Done - Magic!";
}
?>
