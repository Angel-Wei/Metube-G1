<!-- HTML Template Resource
Author: WebThemez
Author URL: http://webthemez.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
<title>Metube-View Media</title>
<link rel="favicon" href="../assets/images/favicon.png">
<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<!-- Custom styles for our template -->
<link rel="stylesheet" href="../assets/css/bootstrap-theme.css" media="screen">
<link rel="stylesheet" href="../assets/css/style.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
<style>
.center {
  margin: auto;
  width: 60%;
  border: 3px solid #73AD21;
  padding: 10px;
	text-align: center;
	vertical-align: middle;
	line-height: 90px;
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
                    <li class="active"><a href="media_view.php?id=<?php echo $_GET['id'];?>">View Media</a></li>
										<?php
										if (isset($_SESSION['username']) && isset($_SESSION['success'])) {
											echo "
											<li><a href='../account/profile.php'>".$_SESSION['username']."</a></li>
											<li><a href='media_browse.php'>Browse all</a></li>";
										}
										else {
											echo "
												<li><a href='../login_register/login.php' style='border:1px;border-style:solid; border-radius: 25px; border-color:#9a496b;'   >Login</a></li>
												<li><a href='../login_register/register.php'>Register</a></li>
												<li><a href='media_browse.php'>Browse all</a></li>
												";
										}
										?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>

		<hr style="width:80%; border-top: 3px solid #ccc;">
		<div class="center"> <!--Check the privacy settings of the media, view, and comment-->
			<?php
				if(isset($_GET['id'])){
					$mediaid=$_GET['id'];
					$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
					$result = mysql_query( $query );
					$result_row = mysql_fetch_row($result);

					// get the media information
					$uploaded_by=$result_row[1]; // get the username who uploads the current media
					$filename=$result_row[2];
					$title=$result_row[3];
					$description=$result_row[4];
					$access=$result_row[7];
					$comment_permit=$result_row[8];
					$filepath=$result_row[9];
					$type=$result_row[12];
					$viewcount=$result_row[14];
					updateMediaTime($mediaid); // update the last access time of the current media(in table media)
					// updateViewCount($mediaid, $viewcount); // update the viewcount: increment by 1

					// check if the media is pulic
					if ($access=="Public"){
						//  cases in which registration is not required
						if (!isset($_SESSION['username']))
						{
							play_media($title, $filepath, $description, $type);
							updateViewCount($mediaid, $viewcount); // update the viewcount: increment by 1
						}
						// for a registered user
						else if(isset($_SESSION['username']))
						{
							$verify = block_or_not($_SESSION['username'], $uploaded_by);
							if ($verify == 0) // the current user is not blocked
							{
								play_media($title, $filepath, $description, $type);
								updateViewCount($mediaid, $viewcount);
							}
							else if($verify == 1)
							{
								echo "<h3>".$title." (type: ".$type.")</h3>";
								echo '<h4>Sorry, you do not have access to this media file though it is for public. You are blocked.</h4>';
								echo '<img src="../img/oops.jpg"'.' style="width: 50%; height: 50%; border:5px solid #8bcdcd; margin:10px; float:up"/>';
							}
						}
					}

					// if the media is private
					else if($access=="Private")
					{
						if(isset($_SESSION['username']) and $_SESSION['username']==$uploaded_by)
						{
							play_media($title, $filepath, $description, $type);
							updateViewCount($mediaid, $viewcount);
						}
						else
						{
							echo "<h3>".$title." (type: ".$type.")</h3>";
							echo '<h4>Sorry, you do not have access to this media file. It is private.</h4>';
							echo '<img src="../img/oops.jpg"'.' style="width: 50%; height: 50%; border:5px solid #8bcdcd; margin:10px; float:up"/>';
						}
					}

					else if($access=="Friend")
					{
						// check if the user of current session is a friend of the user who uploads the media or the user himself
						if (isset($_SESSION['username'])){
							$current_user = $_SESSION['username'];
							$verify = contact_or_not($current_user, $uploaded_by);
							// if two users are the same
							if($current_user==$uploaded_by)
							{
								play_media($title, $filepath, $description, $type);
								updateViewCount($mediaid, $viewcount);
							}
							// if two users are contacts and the current user is not blocked
							else if ($verify==1 and block_or_not($current_user, $uploaded_by)==0)
							{
								play_media($title, $filepath, $description, $type);
								updateViewCount($mediaid, $viewcount);
							}
							// print out the message: the media can only be accessed by friend users.
							else
							{
								echo "<h3>".$title." (type: ".$type.")</h3>";
								echo '<h4>Sorry, you do not have access to this media file. It is only accessed by unblocked, friend users.</h4>';
								echo '<img src="../img/oops.jpg"'.' style="width: 50%; height: 50%; border:5px solid #8bcdcd; margin:10px; float:up"/>';
							}
						}
						else
						{
							echo "<h3>".$title." (type: ".$type.")</h3>";
							echo '<h4>Sorry, you are not a registered user in Metube. However, the media is only accessed by friend users.</h4>';
							echo '<img src="../img/oops.jpg"'.' style="width: 50%; height: 50%; border:5px solid #8bcdcd; margin:10px; float:up"/>';
						}
					}
					mysql_free_result($result);
				}
			?>
		</div>
		<!--provide uploaded by and view count information-->
	  <div class="center" style="border-style:none; text-align: left; line-height: 10px;">
			<p>Uploaded by: <?php echo $uploaded_by;?> | <?php echo $viewcount;?> views</p>
		</div>
		<!--add icons for download, playlist, favorite purpose-->
    <a href="media_download_process.php?id=<?php echo $_GET['id'];?>" style="margin-left: 1000px;">
			<img src="../img/download_icon.png" title="Click to download" style="width: 45px; margin:3px; float:bottom"/></a>
    <a href="../playlist/add_to_playlist.php?id=<?php echo $_GET['id'];?>">
			<img src="../img/playlist_icon.png" title="Add to your playlist" style="width: 40px; margin:3px; float:bottom"/></a>
    <a href="../favoritelist/add_to_favoritelist.php?id=<?php echo $_GET['id'];?>">
			<img src="../img/favorite_icon.png" title="Add to your favorte list" style="width: 45px; margin:3px; float:bottom"/></a>

		<div class="center" style="border-style:none; text-align: left;"> <!--Recommendations-->
			<h3>Recommendations: </h3>
			<iframe src="media_recommendation.php?id=<?php echo $_GET['id'];?>" style="border:none"
				sandbox="allow-top-navigation"
        onload="this.style.height=(this.contentWindow.document.body.scrollHeight+20)+'px';"
				width=100% height=auto name="recommendation"></iframe>
		</div>
		<hr style="width:80%; border-top: 3px solid #ccc;">
		<div class="center" style="border-style:none; text-align: left; vertical-align: top; line-height: 10px;"> <!--Comment and scoring session-->
			<form method="post" action="../comment/comment_process.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<textarea style="margin-left:30px; font-family: Helvetica;" name="comment" rows="8" cols="60">Comment here: </textarea>
				</br></br>
				<label style="margin-left:30px;" for="score">Rate the media: </label>
		    <select name="score" id="score">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select></br></br>
				<input style="margin-left:30px; width:100px; height:20px" name="reset" type="reset" value="Reset">
		    <input style="width:100px; height:20px" name="submit" type="submit" value="Submit">
			</form>
		</div>
</body>
</html>
