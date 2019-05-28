<?php 
/*requires login to book*/
if(empty($_SESSION['carerData']['Email'])){
    $error = "You must log in to book!";   
    echo '<h2 class="errormsg">Error: '.$error.'<br><br></h2>';
}
else{
    /*select children parented by logged in carer*/
    $query = 'SELECT * FROM `child` WHERE CarerID IN(
    SELECT CarerID FROM `carer` WHERE Email =:email)';
    $carerschild = $DBH->prepare($query);
    $carerschild->bindParam(':email', $_SESSION['carerData']['Email']);
    $carerschild->execute();
    
    /*select services available*/
    $query2 = 'SELECT * FROM `service`';
    $service = $DBH->prepare($query2);
    $service->execute();

    if(isset($_POST["submit"])){   
        /*insert new booking information to database*/
        $query3 ='INSERT INTO `booking` (BookingID, ServiceID, BookingDate, BookingTime, CollectionAddress, CollectionPostcode, ChildID) VALUES (NULL, :service, :bookingdate, :bookingtime, :collectionaddress, :collectionpostcode, :child)';
        $smt = $DBH->prepare($query3);
        $smt->bindParam(':service', $_POST["service"]);
        $smt->bindParam(':bookingdate', $_POST["date"]);
        $smt->bindParam(':bookingtime', $_POST["time"]);
        $smt->bindParam(':collectionaddress', $_POST["address"]);
        $smt->bindParam(':collectionpostcode', $_POST["postcode"]);
        $smt->bindParam(':child', $_POST["child"]);
        $smt->execute();
      
    echo "<script> window.location.assign('carer.php?p=bookings'); </script>";
    }

?>
    <div class="content">
        <form id="bookingForm" action="" method="POST">
            <h3>Service</h3>
            <select id="service" name="service">
                <option value="" required>Select A Service</option>
                <?php
            /*display services availble*/
            while($row2 = $service->fetch(PDO::FETCH_ASSOC)) { 
                echo "<option value='".$row2["ServiceID"]."'> ".$row2['ServiceName']."&#160;".$row2['Length']." hour &#163;".$row2['Price']."</option>";
            }
            ?>
            </select>
            <h3>Date</h3>
            <input type="date" class="bookingInput" name="date" placeholder="Select Date" required>
            <h3>Time</h3>
            <input type="time" class="bookingInput" name="time" placeholder="Select Time" step="1" required>
            <h3>Collection Address</h3>
            <input type="text" class="bookingInput" name="address" placeholder="Enter Collection Address" required>
            <h3>Collection Postcode</h3>
            <input type="text" class="bookingInput" name="postcode" placeholder="Enter Collection Postcode" required>
            <h3>Child</h3>
            <select id="service" name="child">
                <option>Select Child</option>
                <?php
                    /*display children available*/
                    if ($carerschild->rowCount() == 0){
                        echo "<option>Please log in and register a child</option>";
                    }else{
                        while($row = $carerschild->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$row["ChildID"]."'>".$row['FirstName']."</option>";
                        }
                    }
                ?>
            </select>
            <button type="submit" class="booknow" id="submitbtn" name="submit">Book Now</button>
        </form>
    </div>
<?php } ?>