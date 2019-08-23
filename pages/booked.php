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
            $stmt=$DBH->prepare('
            SELECT `booking`.`BookingID`,`BookingDate`,`BookingTime`,`CollectionAddress`,`CollectionPostcode`, child.FirstName, service.ServiceName, service.Length 
            FROM `booking`
            LEFT JOIN service 
            ON service.ServiceID = booking.ServiceID 
            INNER JOIN child 
            ON child.ChildID = booking.ChildID 
            LEFT JOIN staffallocation 
            ON staffallocation.BookingID = booking.BookingID
            ');
            $stmt->execute();
            while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){
        ?>

        <tr>
            <td> <?php echo $rows['BookingDate']; ?></td>
            <td> <?php echo $rows['BookingTime']; ?></td>
            <td> <?php echo $rows['Length']."Hr ".$rows['ServiceName']; ?></td>
            <td> <?php echo $rows['CollectionAddress']." ".$rows['CollectionPostcode']; ?></td>
            <td> <?php echo $rows['FirstName']; ?></td>
            <td><select id="bookedSelect" onchange="changeAllocation(<?php echo $rows['BookingID']; ?>)">
                <option>---</option>
                <?php
                $smt=$DBH->prepare('SELECT `StaffID`,`FirstName`,`LastName` FROM `staff`');
                $smt->execute();
                while($row=$smt->fetch(PDO::FETCH_ASSOC)){?>
                <option value="<?php echo $row['StaffID']?>"><?php echo $row['FirstName']." ".$row['LastName']; ?></option>
                <?php }?>
            </select></td>
        </tr>
            <?php } ?>
    </table>
</div>
</div>