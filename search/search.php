<!-- HTML Template Resource
Author: WebThemez
Author URL: http://webthemez.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	session_start();
	include "../function.php";
  $search = (isset($_GET['submit']) ? $_GET['search'] : null); //used for advanced search
  $filter_category = (isset($_GET['category']) ? $_GET['category'] : null);
  $filter_uploadtime = (isset($_GET['date']) ? $_GET['date'] : null);
  $filter_order = (isset($_GET['order']) ? $_GET['order'] : null);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Interior-Design-Responsive-Website-Templates-StyleInn">
<meta name="author" content="webThemez.com">
<title>Search</title>
<link rel="favicon" href="../assets/images/favicon.png">
<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap-theme.css" media="screen">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="../assets/css/contact_table.css" rel="stylesheet">
<link rel='stylesheet' id='camera-css'  href='../assets/css/camera.css' type='text/css' media='all'><script>
function validateForm() {
  var content = document.forms["search_form"]["search"].value;
  if (content == '') { return false;}
  else { return true; }
}
</script>



<style>
.center{
  padding-left:150px;
  vertical-align: middle;
  line-height: 30px;
}
a{
  color:#1b6ca8;
}
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
              <form name='search_form' method='GET' action='search.php'
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
										<li><a href='../media/media_browse.php'>Browse all</a></li>
                    ";
                  }
                  else {
                    echo "
                      <li><a href='../login_register/login.php' style='border:1px;border-style:solid; border-radius: 25px; border-color:#9a496b;'   >Login</a></li>
                      <li><a href='../login_register/register.php'>Register</a></li>
											<li><a href='../media/media_browse.php'>Browse all</a></li>
                      ";
                   }
                  ?>
              </ul>
          </div>
          <!--/.nav-collapse -->
      </div>
  </div>
  <hr style="width:80%; border-top: 3px solid #ccc;">

  <div style="width:80%; margin:0 auto">
    <p style="background-color:#fddb3a;color:black;"><span><b>Search results for: </b></span><?php echo "$search"; ?></p>
    <button onclick="toggleHide()"> Filter </button>
  </div>
  <div id="advanced_search" style="width:80%; margin:0 auto; display: none">
  <form name='advanced_search_form' method='GET' action='search.php'
        enctype='multipart/form-data'>
  <label for="category"><b>Category:</b>&nbsp&nbsp&nbsp&nbsp</label>
  <input type="radio" name="category" id="category" value="Video"> Video
  <input type="radio" name="category" id="category" value="Audio" > Audio
  <input type="radio" name="category" id="category" value="Image" > Image<br>
  <label for="date"><b>Upload date:</b>&nbsp&nbsp&nbsp&nbsp</label>
  <input type="radio" name="date" id="date" value="week"> < 1 week
  <input type="radio" name="date" id="date" value="month" > < 1 month
  <input type="radio" name="date" id="date" value="year" > < 1 year<br>
  <label for="order"><b>Sort by:</b>&nbsp&nbsp&nbsp&nbsp</label>
  <input type="radio" name="order" id="order" value="Name" > Title
  <input type="radio" name="order" id="order" value="Viewcount" > View count
  <input type="radio" name="order" id="order" value="Uploadtime"> Upload date<br>
  <input type="hidden" name="search" value="<?php echo $search; ?>" >
  <button type="submit" name="submit">Apply </button>
  </form>
  </div>


  <table class="head" width="80%" cellpadding="0" cellspacing="0">
    <tr valign="middle">
      <td>Title</td>
      <td>Description</td>
      <td>Category</td>
      <td>Uploaded by</td>
      <td>Upload time</td>
      <td>Views</td>
    </tr>

