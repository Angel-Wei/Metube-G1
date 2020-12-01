<?php
include_once "../function.php";
session_start();
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
$user = $_SESSION['username'];
$upper_user = strtoupper($user);
$query="SELECT accountid FROM account WHERE username = '$user'";
$result = mysql_query( $query );
$row = mysql_fetch_row($result);
$accountid = $row[0];
mysql_free_result($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Group Discussion</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="../assets/css/contact_table.css" rel="stylesheet">
    <style> a {color:#4785b8} </style>
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
                  <form name='search_form' method='GET' action='../search/search.php'
                        onsubmit='return validateForm()' enctype='multipart/form-data'>
                  <a class="navbar-brand" href="../index.php"><img src="../assets/images/logo.png" style="margin:-15px 10px 40px 0px"  width="190" alt="MeTube"></a>
                  <input name='search' type='text' style="margin-top:15px;margin-left:30px" size="20" placeholder="Search.."></input>
                  <button type="submit" name="submit"><i class="fa fa-search"></i> </button>
                  </form>
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
            <a href="../index.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span>Home </a>
          </li>
            <li>
              <a href="../account/profile.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Profile </a>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-video-camera fa-stack-1x "></i></span>Channel</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all uploaded media -->
                <li><a href="../media/media_under_channel.php">Your Media</a></li>
                <!-- Button for upload new media -->
                <li><a href="../media/media_upload.php">Upload New Media</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-music fa-stack-1x "></i></span>Playlist</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all playlists -->
                <li><a href="../playlist/view_playlist.php">Your Playlists</a></li>
                <!-- Button to create a new playlist -->
                <li><a href="../playlist/create_playlist.php">Create New Playlist</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-heart fa-stack-1x "></i></span>Favorites</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all favorite list -->
                <li><a href="../favoritelist/view_favoritelist.php">Your Favorite Lists</a></li>
                <!-- Button to create a new favorite list -->
                <li><a href="../favoritelist/create_favoritelist.php">Create New Favorite List</a></li>
              </ul>
            </li>
            <li>
              <a href="../media/view_downloaded.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cloud-download fa-stack-1x "></i></span>Downloaded Media</a>
            </li>
            <li>
                <a href="../contact/contact.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Contact</a>
            </li>
            <li>
              <a href="../message/message.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope-square fa-stack-1x "></i></span>Message</a>
            </li>
            <li  class="active">
              <a href="../discussion/discussion.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-comments fa-stack-1x "></i></span>Discussion</a>
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
                    <h4 style="text-align: center;margin-top:-5px;"><a href="discussion.php">Group Discussion</a></h4><br>
                    <div style="margin:0 auto;">
                      <table class='head'>
                        <caption style='font-size:16px;margin-bottom:5px; text-align:left;color:orange;'>My Discussion</caption>
                        <tr>
                        <th class='th2'>Topic</th>
                        <th class='th3'>Creator</th>
                        <th class='th3'>Replies</th>
                        <th class='th2'>Create Time</th>
                        <th class='th2'>Last Reply</th>
                        </tr>

                      <?php
                      $query = "select * from topic";
                      $result = mysql_query( $query );
                      while($row = mysql_fetch_row($result)) {
                        $topicid= $row[0];
                        $creator = $row[2];
                        $result_taken = mysql_query( "select accountid from discussion WHERE topicid='$topicid' and accountid='$accountid'" );
                        if ($creator == $accountid or mysql_num_rows($result_taken)) {
                          $topic= $row[1];
                          $create_time = $row[3];
                          $result_user = mysql_query( "select username from account WHERE accountid='$creator'" );
                          $result_replies = mysql_query( "select COUNT(*) from discussion WHERE topicid='$topicid'" );
                          $result_last_reply = mysql_query( "select post_time from discussion WHERE topicid='$topicid' ORDER BY post_time DESC limit 1" );
                          $username = mysql_fetch_row($result_user)[0];
                          $replies = mysql_fetch_row($result_replies)[0];
                          $last_reply = mysql_fetch_row($result_last_reply)[0];
                          echo "
                          <tr>
                            <td class='td2'><a href='display_discussion.php?topicid=$topicid'> $topic </td>
                            <td class='td3'> $username </td>
                            <td class='td3'> $replies </a></td>
                            <td class='td2'> $create_time </td>
                            <td class='td2'> $last_reply </td>
                          </tr>
                          ";
                          mysql_free_result($result_replies);
                          mysql_free_result($result_last_reply);
                        }
                      }
                      echo "</table>";
                      mysql_free_result($result);
                      ?>
                      <br>

                      <table class='head'>
                        <caption style='font-size:16px;margin-bottom:5px; text-align:left;color:orange;'>Choose another Topic</caption>
                        <tr>
                        <th class='th2'>Topic</th>
                        <th class='th3'>Creator</th>
                        <th class='th3'>Replies</th>
                        <th class='th2'>Create Time</th>
                        <th class='th2'>Last Reply</th>
                        </tr>

                      <?php
                      $query = "select * from topic";
                      $result = mysql_query( $query );
                      while($row = mysql_fetch_row($result)) {
                        $topicid= $row[0];
                        $creator = $row[2];
                        $result_taken = mysql_query( "select accountid from discussion WHERE topicid='$topicid' and accountid='$accountid'" );
                        if ($creator != $accountid and mysql_num_rows($result_taken) == 0) {
                          $topic= $row[1];
                          $create_time = $row[3];
                          $result_user = mysql_query( "select username from account WHERE accountid='$creator'" );
                          $result_replies = mysql_query( "select COUNT(*) from discussion WHERE topicid='$topicid'" );
                          $result_last_reply = mysql_query( "select post_time from discussion WHERE topicid='$topicid' ORDER BY post_time DESC limit 1" );
                          $username = mysql_fetch_row($result_user)[0];
                          $replies = mysql_fetch_row($result_replies)[0];
                          $last_reply = mysql_fetch_row($result_last_reply)[0];
                          echo "
                          <tr>
                            <td class='td2'><a href='display_discussion.php?topicid=$topicid'> $topic </td>
                            <td class='td3'> $username </td>
                            <td class='td3'> $replies </a></td>
                            <td class='td2'> $create_time </td>
                            <td class='td2'> $last_reply </td>
                          </tr>

                          ";
                          mysql_free_result($result_replies);
                          mysql_free_result($result_last_reply);
                        }
                      }
                      echo "</table>";
                      mysql_free_result($result);
                      ?>
                      <br>
                      <!-- <button type="button" style="font-size:20px; color:#4785b8" onclick="location.href='add_topic.php'">Add a New Topic</button> -->
                      <p style='font-size:16px;color:orange;'>Create a New Topic</p>
                      <form name='add_topic_form' method='POST' action='add_topic.php'
                            onsubmit='return validateForm()' enctype='multipart/form-data'>
                      <input name='topic' type='text'>
                      <input name='accountid' type='hidden' value='<?php echo "$accountid";?>' >
                      <input name='add_topic' type='submit' value='Add'>
                      </form>

                  </div>
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
