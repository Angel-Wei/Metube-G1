<?php
session_start();
include_once "../function.php";
/*
$link = mysql_connect("mysql1.cs.clemson.edu","metube_vm7e","alwo0825","metube_ndyk")
or die("Could not connect:".mysql_error($link));
*/
// the server didn't process the code downbelown at all
if(isset($_POST['submit'])){
  // receive all input values from the form
  $username = mysql_real_escape_string($_POST['username']);
  $psw = mysql_real_escape_string($_POST['psw']);
  $psw_repeat = mysql_real_escape_string($_POST['psw_repeat']);
  $email = mysql_real_escape_string($_POST['email']);
  $sex = (isset($_POST['sex']) ? mysql_real_escape_string($_POST['sex']) : null);//added to avoid php error in case user doesn't specify sex

  $signin_error = array();

  // check if all the blanks are filled in
  if (empty($username)||empty($psw)||empty($psw_repeat)||empty($email)||empty($sex)){
    array_push($signin_error, "One or more fields are missing.\n");
  }

  // check if the user name is valid
  if (!preg_match("/^[a-zA-Z0-9]{4,}$/",$username)){
    array_push($signin_error, "The username must have minimum 4 characters(numbers or letters, no special characters).\n");
  }

  // check if the password is input before it's being repeated.
  if (empty($psw)){
    array_push($signin_error, "Password has to be typed in before confirmation.\n");
  }
  // check if the password is valid
  if (!preg_match("/^[a-zA-Z0-9]{6,}$/",$psw)){
    array_push($signin_error, "Only letters and numbers are allowed in the password (minumum 6).\n");
  }

  // check if the two-time passwords are identical
  if ($psw != $psw_repeat){
    array_push($signin_error, "The repeated-password did not match the first one.\n");
  }

  //check if the email address is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    array_push($signin_error, "Invalid email format.\n");
  }

  // check if the gender info is selected
  if (empty($sex)){
    array_push($signin_error, "The gender info has to be indicated.\n");
  }

  // check if the user exists already
  $verify=check_user_exist($username,$email);
  if ($verify!=0){
    if ($verify==1) array_push($signin_error, "The email address already exists.\n");
    if ($verify==2) array_push($signin_error, "The username already exists.\n");
  }


  if(count($signin_error)!=0){
    echo "<ul>";
    foreach ($signin_error as $value) {
      echo "<li>".$value."</li>";
    }
    echo "</ul>";
  }

  // insert the values into table account if all the requirements are met
  if ($username!="" and $psw!="" and $email!="" and $sex!=""){
    if (count($signin_error) == 0){
      insert_usr($username, $psw, $email, $sex);
      header('Location: login.php');
    }
  }
}
