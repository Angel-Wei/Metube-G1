<?php
session_start();
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
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
  // check if all the blanks are filled in
  if (empty($_POST['comment'])||empty($_POST['score'])){
		echo "<script type='text/javascript'>alert('Please fill both the comments and score.');
		window.location='../media/media_view.php?id=$mediaid';</script>";
    exit();
	}

	$comment = mysql_real_escape_string($_POST['comment']);
  $score= $_POST['score'];

	// Public: Allow everyone to comment and rate
	if($comment_permit=="Public")
	{
		// if the current viewer is a registered user and is not blocked
		if(isset($_SESSION['username']))
		{
      if($_SESSION['username']==$uploaded_by)
      echo "<script type='text/javascript'>alert('You cannot comment and rate the media uploaded by yourself');
  		window.location='../media/media_view.php?id=$mediaid';</script>";
      else
      {
        // the user is blocked
        if(block_or_not($_SESSION['username'], $uploaded_by)==1)
        echo "<script type='text/javascript'>alert('You are blocked to comment this media.');
    		window.location='../media/media_view.php?id=$mediaid';</script>";
        // the user is not blocked
        else
        {
          $current_user = $_SESSION['username'];
          $query1 = "insert into comment values (NULL,'$current_user','$mediaid','$comment',current_timestamp,'$score');";
    			$result1=mysql_query($query1)
    			or die("Cannot query the database and insert comment information" .mysql_error());
    			// echo the message indicating the success of the submission
    			echo "<script type='text/javascript'>alert('The comment and rating score is submitted!');
    			window.location='../media/media_view.php?id=$mediaid';</script>";
        }
      }
		}

    // when the viewer is not a registered user in metube
		else if(!isset($_SESSION['username']))
		{
			$query2 = "insert into comment(mediaid, comment, submission_time, score) values ('$mediaid', '$comment', current_timestamp, '$score');";
			$result2=mysql_query($query2)
			or die("Cannot query the database and insert comment information" .mysql_error());
			// echo the message indicating the success of the submission
			echo "<script type='text/javascript'>alert('The comment and rating score is submitted!');
			window.location='../media/media_view.php?id=$mediaid';</script>";
		}
	}

	else if($comment_permit=="Friend")
	{
		// the viewer has to be a registered user in this case
		if(isset($_SESSION['username']))
		{
      if($_SESSION['username']==$uploaded_by)
      echo "<script type='text/javascript'>alert('You cannot comment and rate the media uploaded by yourself');
  		window.location='../media/media_view.php?id=$mediaid';</script>";
      else
      {
        // check if the current user is a friend of the user who uploaded the media and not blocked
  			if(contact_or_not($_SESSION['username'], $uploaded_by)==1 and block_or_not($_SESSION['username'], $uploaded_by)==0)
  			{
  				$query2 = "insert into comment values (NULL, ".$_SESSION['username'].",".$mediaid.",".$comment.", NOW(),".$score.");";
  				$result2=mysql_query($query2)
  				or die("Cannot query the database and insert comment information" .mysql_error());
  				// echo the message indicating the success of the submission
  				echo "<script type='text/javascript'>alert('The comment and rating score is submitted!');
  				window.location='../media/media_view.php?id=$mediaid';</script>";
  			}
        else if(contact_or_not($_SESSION['username'], $uploaded_by)==0 or block_or_not($_SESSION['username'], $uploaded_by)==1)
        {
          echo "<script type='text/javascript'>alert('You are not a friend or family user or blocked to submit comments and ratings.');
  				window.location='../media/media_view.php?id=$mediaid';</script>";
        }
      }
		}

		else if(!isset($_SESSION['username']))
		{
			// non-users cannot comment and rate the media with the permission of Friend
			// echo the message indicating the success of the submission
			echo "<script type='text/javascript'>alert('Sorry, you cannot comment and rate on this media. This can be only done by a friend user');
			window.location='../media/media_view.php?id=$mediaid';</script>";
		}
	}

	else if($comment_permit=="Private")
	{
		echo "<script type='text/javascript'>alert('Sorry, the comment and rating features are not enabled for this media');
		window.location='../media/media_view.php?id=$mediaid';</script>";
	}
}
?>
