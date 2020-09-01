<?php
  header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');

  require_once "admin/config.php";

  $file_dir = "admin/uploads/delivery_menu/";
  $current_session_id = isset($_COOKIE["delivery_id"]) ? $_COOKIE["delivery_id"] : "";
  
  if($current_session_id == ""){
              echo "<script>
                    alert('Invalid session Id!');
                    //window.location.href = 'http://alexiiirestaurant.com/delivery.php';
                    window.location.href = 'http://localhost/AlexIII_Repo/web-alexIII/delivery.php';
                </script>"; 
  }
  
  /*
  if(array_key_exists("id", $_GET))
  {
    $current_session_id = $_GET['id'];
    file_put_contents("session.ss", $current_session_id);
  }else{
    $file_contents = file_get_contents("session.ss");
    
    for($x = 0; $x < count($file_contents); $x++)
    {
      $current_value = $file_contents[$x];
      if($current_value)
      {

      }
    }
    if(){

    }
  }
  */

  $email = "";
  $contact = "";

  $menu_data = null;
  $cart_size = 0;
  $total_price = 0;

  $category_kvp = array(); //contents of the categories text
  $sorted_entry_kvp = array(); //sorted menu_data items. Key => category_name, Value => array of strings
  $file_handle = fopen("admin/categories.txt", "r");
  if($file_handle)
  {
    while(($line = fgets($file_handle)) !== false)
    {
      $string_arr = explode(",",$line); //Key => category_num , Value => category_name
      $category_kvp[$string_arr[0]] = $string_arr[1];
    }

    fclose($file_handle);
  }

  $sql = "SELECT * FROM delivery_menu";

  class MenuEntry{
    public $id;
    public $price;
    public $name;
    public $description;
    public $category;

    function __construct($id, $price, $name, $description, $category)
    {
      $this->id = $id;
      $this->price = $price;
      $this->name = $name;
      $this->description = $description;
      $this->category = $category;
    }
  }

  if($statement_get = mysqli_prepare($link, $sql))
  {
    if(mysqli_stmt_execute($statement_get))
    {
      $result_set = mysqli_stmt_get_result($statement_get);
      $menu_data = mysqli_fetch_all($result_set);
      $dump_once = false;
      foreach($category_kvp as $key => $value)
      { 
        $sorted_entry_kvp[$value] = array();
        foreach($menu_data as $menu_entry)
        {
          
          $category = $menu_entry[4];
          
          if($key === $category)
          {
            $new_entry = new MenuEntry($menu_entry[0], $menu_entry[1], $menu_entry[2], $menu_entry[3], $menu_entry[4]);
            array_push($sorted_entry_kvp[$value], $new_entry);
          }
        }
      }
      /*
      foreach($sorted_entry_kvp as $key => $entries){
        foreach($entries as $entry){
        }
      }
      */
    }
  }  
  $user_cart = array();
  $address = "";
  $number = "";
  $res_id = "";
  $sql = "SELECT cart, res_name, res_tel,res_email,address, res_id FROM deliveries WHERE res_id=".$current_session_id;
    if($statement = mysqli_prepare($link, $sql))
      {
          if(mysqli_stmt_execute($statement))
          {
             # mysqli_stmt_store_result($statement);
             $result_set = ( mysqli_stmt_get_result($statement));
             $rows = mysqli_fetch_array($result_set);
             $json_string = $rows['cart'];
             $address = $rows['address'];
             $number = $rows['res_tel'];
             $res_id = $rows['res_id'];
             $json_arr = json_decode($json_string);
             $user_cart = $json_arr;
            $method_name= "item_1";
            $method_idx = 1;
            if($user_cart != null){
              foreach($user_cart as $key => $val){
                $topmost_idx = trim($key, "item_");
                if($topmost_idx > $method_idx) $method_idx = ++$topmost_idx; else $method_idx++;
              }
            }
          }
          mysqli_stmt_close($statement);
      }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(array_key_exists("submit_delivery", $_POST))
    {
      header("Location:tracker.php");
    }

    if(array_key_exists("add_item", $_POST))
    {
      $item_id ="";
      $item_price = "";
      $item_name = "";
      $item_description = "";
      $item_category = 0;

      $encounters = 0;
      $requested_id = $_POST['add_item'];
 
    for($x = 0; $x < count($menu_data); $x++)
    {
      $column_data = $menu_data[$x];
      $item_id = $column_data[0];

      if($item_id == $requested_id)
      {
        $encounters++;
        $item_price = $column_data[1];
        $item_name = $column_data[2];
        $item_description = $column_data[3];

        $method_name= "item_".$method_idx;
        $user_cart->$method_name[0] = $item_id;
        $user_cart->$method_name[1] = $item_price;
        $user_cart->$method_name[2] = $item_name;
        $user_cart->$method_name[3] = $item_description;
      }

    $json = json_encode($user_cart);
    $sql = "UPDATE `deliveries` set cart = ? WHERE res_id = ?";

      if($statement_get = mysqli_prepare($link, $sql))
      {
          mysqli_stmt_bind_param($statement_get, "ss", $p1, $p2);

          $p1 = $json;
          $p2 = $current_session_id;
          if(mysqli_stmt_execute($statement_get))
          {
          
          }
      }
    }
  }

  if(array_key_exists("remove_item", $_POST))
  {
      $item_id ="";
      $item_price = "";
      $item_name = "";
      $item_description = "";
      $encounters = 0;
      $requested_id = $_POST['remove_item'];
          
      $deducted = false;
          foreach($user_cart as $key => $val){
            $row_entry = ((array)$user_cart)[$key];
            if($deducted == false){
              if($requested_id == $row_entry[0]){
                $total_price -= $row_entry[1];
                $deducted = true;
              }
            }
          }
          unset($user_cart->$requested_id);
    $json = json_encode($user_cart);
    $sql = "UPDATE `deliveries` set cart = ? WHERE res_id = ?";

    if($statement_get = mysqli_prepare($link, $sql))
    {
        mysqli_stmt_bind_param($statement_get, "ss", $p1, $p2);

        $p1 = $json;
        $p2 = $current_session_id;
        if(mysqli_stmt_execute($statement_get))
        {
        
        }
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
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.fancybox-1.3.4.css">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="js/add-to-cart-interaction-master/assets/css/style.css">
    <script src="js/jquery-1.7.min.js"></script>
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
  <style>
    #stickynav {
      z-index: 4;
      overflow: hidden;
      background-color: #a6a3a2;
    }

    #stickynav a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    #stickynav a:hover {
      background-color: #ddd;
      color: black;
    }

    #stickynav a.active {
      background-color: #4CAF50;
      color: white;
    }

    .content {
      padding: 16px;
    }

    .sticky {
      position: fixed;
      top: 0;
      width: 100%;
    }

    .sticky + .content {
      padding-top: 60px;
    }
  </style>
