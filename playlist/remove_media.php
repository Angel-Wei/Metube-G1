<?php
session_start();
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
$playlistid = $_GET['playlistid'];
$mediaid = $_GET['mediaid'];
$result = mysql_query("delete from playlistmedia where playlistid='$playlistid' and mediaid='$mediaid'")
  or die ("Cannot delete media from playlistmedia: <br/>". mysql_error());
echo "<script type='text/javascript'>alert('Media removed from playlist');
  window.location='view_playlist.php';</script>";
?>
