<?php
session_start();
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}

if (isset($_POST['send_msg'])) {
  $from_id = $_GET['send_from'];
  $to_id = $_POST['send_to'];

  //check whether "I" am blocked by the reciever
  $result_block = mysql_query( "select block from contact where accountid1='$to_id'
                                && accountid2='$from_id' && block!=0 " );
  if (mysql_num_rows($result_block)) {
    $result_name = mysql_query( "select * from account where accountid='$to_id'" );
    $to_name = mysql_fetch_row($result_name)[1];
    echo "<script type='text/javascript'>
          alert('You are blocked by $to_name. Sent failed.');
          window.location='message.php';
          </script>";
    mysql_free_result($result_name);
    mysql_free_result($result_block);
    exit();
  }

  $subject = $_POST['subject'];
  $content = $_POST['content'];
  $time=date("Y/m/d")." ".date("H:i:s");
  mysql_query("INSERT INTO message (`messageid`,`from_id`,`to_id`,`subject`,`content`,`message_time`)
      VALUES (NULL,'$from_id','$to_id','$subject','$content','$time')");
  echo "<script type='text/javascript'>
            alert('Message sent.');
            window.location='message.php';
            </script>";
}

?>
