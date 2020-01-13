<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
	<link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/responsiveslides.css" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.fancybox-1.3.4.css">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/tms-0.4.1.js"></script>
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
    <script src="js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="js/responsiveslides.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        maxwidth: 948,
        namespace: "centered-btns"
      });
    });
  </script>
  <script>

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
        	<a href="index.php"><img src="images/AlexLOGO.png" alt="" width="150" height="90"></a>
       	</center>
      	
      	<!--
        <nav>  
            <ul class="menu">
                <li class="current"><a href="index.html">Home</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="wine_list.html">wine list</a></li>
                <li><a href="cookbook.html">cookbook</a></li>
            </ul>
            <div class="clear"></div>
         </nav>
		-->

		<div class="topnav" id="myTopnav">
		  <a href="index.php" class="active">Home</a>
		  <a href="gallery.php">Gallery</a>
		  <a href="contacts.php">Contacts</a>
		  <a>Reservation</a>
		  <a>Delivery</a>
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

        <div id="slide">		
	        <div class="rslides_container">
				<ul class="rslides" id="slider">
					<!--<li><img src="images/slider-1.jpg" alt="" /></li>
	                <li><img src="images/slider-2.jpg" alt="" /></li>
	                <li><img src="images/slider-3.jpg" alt="" /></li>
	            -->
	            	<li><img src="images/ALEX SLIDERS1.jpg" alt="" /></li>
	            	<li><img src="images/ALEX SLIDERS2.jpg" alt="" /></li>
	            	<li><img src="images/ALEX SLIDERS3.jpg" alt="" /></li>
	            	<li><img src="images/ALEX SLIDERS4.jpg" alt="" /></li>
				</ul>
			</div>
				
         <!--<div class="phone-number">Call us for reservation:<strong>1-800-123-1234</strong></div>-->	
      	</div> 
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
       <div class="block-2 pad-1">
       	<div class="col-1-1">
			<div class="wrap-col">
	        	<h2 class="h2-line">Welcome to Alex III!<strong>Insert Other Messages Here</strong></h2>
	            <div class="box-1">
					<div class="col-1-2"><div class="wrap-col">
	            		<div class="img-border"><img src="images/ALEXIII HISTORY.jpg" alt=""></div>
					</div></div>
					<div class="col-1-2"><div class="wrap-col">
		                <div class="extra-wrap">
		                	<!--<p class="it-bold p2">Valencia is one of <a href="http://blog.templatemonster.com/free-website-templates/" target="_blank" class="link">free website templates</a> created by TemplateMonster.com team. This website template is optimized for 1280X1024 screen resolution. </p>
		                    <p class="border-1">The PSD source files of this <a href="http://blog.templatemonster.com/2012/06/18/free-website-template-jquery-slider-restaurant-business/" class="link">Valencia</a><br> template are available for free for the<br> registered members of TemplateMonster.com. Feel free to get them! Vivamus hendrerit<br> mauris ut dui gravida ut viverra lectus <br>incidunt. </p>
		                    <a href="#" class="link-1">read more</a>  
		                	-->
		                	<p> 
		                		A very long message to show the history of Alex III (Insert CMS Refs)
		                	</p>
		                </div>
					</div></div>
	            </div>
			</div>
        </div>

       <!-- <div class="col-1-3">
			<div class="wrap-col">
	        	<h3 class="h3-line top-1">Testimonials:</h3>
	            <div class="box-2 top-2">
	                <div class="comment border-1">
	                    <p><img src="images/comment-top.png" alt="" ><span class="clr-1">Vivamus hendrerit mauris ut dui</span> gravida ut viverra lectus incidunt. Cras mattis tempor eros nec tristique. Sed sed felis arcu, vel vehicula.<img src="images/comment-bottom.png" alt="" class="second"></p>
	                    <span class="clr-1"><strong>Tina Smith</strong> <i>(top manager)</i></span>
	                </div>
	                <div class="comment border-1 top-3">
	                    <p><img src="images/comment-top.png" alt="" ><span class="clr-1">Vivamus hendrerit mauris ut dui</span> gravida ut viverra lectus incidunt. Cras mattis tempor eros nec tristique. Sed sed felis arcu, vel vehicula.<img src="images/comment-bottom.png" alt="" class="second"></p>
	                    <span class="clr-1"><strong>John Green</strong> <i>(director)</i></span>
	                </div>
	                <a href="#" class="link-1">read more</a>
	             </div> 
			 </div>
        </div>-->
        <div class="clear"></div>

        <div class="block-3">
        	<div class="h3">
       			<h3 class="h3-line-2">Popular Dishes</h3>
            </div>
            <div class="box-3">
				<div class="col-1-2">
	            	<div class="pad">
	                	<a class="plus" href="images/BBQ.jpg"><img src="images/BBQ.jpg" alt=""></a>

	                	<p class="border-2"><span class="it-bold clr-1">Chicken</span><br>Popular alex III Chicken </p>
	                </div>
				</div>

				<div class="col-1-2">
	            	<div class="pad">
	                	<a class="plus" href="images/PANCIT.jpg"><img src="images/PANCIT.jpg" alt=""></a>

	                	<p class="border-2"><span class="it-bold clr-1">Pancit</span><br>Best Pancit Ever </p>
	                </div>
				</div>
				<!--
				<div class="col-1-4">
	                <div class="pad">
	                	<div class="img-border"><img src="images/page1-img3.jpg" alt=""></div>
	                	<p class="border-2"><span class="it-bold clr-1">Cras mattis tempor eros nec </span><br>tristique Sed sed felis arcu, vel vehicula augue maecenas faucibus sagittis.</p>
	                	<a href="#" class="link">read more</a>
	                </div>
				</div>
				<div class="col-1-4">
	                <div class="pad">
	                	<div class="img-border"><img src="images/page1-img4.jpg" alt=""></div>
	                	<p class="border-2"><span class="it-bold clr-1">Sed sed felis arcu, vel </span><br>vehicula augue  maecenas faucibus sagittis cursus. Fusce tincidunt tellus eget.</p>
	                	<a href="#" class="link">read more</a>
	                </div>
				</div>
				<div class="col-1-4">
	                <div class="pad">
	                	<div class="img-border"><img src="images/page1-img5.jpg" alt=""></div>
	                	<p class="border-2"><span class="it-bold clr-1">Maecenas faucibus sagittis</span><br>cursus fusce tincidunt, tellus eget tristique cursus orci mi iaculis sem sit amet.</p>
	                	<a href="#" class="link">read more</a>
	                </div>
				</div>
			-->
            </div>
        </div>
    


       </div>
	  </div>
    </section>

<!--==============================footer=================================-->
 <footer>
 	<div class="zerogrid">
      <p>?? 2012  Valencia<br>
      Designed by <a rel="nofollow" href="http://www.templatemonster.com/" target="_blank" class="link">TemplateMonster</a> & <a rel="nofollow" href="https://www.zerotheme.com/" class="link">ZEROTHEME</a></p> 
	</div>
  </footer>	
</div> 
</div>       
</body>
</html>