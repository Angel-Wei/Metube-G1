<?php
session_start();
include_once "../mysqlClass.inc.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}

if (isset($_POST['reply_msg'])) {
  $parent_msg_id = $_GET['msg_id'];
  $content = $_POST['content'];
  if ($content == '') {
    echo "<script type='text/javascript'>
          alert('Empty message. Sent failed.');
          window.location='display_message.php?msg_id=$parent_msg_id';
          </script>";
  }
  else {
    $query = "select * from message WHERE messageid='$parent_msg_id'";
    $result = mysql_query( $query );
    $row = mysql_fetch_row($result);
    $from_id = $row[2];
    $to_id = $row[1];
    $subject = $row[3];
    $time=date("Y/m/d")." ".date("H:i:s");
    mysql_query("INSERT INTO message (`messageid`,`from_id`,`to_id`,`subject`,`content`,`message_time`)
      VALUES (NULL,'$from_id','$to_id','$subject','$content','$time')");
    mysql_free_result($result);
    echo "<script type='text/javascript'>
          alert('Message sent.');
          window.location='message.php';
          </script>";
    }
}

?>
