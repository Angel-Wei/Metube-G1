<?php
session_start();
include "../function.php";

if(isset($_POST['submit']) and isset($_GET['id']))
{
  $profile = get_user_profile($_SESSION['username']);
  $accountid = $profile[0];
  $mediaid = $_GET['id'];
  $favoritelistid = $_POST['listid'];
  // the media has to be in the playlist first and then added to the favorite list
  $tablequery = "create temporary table media_in_playlists select playlist.playlistid, accountid, mediaid from playlist join playlistmedia on playlist.accountid='$accountid' and playlist.playlistid=playlistmedia.playlistid;";
  $tableresult = mysql_query($tablequery)
    or die("Failed to query the playlists owned by the current user by add_to_favoritelist_process.php" .mysql_error());
  $checkresult = mysql_query("select * from media_in_playlists;");
  $num = mysql_num_rows($checkresult);
  if($num==0)
  {
    echo "<script type='text/javascript'>alert('Create your playlist first and add the media before adding the media into your favorite list.');
    window.location='../media/media_view.php?id=$mediaid';</script>";
  }
  else
  {
    // check if the current media is added into one of user's playlists
    $checkquery2 = "select mediaid from media_in_playlists where mediaid='$mediaid';";
    $checkresult2 = mysql_query($checkquery2)
      or die("Failed to query the media in the playlists owned by the user by add_to_favoritelist_process.php" .mysql_error());
    // if no, the media has to be added into playlist first
    if(mysql_num_rows($checkresult2)==0)
    echo "<script type='text/javascript'>alert('The file has to be added into one of your playlist before being added into your favorite list.');
    window.location='../media/media_view.php?id=$mediaid';</script>";
    // if yes, then proceed to add media into favorite list
    else
    {
      // check if this file has been added to one favorite list
      $query = "select * from favoritelistmedia where mediaid='$mediaid' and favoritelistid='$favoritelistid'";
    	$result = mysql_query($query)
          or die ("Could not query the database: ". mysql_error());
    	$count = mysql_num_rows($result);
    	if($count != 0){
        echo "<script type='text/javascript'>alert('The file already exists in the favorite list you specified.');
        window.location='../media/media_view.php?id=$mediaid';</script>";
    	}
      // if not, add media to the specified favorite list and return to the browse page
      else{
        $insertquery = "insert into favoritelistmedia values(NULL,'$favoritelistid','$mediaid')";
        $queryresult = mysql_query($insertquery)
            or die("Insert into table favoritelistmedia error by add_to_favoritelist_process.php" .mysql_error());
        echo "<script type='text/javascript'>alert('This file is added into the favorite list you specified.');
            window.location='../media/media_browse.php';</script>";
    	}
      mysql_free_result($result);
    }
    mysql_free_result($checkresult2);
  }
  mysql_free_result($checkresult);
  mysql_query("drop temporary table media_in_playlists;")
    or die ("Failed to drop the temporary table media_in_playlists" .mysql_error());
}
?>
