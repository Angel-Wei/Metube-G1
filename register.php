<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
  echo "Hello PHP! I'm on branch anqi";
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<title>MeTube: Sign Up</title>
<head>
<body>
  <!--Layout Reference: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_signup_form_modal-->
  <div style="text-align:center;">
		<img src="img/logo.png" class="center" alt="Logo of MeTube" style="width:345px;height:131px;">
  </div>
  <div style="text-align:left; width:40%; height:60%; border: 3px solid #fcbf1e; margin:0 auto;">
  <form method="post" class="modal-content" action="<?php echo "login.php"; ?>" >
    <h1 align="middle">Sign Up</h1>
    <h3 align="middle">Please fill in this form to create an account.</h3>
    <hr>

    <label style="padding-left:150px;" for="usrname" align="middle"><b>Username</b></label>
    <input type="text" name="username" placeholder="Enter Username"><br><br>

    <label style="padding-left:150px;" for="psw"><b>Password</b></label>
    <input type="password" name="psw" placeholder="Enter Password"><br><br>

    <label style="padding-left:150px;" for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" name="psw-repeat" placeholder="Repeat Password"><br><br>

    <label style="padding-left:150px;" for="email"><b>Email</b></label>
    <input type="text" name="email" placeholder="Enter Email"><br><br>

    <label style="padding-left:145px;">
    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>

    <div class="clearfix">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </form>
  </div>
</body>
