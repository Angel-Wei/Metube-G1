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
<title>MeTube-Create Playlist</title>
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
                      $upper_user
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
            <a href="../index.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span>Home </a>
          </li>
            <li >
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
            <li class="active">
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-music fa-stack-1x "></i></span>Playlist</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all playlists -->
                <li><a href="view_playlist.php">Your Playlist</a></li>
                <!-- Button to create a new playlist -->
                <li class="active"><a href="create_playlist.php">Create New Playlist</a></li>
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
                    <form method="post" action="create_playlist.php" enctype="multipart/form-data">
                      <h2>Create New Playlist</h2>

                      <label><b>Please provide supplementary information of the playlist.</b></label><br>
                      <label for="name">Name:</label>
                      <input type="text" name="name" placeholder="Name your playlist..."; style="width:400px;"><br>

                      <label for="description">Description of the playlist(optional):</label><br>
                      <textarea style="font-family: Helvetica;" name="description" rows="4" cols="60" placeholder="Please give a brief description of the playlist."></textarea>
                      <br>

                      <input style="width:100px;" name="reset" class="resetbtn" type="reset" value="Reset">
                      <input style="width:100px;" name="submit" class="signupbtn" type="submit" value="Submit">
                    </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <?php
  if(isset($_POST['submit'])) {
    // check if a name is given to the playlist
    if (empty($_POST['name'])){
  		echo "<script type='text/javascript'>alert('Please provied a name to the playlist');
  		window.location='create_playlist.php';</script>";
  	}
    // retrive information from the submitted form data of playlist
  	$name=$_POST['name'];
  	$name=addslashes($name); // add backslashes added before characters that need to be escaped.
  	$description=$_POST['description'];
  	$description=addslashes($description); // add backslashes added before characters that need to be escaped.
    // check if a playlist of the same name exists
    $query = "select * from playlist where accountid='$accountid' and listname='$name'";
  	$result = mysql_query($query)
  		or die ("Check if a playlist of the same name exists failed. Could not query the database: <br />". mysql_error());
  	$count = mysql_num_rows($result);

    if($count == 0) // there is no playlist of the same name that exists
    {
      if(!empty($name) and !empty($description))
      {
        $insertquery = "insert into playlist values(NULL, '$accountid', '$name', '$description')";
        $queryresult = mysql_query($insertquery)
            or die("Insert into table playlist error by create_playlist.php" .mysql_error());
        echo "<script type='text/javascript'>alert('Playlist created.');
            window.location='create_playlist.php';</script>";
      }
      else if(!empty($name) and empty($description))
      {
        $insertquery = "insert into playlist values(NULL, '$accountid', '$name', NULL)";
        $queryresult = mysql_query($insertquery)
            or die("Insert into table playlist error by create_playlist.php" .mysql_error());
        echo "<script type='text/javascript'>alert('Playlist created.');
            window.location='create_playlist.php';</script>";
      }
    }
    else echo "<script type='text/javascript'>alert('A playlist of the same name belonging to the same user already exists.');
    window.location='create_playlist.php';</script>";
  }
  ?>
  <!-- /#wrapper -->
  <!-- jQuery -->
  <!-- <script src="../Metube-G1/assets/js/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-1.12.2.js"   integrity="sha256-VUCyr0ZXB5VhBibo2DkTVhdspjmxUgxDGaLQx7qb7xY="   crossorigin="anonymous"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/sidebar_menu.js"></script>
</body>
</body>
</html>
