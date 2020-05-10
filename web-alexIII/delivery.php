<?php
  header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');

  require_once "admin/config.php";

  $name ="";
  $email = "";
  $address ="";
  $contact = "";
  $captchaSubmitted = false;

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
      if($captchaSubmitted == false){
          echo "<script>
                    alert('Please check the Captcha test before continuing!');
                    window.location.href = 'http://alexiiirestaurant.com/delivery.php';
                </script>";
                
          return;
      }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact_num'];

    $sql = "INSERT INTO `deliveries` (`res_name`, `res_email`, `res_tel`, `address`) VALUES (?,?,?,?)";
    if($statement = mysqli_prepare($link, $sql))
      {
        mysqli_stmt_bind_param($statement, "ssss", $p1, $p2, $p3, $p4);

        $p1 = $name;
        $p2 = $email;
        $p3 = $contact;
        $p4 = $address;
        if(mysqli_stmt_execute($statement))
        {
          header("Location: delivery_2.php?id=". mysqli_stmt_insert_id($statement));
        }
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delivery</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.fancybox-1.3.4.css">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'
>    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="js/css3-mediaqueries.js"></script>
    <script src="js/jquery.fancybox-1.3.4.pack.js"></script>
    <script>
    $(document).ready(function(){
      $("a.plus").fancybox({
        'transitionIn'  : 'elastic',
        'transitionOut' : 'elastic',
        'speedIn'   : 600, 
        'speedOut'    : 200, 
        'overlayShow' : true
      })
    });


  </script>
 	<script type="text/javascript">
	var captchaSubmitted = false;
      var onloadCallback = function() {
        grecaptcha.render(document.getElementById('captcha_element'), {
          'sitekey' : '6LfRY-EUAAAAAFP3Eowrv1NXKVJGCM5dVS-n1XcW',
          'callback' : onCaptchaSubmit
        });
      };c
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
      <a href="contacts.php">Contacts</a>
      <a href="reservation.php">Reservation</a>
      <a href="delivery.php" class="active">Delivery</a>
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
       <div class="block-2 pad-1">
        <div class="col-lg-12">
          <center>
          <h3 class="h3-line">Delivery (Step 1):</h3>
          <h5>Input your personal information!</h5>
            <form id="form" method="post" >
              <fieldset>
                <label><strong>Name:</strong><input type="text" name="name"><strong class="clear"></strong></label>
                <label><strong>Email:</strong><input type="text" name="email"><strong class="clear"></strong></label>
                <label><strong>Address:</strong><input type="text" name="address"><strong class="clear"></strong></label>
                <label><strong>Contact Number:</strong><input type="text" name="contact_num"><strong class="clear"></strong></label>
                <strong class="clear"></strong>
                <!--<a href="#" class="link" onClick="document.getElementById('form').submit()">send</a>
                -->
                <br/>
                <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                async defer>
                </script>
                <div id="captcha_element"></div>
                <br/>
                <script>
                var onCaptchaSubmit = function(){
                    $(document).ready(function(){
                       createCookie("verify", true,""); 
                    });
                    
                    function createCookie(name, value, days) 
                    { 
                        var expires; 
                        var date = new Date();
                        if (days) { 
                             
                            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
                            expires = "; expires=" + date.toGMTString(); 
                        } 
                        else 
                        { 
                            date.setTime(date.getTime() + (2 * 1000));
                            expires = "; expires=" + date.toGMTString(); 
                        } 
                          
                        document.cookie = escape(name) + "=" +  
                            escape(value) + expires + "; path=/"; 
                    } 
                    //captchaSubmitted = true;
                };
                </script>
                <button type="submit" class="btn btn-round btn-success" name="delivery_submit">Submit</button>
              </div>
              </fieldset>  
            </form>
            </center> 
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