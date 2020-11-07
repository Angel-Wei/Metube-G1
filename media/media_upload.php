<?php
include "media_upload_process.php";
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
    <title>MeTube: Media Upload</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="css/default.css" />

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
            <li >
              <a href="../account/profile.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Profile </a>
            </li>
            <li class="active">
              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-video-camera fa-stack-1x "></i></span> Channel</a>
              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                <!-- Button for showing all uploaded media -->
                <li><a href="media_under_channel.php">Your Media</a></li>
                <!-- Button for upload new media -->
                <li class="active"><a href="media_upload.php">Upload New Media</a></li>
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
      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid xyz">
              <div class="row">
                  <div class="col-lg-12">
                    <form method="post" action="media_upload_process.php" enctype="multipart/form-data">
                      <h2>Upload Media</h2>
                      <label for="file"><b>Please select a file to upload. </b></label><br>
                      <input type="file" name="file"><br>

                      <label><b>Please provide supplementary information of the file.</b></label><br>
                      <label for="title">Title:</label>
                      <input type="text" name="title" placeholder="Title"; style="width:400px;"><br>

                      <label for="description">Description of the file:</label><br>
                      <textarea style="font-family: Helvetica;" name="description" rows="4" cols="60" placeholder="Please give a brief description of the file."></textarea>
                      <br>

                      <label for="keyword">Keyword:</label>
                      <input type="text" name="keyword" placeholder="Keyword tags:nature, news, music, anime etc."; style="width:400px;"><br>

                      <!--Create a drop down list to list options for the category-->
                      <label for="category">Category: </label>
                      <select name="category" id="category">
                        <optgroup label="Image">
                          <option value="Image: static picture">static picture</option>
                          <option value="Image: dynamic picture">dynamic picture</option>
                          <option value="Image: other">other</option>
                        </optgroup>
                        <optgroup label="Audio">
                          <option value="Audio: song">song</option>
                          <option value="Audio: recording file">recording file</option>
                          <option value="Audio: other">other</option>
                        </optgroup>
                        <optgroup label="Video">
                          <option value="Video: mv">mv</option>
                          <option value="Video: trailer">trailer</option>
                          <option value="Video: news">news</option>
                          <option value="Video: movie">movie</option>
                          <option value="Video: other">other</option>
                        </optgroup>
                        <option value="Other" selected>Other</option>
                      </select><br>

                      <!--Create a drop down list to list options for privacy-->
                      <label for="privacy">Privacy: </label>
                      <select name="privacy">
                        <option value="Public" selected>Public</option>;
                        <option value="Friend">Friend</option>;
                        <option value="Private">Private</option>;
                      </select><br>

                      <!--Create a drop down list to define permission settings-->
                      <label for="permission">Permission settings (Comments & Ratings): </label>
                      <select name="permission">
                        <option value="Public" selected>Allow others to comment and rate</option>;
                        <option value="Friend">Only allow friends to comment and rate</option>;
                        <option value="Private">No comments and ratings allowed</option>;
                      </select><br>

                      <input style="width:100px;" name="reset" class="resetbtn" type="reset" value="Reset">
                      <input style="width:100px;" name="submit" class="signupbtn" type="submit" value="Submit">
                    </form>

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
