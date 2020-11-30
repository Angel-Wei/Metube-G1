<?php
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
$accountid1 = $_GET['accountid1'];
$accountid2 = $_GET['accountid2'];

$result = mysql_query( "select * from account where accountid='$accountid2'" );
$contact_name = mysql_fetch_row($result)[1];

unblock($accountid1, $accountid2);
echo "Unblock $contact_name";

mysql_free_result($result);
?>
