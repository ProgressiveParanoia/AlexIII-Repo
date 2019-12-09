<?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');

    require_once 'admin/config.php';
   $history_description = "";
   $history_header = "";

   $iconic_description = "";
   $iconic_header = "";

   //history description
      $sql = "SELECT description, header FROM history_description WHERE id = 1";

      if($statement = mysqli_prepare($link, $sql))
      {
          if(mysqli_stmt_execute($statement))
          {
             # mysqli_stmt_store_result($statement);
             $result_set = ( mysqli_stmt_get_result($statement));
             $rows = mysqli_fetch_array($result_set);
             $history_description = $rows['description'];
             $history_header = $rows['header'];
          }
          mysqli_stmt_close($statement);
      }
     //history description end

      //iconic dish start
      $sql = "SELECT description, header FROM signature_dish_description WHERE id = 1";

      if($statement = mysqli_prepare($link, $sql))
      {
          if(mysqli_stmt_execute($statement))
          {
             # mysqli_stmt_store_result($statement);
             $result_set = ( mysqli_stmt_get_result($statement));
             $rows = mysqli_fetch_array($result_set);
             $iconic_description = $rows['description']; //get first description
             $iconic_header = $rows['header'];
          }
          mysqli_stmt_close($statement);
      }
      //iconic dish end
    	mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>AlexIII Restaurant</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords"
		content="Baking Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->

	<!-- Custom-Files -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Bootstrap-CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link
		href="//fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese"
		rel="stylesheet">
	<!-- //Web-Fonts -->
</head>

