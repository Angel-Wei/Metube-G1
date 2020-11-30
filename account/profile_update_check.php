<?php
include_once "../function.php";
session_start();
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
$user = $_SESSION['username'];
$upper_user = strtoupper($user);
$profile = get_user_profile($user);
$password = $profile[2];
$email = $profile[3];
$sex = $profile[4];



if(isset($_POST['submit'])){
  // receive all input values from the form
  $new_username = mysql_real_escape_string($_POST['username']);
  $new_psw = mysql_real_escape_string($_POST['psw']);
  $new_psw_repeat = mysql_real_escape_string($_POST['psw_repeat']);
  $new_sex = (isset($_POST['sex']) ? mysql_real_escape_string($_POST['sex']) : null);
  $signin_error = array();
  // check if all the blanks are filled in
  if (empty($new_username)||empty($new_psw)||empty($new_psw_repeat)||empty($new_sex)){
    array_push($signin_error, "One or more fields are missing.\n");
  }

  // check if the user name is valid
  if (!preg_match("/^[a-zA-Z0-9]{4,}$/",$new_username)){
    array_push($signin_error, "The username must have minimum 4 characters(numbers or letters, no special characters).\n");
  }

  $verify = update_profile_check($new_username, $email);
  if ($verify) {
    array_push($signin_error, "The username already exists.\n");
  }


  // check if the gender info is selected
  if (empty($new_sex)){
    array_push($signin_error, "The gender info has to be indicated.\n");
  }
  // check if the password is input before it's being repeated.
  if (empty($new_psw)){
    array_push($signin_error, "Password has to be typed in before confirmation.\n");
  } elseif (!preg_match("/^[a-zA-Z0-9]{6,}$/",$new_psw)) {
     array_push($signin_error, "Only letters and numbers are allowed in the password (minumum 6).\n");
  } elseif ($new_psw != $new_psw_repeat) {
     array_push($signin_error, "The repeated-password did not match the first one.\n");
  }


  if(count($signin_error)!=0){
    echo "<ul>";
    foreach ($signin_error as $value) {
      echo "<li>".$value."</li>";
    }
    echo "</ul>";
  }

  // insert the values into table account if all the requirements are met
  if (count($signin_error) == 0){
      update_profile($new_username, $new_psw, $email, $new_sex);
      $_SESSION['username']=$new_username; //Set the $_SESSION['username']
      header('Location: profile.php');
  }
}

?>
