<?php
    /*select allergy options*/
    $smt = $DBH->prepare('SELECT * FROM allergylist');
    $smt->execute();
    $allergies = $smt->fetchAll();
    /*seperate selected allergies*/
    if(isset($_POST["submit"])){
        $allergy = implode(', ', $_POST["allergy"]);
        /*insert children information to database*/
        $query="INSERT INTO `child` (CarerID, FirstName, Age, Allergies) VALUES (:carer, :name, :age, :allergy)";
        $result = $DBH->prepare($query);
        $result->bindParam(':carer',  $_SESSION['carerData']['CarerID']);
        $result->bindParam(':name', $_POST['childname']);
        $result->bindParam(':age', $_POST['age']);
        $result->bindParam(':allergy', $allergy);
        $result->execute();
      
    echo "<h2>You have registered a new child called: " .$_POST['childname']."</h2>";
    }
?>
<div class = "content">
    
<div class="tab-group">

<!-- start tab-1 -->
<div class="tab">
    <input class="tabinputs" id="tab-1" type="radio" name="tabs" checked>
    <label for="tab-1"><h2>Registered children</h2></label>
    <div class="tab-content">
        <div id = "childrencont">
            <table id="regChildren" class = "accounttbl">
                
            </table>
        </div>
    </div>
</div>
<!-- end tab-1 -->

<!-- start tab-2 -->
<div class="tab">
    <input class="tabinputs" id="tab-2" type="radio" name="tabs">
    <label for="tab-2"><h2>Register new child</h2></label>
    <div class="tab-content">
        <form class="newchildform" action="carer.php?p=children" method="post">
        <h3>Child&#39;s Name</h3>
        <input type = "text" class = "bookingInput" name = "childname" placeholder = "Enter Child&#39;s Name">
        <h3>Enter Child&#39;s Age</h3>
        <input type = "text" class = "bookingInput" name = "age" placeholder = "Enter Child&#39;s Age">
        <h3>Select Allergies</h3>
        <div id = "checkbxscont">
            <?php foreach ($allergies as $row) {
                echo '<h4 class = "checkbxs"><input type="checkbox" name="allergy[]" value="' . $row["AllergyName"] . '" />&#160;' . $row['AllergyName'] . '</h4>';
            } ?>
        </div>
            <br><br>
        <button type = "submit" class = "booknow" id = "registerchildbtn" name="submit">Register Child</button>
    </form>
    </div>
</div>
<!-- end tab-2 -->   
</div>
    
</div>