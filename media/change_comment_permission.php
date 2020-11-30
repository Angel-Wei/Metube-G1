<?php
session_start();
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
include_once "../function.php";
if($_GET['id'])
{
  $mediaid = $_GET['id'];
  if($_POST['submit'])
  {
    $new_comment_permit = $_POST['commentoptions'];
    $username = $_SESSION['username'];
    $result = mysql_query("update media set permission='$new_comment_permit' where username='$username';")
      or die ("Cannot change the comment & rate permission of the media: <br/>". mysql_error());
    echo "<script type='text/javascript'>alert('Comment & rate permission changed.');
        window.location='media_view.php?id=$mediaid';</script>";
  }
}
?>
