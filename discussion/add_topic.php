<?php
session_start();
include_once "../function.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
if (isset($_POST['add_topic'])) {
  $accountid = $_POST['accountid'];
  $topic = $_POST['topic'];
  if ($topic == '') {
    echo "<script type='text/javascript'>
          alert('Topic must be filled out!');
          window.location='discussion.php';
          </script>";
  }

  else {
    $upper_topic = strtoupper($topic);
    $time=date("Y/m/d")." ".date("H:i:s");
    $query = "select topic from topic where upper(topic)='$upper_topic'";
    $result = mysql_query( $query );
    $count = mysql_num_rows($result);
    if ($count != 0) {
      echo "<script type='text/javascript'>
            alert('Topic $topic already exsists!');
            window.location='discussion.php';
            </script>";
    }
    else {
  	   echo "<script type='text/javascript'>
      	     alert('Topic $topic created. You can go to My Discussion section to read more.');
             window.location='discussion.php';
  	         </script>";
         mysql_query("INSERT INTO topic (`topicid`, `topic`, `creator`, `topic_create_time`)
         VALUES (NULL,'$topic','$accountid','$time')");
  	    }
    mysql_free_result($result);
  }
}
?>
