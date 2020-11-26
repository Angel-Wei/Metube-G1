<?php
session_start();
include_once "../function.php";
$favoritelistid = $_GET['listid'];
// use inner join to delete playlist records from two tables
$query1 = "delete from favoritelistmedia where favoritelistid='$favoritelistid'";
$query2 = "delete from favoritelist where favoritelistid='$favoritelistid'";
$result1 = mysql_query($query1)
  or die ("Cannot delete record from table favoritelist: <br/>". mysql_error());
$result2 = mysql_query($query2)
    or die ("Cannot delete record from table favoritelistmedia: <br/>". mysql_error());
echo "<script type='text/javascript'>alert('favorite list deleted.');
    window.location='view_favoritelist.php';</script>";
?>
