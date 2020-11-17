<?php
include "../function.php";
session_start();
if(!$_SESSION["username"]){
  echo "<meta http-equiv=\"refresh\" content=\"0;url=../login_register/login.php\">";
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
<title>MeTube-View downloaded media</title>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet">
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="../assets/css/contact_table.css" rel="stylesheet">
<style>
div.gallery {
  margin: 5px;
  border: 2px solid #ccc;
  float: left;
  width: 400px;
}

div.gallery:hover {
  border: 5px solid #8bcdcd;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}

figure {
    margin: 0;
}

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
$password = $profile[2];
$email = $profile[3];
$Sex = $profile[4];
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
                <li><a href="media_under_channel.php">Your Media</a></li>
                <li><a href="media_upload.php">Upload New Media</a></li>
                <li><a href="#">Playlists</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-heart fa-stack-1x "></i></span>Favorites</a>
            </li>
            <li class="active" >
              <a href="view_downloaded.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cloud-download fa-stack-1x "></i></span>Downloaded Media</a>
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
  <!-- Page Content: display the downloaded information-->
  <div id="page-content-wrapper">
    <h3>Files you have downloaded.</h3></br>
    <?php
    // retrieve the download information from table download
    $username = $_SESSION['username'];
    $query = "select * from download where username = '$username'";
    $result = mysql_query($query)
  	   or die ("Retrieving download information failed. Could not query the database: <br/>". mysql_error());
    $count = mysql_num_rows($result);
    // if no events for downloading files
    if($count == 0)
    {
      echo "<h3 style='background-color:#ffeadb;'>You haven/'t had any download events.</h3>";
    }
    // else: display the download evenets
    else
    {
    ?>
    <table class="head" style="margin-left:100px;text-align:'center';" width="70%" cellpadding="0" cellspacing="0">
      <tr valign="middle">
        <th class="th1">Title</th>
        <th class="th2">Type</th>
        <th class="th3">Uploaded by</th>
        <th class="th4">Downloaded time</th>
      </tr>
      <?php
      while($result_row = mysql_fetch_row($result))
      {
        $mediaid = $result_row[2];
        $downloadtime = $result_row[3];
        $media_query = "select * from media where mediaid = '$mediaid'";
        $media_result = mysql_query($media_query)
      	   or die ("Retrieving downloaded media information failed. Could not query the database: <br/>". mysql_error());
        $media_row = mysql_fetch_row($media_result);
        $uploaded_by = $media_row[1];
        $title = $media_row[3];
        $type = $media_row[12];
      ?>
      <tr valign="middle">
        <td><a href="media_view.php?id=<?php echo $mediaid;?>"><?php echo $title;?></a></td>
        <td><?php echo $type;?></td>
        <td><?php echo $uploaded_by;?></td>
        <td><?php echo $downloadtime;?></td>
      </tr>
    <?php
     }
    }
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
