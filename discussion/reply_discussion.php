<?php
session_start();
include_once "../mysqlClass.inc.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}

if (isset($_POST['rpl_discussion'])) {
  $topicid = $_GET['topicid'];
  $accountid = $_POST['accountid'];
  $content = $_POST['content'];
  $time=date("Y/m/d")." ".date("H:i:s");
  mysql_query("INSERT INTO discussion (`discussid`,`topicid`,`accountid`,`content`,`post_time`)
      VALUES (NULL,'$topicid','$accountid','$content','$time')");
  header('Location: display_discussion.php?topicid='.$topicid);
}

?>
