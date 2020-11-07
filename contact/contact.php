<?php
include_once "../function.php";
// if(!$_SESSION["username"]){
//   echo "<meta http-equiv=\"refresh\" content=\"0;url=../login_register/login.php\">";
// }
session_start();
$user = $_SESSION['username'];
$upper_user = strtoupper($user);
$query="SELECT accountid FROM account WHERE username = '$user'";
$result = mysql_query( $query );
$row = mysql_fetch_row($result);
$accountid1 = $row[0];
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
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
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
                      $upper_user
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
                                $upper_user</button>
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
            <li  class="active">
                <a href="contact.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Contact</a>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cloud-download fa-stack-1x "></i></span>Downloaded Media</a>
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
                                  echo "
                                  <tr>
                                      <td class='td1'>$row[1]</td>
                                      <td class='td2'>$row[3]</td>
                                      <td class='td3'>$row[4]</td>
                                      <td class='td4'>
                                      <select name='addContact' onchange='contact_process(this.value,$accountid1,$accountid2)'>
                                                            <option value=''>Add</option>
                                                            <option value='Family'>Family</option>;
                                                            <option value='Friend'>Friend</option>;
                                          </select><br></td>
                                      <td class='td5'><a href='#' onclick='block_user($accountid1,$accountid2)' style='color:#cc0000'>Block</a></td>
                                  </tr>
                                  ";
                              	}
                              	mysql_free_result($result);
                               ?>
                             </table>
                           </div>
                        </div>
                        <br><br>

                        <div class="wrap2" style="margin:0 auto;"> <!--margin:0 auto doesn't work here,but work on below <table>-->
                          <table class="head">
                            <caption style="font-size:16px;margin-bottom:5px;">Family Contact</caption>
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
                                $query = "select * from contact WHERE accountid1='$accountid1'
                                          && type=1 && block=0";
                                $result = mysql_query( $query )
                                  or die ("get_family_contact failed. Could not query the database: <br />". mysql_error());
                                while($row = mysql_fetch_row($result)) {
                                  $accountid2 = $row[2];
                                  $result_contact = mysql_query( "select * from account WHERE accountid='$accountid2'" );
                                  $row_contact = mysql_fetch_row($result_contact);
                                  echo "
                                    <tr>
                                      <td class='td1'> $row_contact[1] </td>
                                      <td class='td2'> $row_contact[3] </td>
                                      <td class='td3'> $row_contact[4] </td>
                                      <td class='td4'><a href='#' onclick='remove_contact($accountid1,$accountid2)'> Remove </a></td>
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
                            <caption style="font-size:16px;margin-bottom:5px;">Friend Contact</caption>
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
                                $query = "select * from contact WHERE accountid1='$accountid1'
                                          && type=2 && block=0";
                                $result = mysql_query( $query )
                                  or die ("get_family_contact failed. Could not query the database: <br />". mysql_error());
                                while($row = mysql_fetch_row($result)) {
                                  $accountid2 = $row[2];
                                  $result_contact = mysql_query( "select * from account WHERE accountid='$accountid2'" );
                                  $row_contact = mysql_fetch_row($result_contact);
                                  echo "
                                    <tr>
                                      <td class='td1'> $row_contact[1] </td>
                                      <td class='td2'> $row_contact[3] </td>
                                      <td class='td3'> $row_contact[4] </td>
                                      <td class='td4'><a href='#' onclick='remove_contact($accountid1,$accountid2)'> Remove </a></td>
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
