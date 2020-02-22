<?php
  $curret_store_selection = empty($_GET) === false ? $_GET['store'] : "Matalino";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contacts</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
	<link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
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
                <li><a href="gallery.html">Gallery</a></li>
                <li class="current"><a href="contacts.html">Contacts</a></li>
                <li><a href="wine_list.html">wine list</a></li>
                <li><a href="cookbook.html">cookbook</a></li>
            </ul>
            <div class="clear"></div>
         </nav>
       -->
      <div class="topnav" id="myTopnav">
      <a href="index.php">Home</a>
      <a href="gallery.php">Gallery</a>
      <a href="contacts.php" class="active">Contacts</a>
      <a href="reservation.php">Reservation</a>
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
        <div class="col-2-3">
			<div class="wrap-col">
        	<h3 class="h3-line">Contact info</h3>
            <div class="map img-border">
              <?php 
                $iframe_source = "";
                switch ($curret_store_selection) {
                  case 'Matalino':
                    $iframe_source = "https://maps.google.com/maps?q=29%20Matalino%20St%2C%20Central%20Diliman%2C%20Quezon%2C%201100%20Metro%20Manila&t=&z=13&ie=UTF8&iwloc=&output=embed";
                    break;
                  case 'Wilson':
                    $iframe_source = "https://maps.google.com/maps?q=alex%20iii&t=&z=13&ie=UTF8&iwloc=&output=embed";
                    break;
                  case 'Tomas_Morato':
                    $iframe_source="https://maps.google.com/maps?q=Alex%20III&t=&z=13&ie=UTF8&iwloc=&output=embed";
                    break;
                  case 'Fairview':
                    $iframe_source="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=14.703773, 121.070369&amp;q=%2053%20Pontiac%20Corner%20Cheville%20Novaliches%2C%20Quezon%20City%201118%20Metro%20Manila%20Philippines+(Alex%20III%20Restaurant)&amp;ie=UTF8&amp;t=&amp;z=17&amp;iwloc=B&amp;output=embed";
                    break;
                  default:
                    # code...
                    break;
                }
              ?>
              <iframe src=<?php echo "'".$iframe_source."'"; ?>></iframe>
            </div>
            <div class="wrap">
            	<dl class="adr">
                    <a href="contacts.php?store=Matalino"><dt class="clr-3 it-bold">Matalino</dt></a>
                    <dd> 29 Matalino St, Central Diliman <br>Quezon City, 1100 Metro Manila</dd>
                    <dd><span>Telephone:</span><strong class="clr-2">+1 959 603 6035</strong></dd>
                    <dd><span>Fax:</span><strong class="clr-2">+1 504 889 9898</strong></dd>
                    <dd><span>Email:</span><a href="#" class="link">email@gmail.com</a></dd>
                </dl>
              <dl class="adr">
                    <a href="contacts.php?store=Wilson"><dt class="clr-3 it-bold">Wilson</dt></a>
                    <dd> Wilson <br>San Juan, 1502 Metro Manila</dd>
                    <dd><span>Telephone:</span><strong class="clr-2">+1 959 603 6035</strong></dd>
                    <dd><span>Fax:</span><strong class="clr-2">+1 504 889 9898</strong></dd>
                    <dd><span>Email:</span><a href="#" class="link">email@gmail.com</a></dd>
                </dl>
                <dl class="adr">
                    <a href="contacts.php?store=Tomas_Morato"><dt class="clr-3 it-bold">Tomas Morato</dt></a>
                    <dd> 30 Sct. Bayoran St, Diliman <br>Quezon City, Metro Manila</dd>
                    <dd><span>Telephone:</span><strong class="clr-2">+1 959 603 6035</strong></dd>
                    <dd><span>Fax:</span><strong class="clr-2">+1 504 889 9898</strong></dd>
                    <dd><span>Email:</span><a href="#" class="link">email@gmail.com</a></dd>
                </dl>
                <dl class="adr">
                    <a href="contacts.php?store=Fairview"><dt class="clr-3 it-bold">Fairview</dt></a>
                    <dd>  53 Pontiac Corner Cheville Novaliches <br>Quezon City 1118 Metro Manila Philippines</dd>
                    <dd><span>Telephone:</span><strong class="clr-2">+1 959 603 6035</strong></dd>
                    <dd><span>Fax:</span><strong class="clr-2">+1 504 889 9898</strong></dd>
                    <dd><span>Email:</span><a href="#" class="link">email@gmail.com</a></dd>
                </dl>
                <!--
                <dl class="adr last">
                    <dt class="clr-3 it-bold">Valencia</dt>
                    <dd>9863 Mill Road, <br>Cambridge, MG09 99HT</dd>
                    <dd><span>Telephone:</span><strong class="clr-2">+1 959 603 6035</strong></dd>
                    <dd><span>Fax:</span><strong class="clr-2">+1 504 889 9898</strong></dd>
                    <dd><span>Email:</span><a href="#" class="link">mail@valencia.com</a></dd>
                </dl>
              -->
            </div>
			</div>
        </div>
        <div class="col-1-3">
			<div class="wrap-col">
        	<h3 class="h3-line">Contact form:</h3>
            <form id="form" method="post" >
              <fieldset>
                <label><strong>Full name:</strong><input type="text" value=""><strong class="clear"></strong></label>
                <label><strong>Email:</strong><input type="text" value=""><strong class="clear"></strong></label>
                <label><strong>Message:</strong><textarea></textarea><strong class="clear"></strong></label>
                <strong class="clear"></strong>
                <div class="btns"><a href="#" class="link">clear</a><a href="#" class="link" onClick="document.getElementById('form').submit()">send</a></div>
              </fieldset>  
            </form> 
			</div>
        </div>
       </div>
	   </div>
    </section> 

<!--==============================footer=================================-->
<footer>
  <div class="zerogrid">
      <p>2020 Alex III<br>
      </p> 
  </div>
  </footer> 
</div> 
</div>       
</body>
</html>