<?php
session_start();
include_once "../function.php";
$playlistid = $_GET['listid'];
// use inner join to delete playlist records from two tables
$query1 = "delete from playlistmedia where playlistid='$playlistid'";
$query2 = "delete from playlist where playlistid='$playlistid'";
$result1 = mysql_query($query1)
  or die ("Cannot delete record from table playlist: <br/>". mysql_error());
$result2 = mysql_query($query2)
    or die ("Cannot delete record from table playlistmedia: <br/>". mysql_error());
echo "<script type='text/javascript'>alert('Playlist deleted.');
    window.location='view_playlist.php';</script>";
?>
