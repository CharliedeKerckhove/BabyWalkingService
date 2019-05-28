<?php
if(isset($_POST['fname'])){
    //Update carer first name
    $query = "UPDATE carer SET FirstName = :fname WHERE Email = :email";
	$result = $DBH->prepare($query);
	$result->bindParam(':fname', $_POST['fname']);
	$result->bindParam(':email', $_SESSION['carerData']['Email']);
    $result->execute();
    
    $success = "First Name Changed";
}
if(isset($_POST['lname'])){
    //Update carer last name
    $query = "UPDATE carer SET LastName = :lname WHERE Email = :email";
	$result = $DBH->prepare($query);
	$result->bindParam(':lname', $_POST['lname']);
	$result->bindParam(':email', $_SESSION['carerData']['Email']);
    $result->execute();
    
    $success = "Last Name Changed";
}
if(isset($_POST['phone'])){
    //Update carer phone number
    $query = "UPDATE carer SET PhoneNumber = :phone WHERE Email = :email";
	$result = $DBH->prepare($query);
	$result->bindParam(':phone', $_POST['phone']);
	$result->bindParam(':email', $_SESSION['carerData']['Email']);
    $result->execute();
    
    $success = "Phone Number Changed";
}
if(isset($_POST['email'])){
    //Update carer email
    $query = "UPDATE carer SET Email = :email WHERE CarerID = :id";
	$result = $DBH->prepare($query);
	$result->bindParam(':email', $_POST['email']);
	$result->bindParam(':id', $_SESSION['carerData']['CarerID']);
    $result->execute();
    
    $success = "Email Changed";
    echo "<script> window.location.assign('index.php?p=emailchange'); </script>";
}

if(isset($_POST['curpassword']) && isset($_POST['newpassword'])){
    //check all fields are completed
	if(!$_POST['curpassword'] || !$_POST['newpassword'] || !$_POST['newpassword2']){
		$error = "Please complete ALL fields";
	}
    //check passwords match
    else if($_POST['newpassword']!=$_POST['newpassword2']){
        $error = "Passwords do not match";
    }
    //check password is longer than 5 characters
    else if(strlen($_POST['newpassword']) < 5){
        $error = "Your password is too short";
    }
    //No errors password change allowed
	else {
	//Encrypt the password with default salt
	$encryptedPass = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
	//Insert to database
	$query = "UPDATE carer SET CarerPassword = :newpassword WHERE Email = :email";
	$result = $DBH->prepare($query);
	$result->bindParam(':newpassword', $encryptedPass);
	$result->bindParam(':email', $_SESSION['carerData']['Email']);
    $result->execute();
        
    $success = "Password Changed";
    }
}

?>
    <div class="content">
        <div class="tab-group">

            <!-- start tab-1 -->
            <div class="tab">
                <input class="tabinputs" id="tab-1" type="radio" name="tabs" checked>
                <label for="tab-1">
                    <h2>Your account details</h2></label>
                <div class="tab-content">
                    <div id="accountcont">
                        <table class="accounttbl">
                            <tr>
                                <th>First name</th>
                                <td id="hideF">

                                </td>
                                <td id="pencilF" onclick="changeFName()"><i class="fal fa-pencil"></i></td>
                                <form class="passform" action="carer.php?p=account" method="post">
                                    <td>
                                        <input id="inputF" type="text" class="bookingInput" name="fname" placeholder="Enter First Name" required>
                                    </td>
                                    <td>
                                        <button id="updateF" type="submit">Update</button>
                                    </td>
                                </form>
                            </tr>
                            <tr>
                                <th>Last name</th>
                                <td id="hideL">

                                </td>
                                <td id="pencilL" onclick="changeLName()"><i class="fal fa-pencil"></i></td>
                                <form class="passform" action="carer.php?p=account" method="post">
                                    <td>
                                        <input id="inputL" type="text" class="bookingInput" name="lname" placeholder="Enter Last Name" required>
                                    </td>
                                    <td>
                                        <button id="updateL" type="submit">Update</button>
                                    </td>
                                </form>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td id="hideP">

                                </td>
                                <td id="pencilP" onclick="changePhone()"><i class="fal fa-pencil"></i></td>
                                <form class="passform" action="carer.php?p=account" method="post">
                                    <td>
                                        <input id="inputP" type="text" class="bookingInput" name="phone" placeholder="Enter Phone Number" required>
                                    </td>
                                    <td>
                                        <button id="updateP" type="submit">Update</button>
                                    </td>
                                </form>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="hideE">

                                </td>
                                <td id="pencilE" onclick="changeEmail()"><i class="fal fa-pencil"></i></td>
                                <form class="passform" action="carer.php?p=account" method="post">
                                    <td>
                                        <input id="inputE" type="text" class="bookingInput" name="email" placeholder="Enter Email" required>
                                    </td>
                                    <td>
                                        <button id="updateE" type="submit">Update</button>
                                    </td>
                                </form>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end tab-1 -->

            <!-- start tab-2 -->
            <div class="tab">
                <input class="tabinputs" id="tab-2" type="radio" name="tabs">
                <label for="tab-2">
                    <h2>Change your password</h2></label>
                <div class="tab-content">
                    <form class="regform" action="carer.php?p=account" method="post">
                        <h3>Current Password</h3>
                        <input type="password" class="bookingInput" name="curpassword" placeholder="Enter Current Password">
                        <h3>New Password</h3>
                        <input type="password" class="bookingInput" name="newpassword" placeholder="Enter New Password">
                        <h3>Confirm New Password</h3>
                        <input type="password" class="bookingInput" name="newpassword2" placeholder="Confirm New Password">

                        <button type="submit" class="booknow" id="submitbtn">Change Password</button>
                    </form>
                </div>
            </div>
            <!-- end tab-2 -->
            <!-- start tab-3 -->
            <div class="tab">
                <input class="tabinputs" id="tab-3" type="radio" name="tabs">
                <label for="tab-3">
                    <h2>Delete Account</h2>
                </label>
                <div class="tab-content">
                    <button class="booknow"><a href="includes/deleteacc.php">
                        Confirm Account Deletion</a></button>
                </div>
            </div>
            <?php if(!empty($error)){
    echo '<h2 class="errormsg">Error: '.$error.'<br><br></h2>';} ?>
                <?php if(!empty($success)){
    echo '<h2 class="successmsg">Success: '.$success.'<br><br></h2>';} ?>
                    <div id="errors"></div>

        </div>
    </div>
