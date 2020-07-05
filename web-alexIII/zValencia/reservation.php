<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservation</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
	<link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">
  <link rel="stylesheet" href="reservation/public/3-theme.css" type="text/css" media="all">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>

  <script src="reservation/public/3a-reserve-day.js"></script>
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
      <a href="menu.php">Menu</a>
      <a href="contacts.php">Contacts</a>
      <a href="reservation.php" class="active">Reservation</a>
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
       <div class="block-2 pad-2">
        <center>
         <h3 class="h3-line">Reservation</h3>
          <form id="res_form" onsubmit="return res.save()">
            <label for="res_name">Name</label>
            <input type="text" required id="res_name"/>
            <label for="res_email">Email</label>
            <input type="email" required id="res_email"/>
            <label for="res_tel">Telephone Number</label>
            <input type="text" required id="res_tel"/>
            <!--
            <label for="res_notes">Notes (if any)</label>
            <input type="text" id="res_notes"/>  
            -->
            <label for="res_persons_count">Number of persons </label>
            <input type="text" required id="res_persons_count"/> 
            <label>Reservation Date</label>
            <div id="res_date" class="calendar"></div>
            <button id="res_go" disabled>
              Submit
            </button>
          </form>
        </center>
<!--
			<div class="wrap-col">
        	<h3 class="h3-line">Contact info</h3>
            <div class="map img-border">
              <iframe src="https://maps.google.com/maps?q=29%20Matalino%20St%2C%20Central%20Diliman%2C%20Quezon%2C%201100%20Metro%20Manila&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
            </div>
            <div class="wrap">
            	<dl class="adr">
                    <dt class="clr-3 it-bold">Valencia</dt>
                    <dd> 29 Matalino St, Central Diliman <br>Quezon City, 1100 Metro Manila</dd>
                    <dd><span>Telephone:</span><strong class="clr-2">+1 959 603 6035</strong></dd>
                    <dd><span>Fax:</span><strong class="clr-2">+1 504 889 9898</strong></dd>
                    <dd><span>Email:</span><a href="#" class="link">email@gmail.com</a></dd>
                </dl>
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
      -->
	   </div>
    </section> 

<!--==============================footer=================================-->
  <footer>
    <!--
 	<div class="zerogrid">
      <p>© 2012  Valencia<br>
      Designed by <a rel="nofollow" href="http://www.templatemonster.com/" target="_blank" class="link">TemplateMonster</a> & <a rel="nofollow" href="https://www.zerotheme.com/" class="link">ZEROTHEME</a></p> 
	</div>
-->
  </footer>	 
</div> 
</div>       
</body>
</html>