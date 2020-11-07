<?php
include_once "../function.php";
$contact_type = $_GET['contact_type'];
$accountid1 = $_GET['accountid1'];
$accountid2 = $_GET['accountid2'];

add_contact($contact_type, $accountid1, $accountid2);

if ($contact_type == '') {
  echo "Remove from contact list";
}
else {
  echo "Added to $contact_type list";
}
 ?>
