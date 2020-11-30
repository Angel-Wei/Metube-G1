<?php
	session_start();
	include "../function.php";

  // only registered users are able to add media to their favorite lists
  if(!isset($_SESSION['username']))
  {
		echo "<script type='text/javascript'>alert('This action is for registered users only.');
    window.location='../media/media_browse.php';</script>";
  }
  else
  {
    // the information of current user
    $profile = get_user_profile($_SESSION['username']);
    $accountid = $profile[0];

    // the information of the media
    $mediaid=$_GET['id'];
    $query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
    $result = mysql_query( $query );
    $result_row = mysql_fetch_row($result);
    // get the media information
    $uploaded_by=$result_row[1]; // get the username who uploads the current media
    $access=$result_row[7];
    // check the access permission of this file, these exceptions will be directed to the browse page
    if($access=="Public")
    {
      // return to the browse page if current user is blocked
      if(block_or_not($_SESSION['username'], $uploaded_by)==1)
      {
        echo "<script type='text/javascript'>alert('Sorry, you are blocked to add this media to the favorite list.');
        window.location='../media/media_browse.php';</script>";
      }
    }
    else if($access=="Friend")
    {
      if(contact_or_not($_SESSION['username'],$uploaded_by)==1 and block_or_not($_SESSION['username'],$uploaded_by)==1)
      echo "<script type='text/javascript'>alert('Sorry, you are blocked to add this media to the favorite list.');
      window.location='../media/media_browse.php';</script>";
      else if($_SESSION['username']!= $uploaded_by and contact_or_not($_SESSION['username'],$uploaded_by)==0)
      echo "<script type='text/javascript'>alert('Sorry, you are blocked to add this media to the favorite list.');
      window.location='../media/media_browse.php';</script>";
    }
    else if($access=="Private")
    {
      if($_SESSION['username'] != $uploaded_by)
      echo "<script type='text/javascript'>alert('Sorry, this file is private and cannot be added.');
      window.location='../media/media_browse.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Interior-Design-Responsive-Website-Templates-StyleInn">
<meta name="author" content="webThemez.com">
<title>Add media to favorite list</title>
<link rel="favicon" href="../assets/images/favicon.png">
<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap-theme.css" media="screen">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel='stylesheet' id='camera-css'  href='../assets/css/camera.css' type='text/css' media='all'>
<link href="../assets/css/contact_table.css" rel="stylesheet">
<style>
.center{
  padding-left:150px;
  vertical-align: middle;
  line-height: 30px;
}
a{
  color:#1b6ca8;
}
.dropbtn {
  color: #ffc93c;
	background-color: #07689f;
  padding: 16px;
	padding-top: 11px;
  font-size: 16px;
  border: none;
	text-align: center;
	margin: 4px 2px;
  cursor: pointer;
	border-radius: 12px;
}
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content a:hover {background-color: #ddd;}
.dropdown:hover .dropdown-content {display: block;}
</style>
</head>
<body>
  <!-- Fixed navbar -->
  <div class="navbar navbar-inverse">
      <div class="container">
          <div class="navbar-header">
              <!-- Button for smallest screens -->
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              <a class="navbar-brand" href="../index.php">
                  <img src="../assets/images/logo.png" alt="Techro HTML5 template"></a>
          </div>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right mainNav">
                  <li><a href="../index.php">Home</a></li>
                  <?php
                  if (isset($_SESSION['username']) && isset($_SESSION['success'])) {
                    echo "
                    <li><a href='../account/profile.php'>".$_SESSION['username']."</a></li>
										<div class='dropdown'>
										<button class='dropbtn'>BROWSE</button>
										<div class='dropdown-content'>
                    <a href='../media/media_browse.php'>Browse All</a>
										<a href='../media/category.php?category=Image&order=default'>Browse Image</a>
										<a href='../media/category.php?category=Audio&order=default'>Browse Audio</a>
										<a href='../media/category.php?category=Video&order=default'>Browse Video</a>
										</div>
										</div>";
                  }
                  else {
                    echo "
                      <li><a href='../login_register/login.php' style='border:1px;border-style:solid; border-radius: 25px; border-color:#9a496b;'   >Login</a></li>
                      <li><a href='../login_register/register.php'>Register</a></li>
											<div class='dropdown'>
											<button class='dropbtn'>BROWSE</button>
											<div class='dropdown-content'>
                      <a href='../media/media_browse.php'>Browse All</a>
											<a href='../media/category.php?category=Image&order=default'>Browse Image</a>
											<a href='../media/category.php?category=Audio&order=default'>Browse Audio</a>
											<a href='../media/category.php?category=Video&order=default'>Browse Video</a>
											</div>
											</div>
                      ";
                  }
                  ?>
              </ul>
          </div>
          <!--/.nav-collapse -->
      </div>
  </div>
  <hr style="width:80%; border-top: 3px solid #ccc;">
  <!-- Browse by category -->
  <h4 class="center">Select the favorite list of yours to add the media.</h4>
      <?php
      // retrieve the download information from table download
      $query = "select * from favoritelist where accountid = '$accountid'";
      $result = mysql_query($query)
         or die ("Retrieving download information failed. Could not query the database: <br/>". mysql_error());
      $count = mysql_num_rows($result);
      // if no availablefavorite lists
      if($count==0)
      {
      ?>
      <p class="center">No favorite lists available. <a href="create_favoritelist.php" target="_blank">Clcik here to create one.</a></p>;
      <?php
      }
      else
      {
?>
        <form class="center" method="post" action="add_to_favoritelist_process.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
          <label for="listid">Name of favorite list:</label>
          <select name="listid">
<?php   while($result_row = mysql_fetch_row($result))
        {
      ?>
      <option value="<?php echo $result_row[0];?>"><?php echo $result_row[2];?></option>;
      <?php
        }
      }
      ?>
    </select><br>

    <input style="width:100px;" name="reset" class="resetbtn" type="reset" value="Reset">
    <input style="width:100px;" name="submit" class="signupbtn" type="submit" value="Add">
  </form>
<?php
  mysql_free_result($result);
}
?>
</body>
</html>
