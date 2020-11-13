
<?php
session_start();
include "../function.php";
$msg_id = $_GET['msg_id'];

echo "
  <div style='margin:0 auto; width:630px'>
  <p > Reply</p>
  <form name='replyForm' method='POST' action='reply_message_process.php?msg_id=$msg_id'
        onsubmit='return validateForm()' enctype='multipart/form-data'>
  <textarea name='content' style='width: 100%;' rows=3 placeholder='Reply here...'></textarea>
  <br><br>
  <input name='reply_msg' type='submit' value='Send'>
  </form>
  <br>
  <button type='button' onclick='location.href=\"display_message.php?msg_id=$msg_id\"'> Cancel </button>
  </div>
";

?>
