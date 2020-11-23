<?php
	session_start();
	include "../function.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Interior-Design-Responsive-Website-Templates-StyleInn">
<meta name="author" content="webThemez.com">
<title>Media browse by category</title>
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
div.gallery {
  margin: 5px;
  border: 2px solid #ccc;
  float: left;
  width: 200px;
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
table {
	margin:10px auto;
	empty-cells:show; /* Change to "hide" if you prefer*/
	border-collapse:separate;
	border-spacing:0px;
	}
th {
	padding:5px;
	border-bottom:#000 2px solid;
	text-align:center;
	}
td {
	padding:5px;
	text-align:center;
	}
td:first-child {
	border-left:#FFF 15px solid;
	}
td:last-child {
	border-right:#FFF 15px solid;
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
                    <a href='media_browse.php'>Browse All</a>
										<a href='category.php?category=Image&order=default'>Browse Image</a>
										<a href='category.php?category=Audio&order=default'>Browse Audio</a>
										<a href='category.php?category=Video&order=default'>Browse Video</a>
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
                      <a href='media_browse.php'>Browse All</a>
											<a href='category.php?category=Image&order=default'>Browse Image</a>
											<a href='category.php?category=Audio&order=default'>Browse Audio</a>
											<a href='category.php?category=Video&order=default'>Browse Video</a>
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
	<a href='category.php?category=<?php echo $_GET['category'];?>&order=Name'>Title</a>
	<a href='category.php?category=<?php echo $_GET['category'];?>&order=Viewcount'>Mostly Viewd</a>
	<a href='category.php?category=<?php echo $_GET['category'];?>&order=Uploadtime'>Most Recently Uploaded</a>
	</div>
	</div></br>
  <h4 style="padding-left:600px;">Click to view detailed information.</h4>

  <?php
  if(isset($_GET['category']))
  {
		// sort the media by different ways;
    $category = $_GET['category'];
		$query = "SELECT * FROM media WHERE category REGEXP '^$category'"; // defalut order
		if(isset($_GET['order']) and $_GET['order']=="Name") $query = "SELECT * FROM media WHERE category REGEXP '^$category' order by title";
		else if(isset($_GET['order']) and $_GET['order']=="Viewcount") $query = "SELECT * FROM media WHERE category REGEXP '^$category' order by viewcount DESC";
		else if(isset($_GET['order']) and $_GET['order']=="Uploadtime") $query = "SELECT * FROM media WHERE category REGEXP '^$category' order by upload_data_time DESC";
    $result = mysql_query($query)
    or die ("Browse by category failed. Could not query the database: <br/>". mysql_error());
  ?>
    <table class="head" style="margin-left:150px;" width="80%" cellpadding="0" cellspacing="0">
      <tr valign="middle">
        <td>Title</td>
        <td>Description</td>
        <td>Category</td>
        <td>Uploaded by</td>
        <td>Upload time</td>
        <td>Views</td>
      </tr>
  <?php
    while($result_row = mysql_fetch_row($result))
    {
      $mediaid = $result_row[0];
      $uploaded_by = $result_row[1];
      $title = $result_row[3];
      $description = $result_row[4];
      $detailed_category = $result_row[6];
      $filepath = $result_row[9];
      $uploadtime = $result_row[11];
      $viewcount = $result_row[14];
      $view_link_address="media_view.php?id=".$mediaid;
      if($category=="Image"){
  ?>
        <tr valign="middle">
          <td><a href="<?php echo $view_link_address;?>" target="_blank"><div class="gallery"><img src="<?php echo $filepath;?>" alt="<?php echo $title;?>"/></a>
          <div class="desc" style="color:#2d6187; font-size:15px"><?php echo $title;?></div></td>
          <td style="word-wrap: break-word"><?php echo $description;?></td>
          <td><?php echo $detailed_category;?></td>
          <td><?php echo $uploaded_by;?></td>
          <td><?php echo $uploadtime;?></td>
          <td><?php echo $viewcount;?></td>
        </tr>
<?php
      }
      else if($category=="Audio")
      {
?>
        <tr valign="middle">
          <td><a href="<?php echo $view_link_address;?>" target="_blank"><figure><figcaption style="color:#2d6187; font-size:20px">
            <?php echo $title;?></figcaption><audio controls controlsList="nodownload" src="<?php echo $filepath;?>">
              Your browser does not support the<code>audio</code>element.</audio></figure></a></td>
          <td style="word-wrap: break-word"><?php echo $description;?></td>
          <td><?php echo $detailed_category;?></td>
          <td><?php echo $uploaded_by;?></td>
          <td><?php echo $uploadtime;?></td>
          <td><?php echo $viewcount;?></td>
        </tr>
<?php
      }
      else if($category=="Video")
      {
?>
        <tr valign="middle">
          <td><a href="<?php echo $view_link_address;?>" target="_blank"><div class="gallery"><video width="190px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
            <source src="<?php echo $filepath;?>">Your browser does not support the <code>video</code>tag.</video></a>
              <div class="desc" style="color:#2d6187; font-size:15px"><?php echo $title;?></div></td>
          <td style="word-wrap: break-word"><?php echo $description;?></td>
          <td><?php echo $detailed_category;?></td>
          <td><?php echo $uploaded_by;?></td>
          <td><?php echo $uploadtime;?></td>
          <td><?php echo $viewcount;?></td>
        </tr>
<?php
      }
    }
    echo "</table>";
		mysql_free_result($result);
  }
  else echo "<script type='text/javascript'>alert('Browse by category failed.');
  window.location='media_browse.php';</script>";
?>



</body>
</html>
