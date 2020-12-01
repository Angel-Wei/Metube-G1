<?php
include_once "../function.php";

$contact_type = $_GET['contact_type'];
$accountid1 = $_GET['accountid1'];
$accountid2 = $_GET['accountid2'];

$result = mysql_query( "select * from account where accountid='$accountid2'" );
$contact_name = mysql_fetch_row($result)[1];

add_contact($contact_type, $accountid1, $accountid2);

if ($contact_type == '') {
  echo "Removed $contact_name from contact list";
}
else {
  echo "Added $contact_name to $contact_type list";
}

mysql_free_result($result);
?>
