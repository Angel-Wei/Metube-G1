<?php
session_start();
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
if($_GET['id'])
{
  $mediaid = $_GET['id'];
  if($_POST['submit'])
  {
    $new_sharing_mode = $_POST['modeoptions'];
    $username = $_SESSION['username'];
    $result = mysql_query("update media set privacy='$new_sharing_mode' where username='$username';")
      or die ("Cannot change the sharing mode of the media: <br/>". mysql_error());
    echo "<script type='text/javascript'>alert('Sharing mode changed.');
        window.location='media_view.php?id=$mediaid';</script>";
  }
}
?>
