<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu</title>
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
		  <a href="gallery.php">Gallery</a>
		  <a href="menu.php" class="active">Menu</a>
		  <a href="contacts.php">Contacts</a>
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
       <div class="block-2 pad-2">
        <div class="block-4 col-3">
        	<div class="h2">
       			<h2 class="h2-line-2">Alex III Menu</h2>
            </div>
            <ul class="gallery">
					<?php
						$slider_dir = 'admin/uploads/menu';
    					$slider_images = array_diff(scandir($slider_dir), array('..', '.'));
						for($i = 2; $i < count($slider_images) + 2; $i++)
						{
							$current_slider_img = $slider_images[$i];
							if($current_slider_img)
							{
								if(strpos($current_slider_img, ".jpg"))
								{
									
									echo "<li>
											<img src='".$slider_dir."/".$current_slider_img."'>
										</li>";
									
									//echo "<li><a class='plus' href='".$slider_dir."/".$current_slider_img."'><img src='".$slider_dir."/".$current_slider_img."'></li>";
								}else if(strpos($current_slider_img, ".mp4"))
								{
									echo "<li><video width=640 height=480 controls>
										<source src='".$slider_dir."/".$current_slider_img."' type='video/mp4'>
										</video>
									</li>";								
								}
							}
						}
					?>       

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