</head>
<body>
<div class="bg-top">
<div class="bgr">
  <!--==============================header=================================-->
    <header></header>
      
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
      <a href="menu.php">Menu</a>
      <a href="contacts.php">Contacts</a>
      <a href="reservation.php">Reservation</a>
      <a href="delivery.php" class="active">Delivery</a>
      <a href="tracker.php">Tracker</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>

    <div id="stickynav">
      <?php
        $assignedTopNav = false;
        foreach($sorted_entry_kvp as $key => $entries)
        {
          $str_to_use = "";
          if($assignedTopNav){
            $id = explode(" ",$key) ;
            $decodedId = str_replace(array("\n", "\r"), '', $id);
            $str_to_use = $decodedId[0];
          }else{
            $assignedTopNav = true;
            $str_to_use = "myTopnav";
          }
          
          echo "<a href='#".$str_to_use."'>".$key."</a>";
        }
      ?>
      <!--
      <a href="#0" class="icon cd-cart__trigger" style="float:right">
        <img src="images/cart.png" style="width:30px;height:25px">
        <?php
          echo "<span>x".$cart_size."</span>"
        ?>
      </a>
      -->
      
      <!--
      <a href="gallery.php">Gallery</a>
      <a href="menu.php">Menu</a>
      <a href="contacts.php">Contacts</a>
      <a href="reservation.php">Reservation</a>
      <a href="delivery.php" class="active">Delivery</a>
      <a href="tracker.php">Tracker</a>
      -->
    </div>

    <script>
      // When the user scrolls the page, execute myFunction
      window.onscroll = function() {onStickyScroll()};
      // Get the navbar
      var navbar = document.getElementById("stickynav");

      // Get the offset position of the navbar
      var sticky = navbar.offsetTop;

      // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
      function onStickyScroll() {
        if (window.pageYOffset >= sticky) {
          navbar.classList.add("sticky")
        } else {
          navbar.classList.remove("sticky");
        }
      }
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
  <!--==============================content================================-->
   <section id="content">
      <div class="zerogrid">
       <div class="block-2 pad-2">
        <div class="col-12"> 
            <?php
              foreach($sorted_entry_kvp as $key => $entries){
                $id = explode(" ",$key);
                $decodedId = urldecode($id[0]);
                echo "<h2>".$key."</h2>";
                echo "<form id='".$decodedId."' action='delivery_2.php' method='POST' name='".$decodedId."'>";
                  echo "<div class='form-group row'>";
                  foreach($entries as $entry){
                    $id = $entry->id;
                    echo "<div class='col-sm-4'>";
                      //echo "<img src='".$file_dir.$id.".jpg'>";
                      echo "<image src='".$file_dir."page4-img6.jpg'>";
                    echo "</div>";

                    echo "<div class='col-sm-6'>";
                      echo "<div class='row'>";
                          echo "<div class='col-sm-8'>";
                            echo "<h3>".$entry->name."</h3>";
                          echo "</div>";
                          echo "<div class='col-sm-2'>";
                            echo "<h5>".$entry->price."</h3>";
                          echo "</div>";
                      echo "</div>";

                      echo "<div class='row'>";
                        echo "<div class='col-sm-12'>";
                          echo "<h5>". 
                                $entry->description
                                ."</h5>";
                        echo "</div>";                  
                      echo "</div>";
                  echo "</div>";
                  echo "<div class='col-sm-2'>";
                    echo "<button type='submit' class='btn btn-success' name='add_item' value='".$id."'>Add to Cart</button>";
                  echo "</div>";
                  }
                  echo "</div>";
                echo "</form>";
              }
            ?>
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

