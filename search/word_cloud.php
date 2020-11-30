<!-- HTML Template Resource
Author: WebThemez
Author URL: http://webthemez.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	session_start();
	include "../function.php";
  $search = (isset($_POST['submit']) ? $_POST['search'] : null); //used for advanced search
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Interior-Design-Responsive-Website-Templates-StyleInn">
<meta name="author" content="webThemez.com">
<title>Word Cloud</title>
<link rel="favicon" href="../assets/images/favicon.png">
<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap-theme.css" media="screen">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="../assets/css/contact_table.css" rel="stylesheet">
<link rel='stylesheet' id='camera-css'  href='../assets/css/camera.css' type='text/css' media='all'>
<script src="https://d3js.org/d3.v4.js"></script>
<style>
.button {
  background-color: #d0efff; /* blue */
  border: none;
  color: black;
  padding: 3px 10px 3px 10px;;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  border-radius: 10px;
  cursor: pointer;
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
<?php
  $all_words = array();
  $stopword = array("a","an","the","i","am","are","is","it","this","that","by","for","from",
                    "in","on","and","or","but","to","of","mp3","mp4","jpg","mpgeg",
                    "png","jpeg","gif","quicktime","mov","IMG");
  $query = "select filename,title,description,keyword from media";
  $result = mysql_query($query);

  while ($row = mysql_fetch_row($result)) {

    $filename=preg_split('/[, ;:-\s*+_!?.\{\{\(\)\[\]\'\"&]/', $row[0]);
    $title=preg_split('/[, ;:-\s*+_!?.\{\{\(\)\[\]\'\"&]/', $row[1]);
    $description=preg_split('/[, ;:-\s*+_!?.\{\{\(\)\[\]\'\"&]/', $row[2]);
    $keyword=preg_split('/[, ;:-\s*+_!?.\{\{\(\)\[\]\'\"&]/', $row[3]);
    $all_words = array_merge($all_words,$filename,$title,$description,$keyword);
  }

  foreach ($all_words as $key => $value) {
    if (strlen($value)<2 or in_array(strtolower($value),$stopword)
        or strpos($value, 'DSC') !== false or strpos($value, 'IMG') !== false) {
      unset($all_words[$key]);
    }
  }

  $occurences = array_count_values(array_map('strtolower',$all_words));
  arsort($occurences);

  foreach ($occurences as $key => $value) {
    $fontsize = ($value*2+10)."px";
    echo "<a class='button' href='search.php?submit=submit&search=$key' style='font-size:$fontsize;'>$key</a>";
  }

?>
</div>





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
