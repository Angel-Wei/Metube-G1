<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
	if($_POST['username'] == "" || $_POST['password'] == ""){
		$login_error = "One or more fields are missing.";
	}
	else{
		$check = user_pass_check($_POST['username'],$_POST['password']); // Call functions from function.php
		if($check == 1){
			$login_error = "User ".$_POST['username']." not found.";
		}
		elseif($check==2){
			$login_error = "Incorrect password.";
		}
		else if($check==0){
			$_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']
			header('Location: browse.php');
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<title>MeTube: Log In</title>
<head>
<body>
  <div style="text-align:center;">
		<img src="img/logo.png" class="center" alt="Logo of MeTube" style="width:345px;height:131px;">
  </div>
  <div style="text-align:center; width:40%; height:50%; border: 3px solid #51adcf; margin:0 auto;">
		<form method="post" action="index.php" style="text-align:center">
    <h1 align="middle">Log In</h1>
    <h3 align="middle">Welcome back! Log in to access the MeTube.</h3><br>

    <label for="usrname" align="middle"><b>Username</b></label>
    <input type="text" name="username" placeholder="Enter Username"><br><br>

    <label for="psw" align="middle"><b>Password </b></label>
		<input type="password" name="password" placeholder="Enter Password"><br><br>

    <label align="middle">
    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me</label><br>

		<input name="submit" class="signupbtn" type="submit" value="Login">
		<input name="reset" class="resetbtn" type="reset" value="Reset">
		</form>
  </div>
</body>

<?php
if(isset($login_error)){
	echo "<div id='passwd_result'>".$login_error."</div>";
}
?>
