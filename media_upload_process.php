<?php
session_start();
include "function.php";

/******************************************************
* upload document from user
*******************************************************/
$username=$_SESSION['username']; // retrieve the username of the current session

//Create Directory of uploades/ if doesn't exist and change mode
if(!file_exists('uploads/'))
	mkdir('uploads/', 0755);
$dirfile = 'uploads/'.$username.'/'; // filepath of user's uploaded files

if(isset($_POST['submit'])){
	// retrive information from the submitted form data of upload
	$title=$_POST['title'];
	$description=$_POST['description'];
	$keyword=$_POST['keyword'];
	$category=$_POST['category'];
	$privacy_setting=$_POST['privacy'];
	$permission_setting=$_POST['permission'];
	$uploadIP=$_SERVER['REMOTE_ADDR']; // getthe IP address from which the request was sent to the web server.
	$uploadTime=date("Y/m/d")." ".date("h:i:sa"); // get the current date and time

	// check if all the blanks are filled in
  if (empty($title)||empty($description)||empty($keyword)){
		echo '<script>alert("Please provied the title, description, and keyword information.")</script>';
	}

	//Create nested user's directory under uploads and change mode
	if(!file_exists($dirfile)) mkdir($dirfile, 0755);
	if($_FILES["file"]["error"] > 0){
		//error from 1-4
		echo '<script>alert("File errors.")</script>';
	}
	else{
		// encode a string to be used in a query part of a URL
		$upfile = $dirfile.urlencode($_FILES["file"]["name"]);

		if(file_exists($upfile)){
	  		//The file has been uploaded.
				echo '<script>alert("The file has been uploaded.")</script>';
	  }
		else{
			if(is_uploaded_file($_FILES["file"]["tmp_name"])){
				if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
				{
					//Failed to move file from temporary directory
					echo '<script>alert("Failed to movce file from temporary directory.")</script>';
				}
				else /*Successfully upload file*/
				{
					//insert into media table
					$insert = "insert into media ".
					"values(NULL,'$username','". urlencode($_FILES["file"]["name"])."','$title','$description','$keyword',
					'$category','$privacy_setting','$permission_setting','$upfile','$uploadIP','$uploadTime','".$_FILES["file"]["type"]."')";
					$queryresult = mysql_query($insert)
						  or die("Insert into table media error in media_upload_process.php " .mysql_error());
					chmod($upfile, 0644); // change the mode of uploaded file

					$mediaid = mysql_insert_id();
					//insert into upload table
					// INSERT INTO `upload` (`uploadid`, `username`, `filename`, `filepath`, `mediaid`, `upload_data_time`) VALUES
					$insertUpload="insert into upload values(NULL,'$username','". urlencode($_FILES["file"]["name"])."', '$upfile',
					'$mediaid','$uploadTime')";
					$queryresult = mysql_query($insertUpload)
						  or die("Insert into table upload error in media_upload_process.php " .mysql_error());
					//redirect to the profile page and display message of succesfull upload
					echo "<script type='text/javascript'>alert('The file is succesfully uploaded!');
					window.location='./account/profile.php';</script>";
				}
			}
			else{
				//upload file failed
				echo '<script>alert("Upload file failed.")</script>';
			}
		}
	}
}
?>
<!--
<meta http-equiv="refresh" content="0;url=browse.php">
-->
