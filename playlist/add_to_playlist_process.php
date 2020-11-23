<?php
session_start();
include "../function.php";

if(isset($_POST['submit']) and isset($_GET['id']))
{
  $mediaid = $_GET['id'];
  $playlistid = $_POST['listid'];

  // check if this file has been added to one playlist
  $query = "select * from playlistmedia where mediaid='$mediaid' and playlistid='$playlistid'";
	$result = mysql_query($query)
      or die ("Could not query the database: ". mysql_error());
	$count = mysql_num_rows($result);
	if($count != 0){
    echo "<script type='text/javascript'>alert('The file already exists in the playlist you specified.');
    window.location='../media/media_view.php?id=$mediaid';</script>";
	}
  // if not, add media to the specified playlist and return to the browse page
  else{
    $insertquery = "insert into playlistmedia(playmediaid,playlistid,mediaid) values(NULL,'$playlistid','$mediaid')";
    $queryresult = mysql_query($insertquery)
        or die("Insert into table playlistmedia error by add_to_playlist_process.php" .mysql_error());
    echo "<script type='text/javascript'>alert('This file is added into the playlist you specified.');
        window.location='../media/media_view.php?id=$mediaid';</script>";
	}
  mysql_free_result($result);
}
?>
