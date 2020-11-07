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
<title>MeTube-Channel: Your Media</title>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet">
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
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
  <div id="sidebar-wrapper">

    <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
        <li>
          <a href="../account/profile.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Profile </a>
        </li>
        <li  class="active">
          <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-video-camera fa-stack-1x "></i></span> Channel</a>
          <ul class="nav-pills nav-stacked" style="list-style-type:none;">
            <!-- Button for showing all uploaded media -->
            <li  class="active"><a href="media_under_channel.php">Your Media</a></li>
            <!-- Button for upload new media -->
            <li><a href="media_upload.php">Upload New Media</a></li>
            <!-- Button for Playlists -->
            <li><a href="#">Playlists</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-heart fa-stack-1x "></i></span>Favorites</a>
        </li>
        <li>
            <a href="../contact/contact.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Contact</a>
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
  <!-- Page Content: display the uploaded media-Image-->
  <div id="page-content-wrapper">
    <h2>Media uploaded by <?php echo $user?> (click to view the media)</h2></hr>
    <!--Display the images in CSS gallery-->
    <h3 style="background-color:#ffeadb;">Image: <?php
      // query the database to retrive the number of images uploaded
      $query1="select * from media where username='$user' AND category REGEXP '^Image'";
      $result1 = mysql_query($query1)
          or die("Cannot query the database" .mysql_error());
      $count1 = mysql_num_rows($result1);
      echo $count1;
    ?><h3></hr>
    <?php
    if ($count1!=0){
      // if the number of images is greater than 0, then display in an unordered list
      echo "<ul>";
      while ($line= mysql_fetch_array($result1)){
        $filepath=$line['filepath'];
        $title=$line['title'];
        $description=$line['description'];
        $mediaid=$line['mediaid'];
        // display the images (the syntax is very important!)
        $view_link_address="../media/media_view.php?id=".$mediaid;
        echo "<a href='$view_link_address' target='_blank'>".
        '<li><div class="gallery"><img src="'.$filepath.'"'.' alt="'.$title.'"'.'/></a>';
        echo '<div class="desc" style="color:#2d6187; font-size:15px">'.$title.'<br>'.$description.'</div></li>';
      }
      echo "</ul>";
    }
    mysql_free_result($result1); // free memory
    ?>
  </div>

  <!-- Page Content: display the uploaded media-Audio-->
  <div id="page-content-wrapper">
    <h3 style="background-color:#ffeadb;">Audio: <?php
      // query the database to get the number of audio files uploaded
      $query2="select * from media where username='$user' AND category REGEXP '^Audio'";
      $result2 = mysql_query($query2)
          or die("Cannot query the database" .mysql_error());
      $count2 = mysql_num_rows($result2);
      echo $count2;
    ?><h3></hr>
    <?php
    if ($result2!=0){
      echo "<table>";
      while ($line= mysql_fetch_array($result2)){
        $filepath=$line['filepath'];
        $title=$line['title'];
        $description=$line['description'];
        $mediaid=$line['mediaid'];
        // display the audio files in an unordered list using audio tag
        $view_link_address="../media/media_view.php?id=".$mediaid;
        echo '<tr><td>'."<a href='$view_link_address' target='_blank'>".'<figure><figcaption style="color:#2d6187; font-size:20px">'
        .$title.': '.$description.'</figcaption><audio controls controlsList="nodownload" src="'.$filepath.
        '">Your browser does not support the <code>audio</code>element.</audio></figure></a><br></td></tr>';
      }
      echo "</table>";
    }
    mysql_free_result($result2); // free memory
    ?>
  </div>

  <!-- Page Content: display the uploaded media-Video-->
  <div id="page-content-wrapper">
    <h3 style="background-color:#ffeadb;">Video: <?php
      // query the database to get the number of audio files uploaded
      $query3="select * from media where username='$user' AND category REGEXP '^Video'";
      $result3 = mysql_query($query3)
          or die("Cannot query the database" .mysql_error());
      $count3 = mysql_num_rows($result3);
      echo $count3;
    ?> (Hover cursor to preview)<h3></hr>
    <?php
    if ($count3!=0){
      // if the number of images is greater than 0, then display in an unordered list
      echo "<ul>";
      while ($line= mysql_fetch_array($result3)){
        $filepath=$line['filepath'];
        $title=$line['title'];
        $description=$line['description'];
        $mediaid=$line['mediaid'];
        // Hover to play video(the syntax is very important!)
        $view_link_address="../media/media_view.php?id=".$mediaid;
        echo "<a href='$view_link_address' target='_blank'>"
        .'<li><div class="gallery"><video width="396px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;"><source src="'
        .$filepath.'">Your browser does not support the <code>video</code>tag.</video></a>';
        echo '<div class="desc" style="color:#2d6187; font-size:15px">'.$title.'<br>'.$description.'</div></li>';
      }
      echo "</ul>";
    }
    mysql_free_result($result3); // free memory
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
