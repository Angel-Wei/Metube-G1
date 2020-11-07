<?php
include_once "../function.php";
$accountid1 = $_GET['accountid1'];
$accountid2 = $_GET['accountid2'];

add_block($accountid1, $accountid2);
  echo "User blocked";
?>
