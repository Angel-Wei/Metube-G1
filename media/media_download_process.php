<?php
session_start();
include_once "../function.php";
if(!$_GET['id']){
	echo "<meta http-equiv=\"refresh\" content=\"0;url=media_browse.php\">";
}
/******************************************************
*
* download by username
*
*******************************************************/
$mediaid=$_GET['id'];
$query = "SELECT * FROM media WHERE mediaid='".$mediaid."'";
$result = mysql_query($query);
$result_row = mysql_fetch_row($result);

// get the media information
$uploaded_by=$result_row[1]; // get the username who uploads the current media
$access=$result_row[7];
$filepath=$result_row[9];

// if the current session has a registered user
if(isset($_SESSION['username']))
{
  $username=$_SESSION['username'];
  //query statement to insert new record into download table
  $insertDownload="insert into download(downloadid,username,mediaid) values(NULL,'$username','$mediaid')";
  if($access=="Public")
  {
    if(block_or_not($username, $uploaded_by)==0)
    {
      header("Content_type: application/octet-stream");
      header("Content-Disposition: attachment; filename = ".$filepath);
      readfile($filepath);
      $queryresult = mysql_query($insertDownload);
    }
    else echo "<script type='text/javascript'>alert('You are blocked. Download failed.');
    window.location='media_browse.php';</script>";
  }

  else if($access=="Friend")
  {
		// if two users are contacts
    if(contact_or_not($username, $uploaded_by)==1)
    {
			if(block_or_not($username, $uploaded_by)==0)
			{
				header("Content_type: application/octet-stream");
	      header("Content-Disposition: attachment; filename = ".$filepath);
	      readfile($filepath);
	      $queryresult = mysql_query($insertDownload);
			}
			else echo "<script type='text/javascript'>alert('You are a friend user, but blocked. Download failed.');
	    window.location='media_browse.php';</script>";
    }
		// if two users are the same
		else if($username==$uploaded_by)
		{
			header("Content_type: application/octet-stream");
			header("Content-Disposition: attachment; filename = ".$filepath);
			readfile($filepath);
			$queryresult = mysql_query($insertDownload);
		}
    else echo "<script type='text/javascript'>alert('You are not a friend user. Download failed.');
    window.location='media_browse.php';</script>";
  }

  else if($access=="Private")
  {
    if($username==$uploaded_by)
    {
      header("Content_type: application/octet-stream");
      header("Content-Disposition: attachment; filename = ".$filepath);
      readfile($filepath);
      $queryresult = mysql_query($insertDownload);
    }
    else echo "<script type='text/javascript'>alert('The file is private. Download failed.');
    window.location='media_browse.php';</script>";
  }
}

// if the current viewer is not a registered user
else
{
  $insertDownload="insert into download(mediaid) values('$mediaid')";
  if($access=="Public")
  {
    header("Content_type: application/octet-stream");
    header("Content-Disposition: attachment; filename = ".$filepath);
    readfile($filepath);
    $queryresult = mysql_query($insertDownload) or die("Insert into table download error in media_download_process.php ".mysql_error());
  }

  else if($access=="Friend")
  {
    echo "<script type='text/javascript'>alert('You cannot download if you are not a friend user.');
    window.location='media_browse.php';</script>";
  }

  else if($access=="Private")
  {
    echo "<script type='text/javascript'>alert('The file is private. Download failed.');
    window.location='media_browse.php';</script>";
  }
}
?>