<div class="cd-cart cd-cart--empty js-cd-cart">
	<a href="#0" class="cd-cart__trigger text-replace">
		<ul class="cd-cart__count"> <!-- cart items count -->
			<li>0</li>
			<li>0</li>
		</ul> <!-- .cd-cart__count -->
	</a>

	<div class="cd-cart__content">
		<div class="cd-cart__layout">
			<header class="cd-cart__header">
        <h2>Delivery Information</h2>
      </header>
      <ul>
        
        <li><?php echo "<h5 style='color:#eb4034;'>Order Id:".$res_id."</h5>";?></li>
        <li><?php echo "<h5>".$address. "</h5>"; ?></li>
        <li><?php echo "<h5>". $number. "</h5>"; ?></li>
      </ul>
      <header class="cd-cart__header">
        <h2>Cart</h2>
			</header>
			<div class="cd-cart__body">
        <form method='POST' action=''>
				  <ul>
					  <!-- products added to the cart will be inserted here using JavaScript -->
          </ul>
        </form>
			</div>

			<footer class="cd-cart__footer">
				<a href="#0" class="cd-cart__checkout">
          <em>Place Order - P<span>
            <?php 
             foreach($user_cart as $key => $val){
              $price = ((array)$user_cart)[$key][1];
              $total_price += $price;
             }
            echo $total_price?>
            .00</span>
            <svg class="icon icon--sm" viewBox="0 0 24 24"><g fill="none" stroke="currentColor"><line stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="3" y1="12" x2="21" y2="12"/><polyline stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="15,6 21,12 15,18 "/></g>
            </svg>
          </em>
        </a>
			</footer>
		</div>
	</div> <!-- .cd-cart__content -->
</div> <!-- cd-cart -->
<script src="js/add-to-cart-interaction-master/assets/js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
<script src="js/add-to-cart-interaction-master/assets/js/main.js"></script> 
</body>
</html>