<?php
session_start();
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
$favoritelistid = $_GET['favoritelistid'];
$mediaid = $_GET['mediaid'];
$result = mysql_query("delete from favoritelistmedia where favoritelistid='$favoritelistid' and mediaid='$mediaid'")
  or die ("Cannot delete media from favoritelistmedia: <br/>". mysql_error());
echo "<script type='text/javascript'>alert('Media removed from favorite list');
  window.location='view_favoritelist.php';</script>";
?>
