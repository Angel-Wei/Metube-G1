<?php
session_start();
include_once "../function.php";
// process the submitted form data
if(!isset($_GET['id']))
{
  echo "<script type='text/javascript'>alert('Cannot get the media id');
  window.location='../index.php';</script>";
}
$mediaid=$_GET['id'];
$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
$result = mysql_query( $query );
$result_row = mysql_fetch_row($result);

// get the media information
$uploaded_by=$result_row[1]; // get the username who uploads the current media
$comment_permit=$result_row[8];

if(isset($_POST['submit']))
{
	$comment = mysql_real_escape_string($_POST['comment']);
  $score= $_POST['score'];

	// Public: Allow everyone to comment and rate
	if($comment_permit=="Public")
	{
		// if this is a user
		if(isset($_SESSION['username']))
		{
      $current_user = $_SESSION['username'];
      $query1 = "insert into comment values (NULL,'$current_user','$mediaid','$comment',current_timestamp,'$score');";
			$result1=mysql_query($query1)
			or die("Cannot query the database and insert comment information" .mysql_error());
			// echo the message indicating the success of the submission
			echo "<script type='text/javascript'>alert('The comment and rating score is submitted!');
			window.location='../index.php';</script>";
		}
		else
		{
			// when the viewer is not a registered user in metube
			$query2 = "insert into comment(mediaid, comment, submission_time, score) values ('$mediaid', '$comment', current_timestamp, '$score');";
			$result2=mysql_query($query2)
			or die("Cannot query the database and insert comment information" .mysql_error());
			// echo the message indicating the success of the submission
			echo "<script type='text/javascript'>alert('The comment and rating score is submitted!');
			window.location='../index.php';</script>";
		}
	}

	else if($comment_permit=="Friend")
	{
		// the viewer has to be a registered user in this case
		if(isset($_SESSION['username']))
		{
			// check if the current user is a friend of the user who uploaded the media
			$verify = contact_or_not($uploaded_by, $_SESSION['username']);
			if($verify==1)
			{
				$query2 = "insert into comment values (NULL, ".$_SESSION['username'].",".$mediaid.",".$comment.", NOW(),".$score.");";
				$result2=mysql_query($query2)
				or die("Cannot query the database and insert comment information" .mysql_error());
				// echo the message indicating the success of the submission
				echo "<script type='text/javascript'>alert('The comment and rating score is submitted!');
				window.location='../index.php';</script>";
			}
		}
		// comment and rating score cannot be submitted by the same user who uploaded the file
		else if(isset($_SESSION['username']) and $_SESSION['username']==$uploaded_by)
		{
			// echo the message indicating the success of the submission
			echo "<script type='text/javascript'>alert('You cannot comment and rate the media uploaded by yourself.');
			window.location='../index.php';</script>";
		}

		else if(!isset($_SESSION['username']))
		{
			// non-users cannot comment and rate the media with the permission of Friend
			// echo the message indicating the success of the submission
			echo "<script type='text/javascript'>alert('Sorry, you cannot comment and rate on this media. This can be only done by a friend user');
			window.location='../index.php';</script>";
		}
	}

	else if($comment_permit=="Private")
	{
		echo "<script type='text/javascript'>alert('Sorry, the comment and rating features are not enables for this media');
		window.location='../index.php';</script>";
	}
}
?>
