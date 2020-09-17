<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gallery</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.fancybox-1.3.4.css">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
    <script src="js/jquery.fancybox-1.3.4.pack.js"></script>
    <script>
		$(document).ready(function(){
			$("a.plus").fancybox({
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600, 
				'speedOut'		:	200, 
				'overlayShow'	:	true
			})
		});


	</script>
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
    	<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
	<![endif]-->
</head>
<body>
<div class="bg-top">
<div class="bgr">
  <!--==============================header=================================-->
    <header>
		<div class="zerogrid">
        <center>
        	<a href="index.php"><img src="images/AlexLOGO.png" width="150" height="90"></a>
        </center>
	<!--
        <nav>  
            <ul class="menu">
                <li><a href="index.html">Home</a></li>
                <li class="current"><a href="gallery.html">Gallery</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="wine_list.html">wine list</a></li>
                <li><a href="cookbook.html">cookbook</a></li>
            </ul>
            <div class="clear"></div>
         </nav>
     -->
     	<div class="topnav" id="myTopnav">
		  <a href="index.php">Home</a>
		  <a href="gallery.php" class="active">Gallery</a>
		  <a href="menu.php">Menu</a>
		  <a href="contacts.php">Contacts</a>
		  <a href="reservation.php">Reservation</a>
		  <a href="delivery.php">Delivery</a>
		  <a href="tracker.php">Tracker</a>
		  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
		    <i class="fa fa-bars"></i>
		  </a>
		</div>

		<script>
			function myFunction() {
			  var x = document.getElementById("myTopnav");
			  if (x.className === "topnav") {
			    x.className += " responsive";
			  } else {
			    x.className = "topnav";
			  }
			}
		</script>
		 </div>  
    </header>  
  <!--==============================content================================-->
   <section id="content">
	<div class="zerogrid">
<!--
       <div class="block-1">
	   	<div class="col-1-4">
	       	<div class="pad border-right">
	        	<div class="block-1-title">
	            	<span>01.</span>
	                <div class="text-1">Best<strong>cuisine</strong></div>
	                <strong class="clear"></strong>
	            </div>
	            <p class="border-1">This website template has several pages:  Restaurant, Cuisine, Wine List, CookBook, Gallery, Contacts (note that contact us form - doesn't work).</p>
	            <a href="#" class="link-1">read more</a>
	        </div>
		</div>
		<div class="col-1-4">
	        <div class="pad border-right">
	        	<div class="block-1-title">
	            	<span>02.</span>
	                <div class="text-2">Good<strong>rest</strong></div>
	                <strong class="clear"></strong>
	            </div>
	            <p class="border-1">Cras mattis tempor eros nec tristique. Sed sed felis arcu, vel vehicula augue. Maecenas faucibus sagittis cursus. Fusce tincidunt, tellus eget tristique cursus.</p>
	            <a href="#" class="link-1">read more</a>
	        </div>
		</div>
		<div class="col-1-4">
	        <div class="pad border-right">
	        	<div class="block-1-title">
	            	<span>03.</span>
	                <div class="text-3">Great<strong>service</strong></div>
	                <strong class="clear"></strong>
	            </div>
	            <p class="border-1">Maecenas faucibus sagittis cursus. Fusce tincidunt, tellus eget tristique cursus, orci mi iaculis. sem, sit amet dictum velit velit eu magna. 
	Nunc viverra nisi sed orci.</p>
	            <a href="#" class="link-1">read more</a>
	        </div>
		</div>
		<div class="col-1-4">
	        <div class="pad">
	        	<div class="block-1-title">
	            	<span>04.</span>
	                <div class="text-4">Best<strong>cooks</strong></div>
	                <strong class="clear"></strong>
	            </div>
	            <p class="border-1">Fusce tincidunt, tellus eget tristique cursus, orci mi iaculis. sem, sit amet dictum velit velit eu magna. Nunc viverra nisi sed orci tincidunt at hendrerit orci.</p>
	            <a href="#" class="link-1">read more</a>
	        </div>
		</div>
       </div>
-->
       <div class="block-2 pad-2">
        <div class="block-4 col-3">
        	<div class="h2">
       			<h2 class="h2-line-2">Our gallery:</h2>
            </div>
            <ul class="gallery">
					<?php
						$descriptions = array("The film is about the history of Alex III Restaurant on how it began and how it became a well known restaurant in metro manila.",
											 "The film is about the importance of family bonding and how Alex III Restaurant makes a family bonding
											 more meaningful.",
											 "The film is about friendship even though you and your friends doesn’t see each other Alex III Restaurant is always there to deliver comfort food to you and your friends.",
											"The film is about love at Alex III Restaurant because of its relaxing environment and good food it also has been a place where wedding and proposals have been witnessed.",
											"The film is about celebrations being held at Alex III Restaurant families could bond and dine altogether inside the restaurant serving quality food and great service");
						$slider_dir = 'admin/uploads/gallery';
    					$slider_images = array_diff(scandir($slider_dir), array('..', '.'));
						for($i = 2; $i < count($slider_images) + 2; $i++)
						{
							$current_slider_img = $slider_images[$i];
							if($current_slider_img)
							{
								if(strpos($current_slider_img, ".jpg"))
								{
									echo "<li><a class='plus' href='".$slider_dir."/".$current_slider_img."'><img src='".$slider_dir."/".$current_slider_img."'</li>";
								}else if(strpos($current_slider_img, ".mp4"))
								{
									echo "<li>
											<center>
												<video width=640 height=480 controls>
													<source src='".$slider_dir."/".$current_slider_img."' type='video/mp4'>
												</video>
											<br>".$descriptions[($i - 2)]."
											</center>
									</li>";								
								}
							}
						}
					?>       

					<!--    	
               	<li><a class="plus" href="images/gallery-1-big.jpg"><img src="images/gallery-1.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-2-big.jpg"><img src="images/gallery-2.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-3-big.jpg"><img src="images/gallery-3.jpg" alt=""></a></li>
                <li><a class="plus" href="images/gallery-4-big.jpg"><img src="images/gallery-4.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-5-big.jpg"><img src="images/gallery-5.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-6-big.jpg"><img src="images/gallery-6.jpg" alt=""></a></li>
                <li><a class="plus" href="images/gallery-7-big.jpg"><img src="images/gallery-7.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-8-big.jpg"><img src="images/gallery-8.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-9-big.jpg"><img src="images/gallery-9.jpg" alt=""></a></li>
                <li><a class="plus" href="images/gallery-10-big.jpg"><img src="images/gallery-10.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-11-big.jpg"><img src="images/gallery-11.jpg" alt=""></a></li>
				<li><a class="plus" href="images/gallery-12-big.jpg"><img src="images/gallery-12.jpg" alt=""></a></li>
			-->
            </ul>
        </div>
       </div>

	  </div>
    </section> 

<!--==============================footer=================================-->
<footer>
 	<div class="zerogrid">
      <p>© 2020 ALEX III RESTAURANT<br>
      </p> 
	</div>
  </footer>	
</div> 
</div>       
</body>
</html>