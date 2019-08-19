<div class = "content">
<h2>Your Bookings</h2>
<div id = "accountcont">
    <table class = "accounttbl">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Service</th>
            <th>Collection Location</th>
            <th>Child</th>
            <th>Allocate</th>
        </tr>
        <?php 
            /*display all children*/
            $stmt=$DBH->prepare('SELECT * FROM booking');
            $stmt->execute();
            while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){
        ?>

        <tr>
            <td> <?php echo $rows['BookingDate']; ?></td>
            <td> <?php echo $rows['BookingTime']; ?></td>
            <td> <?php echo $rows['ServiceID']; ?></td>
            <td> <?php echo $rows['CollectionAddress']." ".$rows['CollectionPostcode']; ?></td>
            <td> <?php echo $rows['ChildID']; ?></td>
            <td><select>
                <?php foreach($carers->fetch(PDO::FETCH_ASSOC) as $carer):?>
                    <option><?=$carer['FirstName']." ".$carer['LastName']?></option>
                <?php endforeach;?>
                </select>
            </td>

        </tr>
            <?php } ?>
    </table>
</div>
</div>