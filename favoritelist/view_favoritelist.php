<?php
include "../function.php";
session_start();
if(!$_SESSION["username"]){
  header("Location: ../login_register/login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>MeTube-View Favorite Lists</title>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet">
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="../assets/css/contact_table.css" rel="stylesheet">
<style>
a{
  color:#1b6ca8;
}
</style>
<script type="text/javascript">
</script>
</head>
<?php
$user = $_SESSION['username'];
$upper_user = strtoupper($user);
$profile = get_user_profile($user);
$accountid = $profile[0];
?>
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
                <li><a href="../media/media_under_channel.php">Your Media</a></li>
                <li><a href="../media/media_upload.php">Upload New Media</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-music fa-stack-1x "></i></span>Playlist</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all playlists -->
                <li><a href="../playlist/view_playlist.php">Your Playlist</a></li>
                <!-- Button to create a new playlist -->
                <li><a href="../playlist/create_playlist.php">Create New Playlist</a></li>
              </ul>
            </li>
            <li class="active">
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-heart fa-stack-1x "></i></span>Favorites</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all favorite list -->
                <li class="active"><a href="../favoritelist/view_favoritelist.php">Your Favorite Lists</a></li>
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
            <li>
              <a href="../discussion/discussion.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-comments fa-stack-1x "></i></span>Discussion</a>
            </li>
            <li>
              <a href="../login_register/logout.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-sign-out fa-stack-1x "></i></span>Logout</a>
            </li>
          </ul>
      </div><!-- /#sidebar-wrapper -->
      <!-- Page Content: display all the favorite lists created by the current user-->
      <div id="page-content-wrapper">
        <h3>Your favorite lists:</h3></br>
        <?php
        // retrieve the favorite lists if any
        $query = "select * from favoritelist where accountid = '$accountid'";
        $result = mysql_query($query)
      	   or die ("Retrieving favoritelist information failed. Could not query the database: <br/>". mysql_error());
        $count = mysql_num_rows($result);
        // if no favorite lists
        if($count == 0)
        {
          echo "<h3 style='background-color:#ffeadb;'>You haven/'t created any favorite lists.
          <h4><a href='create_favoritelist.php'>Click here to create favorite list.</a></h4></h3>";
        }
        // else: display created favorite lists
        else
        {
          while($result_row = mysql_fetch_row($result))
          {
            $favoritelistid = $result_row[0];
?>
            <table class="head" style="margin-left:100px;text-align:'center';" width="80%" cellpadding="0" cellspacing="0">
              <caption><?php echo $result_row[2];?> &nbsp;
                <a href="remove_favoritelist.php?listid=<?php echo $favoritelistid;?>" target="_self">Click to delete</a><caption>
              <?php
              if($result_row[3]!='')
              {
              ?>
              <tr valign="middle">
                <td colspan="3"><?php echo $result_row[3];?></td>
              </tr>
              <?php
              }
              ?>
              <tr valign="middle">
                <th class="th1">Title of Media</th>
                <th class="th2">Uploaded by</th>
                <th class="th3">Remove from favorite list</th>
              </tr>
              <?php
              $query2 = "select * from media m join favoritelistmedia f on m.mediaid=f.mediaid and f.favoritelistid='$favoritelistid'";
              $result2 = mysql_query($query2)
                or die ("Retrieving media from favoritelist failed. Could not query the database: <br/>". mysql_error());
              $count2 = mysql_num_rows($result2);
              if($count2!=0)
              {
                while($result_row2 = mysql_fetch_row($result2))
                {
                  $mediaid = $result_row2[0];
              ?>
              <tr valign="middle">
                <td class="th1"><a href="../media/media_view.php?id=<?php echo $mediaid;?>"><?php echo $result_row2[3];?></a></td>
                <td class="th2"><?php echo $result_row2[1];?></td>
                <td class='td3'><a target="_self" href='remove_media.php?favoritelistid=<?php echo $favoritelistid;?>&mediaid=<?php echo $mediaid;?>'>Remove</a></td>
              </tr>
        <?php
                }
                mysql_free_result($result2);
              }
            echo "</table><br><br>";
          }
        }
        mysql_free_result($result);
        ?>
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
