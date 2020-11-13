<?php
session_start();
include_once "../function.php";

if (isset($_POST['send_msg'])) {
  $from_id = $_GET['send_from'];
  $to_id = $_POST['send_to'];
  $subject = $_POST['subject'];
  $content = $_POST['content'];
  $time=date("Y/m/d")." ".date("h:i:s");
  mysql_query("INSERT INTO message (`messageid`,`from_id`,`to_id`,`subject`,`content`,`message_time`)
      VALUES (NULL,'$from_id','$to_id','$subject','$content','$time')");
  header("Location: message.php");
}

?>
