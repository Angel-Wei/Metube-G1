<?php
session_start();
include_once "../mysqlClass.inc.php";
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}

if (isset($_POST['delete_msg'])) {

  $msg_id = $_GET['msg_id'];
  mysql_query("DELETE FROM message WHERE messageid='$msg_id'");
  echo "
    <script type='text/javascript'>
      alert('This message has been deleted!')
      location.href='message.php'
    </script>
  ";
}
?>
