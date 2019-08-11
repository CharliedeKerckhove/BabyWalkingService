<?php
if(isset($_POST['email']) || isset($_POST['password'])){
	if(!$_POST['email'] || !$_POST['password']){
		$error = "Please enter an email and password";
	}
    else if($_POST['email'] === 'admin' && $_POST['password'] === 'password123'){
		echo "<script> window.location.assign('admin.php?p=adminarea'); </script>";
	}
	else{
		//No errors - lets get the users account
        $query = "SELECT * FROM carer WHERE Email = :email";
		$result = $DBH->prepare($query);
		$result->bindParam(':email', $_POST['email']);
		$result->execute();

		$row = $result->fetch(PDO::FETCH_ASSOC);

		if($row){
		    	//User found - let’s check the password
			if(password_verify($_POST['password'], $row['CarerPassword'])){
				/*create session variables*/    
                $_SESSION['loggedin'] = true;
		    		$_SESSION['carerData'] = $row;
		    		echo "<script> window.location.assign('carer.php?p=carerarea'); </script>";
			}else{
                $error = "Password does not match";
			}
		    	
		}else{
		    	$error = "Email not recognised";
		}

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel = "stylesheet" href = "fontawesome/css/all.css">
    <link rel="stylesheet" href="css/index.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
  <title>Baby Walking Service</title>
</head> 

<body> 
<header>
    <a href = "index.php?p=home"><img alt = "baby walking service logo" id = "logo" src = "images/logo.png"/></a>
    <?php if(!empty($error)){
        echo '<h2 class="errormsg">Error: '.$error.'<br><br></h2>';} ?>
    <h3 class = "loginBtn" onclick = "document.getElementById('id01').style.display='block'" >Log in &nbsp; <i class="fal fa-user-circle"></i></h3>
    
<!--
Adapted from w3schools 
https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_login_form_modal
-->
    <div id="id01" class="modal">
      <form class="modal-content animate" action="index.php" method="post">
        <div class="container">
            <div class = "logincont">
          <label for="uname"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email" class = "logmargin" required>
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" class = "logmargin" required>
</div>
          <button class = "booknow" id = "submitbtn" type="submit">Login</button><br>
          <button class = "altbtn"><a href = "index.php?p=register">Register</a></button>
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
    </div>
</header>