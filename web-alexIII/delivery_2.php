<?php
  header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');

  require_once "admin/config.php";

  $file_dir = "admin/uploads/delivery_menu/";
  $current_session_id = "";
  if(array_key_exists("id", $_GET))
  {
    $current_session_id = $_GET['id'];
    file_put_contents("session.ss", $current_session_id);
  }else{
    $current_session_id = file_get_contents("session.ss");
  }

  $name ="";
  $email = "";
  $address ="";
  $contact = "";

  $menu_data = null;
  $cart_size = 0;

  $sql = "SELECT * FROM delivery_menu";

  if($statement_get = mysqli_prepare($link, $sql))
  {
    if(mysqli_stmt_execute($statement_get))
    {
      $result_set = mysqli_stmt_get_result($statement_get);
      $menu_data = mysqli_fetch_all($result_set);
     // echo "sesh  id:" . $current_session_id;
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
      <a href="menu.php">Menu</a>
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
       <div class="block-2 pad-2">
        <div class="col-5"> 
         <h3 class="h3">Menu:</h3>
          <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post">
            <font color="black">
            <ul>
            <?php
              for($x = 0; $x < count($menu_data); $x++)
              {
                $column_data = $menu_data[$x];
                $id = $column_data[0];

                echo "<li><img src='".$file_dir.$id.".jpg' class='col-sm-1 control-label'></li>";
                echo"<li><label class='col-sm-1 control-label' name='name' value='".$column_data[2]."'>Name:".$column_data[2]."</li>";
                echo"<li><label class='col-sm-1 control-label' name='price' value='".$column_data[1]."'>Price:".$column_data[1]."</li>";
                echo "<button class='col-sm-1 control-label' name='add_item' value='".$id."'>Add to Cart</button>";
              }    
            ?>

            </ul>
          </font>
         </form>
        </div>

        <div class="block-2 col-3"> 
        <div class="col-4"> 
         <h3 class="h3">Items in Cart:</h3>
          <form id="form" method="post"> 
          <ul>
            <?php

            $method_name= "item_1";
            $method_idx = 1;

            while(empty($json_arr->$method_name) != 1)
            {
              $column_data = $json_arr->$method_name;
              $id = $column_data[0];

              echo"<li><label class='col-sm-1 control-label' name='name' value='".$column_data[2]."'>Name:".$column_data[2]."</li>";
              echo"<li><label class='col-sm-1 control-label' name='price' value='".$column_data[1]."'>Price:".$column_data[1]."</li>";
              echo "<button class='col-sm-1 control-label' name='remove_item' value='".$id."'>Remove from Cart</button>";
              $method_idx++;
              $method_name = "item_" . $method_idx;
             }
            ?>
            <li><center><button onclick="myFunction()" type="submit" class="btn btn-round btn-success" name ="submit_delivery">Submit</button></center></li>
            <script>alert("Your session id is "+ <?php echo $current_session_id; ?>);</script>
          </ul>
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