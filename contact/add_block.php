<?php
include_once "../function.php";
$accountid1 = $_GET['accountid1'];
$accountid2 = $_GET['accountid2'];

$result = mysql_query( "select * from account where accountid='$accountid2'" );
$contact_name = mysql_fetch_row($result)[1];

add_block($accountid1, $accountid2);
echo "User $contact_name is blocked";

mysql_free_result($result);
?>
