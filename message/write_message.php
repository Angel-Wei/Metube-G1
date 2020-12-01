<?php
session_start();
include_once "../function.php";
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
    <title>Message</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="../assets/css/contact_table.css" rel="stylesheet">
    <style> a {color:#4785b8} </style>
    <script>
    function validateForm() {
      var subject = document.forms["sendForm"]["subject"].value;
      var content = document.forms["sendForm"]["content"].value;
      if (subject == '' || content == '') {
            alert("Both subject and content should be filled out!");
            return false;
      } else {
            alert("Message sent.");
            return true;
      }
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
                <!-- Button for showing all playlists-->
                <li><a href="../playlist/view_playlist.php">Your Playlists</a></li>
                <!-- Button to create a new playlist -->
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
            <li>
                <a href="../contact/contact.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Contact</a>
            </li>
            <li class="active">
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
                      <h4 style="text-align: center;margin-top:-5px;">
                          <a href="message.php">Message Box</a> |
                          <a href="write_message.php">Compose</a></h4><br>
                      <form name="sendForm" method="POST" action="send_message.php?send_from=<?php echo $accountid1 ?>"
                            onsubmit="return validateForm()" enctype="multipart/form-data">
                      <div class="wrap" style="margin:0 auto;">
                        <table>
                          <tr>
                            <td class='td1'> Send to </td>
                            <td class='td7'>
                              <select name='send_to'>
                                <?php
                                $contact_count = 0;
                                $result = mysql_query( "select * from contact where accountid1='$accountid1' && type!=0 " )
                                      or die("Could not query the contact database: <br />". mysql_error());;
                              	while($row = mysql_fetch_row($result)) {
                                  $contact_count++;
                                  $accountid2 = $row[2];
                                  $result_name = mysql_query( "select * from account where accountid='$accountid2'" );
                                  $row_name = mysql_fetch_row($result_name);
                                  $contact_name = $row_name[1];
                                  echo "<option value='$accountid2'>$contact_name</option>";
                                  mysql_free_result($result_name);
                                }
                                mysql_free_result($result);
                                echo "</select>";
                                if (!$contact_count) {
                                  echo "&nbsp &nbsp <span style='color:red'>Please edit your contact list first!</span>";
                                }
                               ?>

                            </td>
                          </tr>
                          <tr>
                            <td class='td1'> Subject </td>
                            <td class='td7'> <input name="subject" type="text" size="51"
                                  placeholder="Type subject here..." style="border:1px solid #000000"> </input>
                            </td>
                          </tr>
                          <tr>
                            <td class='td1'> Message </td>
                            <td class='td7'>
                              <textarea name="content" type="text" cols="50" rows="10"
                                  placeholder="Type content here..." style="border:1px solid #000000"></textarea>
                            </td>
                          </tr>
                        </table>
                        </div>
                        <br>
                        <div style='text-align: center'>
                          <input name='send_msg' type='submit' value='Send'><br/><br/>
                      </form>
                      <button type='button' onclick='location.href="message.php"'>Cancel</button>
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