<body>
	<!-- header -->

	<!-- //top-bar -->

	<!-- header 2 -->
	<!-- navigation -->
	<div class="main-top">
		<div class="container d-lg-flex justify-content-between align-items-center">
			<!-- logo -->
			<h1 class="logo-style-res float-left">
				<a class="navbar-brand" href="index.html">
					<img src="pic/LogoNiAlex.png" alt="" class="img-fluid logo-img mt-1">
				</a>
			</h1>
			<!-- //logo -->
			<!-- nav -->
			<div class="nav_w3ls mx-lg-auto">
				<nav>
					<label for="drop" class="toggle">Menu</label>
					<input type="checkbox" id="drop" />
					<ul class="menu mx-lg-auto">
						<li><a href="index.html" class="active">Home</a></li>
						<li><a href="#about">About Us</a></li>
						<li>
							<!-- First Tier Drop Down -->
							<label for="drop-2" class="toggle toogle-2">Pages <span class="fa fa-angle-down"
									aria-hidden="true"></span>
							</label>
							<a href="#">Pages <span class="fa fa-angle-down" aria-hidden="true"></span></a>
							<input type="checkbox" id="drop-2" />
							<ul>
								<li><a href="#chefs" class="drop-text">Our Best Sellers</a></li>
								<li><a href="#blog" class="drop-text">Blog Posts</a></li>
								<li><a href="#menu" class="drop-text">Menu</a></li>
							</ul>
						</li>
						<li><a href="#gallery">Gallery</a></li>
						<li><a href="#contact">Contact Us</a></li>
					</ul>
				</nav>
			</div>
			<!-- //nav -->
			<!-- dwn -->
			
			<!-- //dwn -->
		</div>
	</div>
	<!-- //navigation -->
	<!-- //header 2 -->

	<!-- banner slider -->
	<div id="homepage-slider" class="st-slider">
		<input type="radio" class="cs_anchor radio" name="slider" id="play1" checked="" />
		<input type="radio" class="cs_anchor radio" name="slider" id="slide1" />
		<input type="radio" class="cs_anchor radio" name="slider" id="slide2" />
		<input type="radio" class="cs_anchor radio" name="slider" id="slide3" />
		<div class="images">
			<div class="images-inner">
				<div class="image-slide">
					<div class="banner-w3ls-Slider1">

					</div>
				</div>
				<div class="image-slide">
					<div class="banner-w3ls-Slider2Alex">

					</div>
				</div>
				<div class="image-slide">
					<div class="banner-w3ls-SlideFinal">

					</div>
				</div>
			</div>
		</div>
		<div class="labels">
			<div class="fake-radio">
				<label for="slide1" class="radio-btn"></label>
				<label for="slide2" class="radio-btn"></label>
				<label for="slide3" class="radio-btn"></label>
			</div>
		</div>
	</div>
	<!-- //banner slider -->
	<!-- banner bottom grids -->
	<section class="banner-bottom-w3layouts pb-5" id="services">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 about-in text-center">
					<div class="serv-cont-wthree">
						<div class="icon-wthrees">
							<span class="fa fa-cutlery"></span>
						</div>
						<h5 class="card-title mb-3 mt-4">Dine With Us</h5>
						<p class="card-text">Lorem ipsum dolor sit amet consectetur elit,Adipisicing elit
							tempor.</p>
					</div>
				</div>
				<div class="col-lg-4 about-in text-center my-lg-0 my-4">
					<div class="serv-cont-wthree">
						<div class="icon-wthrees">
							<span class="fa fa-smile-o"></span>
						</div>
						<h5 class="card-title mb-3 mt-4">Rate Us</h5>
						<p class="card-text">Lorem ipsum dolor sit amet consectetur elit,Adipisicing elit
							tempor.</p>
					</div>
				</div>
				<div class="col-lg-4 about-in text-center">
					<div class="serv-cont-wthree">
						<div class="icon-wthrees">
							<span class="fa fa-birthday-cake"></span>
						</div>
						<h5 class="card-title mb-3 mt-4">Celebrate With Us</h5>
						<p class="card-text">Lorem ipsum dolor sit amet consectetur elit,Adipisicing elit
							tempor.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- //banner bottom grids -->

	<!-- about -->
	<section class="w3ls-bnrbtm py-5" id="about">
		<div class="container py-xl-5 py-lg-3">
			<div class="row pb-5">
				<div class="col-lg-6">
					<img class="img-fluid" src="admin/uploads/history_image.jpg" alt="">
				</div>
				<div class="col-lg-6 pl-lg-5 abou-right-w3layuts mt-lg-0 mt-5">
					<h3 class="mb-4"><?php echo $history_header?><!--Our History <br>--></h3>
					<!--<p><November 11, 1985 the Alex III Restaurant and  Catering Services was born located at Wilson street San Juan City. </p>-->
					<p><?php echo $history_description?></p>
				</div>
			</div>
			<div class="row flex-row-reverse border-top pt-lg-5 pt-sm-4 pt-2 mt-lg-5 mt-sm-4 mt-2">
				<div class="col-lg-6">
					<img class="img-fluid mt-5" src="admin/uploads/signature_dish_image.jpg" alt="">
				</div>
				<div class="col-lg-6 abou-right-w3layuts mt-5">
					<h3 class="mb-4"><?php echo $iconic_header; ?><!--Our Famous Chicken Barbecue <br>--> </h3>
					<p><!--Donec consequat sapien ut leo cursus rhoncus. Nullam dui mi, vulputate ac metus
						at, semper
						varius orci. </p>
					<p>Nulla accumsan ac elit in congue. Class aptent taciti sociosqu ad litora torquent
						per conubia.</p>-->
						<?php echo $iconic_description; ?>
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- //about -->

	<!-- team -->
	<section class="teams py-5" id="chefs">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-w3ls text-center text-wh mb-5">Our Best Seller</h3>
			<div class="row text-center">
				<div class="col-lg-4">
					<div class="team-gd">
						<img src="pic/Chicken.jpg" class="img-fluid" alt="user-image">
						<div class="team-info mt-4">
							<h3 class="mb-2"><!--<span class="sub-tittle-team"></span>-->Alex III Chicken BBQ</h3>
							<p>Donec consequat sapien ut leo cursus rhoncus</p>
							<!--social media -->
							<!--
							<ul class="social_section_1info list-unstyled pt-2 mt-4">
								<li class="d-inline facebook">
									<a href="#"><span class="fa fa-facebook mr-1"></span>facebook</a>
								</li>
								<li class="d-inline twitter">
									<a href="#"><span class="fa fa-twitter mr-1"></span>twitter</a>
								</li>
							</ul>
							-->
							<!--social media end -->
						</div>
					</div>
				</div>
				<div class="col-lg-4 mt-lg-0 mt-5">
					<div class="team-gd">
						<img src="pic/PANCIT.jpg" class="img-fluid" alt="user-image">
						<div class="team-info mt-4">
							<h3 class="mb-2"><!--<span class="sub-tittle-team">Chef 02</span>-->Alex III Pancit Canton</h3>
							<p>Donec consequat sapien ut leo cursus rhoncus</p>
							<!--
							<ul class="social_section_1info list-unstyled pt-2 mt-4">
								<li class="d-inline google">
									<a href="#"><span class="fa fa-google-plus mr-1"></span>google</a>
								</li>
								<li class="d-inline linkedin">
									<a href="#"><span class="fa fa-linkedin mr-1"></span>linkedin</a>
								</li>
							</ul>
						-->
						</div>
					</div>
				</div>

				<!--TODO: ADD CMS END ENDPOINTS -->
				<div class="col-lg-4 mt-lg-0 mt-5">
					<div class="team-gd">
						<img src="images/GALLERY6.jpg" class="img-fluid" alt="user-image">
						<div class="team-info mt-4">
							<h3 class="mb-2"><!--<span class="sub-tittle-team">Chef 03</span>--> Alex III Salad</h3>
							<p>Donec consequat sapien ut leo cursus rhoncus</p>
							<!--
							<ul class="social_section_1info list-unstyled pt-2 mt-4">
								<li class="d-inline facebook">
									<a href="#"><span class="fa fa-facebook mr-1"></span>facebook</a>
								</li>
								<li class="d-inline twitter">
									<a href="#"><span class="fa fa-twitter mr-1"></span>twitter</a>
								</li>
							</ul>
						-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- //team -->

	<!-- blog -->
	<section class="blog py-5" id="blog">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-w3ls text-center text-bl mb-5">Our Fresh Blog Posts</h3>
			<div class="row">
				<!-- blog grid -->
				<div class="col-lg-4 col-md-6 px-md-2">
					<div class="card">
						<div class="card-header p-0 position-relative">
							<a href="#">
								<img class="card-img-bottom" src="pic/Appe.jpg" alt="Card image cap">
								<span class="fa fa-user post-icon"></span>
							</a>
						</div>
						<div class="card-body">
							<h6 class="let-spa mb-3">20 April 2019</h6>
							<h5 class="blog-title card-title">
								<a href="#">At vero eos et accusam et
									justo duo dolores et ea rebum</a>
							</h5>
							<!--
							<div class="row mt-5">

								<div class="col-3 testi-img-res px-2">
									<img src="images/te1.jpg" alt=" " class="img-fluid rounded-circle" />
								</div>
								<div class="col-9 w3_testi_grid mt-xl-2 mt-lg-0 mt-md-2 mt-4">
									<h5 class="mb-1">Adam Ster</h5>
									<p>Sed do eiusmod</p>
								</div>
							</div>
						-->
						</div>
					</div>
				</div>
				<!-- //blog grid -->
				<!-- blog grid -->
				<div class="col-lg-4 col-md-6 px-md-2 mt-md-0 mt-5">
					<div class="card">
						<div class="card-header p-0 position-relative">
							<a href="#">
								<img class="card-img-bottom" src="images/blog2.jpg" alt="Card image cap">
								<span class="fa fa-user post-icon"></span>
							</a>
						</div>
						<div class="card-body">
							<h6 class="let-spa mb-3">22 April 2019</h6>
							<h5 class="blog-title card-title">
								<a href="#">At vero eos et accusam et
									justo duo dolores et ea rebum</a>
							</h5>
							<!--
							<div class="row mt-5">
								<div class="col-3 testi-img-res px-2">
									<img src="images/te2.jpg" alt=" " class="img-fluid rounded-circle" />
								</div>
								<div class="col-9 w3_testi_grid mt-xl-2 mt-lg-0 mt-md-2 mt-4">
									<h5 class="mb-1">Anna Mull</h5>
									<p>Sed do eiusmod</p>
								</div>
							</div>
						-->
						</div>
					</div>
				</div>
				<!-- //blog grid -->
				<!-- blog grid -->
				<div class="col-lg-4 col-md-6 px-md-2 mt-lg-0 mt-5">
					<div class="card">
						<div class="card-header p-0 position-relative">
							<a href="#">
								<img class="card-img-bottom" src="images/blog3.jpg" alt="Card image cap">
								<span class="fa fa-user post-icon"></span>
							</a>
						</div>
						<div class="card-body">
							<h6 class="let-spa mb-3">24 April 2019</h6>
							<h5 class="blog-title card-title">
								<a href="#">At vero eos et accusam et
									justo duo dolores et ea rebum</a>
							</h5>
							<!--
							<div class="row mt-5">
								<div class="col-3 testi-img-res px-2">
									<img src="images/te3.jpg" alt=" " class="img-fluid rounded-circle" />
								</div>
								<div class="col-9 w3_testi_grid mt-xl-2 mt-lg-0 mt-md-2 mt-4">
									<h5 class="mb-1">Petey Cruiser</h5>
									<p>Sed do eiusmod</p>
								</div>
							</div>
						-->
						</div>
					</div>
				</div>
				<!-- //blog grid -->
			</div>
		</div>
	</section>
	<!-- //blog -->

	<!-- who we are -->
	<section class="w3ls-bnrbtm py-5" id="menu">
		<div class="row no-gutters">
			<div class="col-xl-6 text-center">
				<img class="img-fluid" src="pic/Appe.jpg" alt="">
			</div>
			<div class="col-xl-6 who-left-w3pvt d-flex">
				<div class="w3layouts-bgs align-self-center mt-xl-5">
					
					<h3 class="title-w3ls-2 mt-1 mb-xl-5 mb-4 pb-xl-2"></h3>
					<div class="d-flex services-box mt-5">
						<div class="icon">
							<span class="fa fa-trophy"></span>
						</div>
						<div class="service-content">
							<h4></h4>
							<p class="serp">
								
							</p>
						</div>
					</div>
					<div class="d-flex services-box mt-5">
						<div class="icon">
							<span class="fa fa-users"></span>
						</div>
						<div class="service-content">
							<h4></h4>
							<p class="serp">
								
							</p>
						</div>
					</div>
					<div class="d-flex services-box mt-5">
						<div class="icon">
							<span class="fa fa-thumbs-up"></span>
						</div>
						<div class="service-content">
							<h4></h4>
							<p class="serp">
								
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row no-gutters" id="testi">
			<div class="col-xl-6 who-left-w3pvt-2 d-flex">
				<div class="w3layouts-bgs-2 align-self-center mb-xl-5 pb-xl-5">
					<h6 class="text-colors let-spa"></h6>
					<h3 class="title-w3ls-2 mt-1 mb-xl-5 mb-4"></h3>
					<p class="mb-4 sub-para-wthree"> </p>
					<p></p>
					<ul class="list-unstyled who-lists mt-5 ml-5">
						<li><span class="fa fa-caret-right"></span></li>
						<li><span class="fa fa-caret-right"></span></li>
						<li><span class="fa fa-caret-right"></span></li>
						<li><span class="fa fa-caret-right"></span></li>
					</ul>
				</div>
			</div>
			<div class="col-xl-6 text-xl-right text-center">
				<img class="img-fluid rounded" src="images/Merienda.jpg" alt="">
			</div>
		</div>
	</section>
	<!-- //who we are -->

	<!-- gallery -->
	<div class="gallery py-5" id="gallery">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-w3ls text-center text-bl mb-5">Our Gallery</h3>
			<div class="row no-gutters">
				<div class="col-md-4 gallery-grid1">
					<a href="#gal1">
						<img src="images/Gallery1.jpg" alt=" " class="img-fluid" />
					</a>
				</div>
				<div class="col-md-4 gallery-grid1">
					<a href="#gal2">
						<img src="images/GalleryNew2.jpg" alt=" " class="img-fluid" />
					</a>
				</div>
				<div class="col-md-4 gallery-grid1">
					<a href="#gal3">
						<img src="images/Gallery4New.jpg" alt=" " class="img-fluid" />
					</a>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-md-4 gallery-grid1">
					<a href="#gal4">
						<img src="images/Gallery5New.jpg" alt=" " class="img-fluid" />
					</a>
				</div>
				<div class="col-md-4 gallery-grid1">
					<a href="#gal5">
						<img src="images/Gallery6New.jpg" alt=" " class="img-fluid" />
					</a>
				</div>
				<div class="col-md-4 gallery-grid1">
					<a href="#gal6">
						<img src="images/Gallery7New.jpg" alt=" " class="img-fluid" />
					</a>
				</div>
			</div>
		</div>
		<!-- gallery popups -->
		<!-- popup-->
		<div id="gal1" class="pop-overlay animate">
			<div class="popup">
				<img src="images/gallery1.jpg" alt="Popup Image" class="img-fluid" />
				<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.
				</p>
				<a class="close" href="#gallery">&times;</a>
			</div>
		</div>
		<!-- //popup -->
		<!-- popup-->
		<div id="gal2" class="pop-overlay animate">
			<div class="popup">
				<img src="images/GalleryNew2.jpg" alt="Popup Image" class="img-fluid" />
				<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.
				</p>
				<a class="close" href="#gallery">&times;</a>
			</div>
		</div>
		<!-- //popup -->
		<!-- popup-->
		<div id="gal3" class="pop-overlay animate">
			<div class="popup">
				<img src="images/Gallery4New.jpg" alt="Popup Image" class="img-fluid" />
				<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.
				</p>
				<a class="close" href="#gallery">&times;</a>
			</div>
		</div>
		<!-- //popup3 -->
		<!-- popup-->
		<div id="gal4" class="pop-overlay animate">
			<div class="popup">
				<img src="images/Gallery5New.jpg" alt="Popup Image" class="img-fluid" />
				<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.
				</p>
				<a class="close" href="#gallery">&times;</a>
			</div>
		</div>
		<!-- //popup -->
		<!-- popup-->
		<div id="gal5" class="pop-overlay animate">
			<div class="popup">
				<img src="images/Gallery6New.jpg" alt="Popup Image" class="img-fluid" />
				<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.
				</p>
				<a class="close" href="#gallery">&times;</a>
			</div>
		</div>
		<!-- //popup -->
		<!-- popup-->
		<div id="gal6" class="pop-overlay animate">
			<div class="popup">
				<img src="images/Gallery7New.jpg" alt="Popup Image" class="img-fluid" />
				<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.
				</p>
				<a class="close" href="#gallery">&times;</a>
			</div>
		</div>
		<!-- //popup -->
		<!-- //gallery popups -->
	</div>
	<!-- //gallery -->

	<!-- contact -->
	<section class="contact py-5" id="contact">
		<div class="container">
			<h3 class="title-w3ls text-center text-bl mb-5">Contact Us</h3>
			<div class="row mx-sm-0 mx-2">
				<!-- map -->
				<div class="col-lg-6 map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.028954773568!2d121.03621731459785!3d14.597425989804435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c82bf0ce831d%3A0x5ed9de4d4359f4bf!2sAlex%20III!5e0!3m2!1sen!2sph!4v1570523121045!5m2!1sen!2sph" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
				</div>
				<!-- //map -->
				<!-- contact form -->
				<div class="col-lg-6 main_grid_contact">
					<div class="form-w3ls p-md-5 p-4">
						<h4 class="mb-4 sec-title-w3 let-spa text-bl">Send us a message</h4>
						<form action="#" method="post">
							<div class="row">
								<div class="col-sm-6 form-group pr-sm-1">
									<input class="form-control" type="text" name="Name" placeholder="Name" required="">
								</div>
								<div class="col-sm-6 form-group pl-sm-1">
									<input class="form-control" type="email" name="Email" placeholder="Email"
										required="">
								</div>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="Subject" placeholder="Subject"
									required="">
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="Phone Number" placeholder="Phone Number"
									required="">
							</div>
							<div class="form-group">
								<textarea name="message" placeholder="Message" required=""></textarea>
							</div>
							<div class="input-group1 text-right">
								<button class="btn" type="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
				<!-- //contact form -->
			</div>
		</div>
	</section>
	<!-- //contact -->
	<!-- support -->
	<!--
	<div class="support py-5" id="support">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-w3ls text-center text-bl mb-5">Help & Support</h3>
			<div class="row support-bottom text-center mb-5">
				<div class="col-lg-4 support-grid">
					<span class="fa fa-headphones"></span>
					<h5 class="text-dark text-uppercase mt-4 mb-3">Online Support</h5>
					<p>Ut enim ad minima veniam, quis nostrum ullam corporis suscipit laboriosam.</p>
					<a href="#" class="btn button-style-2 mt-sm-5 mt-4">
						Call Now
					</a>
				</div>
				<div class="col-lg-4 support-grid my-lg-0 my-5">
					<span class="fa fa-comments"></span>
					<h5 class="text-dark text-uppercase mt-4 mb-3">Live Chat 24/7</h5>
					<p>Ut enim ad minima veniam, quis nostrum ullam corporis suscipit laboriosam.</p>
					<a href="#" class="btn button-style-2 mt-sm-5 mt-4">
						Let's Chat
					</a>
				</div>
				<div class="col-lg-4 support-grid">
					<span class="fa fa-question"></span>
					<h5 class="text-dark text-uppercase mt-4 mb-3">Any Questions</h5>
					<p>Ut enim ad minima veniam, quis nostrum ullam corporis suscipit laboriosam.</p>
					<a href="#" class="btn button-style-2 mt-sm-5 mt-4">
						Learn More
					</a>
				</div>
			</div>
		</div>
	</div> -->
	<!-- support -->

	<!-- footer -->
	

	<!-- //footer -->

	<!-- copyright -->
	<div class="copy_right position-relative">
		<p class="text-center text-wh py-sm-3 py-3">© 2019 Alex III Restaurant. All rights reserved 
			
		</p>
		<!-- move top icon -->
		<a href="#" class="move-top text-center">
			<span class="fa fa-level-up" aria-hidden="true"></span>
		</a>
		<!-- //move top icon -->
	</div>
	<!-- //copyright -->


</body>

</html>
     