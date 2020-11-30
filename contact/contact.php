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
$accountid1 = $row[0];
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
    <title>Contact Page</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="../assets/css/contact_table.css" rel="stylesheet">

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
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-video-camera fa-stack-1x "></i></span> Channel</a>
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
                <!-- Button to create a new favorite list-->
                <li><a href="../playlist/create_playlist.php">Create New Playlist</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-heart fa-stack-1x "></i></span>Favorites</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all favorite lists -->
                <li><a href="../favoritelist/view_favoritelist.php">Your Favorite Lists</a></li>
                <!-- Button to create a new favorite list -->
                <li><a href="../favoritelist/create_favoritelist.php">Create New Favorite List</a></li>
              </ul>
            </li>
            <li>
              <a href="../media/view_downloaded.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cloud-download fa-stack-1x "></i></span>Downloaded Media</a>
            </li>
            <li class="active">
                <a href="contact.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Contact</a>
            </li>
            <li>
              <a href="../message/message.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope-square fa-stack-1x "></i></span>Message</a>
            </li>
            <li>
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
                      <h4 style="text-align: center;margin-top:-5px;">Contact List</h4><br>
                          <div class="wrap" style="margin:0 auto;"> <!--from contact_table.css-->
                            <table class="head">
                              <caption style="font-size:16px;margin-bottom:5px;">All Users (Scroll down to see all!)</caption>
                              <tr>
                              <th class="th1">Name</th>
                              <th class="th2">Email</th>
                              <th class="th3">Sex</th>
                              <th class="th4">Add</th>
                              <th class="th5">Block</th>
                              </tr>
                            </table>
                            <div class="inner_table">
                              <table>
                              <?php
                              	$query = "select * from account WHERE username != '$user' ORDER BY username";
                              	$result = mysql_query( $query )
                              		or die ("get_all_users failed. Could not query the database: <br />". mysql_error());
                              	while($row = mysql_fetch_row($result)) {
                                  $accountid2 = $row[0];
                                  $result_contact = mysql_query( "select * from contact where accountid1='$accountid1' && accountid2='$accountid2'" );
                                  $row_contact = mysql_fetch_row($result_contact);
                                  if (mysql_num_rows($result_contact) != 0) {
                                    $contact_type = $row_contact[3];
                                    $block_status = $row_contact[4];
                                  }
                                  else {
                                    $contact_type = 0;
                                    $block_status = 0;
                                  }

                                  echo "
                                  <tr>
                                      <td class='td1'>$row[1]</td>
                                      <td class='td2'>$row[3]</td>
                                      <td class='td3'>$row[4]</td>
                                      <td class='td4'>
                                      <select name='addContact' onchange='contact_process(this.value,$accountid1,$accountid2)'>
                                  ";
                                      if ($contact_type == 0) {
                                          echo "
                                              <option value='' selected>Add</option>
                                              <option value='Family'>Family</option>
                                              <option value='Friend'>Friend</option>
                                              </select><br></td>
                                              ";
                                      }
                                      elseif ($contact_type == 1) {
                                          echo "
                                              <option value=''>Add</option>
                                              <option value='Family' selected>Family</option>
                                              <option value='Friend'>Friend</option>
                                              </select><br></td>
                                              ";
                                      }
                                      elseif ($contact_type == 2) {
                                          echo "
                                              <option value=''>Add</option>
                                              <option value='Family'>Family</option>
                                              <option value='Friend' selected>Friend</option>
                                              </select><br></td>
                                              ";
                                      }

                                  if ($block_status == 0) {
                                    echo "
                                      <td class='td5'><a href='#' onclick='block_user($accountid1,$accountid2)'>Block</a></td>
                                    </tr>
                                    ";
                                  }
                                  else {
                                    echo "
                                      <td class='td5' ><i>Blocked</i></td>
                                    </tr>
                                    ";
                                  }
                                  mysql_free_result($result_contact);
                              	}
                              	mysql_free_result($result);
                               ?>
                             </table>
                           </div>
                        </div>
                        <br><br>

                        <div class="wrap2" style="margin:0 auto;">
                          <table class="head">
                            <caption style="font-size:16px;margin-bottom:5px;">Family List</caption>
                            <tr>
                            <th class="th1">Name</th>
                            <th class="th2">Email</th>
                            <th class="th3">Sex</th>
                            <th class="th4">Remove</th>
                            </tr>
                          </table>
                          <div>
                              <?php
                                $query = "select * from contact WHERE accountid1='$accountid1' && type=1";
                                $result = mysql_query( $query )
                                  or die ("get_family_contact failed. Could not query the database: <br />". mysql_error());
                                while($row = mysql_fetch_row($result)) {
                                  $accountid2 = $row[2];
                                  $result_contact = mysql_query( "select * from account WHERE accountid='$accountid2'" );
                                  $row_contact = mysql_fetch_row($result_contact);
                                  $contact_type = "Family";
                                  echo "
                                    <table>
                                    <tr>
                                      <td class='td1'> $row_contact[1] </td>
                                      <td class='td2'> $row_contact[3] </td>
                                      <td class='td3'> $row_contact[4] </td>
                                      <td class='td4'><a href='#' onclick='contact_remove(1,$accountid1,$accountid2)'> Remove </a></td>
                                    </tr>
                                    </table>
                                    ";
                                  mysql_free_result($result_contact);
                                }
                              mysql_free_result($result);
                              ?>
                          </div>
                        </div>
                        <br><br>


                        <div class="wrap2" style="margin:0 auto;"> <!--margin:0 auto doesn't work here,but work on below <table>-->
                          <table class="head">
                            <caption style="font-size:16px;margin-bottom:5px;">Friend List</caption>
                            <tr>
                            <th class="th1">Name</th>
                            <th class="th2">Email</th>
                            <th class="th3">Sex</th>
                            <th class="th4">Remove</th>
                            </tr>
                          </table>
                          <div>
                            <table >
                              <?php
                                $query = "select * from contact WHERE accountid1='$accountid1' && type=2";
                                $result = mysql_query( $query )
                                  or die ("get_family_contact failed. Could not query the database: <br />". mysql_error());
                                while($row = mysql_fetch_row($result)) {
                                  $accountid2 = $row[2];
                                  $result_contact = mysql_query( "select * from account WHERE accountid='$accountid2'" );
                                  $row_contact = mysql_fetch_row($result_contact);
                                  $contact_type = "Friend";
                                  echo "
                                    <tr>
                                      <td class='td1'> $row_contact[1] </td>
                                      <td class='td2'> $row_contact[3] </td>
                                      <td class='td3'> $row_contact[4] </td>
                                      <td class='td4'><a href='#' onclick='contact_remove(2,$accountid1,$accountid2)'> Remove </a></td>
                                    </tr>
                                    ";
                                mysql_free_result($result_contact);
                                }
                                mysql_free_result($result);
                              ?>
                            </table>
                          </div>
                        </div>
                        <br><br>


                        <div class="wrap2" style="margin:0 auto;"> <!--margin:0 auto doesn't work here,but work on below <table>-->
                          <table class="head">
                            <caption style="font-size:16px;margin-bottom:5px;">Blocked List</caption>
                            <tr>
                            <th class="th1">Name</th>
                            <th class="th2">Email</th>
                            <th class="th3">Sex</th>
                            <th class="th4">Unblock</th>
                            </tr>
                          </table>
                          <div>
                            <table >
                              <?php
                                $query = "select * from contact WHERE accountid1='$accountid1' && block=1";
                                $result = mysql_query( $query );
                                while($row = mysql_fetch_row($result)) {
                                  $accountid2 = $row[2];
                                  $result_contact = mysql_query( "select * from account WHERE accountid='$accountid2'" );
                                  $row_contact = mysql_fetch_row($result_contact);
                                  echo "
                                    <tr>
                                      <td class='td1'> $row_contact[1] </td>
                                      <td class='td2'> $row_contact[3] </td>
                                      <td class='td3'> $row_contact[4] </td>
                                      <td class='td4'><a href='#' onclick='unblock_user($accountid1,$accountid2)'> Unblock </a></td>
                                    </tr>
                                    ";
                                }
                                mysql_free_result($result);
                              ?>
                            </table>
                          </div>
                        </div>
                        <br><br>

                  </div>
              </div>
          </div>
      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-1.12.2.js"   integrity="sha256-VUCyr0ZXB5VhBibo2DkTVhdspjmxUgxDGaLQx7qb7xY="   crossorigin="anonymous"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/sidebar_menu.js"></script>
  <script src="../assets/js/contact_table.js"></script>
</body>
</html>
