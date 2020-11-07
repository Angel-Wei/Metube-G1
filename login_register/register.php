<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
include "register_check.php";
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
    <a href="../index.php"><img src="../img/logo.png" class="center" alt="Logo of MeTube" style="width:345px;height:131px;"></a>
  </div>
  <div style="text-align:left; width:40%; height:65%; border: 3px solid #fcbf1e; margin:0 auto;">
  <form method="post" class="modal-content" action="register.php" >
    <h1 align="middle">Sign Up</h1>
    <h3 align="middle">Please fill in this form to create an account.</h3><br>

    <label style="padding-left:150px;" for="usrname" align="middle"><b>Username</b></label>
    <input type="text" name="username" placeholder="Enter Username"><br><br>

    <label style="padding-left:150px;" for="psw"><b>Password</b></label>
    <input type="password" name="psw" placeholder="Enter Password"><br><br>

    <label style="padding-left:150px;" for="psw_repeat"><b>Repeat Password</b></label>
    <input type="password" name="psw_repeat" placeholder="Repeat Password"><br><br>

    <label style="padding-left:150px;" for="email"><b>Email</b></label>
    <input type="text" name="email" placeholder="Enter Email"><br><br>

    <label style="padding-left:150px;" for="sex"><b>Sex</b></label>
    <input type="radio" name="sex" value="Male"> Male
    <input type="radio" name="sex" value="Female" > Female<br>

    <p style="padding-left:10px;">Note: The username is 4 characters minimum; the password is 6 characters minimum (numbers or letters, no special characters allowed.)</p>

    <div>
      <input name="reset" class="signupbtn" style="margin-left:185px;height:40px;width:80px;color:white;background-color: #4CAF50;" type="reset" value="Cancel">
      <input name="submit" class="resetbtn" style="margin-left: 50px;height:40px;width:80px;color:white;background-color: #f44336;" type="submit" value="Sign Up">
    </div>
  </form>
  </div>
</body>
</html>