<?php
  if (isset($_GET['submit'])) {
    $search_array = preg_split('/[, ;:-\s*+_!?.\{\{\(\)\[\]\'\"]/', $search);
		$stopword = array("a","an","the","i","am","are","is","it","this","that",
											"by","for","from","in","on","and","or","but","to","of");

    foreach ($search_array as $key => $value) {
      if (strlen($value)<2 or in_array(strtolower($value),$stopword)) {
        unset($search_array[$key]);
      }
    }
		// foreach ($search_array as $key => $value) {
		// 	echo "$value\n";
		// }

    $count = 0;

    foreach ($search_array as $key => $value) {

        $query = 'SELECT * FROM `media` WHERE `title` LIKE "%'.$value.'%"
                OR `description` LIKE "%'.$value.'%"
                OR `filename` LIKE "%'.$value.'%"
                OR `keyword` LIKE "%'.$value.'%" ';

        if($filter_order and $filter_order=="Name") {
          $query = 'SELECT * FROM `media` WHERE `title` LIKE "%'.$value.'%"
                  OR `description` LIKE "%'.$value.'%"
                  OR `filename` LIKE "%'.$value.'%"
                  OR `keyword` LIKE "%'.$value.'%"
                  order by title';
        }
        else if($filter_order and $filter_order=="Viewcount") {
          $query = 'SELECT * FROM `media` WHERE `title` LIKE "%'.$value.'%"
                  OR `description` LIKE "%'.$value.'%"
                  OR `filename` LIKE "%'.$value.'%"
                  OR `keyword` LIKE "%'.$value.'%"
                  order by viewcount DESC';
        }
        else if($filter_order and $filter_order=="Uploadtime") {
          $query = 'SELECT * FROM `media` WHERE `title` LIKE "%'.$value.'%"
                  OR `description` LIKE "%'.$value.'%"
                  OR `filename` LIKE "%'.$value.'%"
                  OR `keyword` LIKE "%'.$value.'%"
                  order by upload_data_time DESC';
        }

        $result = mysql_query($query);
        while($result_row = mysql_fetch_row($result)) {

                  $mediaid = $result_row[0];
                  $uploaded_by = $result_row[1];
                  $title = $result_row[3];
                  $description = $result_row[4];
                  $category = explode(':',$result_row[6])[0];
                  $filepath = $result_row[9];
                  $uploadtime = $result_row[11];
                  $viewcount = $result_row[14];
                  $view_link_address="../media/media_view.php?id=".$mediaid;

                  if ($filter_category and $filter_category != $category) { continue; }

                  if ($filter_uploadtime) {
                    if ($filter_uploadtime=="week" and (time()-strtotime($uploadtime))>60*60*24*7) { continue; }
                    else if ($filter_uploadtime=="month" and (time()-strtotime($uploadtime))>60*60*24*30) { continue; }
                    else if ($filter_uploadtime=="year" and (time()-strtotime($uploadtime))>60*60*24*365) { continue; }
                  }

                  $count++;
                  echo '<tr valign="middle">';

                  if($category=="Image"){
                  ?>
                    <td><a href="<?php echo $view_link_address;?>" target="_blank"><div class="gallery"><img src="<?php echo $filepath;?>" alt="<?php echo $title;?>"/></a>
                      <div class="desc" style="color:#2d6187; font-size:15px"><?php echo $title;?></div></td>
                  <?php
                    }
                  else if($category=="Audio") {
                  ?>
                      <td><a href="<?php echo $view_link_address;?>" target="_blank"><figure><figcaption style="color:#2d6187; font-size:20px">
                        <?php echo $title;?></figcaption><audio controls controlsList="nodownload" src="<?php echo $filepath;?>">
                          Your browser does not support the<code>audio</code>element.</audio></figure></a></td>
                  <?php
                   }
                  else if($category=="Video") {
                  ?>
                          <td><a href="<?php echo $view_link_address;?>" target="_blank"><div class="gallery"><video width="190px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
                            <source src="<?php echo $filepath;?>">Your browser does not support the <code>video</code>tag.</video></a>
                              <div class="desc" style="color:#2d6187; font-size:15px"><?php echo $title;?></div></td>
                  <?php } ?>


                  <td style="word-wrap: break-word"><?php echo $description;?></td>
                  <td><?php echo $category;?></td>
                  <td><?php echo $uploaded_by;?></td>
                  <td><?php echo $uploadtime;?></td>
                  <td><?php echo $viewcount;?></td>
                  </tr>
                  <?php
                  } //end while loop
                  mysql_free_result($result);
                } //end foreach loop
                echo "</table>";

                if ($count == 0) {
                  echo "<div align='center' style='color:red; font-size:20px'>No results found for \"$search\"!</div>";
                }
      }//end isset()
                ?>


				<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="assets/js/modernizr-latest.js"></script>
	<script type='text/javascript' src='../assets/js/jquery.min.js'></script>
	<script type='text/javascript' src='../assets/js/fancybox/jquery.fancybox.pack.js'></script>
	<script type='text/javascript' src='../assets/js/jquery.mobile.customized.min.js'></script>
	<script type='text/javascript' src='../assets/js/jquery.easing.1.3.js'></script>
	<script type='text/javascript' src='../assets/js/camera.min.js'></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/custom.js"></script>

<!-- used for filter search -->
<script>
function toggleHide() {
  var x = document.getElementById("advanced_search");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
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
