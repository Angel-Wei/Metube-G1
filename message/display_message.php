<?php
include_once "../function.php";
session_start();
$user = $_SESSION['username'];
$upper_user = strtoupper($user);
$query="SELECT accountid FROM account WHERE username = '$user'";
$result = mysql_query( $query );
$row = mysql_fetch_row($result);
$accountid1 = $row[0];
mysql_free_result($result);
$msg_id = $_GET['msg_id']; //from message.php, $_POST doesn't work
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profile Page</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="../assets/css/contact_table.css" rel="stylesheet">
    <style> a {color:#4785b8} </style>
    <style>
    fieldset.scheduler-border {
      width: 630px;
      border: 1px groove #ddd !important;
      padding: 0 1em 1em 1em !important;
      /* margin: 0 0 1.5em 0 !important; */
      -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
      margin: 0 auto;
    }

    legend.scheduler-border {
      font-size: 1.0em !important;
      /* font-weight: bold !important; */
      text-align: left !important;
      width:auto;
      padding:0 10px;
      border-bottom:none;
      margin: 0 auto;
    }
    </style>

    <script>
    function replyBox($msg_id) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("reply").innerHTML = this.responseText;
        }
      };
      var msg_id = $msg_id;
      xhttp.open("GET", "reply_message.php?msg_id="+$msg_id, true);
      xhttp.send();
    }
    </script>


</head>


<body>
  <nav class="navbar navbar-default no-margin">
  <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header fixed-brand">

                <!-- show username on toggle button -->
                  <?php
                  echo "
                    <button type='button' class='navbar-toggle collapsed' data-toggle='collapse'  id='menu-toggle'>
                      <span class='glyphicon glyphicon-th-large' aria-hidden='true'></span>$upper_user
                    </button>
                  "
                  ?>
                  <a class="navbar-brand" href="../index.php"> <img src="../assets/images/logo.png" style="margin:-15px 10px 40px 0px"  width="190" alt="MeTube"></a>
                  <input type="text" style="margin-top:10px;margin-left:30px" size="25" placeholder="Search..">

              </div><!-- navbar-header-->

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                           <!-- show username on toggle button -->
                            <?php
                            echo "
                              <li class='active' ><button class='navbar-toggle collapse in' data-toggle='collapse' id='menu-toggle-2'>
                                <span class='glyphicon glyphicon-th-large' aria-hidden='true'></span>$upper_user</button>
                              </li>
                            "
                            ?>
                          </ul>
              </div><!-- bs-example-navbar-collapse-1 -->
  </nav>
  <div id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">

        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <li>
              <a href="../account/profile.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Profile </a>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-video-camera fa-stack-1x "></i></span> Channel</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all uploaded media -->
                <li><a href="../media/media_under_channel.php">Your Media</a></li>
                <!-- Button for upload new media -->
                <li><a href="../media/media_upload.php">Upload New Media</a></li>
                <!-- Button for Playlists -->
                <li><a href="#">Playlists</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-heart fa-stack-1x "></i></span>Favorites</a>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cloud-download fa-stack-1x "></i></span>Downloaded Media</a>
            </li>
            <li>
                <a href="../contact/contact.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Contact</a>
            </li>
            <li class="active">
              <a href="../message/message.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope-square fa-stack-1x "></i></span>Message</a>
            </li>
            <li>
              <a href="../discussion/disucssion.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-comments fa-stack-1x "></i></span>Discussion</a>
            </li>
            <li>
              <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-cart-plus fa-stack-1x "></i></span>Events</a>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-youtube-play fa-stack-1x "></i></span>About</a>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-wrench fa-stack-1x "></i></span>Services</a>
            </li>

            <li>
              <a href="../login_register/logout.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-sign-out fa-stack-1x "></i></span>Logout</a>
            </li>
          </ul>
      </div><!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid xyz">
              <div class="row">
                  <div class="col-lg-12">
                      <h4 style="text-align: center;margin-top:-5px;">
                          <a href="message.php">Message Box</a> |
                          <a href="write_message.php">Compose</a></h4><br>
                      <div class="wrap3" style="margin:0 auto;"> <!--margin:0 auto doesn't work here,but work on below <table>-->
                        <table class="head">
                          <tr>
                          <th class="th1">From</th>
                          <th class="th1">To</th>
                          <th class="th6">Subject</th>
                          <th class="th2">Time</th>
                          </tr>
                        </table>
                        <div>
                            <?php
                              $query = "select * from message WHERE messageid='$msg_id'";
                              $result = mysql_query( $query );
                              $row = mysql_fetch_row($result);
                              $from_id = $row[1];
                              $to_id = $row[2];
                              $subject = $row[3];
                              $content = $row[4];
                              $time = $row[5];
                              $result_from = mysql_query("select * from account WHERE accountid='$from_id'" );
                              $result_to = mysql_query("select * from account WHERE accountid='$to_id'" );
                              $from_name = mysql_fetch_row($result_from)[1];
                              $to_name = mysql_fetch_row($result_to)[1];
                              echo "
                                <table>
                                <tr>
                                  <td class='td1'> $from_name </td>
                                  <td class='td1'> $to_name </td>
                                  <td class='td6'> $subject </td>
                                  <td class='td2'> $time </td>
                                </tr>
                                </table><br><br>
                          </div>
                      </div>
                      ";

                      echo "
                        <fieldset class='scheduler-border'>
                        <legend class='scheduler-border'>Content</legend>
                        <p>$content</p>
                        </fieldset>
                        <br>
                        <div id='reply' style='text-align: center'>
                        <button type='button' onclick=replyBox($msg_id)>Reply</button><br/><br/>
                        <form method='POST' action='delete_message.php?msg_id=$msg_id' enctype='multipart/form-data'>
                        <input name='delete_msg' type='submit' value='Delete'>
                        </form>
                        <br/>
                        <button type='button' onclick='location.href=\"message.php\"'>Back</button>
                        </div>
                        ";
                      mysql_free_result($result_from);
                      mysql_free_result($result_to);
                      mysql_free_result($result);
                    ?>

                  </div>
              </div>
          </div>
      </div>
      <!-- /#page-content-wrapper -->
  </div>


  <!-- /#wrapper -->
  <!-- jQuery -->
  <!-- <script src="../Metube-G1/assets/js/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-1.12.2.js"   integrity="sha256-VUCyr0ZXB5VhBibo2DkTVhdspjmxUgxDGaLQx7qb7xY="   crossorigin="anonymous"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/sidebar_menu.js"></script>
</body>
</body>
</html>