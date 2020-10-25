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
		if ($row[0]==$username and $row[1]==$password) return 0;
		elseif ($row[0]!=$username) return 1; // unmatched username;
		elseif ($row[1]!=$password) return 2; // wrong password;
	}
	mysql_free_result($result); // free memory
}

function updateMediaTime($mediaid)
{
	$query = "	update  media set lastaccesstime=NOW()
   						WHERE '$mediaid' = mediaid
					";
					 // Run the query created above on the database through the connection
    $result = mysql_query( $query );
	if (!$result)
	{
	   die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
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
