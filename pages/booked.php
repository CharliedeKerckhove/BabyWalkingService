<div class = "content">
<h2>Your Unallocated Bookings</h2>
<div id = "accountcont">
    <table class = "accounttbl">
        <tr>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Service</th>
            <th>Collection Location</th>
            <th>Child</th>
            <th>Allocate</th>
        </tr>
        <?php 
            /*display all unallocated bookings*/
            $stmt=$DBH->prepare('
            SELECT `booking`.`BookingID`,`BookingDate`,`StartTime`,`EndTime`,`CollectionAddress`,`CollectionPostcode`, child.FirstName, service.ServiceName 
            FROM `booking`
            LEFT JOIN service 
            ON service.ServiceID = booking.ServiceID 
            INNER JOIN child 
            ON child.ChildID = booking.ChildID 
            LEFT JOIN staffallocation 
            ON staffallocation.BookingID = booking.BookingID
            WHERE booking.`BookingID`NOT IN ( 
                SELECT staffallocation.BookingID 
                FROM staffallocation
            )
            ORDER BY `BookingDate`
            ');
            $stmt->execute();
            while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){
        ?>

        <tr>
            <td> <?php echo $rows['BookingDate']; ?></td>
            <td> <?php echo $rows['StartTime']; ?></td>
            <td> <?php echo $rows['EndTime']; ?></td>
            <td> <?php echo $rows['ServiceName']; ?></td>
            <td> <?php echo $rows['CollectionAddress']." ".$rows['CollectionPostcode']; ?></td>
            <td> <?php echo $rows['FirstName']; ?></td>
            <td><select id="bookedSelect" class="bookedSelect" data-booking="<?php echo $rows['BookingID']; ?>">
                <option>---</option>
                <?php
                $smt=$DBH->prepare('SELECT `StaffID`,`FirstName`,`LastName` FROM `staff`');
                $smt->execute();
                while($row=$smt->fetch(PDO::FETCH_ASSOC)){?>
                <option value="<?php echo $row['StaffID'];?>"><?php echo $row['FirstName']." ".$row['LastName']; ?></option>
                <?php }?>
            </select></td>
        </tr>
            <?php } ?>
    </table>
</div>
</div>