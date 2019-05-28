<?php 
    /*select carer's children from database*/
    $query ='SELECT * FROM `child` WHERE CarerID IN (SELECT CarerID FROM carer WHERE Email = :email)';
    $smt = $DBH->prepare($query);
    $smt->bindParam(':email', $_SESSION['carerData']['Email']);
    $smt->execute();
?>
<div class = "content">
<h2>Your Bookings</h2>
<div id = "accountcont">
        <table class = "accounttbl">
            <?php 
            if($smt->rowCount()>0){
                /*display all children*/
                while($row=$smt->fetch(PDO::FETCH_ASSOC)){
                $stmt=$DBH->prepare('SELECT * FROM booking WHERE BookingID IN (SELECT BookingID FROM booking WHERE ChildID=:cid)');
                $stmt->bindParam(':cid',$row['ChildID']);
                $stmt->execute();
                while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr><td><br></td></tr>
            <tr>
                <th>Date Booked</th>
                <td>
                    <?php 
                    echo $rows['BookingDate']; ?>
                </td> 
            </tr>
            <tr>
                <th>Time Booked</th>
                <td>
                    <?php echo $rows['BookingTime']; ?>
                </td> 
            </tr>
            <tr>
                <th>Child</th>
                <td><?php echo $row['FirstName']."&#160;"; ?>
                </td>
            </tr>
            <?php }}
            } else{ $error = "No Current Bookings";} 
            ?>
        </table>
</div>
<!--error message-->
<?php if(!empty($error)){
    echo '<h2 class="errormsg">'.$error.'<br><br></h2>';}
?>
<button class = "booknow" id = "bookingsbtn"><a href = "carer.php?p=booking">Book Now</a></button>
</div>