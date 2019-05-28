<?php
/*link to database*/
require_once('../includes/db.php');
/*select child information*/
$query2 ='SELECT * FROM `child` WHERE CarerID IN (SELECT CarerID FROM carer WHERE Email = :email)';
$smt3 = $DBH->prepare($query2);
$smt3->bindParam(':email',  $_SESSION['carerData']['Email']);
$smt3->execute();
?>
<?php 
/*if carer has children display their information*/
if($smt3->rowCount()>0){
    while($row=$smt3->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
    <td><br></td>
</tr>
<tr>
    <th>Child&#39;s Name</th>
    <td>
        <?php echo $row['FirstName']; ?>
    </td>
</tr>
<tr>
    <th>Child&#39;s Age</th>
    <td>
        <?php echo $row['Age']; ?>
    </td>
</tr>
<tr>
    <th>Child&#39;s Allergies</th>
    <td>
        <?php echo $row['Allergies']."&#160;"; ?>
    </td>
</tr>
<?php }}else{ $zerochildren = "No children registered to this account";} 
if(!empty($zerochildren)){
            echo '<h2 class="errormsg">'.$zerochildren.'<br><br></h2>';} ?>
