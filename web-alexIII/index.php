<?php
  header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');

  require_once "admin/config.php";

#top header
   	$welcome_header_1 = "";
    $welcome_subheader = "";
    $welcome_description = "";
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "SELECT welcome_header_1, welcome_subheader, welcome_description FROM home";

      if($statement = mysqli_prepare($link, $sql))
      {
        if(mysqli_stmt_execute($statement))
        {
         # mysqli_stmt_store_result($statement);
         $result_set = ( mysqli_stmt_get_result($statement));
         $rows = mysqli_fetch_array($result_set);
         $welcome_header_1 = $rows[0]; 
         $welcome_subheader = $rows[1];
         $welcome_description = $rows[2];
        }
      }
  	}
#topheader end
?>
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
		  <a href="menu.php">Menu</a>
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

        <div id="slide">		
	        <div class="rslides_container">
	        	<!--
				<ul class="rslides" id="slider">

	            	<li><img src="images/ALEX SLIDERS1.jpg" alt="" /></li>
	            	<li><img src="images/ALEX SLIDERS2.jpg" alt="" /></li>
	            	<li><img src="images/ALEX SLIDERS3.jpg" alt="" /></li>
	            	<li><img src="images/ALEX SLIDERS4.jpg" alt="" /></li>
				</ul>
				-->
				<ul class="rslides" id="slider">
					<?php
						$slider_dir = 'admin/uploads/home_slider';
    					$slider_images = array_diff(scandir($slider_dir), array('..', '.'));
						for($i = 2; $i < count($slider_images) + 2; $i++)
						{
							$current_slider_img = $slider_images[$i];
							echo "<li><image width=600 height=480 src='".$slider_dir."/".$current_slider_img."'</li>";
						}
					?>
				</ul>
			</div>

         <!--<div class="phone-number">Call us for reservation:<strong>1-800-123-1234</strong></div>-->	
      	</div> 
		</div>
    </header>  
  <!--==============================content================================-->
   <section id="content">
   	<div class="zerogrid">
       <div class="block-2 pad-1">				
       	<div class="col-1-1">
			<div class="wrap-col">
	        	<h2 class="h2-line"><?php echo $welcome_header_1;?><strong><?php echo $welcome_subheader;?></strong></h2>
	            <div class="box-1">
					<div class="col-1-2"><div class="wrap-col">
	            		<div class="img-border"><img src="admin/uploads/index_images/description_image.jpg" alt=""></div>
					</div></div>
					<div class="col-1-2"><div class="wrap-col">
		                <div class="extra-wrap">
		                	<!--<p class="it-bold p2">Valencia is one of <a href="http://blog.templatemonster.com/free-website-templates/" target="_blank" class="link">free website templates</a> created by TemplateMonster.com team. This website template is optimized for 1280X1024 screen resolution. </p>
		                    <p class="border-1">The PSD source files of this <a href="http://blog.templatemonster.com/2012/06/18/free-website-template-jquery-slider-restaurant-business/" class="link">Valencia</a><br> template are available for free for the<br> registered members of TemplateMonster.com. Feel free to get them! Vivamus hendrerit<br> mauris ut dui gravida ut viverra lectus <br>incidunt. </p>
		                    <a href="#" class="link-1">read more</a>  
		                	-->
		                	<p> 
		                		<?php echo $welcome_description; ?>
		                	</p>
		                </div>
					</div></div>
	            </div>
			</div>
		</div>
		
        <div class="clear"></div>

        <div class="block-3">
        	<div class="h3">
       			<h3 class="h3-line-2">Alex III Bestsellers</h3>
            </div>
            <div class="box-3">
				<div class="col-1-2">
	            	<div class="pad">
	                	<a class="plus" href="images/ThreeChicken.jpg"><img src="images/ThreeChicken.jpg" alt=""></a>

	                	<p class="border-2"><span class="it-bold clr-1">Alex III 3 pcs Chicken Barbecue</span><br> </p>
	                </div>
				</div>

				<div class="col-1-2">
	            	<div class="pad">
	                	<a class="plus" href="images/PancitRemake.jpg"><img src="images/PancitRemake.jpg" alt=""></a>

	                	<p class="border-2"><span class="it-bold clr-1">Alex III Special Pancit Canton</span><br> </p>
	                </div>
				</div>
            </div>
        </div>
    


       </div>
	  </div>
    </section>

<!--==============================footer=================================-->
 <footer>
 	<div class="zerogrid">
      <p>© 2020 ALEX III RESTAURANT <br>
      </p> 
	</div>
  </footer>	
</div> 
</div>       
</body>
</html>