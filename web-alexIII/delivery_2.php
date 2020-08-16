<?php
  header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');

  require_once "admin/config.php";

  $file_dir = "admin/uploads/delivery_menu/";
  $current_session_id = "";
  /*
  if(!isset($_COOKIE["delivery_id"])){
              echo "<script>
                    alert('Invalid session Id!');
                    window.location.href = 'http://alexiiirestaurant.com/delivery.php';
                </script>"; 
  }
  */
  
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

  $name ="";
  $email = "";
  $address ="";
  $contact = "";

  $menu_data = null;
  $cart_size = 0;

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
  $sql = "SELECT cart FROM deliveries WHERE res_id=".$current_session_id;
    if($statement = mysqli_prepare($link, $sql))
      {
          if(mysqli_stmt_execute($statement))
          {
             # mysqli_stmt_store_result($statement);
             $result_set = ( mysqli_stmt_get_result($statement));
             $rows = mysqli_fetch_array($result_set);
             $json_string = $rows['cart'];
             $json_arr = json_decode($json_string);
             $user_cart = $json_arr;

            $method_name= "item_1";
            $method_idx = 1;

            while(empty($json_arr->$method_name) != 1)
            {
              $cart_size++;
              $method_idx++;
              $method_name= "item_".$method_idx;
            }
          }
          mysqli_stmt_close($statement);
      }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    echo "Post called!";
    var_dump($_POST);
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

            $method_name= "item_1";
            $method_idx = 1;

            while(empty($user_cart->$method_name) != 1)
            {
              $column_data = $user_cart->$method_name;
              if($column_data[0] == $requested_id)
              {
                unset($user_cart->$method_name); 
              }
              $method_idx++;
              $method_name = "item_" . $method_idx;
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
</body>
</html>