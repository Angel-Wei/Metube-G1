<?php
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
$contact_type = $_GET['contact_type'];
$accountid1 = $_GET['accountid1'];
$accountid2 = $_GET['accountid2'];

$result = mysql_query( "select * from account where accountid='$accountid2'" );
$contact_name = mysql_fetch_row($result)[1];

remove_contact($accountid1, $accountid2);

if ($contact_type == 1) {
  echo "Removed $contact_name from the Family list";
}
elseif ($contact_type == 2) {
  echo "Removed $contact_name from the Friend list";
}
mysql_free_result($result);
?>
