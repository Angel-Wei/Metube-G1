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
</style>
</head>
<body>
  <!-- Fixed navbar -->
  <div class="navbar navbar-inverse">
      <div class="container">
          <div class="navbar-header">
              <!-- Button for smallest screens -->
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
							<form name='search_form' method='GET' action='../search/search.php'
										onsubmit='return validateForm()' enctype='multipart/form-data'>
							<a class="navbar-brand" href="../index.php"><img src="../assets/images/logo.png" alt="MeTube"></a>
							<input name='search' type='text' style="margin-top:10px;margin-left:30px" size="20" placeholder="Search.."></input>
							<button type="submit" name="submit"><i class="fa fa-search"></i> </button>
							</form>
          </div>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right mainNav">
                  <li><a href="../index.php">Home</a></li>
                  <?php
                  if (isset($_SESSION['username']) && isset($_SESSION['success'])) {
                    echo "
                    <li><a href='../account/profile.php'>".$_SESSION['username']."</a></li>
										<li class='dropdown'>
											<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Browse<b class='caret'></b></a>
											<ul class='dropdown-menu'>
												<li><a href='media_browse.php'>Browse All</a></li>
												<li><a href='category.php?category=Image'>Browse Image</a></li>
												<li><a href='category.php?category=Audio'>Browse Audio</a></li>
												<li><a href='category.php?category=Video'>Browse Video</a></li>
												<li><a href='../search/word_cloud.php'>Word Cloud</a></li>
											</ul>
										</li>";
                  }
                  else {
                    echo "
                      <li><a href='../login_register/login.php' style='border:1px;border-style:solid; border-radius: 25px; border-color:#9a496b;'   >Login</a></li>
                      <li><a href='../login_register/register.php'>Register</a></li>
											<li class='dropdown'>
												<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Browse<b class='caret'></b></a>
												<ul class='dropdown-menu'>
													<li><a href='media_browse.php'>Browse All</a></li>
													<li><a href='category.php?category=Image'>Browse Image</a></li>
													<li><a href='category.php?category=Audio'>Browse Audio</a></li>
													<li><a href='category.php?category=Video'>Browse Video</a></li>
													<li><a href='../search/word_cloud.php'>Word Cloud</a></li>
												</ul>
											</li>";
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
    }
    else
    {
      echo "<p class='center'>Welcome to the MeTube! <a href='../login_register/register.php' style='color:#07689f;'>Want to be a user? Register here!</a></p>";
    }
  ?>
	<li class='dropdown' style="margin-left:150px;">
		<a href='#' class='dropdown' data-toggle='dropdown'>Sort by<b class='caret'></b></a>
		<ul class='dropdown-menu'>
			<li><a href='media_browse.php?order=Name'>Title</a></li>
			<li><a href='media_browse.php?order=Viewcount'>Mostly Viewd</a></li>
			<li><a href='media_browse.php?order=Uploadtime'>Most Recently Uploaded</a></li>
		</ul>
	</li>

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
	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="assets/js/modernizr-latest.js"></script>
	<script type='text/javascript' src='../assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='../assets/js/fancybox/jquery.fancybox.pack.js'></script>

    <script type='text/javascript' src='../assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='../assets/js/jquery.easing.1.3.js'></script>
    <script type='text/javascript' src='../assets/js/camera.min.js'></script>
    <script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/custom.js"></script>
    <script>
		jQuery(function(){

			jQuery('#camera_wrap_4').camera({
				height: '600',
				loader: 'bar',
				pagination: false,
				thumbnails: false,
				hover: false,
				opacityOnGrid: false,
				imagePath: '../assets/images/'
			});

		});
	</script>
</body>
</html>
