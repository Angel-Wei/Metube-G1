<!--
Author: WebThemez
Author URL: http://webthemez.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Interior-Design-Responsive-Website-Templates-StyleInn">
	<meta name="author" content="webThemez.com">
	<title>CPSC 6620 Metube Project G1 Homepage</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet' id='camera-css'  href='assets/css/camera.css' type='text/css' media='all'>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	<style>
	div.gallery {
	  margin: 5px;
	  border: 2px solid #ccc;
	  float: left;
	  width: 400px;
	}

	div.gallery:hover {
	  border: 5px solid #8bcdcd;
	}

	div.gallery img {
	  width: 100%;
	  height: auto;
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

				<a class="navbar-brand" href="index.php">
					<img src="assets/images/logo.png" alt="MeTube"></a>
					<input type="text" style="margin-top:10px;margin-left:30px" size="25" placeholder="Search..">
			</div>


			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<?php
					session_start();
					if (isset($_SESSION['username']) && isset($_SESSION['success'])) {
						echo "
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown'> {$_SESSION['username']} <b class='caret'></b></a>
							<ul class='dropdown-menu'>
								<li><a href='account/profile.php'>Account</a></li>
								<li><a href='#'>Dummy Link1</a></li>
								<li><a href='#'>Dummy Link2</a></li>
								<li><a href='login_register/logout.php'>Log out</a></li>
							</ul>
						</li>
						<li><a href='browse.php'>Browse all</a></li>

						";
					}
					else {
						echo "
							<li><a href='login_register/login.php' style='border:1px;border-style:solid; border-radius: 25px; border-color:#9a496b;'   >Login</a></li>
							<li><a href='login_register/register.php'>Register</a></li>
							<li><a href='browse.php'>Browse all</a></li>
							";
					}
					?>

				</ul>
			</div>


			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<!-- Header -->
	<header id="head">
		<div class="container">
					<div class="fluid_container">
                    <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                        <div data-src="img/Lion king.jpg"></div>
                        <div data-src="img/Thor.jpg"></div>
                        <div data-src="img/Pikachu.jpg"></div>
												<div data-src="img/Batman.jpg"></div>
												<div data-src="img/Captain America.jpg"></div>
                    </div><!-- #camera_wrap_3 -->
                </div><!-- .fluid_container -->
		</div>
	</header>
	<!-- /Header -->
      <section class="news-box top-margin">
        <div class="container">
            <h2><span>Wellcome to the Metube!</span></h2>
						<h4><span>(Hover the cursor to preview or click to view the media in details)</span></h4><hr>
						<!--Video display 1-->
						<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="galley">
							<a href='media/media_view.php?id=8' target='_blank'>
							<video width="350px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
								<source src="uploads/clemson/tangled-lostchameleon_h480p.mov">Your browser does not support the <code>video</code>tag.</video></div></a>
									<div class="box">
											<p class="title"><strong>Tangled-trailer: Lost Chameleon</strong></p>
											<p style="padding: 10px;text-align:'left';">A trailer about the lovely chameleon in the Disney movie "Tangled".</p>
									</div>
						</div>

						<!--Video display 2-->
						<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="galley">
							<a href='media/media_view.php?id=33' target='_blank'>
							<video width="350px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
								<source src="uploads/anqi/the-addams-family-2-announcement-piece_h480p.mov">Your browser does not support the <code>video</code>tag.</video></div></a>
									<div class="box">
										<p class="title"><strong>"The Adams family 2"-trailer</strong></p>
										<p style="padding: 10px;text-align:'left';">The Addams Family 2 has been officially announced to arrive just in time for Halloween in 2021.</p>
									</div>
					  </div>

						<!--Video display 3-->
						<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="galley">
							<a href='media/media_view.php?id=37' target='_blank'>
							<video width="350px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
								<source src="uploads/anqi/Adele-Someone+like+you.mp4">Your browser does not support the <code>video</code>tag.</video></div></a>
									<div class="box">
										<p class="title"><strong>Adele-Someone like you</strong></p>
										<p style="padding: 10px;text-align:'left';">
											"Someone like You" is a song recorded by English singer-songwriter Adele.
											It was written by Adele and Dan Wilson for her second studio album, 21.</p>
									</div>
					  </div>

						<!--Video display 4-->
						<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="galley">
							<a href='media/media_view.php?id=38' target='_blank'>
							<video width="350px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
								<source src="uploads/anqi/Sam+Smith.mp4">Your browser does not support the <code>video</code>tag.</video></div></a>
									<div class="box">
										<p class="title"><strong>Sam Smith-I'm not the only one</strong></p>
										<p style="padding: 10px;text-align:'left';">
											"I'm Not the Only One" is a song recorded by English singer Sam Smith from their debut studio album, In the Lonely Hour (2014).</p>
									</div>
					  </div>

						<!--Video display 5-->
						<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="galley">
							<a href='media/media_view.php?id=41' target='_blank'>
							<video width="350px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
								<source src="uploads/administrator/mulan-trailer-1_h480p.mov">Your browser does not support the <code>video</code>tag.</video></div></a>
									<div class="box">
										<p class="title"><strong>Mulan-trailer</strong></p>
										<p style="padding: 10px;text-align:'left';">
											Mulan is a 2020 American action drama film produced by Walt Disney Pictures.
											It is a live-action adaptation of Disney's 1998 animated film of the same name,
											based on the Chinese folklore "The Ballad of Mulan".</p>
									</div>
					  </div>

						<!--Video display 6-->
						<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="galley">
							<a href='media/media_view.php?id=42' target='_blank'>
							<video width="350px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
								<source src="uploads/administrator/Avril-Skater+boy.mp4">Your browser does not support the <code>video</code>tag.</video></div></a>
									<div class="box">
										<p class="title"><strong>Avril - Sk8er Boi</strong></p>
										<p style="padding: 10px;text-align:'left';">
											"Sk8er Boi" (pronounced "skater boy") is a song by Canadian singer-songwriter Avril Lavigne,
											released as the second single from her debut album, Let Go (2002).</p>
									</div>
					  </div>
					</section><hr>

    <section class="container">
			<div class="row">
				<div class="col-md-12">
					<h3><span>Image Collection</span></h3>
					<div class="carousel slide" id="myCarousel">
						<div class="carousel-inner">
							<div class="item active">
											<ul class="thumbnails">
												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/anqi/chihiro020.jpg" alt=""></div>
													<div class="caption">
														<h4>Faceless man</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=5">Read More</a></div>
												</li>

												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/anqi/chihiro032.jpg" alt=""></div>
													<div class="caption">
														<h4>Haku</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=6">Read More</a></div>
												</li>

												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/yuan/ponyo009.jpg" alt=""></div>
													<div class="caption">
														<h4>Ponyo</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=43">Read More</a></div>
												</li>

												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/yuan/chihiro044.jpg" alt=""></div>
													<div class="caption">
														<h4>Spirited Away</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=44">Read More</a></div>
												</li>
											</ul>
								</div><!-- /Slide1 -->
							<div class="item">
											<ul class="thumbnails">
												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/yuan/DSC01598.JPG" alt=""></div>
													<div class="caption">
														<h4>Clemson University</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=30">Read More</a></div>
												</li>

												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/clemson/DSC03635.JPG" alt=""></div>
				                  <div class="caption">
														<h4>Puerto Rico</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=23">Read More</a></div>
				                </li>

												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/administrator/DSC02645.JPG" alt=""></div>
				                  <div class="caption">
														<h4>Sunset view from a street in Charleston</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=27">Read More</a></div>
				                </li>

												<li class="col-md-3">
													<div class="thumbnail">
														<img src="uploads/clemson/DSC05686.JPG" alt=""></div>
				                  <div class="caption">
														<h4>Foilage view at North Carolina</h4>
														<a class="btn btn-mini" href="media/media_view.php?id=11">Read More</a></div>
				                </li>
											</ul>
								</div><!-- /Slide2 -->
					</div>

        <div class="control-box">
            <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
            <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
        </div><!-- /.control-box -->

    </div><!-- /#myCarousel -->

</div><!-- /.span12 -->
</div><!-- /.row -->
</section><!-- /.container -->

    <footer id="footer">
		<div class="container">
			<div class="social text-center">
				<h4><b>CPSC 6620 - G1</h4>
				<h5>Group Member: Anqi Wei, Xiaohong Zhang</h5>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-dribbble"></i></a>
				<a href="#"><i class="fa fa-flickr"></i></a>
				<a href="#"><i class="fa fa-github"></i></a>
			</div>

			<div class="clear"></div>
			<!--CLEAR FLOATS-->
		</div>
		<div class="footer2">
			<div class="container">
				<div class="row">

					<div class="col-md-6 panel">
						<div class="panel-body">
							<p class="simplenav">
								<a href="index.html">Home</a> |
								<a href="about.html">About</a> |
								<a href="services.html">Services</a> |
								<a href="price.html">Price</a> |
								<a href="projects.html">Projects</a> |
								<a href="contact.html">Contact</a>
							</p>
						</div>
					</div>

					<div class="col-md-6 panel">
						<div class="panel-body">
							<p class="text-right">
								Copyright &copy; 2015. Template by <a href="http://webthemez.com/" rel="develop">WebThemez.com</a>
							</p>
						</div>
					</div>

				</div>
				<!-- /row of panels -->
			</div>
		</div>
	</footer>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="assets/js/modernizr-latest.js"></script>
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/fancybox/jquery.fancybox.pack.js'></script>

    <script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script>
    <script type='text/javascript' src='assets/js/camera.min.js'></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
    <script>
		jQuery(function(){

			jQuery('#camera_wrap_4').camera({
				height: '600',
				loader: 'bar',
				pagination: false,
				thumbnails: false,
				hover: false,
				opacityOnGrid: false,
				imagePath: 'assets/images/'
			});

		});
	</script>

</body>
</html>
