<?php
	session_start();
	include "../function.php";
	include "media_play.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Interior-Design-Responsive-Website-Templates-StyleInn">
<meta name="author" content="webThemez.com">
<title>Media browse</title>
<link rel="favicon" href="../assets/images/favicon.png">
<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<!-- Custom styles for our template -->
<link rel="stylesheet" href="../assets/css/bootstrap-theme.css" media="screen">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel='stylesheet' id='camera-css'  href='../assets/css/camera.css' type='text/css' media='all'>
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
										<a href='category.php?category=Image'>Browse Image</a>
										<a href='category.php?category=Audio'>Browse Audio</a>
										<a href='category.php?category=Video'>Browse Video</a>
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
											<a href='category.php?category=Image'>Browse Image</a>
											<a href='category.php?category=Audio'>Browse Audio</a>
											<a href='category.php?category=Video'>Browse Video</a>
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
  <!-- Display all media -->
  <?php
    if (isset($_SESSION['username']))
    {
      echo "<p class = 'center'>Welcome ".$_SESSION['username']."!</p>";
			echo "<a class='center' href='media_upload.php' style='color:#07689f;'>Upload File &nbsp;</a>";
			echo "<div class='dropdown'>";
    }
    else
    {
      echo "<p class='center'>Welcome to the MeTube! <a href='../login_register/register.php' style='color:#07689f;'>Want to be a user? Register here!</a></p>";
			echo "<div style='margin-left:150px;' class='dropdown'>";
    }
  ?>
	<button class='dropbtn' style="color:#706897; background-color:#ebcfc4; border-radius:30px">Sort by</button>
	<div class='dropdown-content'>
	<a href='media_browse.php?order=Name'>Title</a>
	<a href='media_browse.php?order=Viewcount'>Mostly Viewd</a>
	<a href='media_browse.php?order=Uploadtime'>Most Recently Uploaded</a>
	</div>
	</div>

	</br></br>
  <?php
		// the query changes when the ordering method is specified
		if(!isset($_GET['order']))
		{
			$query = "SELECT * from media";
		}
		else
		{
			if($_GET['order']=="Name") $query = "SELECT * from media order by title";
			else if($_GET['order']=="Viewcount") $query = "SELECT * from media order by viewcount DESC";
			else if($_GET['order']=="Uploadtime") $query = "SELECT * from media order by upload_data_time DESC";
		}
  	$result = mysql_query($query);
  	if (!$result)
  	{
  	   die ("Could not query the media table in the database: <br />". mysql_error());
  	}
  ?>
  <div style="margin-left:150px;background:#fddb3a;color:#41444b; width:80%;">Uploaded Media</div>
  <table class="center" style="margin-left:150px;" width="80%" cellpadding="0" cellspacing="0">
    <tr valign="middle">
      <td>Title</td>
      <td>Uploaded by</td>
			<td>Upload time</td>
			<td colspan="2">Views</td>
    </tr>
		<?php
			while ($result_row = mysql_fetch_row($result))
			{
		?>
      <tr valign="middle">
        <td>
          <a href="media_view.php?id=<?php echo $result_row[0];?>" target="_blank"><?php echo $result_row[3];?></a>
        </td>
        <td>
					<?php
						echo $result_row[1];
					?>
        </td>
				<td>
					<?php
						echo $result_row[11];
					?>
        </td>
				<td>
					<?php
						echo $result_row[14];
					?>
        </td>
        <td>
          <!--This directs to media_download_process.php to evaluate the permission and download the file-->
          <?php
          echo "<a href='media_download_process.php?id=".$result_row[0]."' target='_blank'>Click here to download</a>";
          ?>
        </td>
		</tr>
    <?php
			}
			mysql_free_result($result);
		?>
	</table>
  <footer id="footer">
		<div class="container">
			<div class="social text-center">
			</div>
			<div class="clear"></div>
		</div>
	</footer>
</body>
</html>
