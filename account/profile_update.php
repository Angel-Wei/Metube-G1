<!DOCTYPE html>
<?php
include "profile_update_check.php";
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>table,th,td {border: none;} td,th{height:30px;width:150px;font-size: 16px; }</style>

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
            <li  class="active">
                <a href="profile.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Profile </a>
            </li>
              <li>
                  <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-video-camera fa-stack-1x "></i></span> Channel</a>
                     <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                      <li><a href="#">link1</a></li>
                      <li><a href="../media/media_upload.php">Upload New Media</a></li>
                  </ul>
              </li>
              <li>
                  <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-heart fa-stack-1x "></i></span>Favorites</a>
              </li>
              <li>
                  <a href="../contact/contact.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Contact</a>
              </li>
              <li>
                  <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cloud-download fa-stack-1x "></i></span>Overview</a>
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
                  <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-server fa-stack-1x "></i></span>Contact</a>
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
                      <h1>User Profile</h1><br>
                      <a> <img src="../uploads/metube/nintendogs_wallcoo.com_6.jpg" style="margin:-15px 10px 40px 0px"  width="190" alt="MeTube"></a>
                      <br>
                      <form method="post" action="profile_update.php">
                      <table cellspacing="0" cellpadding="0">
                      <?php
                        echo "
                        <tr>
                          <td style='font-weight: bold'>Username</td>
                          <td><input type='text' name='username' value=$user></td>
                        </tr>
                        <tr>
                          <td style='font-weight: bold'>Sex</td>

                          <td><input type='radio' name='sex' value='Male'> Male
                              <input type='radio' name='sex' value='Female'> Female</td>
                        </tr>
                        <tr>
                          <td style='font-weight: bold'>Email</td>
                          <td>$email</td>
                        </tr>
                        <tr>
                          <td style='font-weight: bold'>Password</td>
                          <td><input type='password' name='psw'></td>
                        </tr>
                      <tr>
                        <td style='font-weight: bold'>Repeat Password</td>
                        <td><input type='password' name='psw_repeat'></td>
                      </tr>
                       "
                       ?>
                      </table>
                      <br>
                      <input type='submit' name='submit' value='Save' style='padding:0px 10px 0px 10px;font-size:20px;color:black'>
                      </form>

                      <br>
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
