<?php
include "mysqlClass.inc.php";

//used by profile.php
function get_user_profile($username) {
	$query = "select * from account where username='$username'";
	$result = mysql_query( $query )
	   or die ("get_user_profile() failed. Could not query the database: <br />". mysql_error());
	$row = mysql_fetch_row($result);
  return $row;
	mysql_free_result($result);
}


function update_profile_check($username, $email) {
	$query = "select * from account where email!='$email' && username='$username'";
	$result = mysql_query( $query )
		or die ("update_profile() failed. Could not query the database: <br />". mysql_error());
	$count = mysql_num_rows($result);

	if ($count != 0) {
		echo '<script type="text/javascript">';
		echo 'alert("'. $username.' already exists.Please create a new username.")';
		echo '</script>';
		return 1;
	}
	mysql_free_result($result);
}

function update_profile($username, $psw, $email, $sex) {
		$query  = "UPDATE account
							 SET username='$username',password='$psw',sex='$sex'
							 WHERE email='$email'";
		mysql_query($query);
}


// used by register_check.php
function check_user_exist($username,$email){
	$query1 = "select * from account where username='$username'";
	$result1 = mysql_query($query1)
		or die ("check_user_exist() failed. Could not query the database: <br />". mysql_error());
	$count1 = mysql_num_rows($result1);

	$query2 = "select * from account where email='$email'";
	$result2 = mysql_query($query2)
		or die ("check_user_exist() failed. Could not query the database: <br />". mysql_error());
	$count2 = mysql_num_rows($result2);

	if ($count1==0 and $count2!=0){
		echo '<script type="text/javascript">';
		echo 'alert("'. $email.' already exists.Please use a different email address.")';
		echo '</script>';
		return 1;
	}

	if ($count1!=0){
		echo '<script type="text/javascript">';
		echo 'alert("'. $username.' already exists.Please create a new username.")';
		echo '</script>';
		return 2;
	}

	if ($count1==0 and $count2==0){
		return 0;
	}
	mysql_free_result($result); // free memory and close connection
}


// used by register_check.php
function insert_usr($username, $psw, $email, $sex){
	$query  = "INSERT INTO `account` (`username`, `password`,`email`, `sex`)
		VALUES ('$username','$psw','$email','$sex')";
	$result = mysql_query($query);
	if (!$result)
	{
	   die ("insert_usr() failed. Could not query the database: <br />". mysql_error());
	}
	return 1;
	mysql_free_result($result); // free memory and close connection
}

// used by login.php
function user_pass_check($username, $password)
{

	$query = "select * from account where username='$username'";
	$result = mysql_query($query);

	if (!$result)
	{
	   die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	else{
		$row = mysql_fetch_row($result);
		if ($row[1]==$username and $row[2]==$password) return 0;
		elseif ($row[1]!=$username) return 1; // unmatched username;
		elseif ($row[2]!=$password) return 2; // wrong password;
	}
	mysql_free_result($result); // free memory
}

// used by register_check.php-Insert one row, one column of the same username into contact table
function insert_contact_instance($username)
{
	// the default value is 0, once two users are friends, the value will be set to 1 in other functions
	$query1 = "alter table contact add ".$username." boolean default '0';";
	$query2 = "insert into contact (username) values ('".$username."');";
	$result1 = mysql_query($query1);
	$result2 = mysql_query($query2);
	if (!$result1 and !$result2)
	{
	   die ("insert_contact_instance() failed. Could not query the database: <br />". mysql_error());
	}
	mysql_free_result($result1); // free memory
	mysql_free_result($result2); // free memory
}

// used by ../media/media_view.php
function updateMediaTime($mediaid)
{
	$query = "update media set lastaccesstime=NOW() WHERE mediaid = '$mediaid'";
	// Run the query created above on the database through the connection
  $result = mysql_query($query);
	if (!$result)
	{
	   die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
}

// used by ../media/media_view.php
function updateViewCount($mediaid, $viewcount)
{
	$new_view_count = $viewcount + 1;
	$query = "update media set viewcount='$new_view_count' where mediaid = '$mediaid'";
	// run the query to increment the view count of a specific media by 1
	$result = mysql_query($query) or die("Cannot query the database and update the view count" .mysql_error());
}

// check if two users are friends, used by ../media/media_view.php
function contact_or_not($uploaded_by, $current_user)
{
	$contact_query="select ".$current_user." from contact where username='$uploaded_by';";
	$contact_result=mysql_query($contact_query)
	or die("Cannot query the database" .mysql_error());
	$line=mysql_fetch_row($contact_result);
	if($line==1) return 1;
	else return 0;
}

function upload_error($result)
{
	//view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}

function other()
{
	//You can write your own functions here.
}

?>
