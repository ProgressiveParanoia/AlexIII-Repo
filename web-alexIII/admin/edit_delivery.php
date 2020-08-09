<?php
  header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');
  session_start();
  if(!isset($_SESSION['username']) && empty($_SESSION['username']) === true)
  {
    header("Location: login.php");
  }
    
  require_once "config.php";
  $file_dir = "uploads/delivery_menu";

  $menu_data = null;
  $item_id = 0; 
  $item_price = 0;

  $item_title = "";
  $item_description = "";
  $new_category = "";

  $category_kvp = array();
  $file_handle = fopen("categories.txt", "r");
  if($file_handle){
    while(($line = fgets($file_handle)) !== false){
      $string_arr = explode(",",$line); //Key => category_num , Value => category_name
      $category_kvp[$string_arr[0]] = $string_arr[1];
    }

    fclose($file_handle);
  }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(array_key_exists("remove_item", $_POST))
    {
      $key_to_remove = $_POST["remove_item"];

      $delete_sql = "DELETE FROM `delivery_menu` WHERE item_id = ?";
      if($statement = mysqli_prepare($link, $delete_sql))
      {

        mysqli_stmt_bind_param($statement, "s", $p1);
        $p1 = $key_to_remove;
        if(mysqli_stmt_execute($statement))
        {
        }
      }
    }
  }

    $sql = "SELECT * FROM delivery_menu";

    if($statement_get = mysqli_prepare($link, $sql))
    {
      if(mysqli_stmt_execute($statement_get))
      {
        $result_set = mysqli_stmt_get_result($statement_get);
        $menu_data = mysqli_fetch_all($result_set);
      }
    }

if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(array_key_exists("submit_category", $_POST)){
      $new_category = $_POST['new_category'];
      $line_count = 0;
      $file_handle = fopen("categories.txt", "r");
      if($file_handle)
      {
        while(($line = fgets($file_handle)) !== false){
          $string_arr = explode(",",$line); //Key => category_num , Value => category_name
          $category_kvp[$string_arr[0]] = $string_arr[1];
          $line_count++;
        }
        $line_count++;
        $entry_key = $line_count . "";
        $category_kvp[$entry_key] = $new_category;
        fclose($file_handle);
      }else{
        $category_kvp["1"] = $new_category;
      }

      $category_entries = "";
      foreach($category_kvp as $key => $value){
        $category_entries = $key . "," . $value . "\n";
      }
      file_put_contents("categories.txt", $category_entries, FILE_APPEND);
    }
    if(array_key_exists("item_submit", $_POST))
    {
      $item_title = $_POST['item_title'];
      $item_description = $_POST['item_description'];
      $item_price = $_POST['item_price'];
      $item_category = $_POST['item_category'];
      $item_key = 0;
      foreach($category_kvp as $key => $value)
      {
        if($item_category === $value)
        {
          $item_key = $key;
        }
      }
      //$post_new_sql = "INSERT INTO `delivery_menu`(`item_id`, `price`, `name`, `description`) VALUES (".$item_id.",".$item_price.",". $item_title.",". $item_description.")";
      $post_new_sql = "INSERT INTO `delivery_menu`(`item_id`, `price`, `name`, `description`, `category`) VALUES (?,?,?,?,?)";
      if($statement = mysqli_prepare($link, $post_new_sql))
      {
        mysqli_stmt_bind_param($statement, "sssss", $p1, $p2, $p3, $p4, $p5);

        $p1 = $item_id;
        $p2 = $item_price;
        $p3 = $item_title;
        $p4 = $item_description;
        $p5 = $item_key;
        if(mysqli_stmt_execute($statement))
        {
          $item_id = mysqli_stmt_insert_id($statement);
        }
      }

      $file = $_FILES['menu_image'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name']; //address
            $fileSize = $file['size'];
            $fileError = $file['error']; //error message
            $fileType = $file['type']; //file extension

            $fileExtension = explode('.', $fileName);
            $fileActualExtensison = strtolower(end($fileExtension));

            $allowedFileExtensions = array('jpg', 'jpeg', 'png', 'mp4');

            if(in_array($fileActualExtensison, $allowedFileExtensions))
            {
                if($fileError === 0)
                {
                  $fileForm = strcasecmp($fileActualExtensison, "mp4") != 0 ? ".jpg" : ".mp4";
                  $fileName = $item_id . $fileForm;
                  $fileDestination = 'uploads/delivery_menu/' . $fileName;
                  move_uploaded_file(($fileTmpName), ($fileDestination));
                  header('Location: edit_delivery.php');
               #   echo "You successfully uploaded the file!";
                }else{
                  echo "File error encountered! Error number:" . $fileError;
                }
            }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>DASHGUM - Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Alex III Content Management System</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <!--  notification end -->
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="assets/img/profile.png" class="img-circle" width="60"></a></p>
                  <h5 class="centered">Admin</h5>
                    
                  <li class="mt">
                      <a href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Reservation</span>
                      </a>
                      <a href="order_tracker.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Order Tracker</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-wrench"></i>
                          <span>Edit Page</span>    <!--Edit Website Stuff-->
                      </a>
                      <ul class="sub">
                          <li><a  href="edit_home.php">Edit Home</a></li>        
                          <li><a  href="edit_gallery.php">Edit Gallery</a></li>  
                          <li><a class="active" href="edit_delivery.php">Edit Delivery</a></li>
                          <li><a  href="edit_menu.php">Edit Menu</a></li>    
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="login.php">
                          <i class="fa fa-power-off"></i>
                          <span>Logout</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>j
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
            <!-- Home of Alex III-->
        	<h3><i class="fa fa-angle-right"></i> Menu</h3>
				<div class="row mt">
					<div class="col-lg-12">		
                  <div class="form-panel">
                    <form class="form-horizontal style-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Current Categories</label>
                              <?php
                                echo "<p class='col-sm-12'> </p>";
                                foreach($category_kvp as $key => $value){
                                    echo "<p class='col-sm-4'> ".$value."</p>";
                                    
                                }
                              ?>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Add Category</label>
                              <div class="col-sm-10">
                                <input type="text" name="new_category" class="form-control" value="<?php echo $new_category?>">
                              </div>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-round btn-success" name="submit_category">Submit</button>   
                              </div>
                            </div>
                      </form>
                  </div>
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i>Menu Item</h4>
                      <form class="form-horizontal style-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                  <!--<input type="text" name="header" class="form-control">-->
                                    <input type="file" name="menu_image">
                                  <span class="help-block">Change Image</span>
                                </div>
                              <label class="col-sm-2 col-sm-2 control-label">Item Name</label>
                              <div class="col-sm-10">
                                  <input type="text" name="item_title" class="form-control" value="<?php echo $item_title?>">
                                  <span class="help-block">Change Item Name</span>
                              </div>                            
                            <label class="col-sm-2 col-sm-2 control-label">Item Price</label>
                            <div class="col-sm-10">
                                  <input type="text" name="item_price" class="form-control" value="<?php echo $item_price?>">
                                  <span class="help-block">Change Item Price</span>
                              </div>
                              <label class="col-sm-2 col-sm-2 control-label">Item Description</label>
                            <!--<div class="col-sm-6">
                              <image width=420 height=320 src='uploads/index_images/description_image.jpg'></image>
                            -->
                            <div class="col-sm-10">
                              <textarea class="form-control" name="item_description" style="height:170px" ><?php echo $item_description?></textarea>
                              <span class="help-block">Change Sub Message.</span>
                            </div>
                            <label class="col-sm-2 col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <?php
                                  echo "<select name='item_category'>";
                                    foreach($category_kvp as $key => $value)
                                    {
                                      echo "<option value='".$key."'>".$value."</option>";
                                    }
                                  echo "</select>";
                                ?>
                                <span class="help-block">Change Item Category</span>
                            </div>
                              <label class="col-sm-2 col-sm-2 control-label">   
                                <button type="submit" class="btn btn-round btn-success" name="item_submit">Submit</button>   
                              </div>                      
                            </div>
                          </div>
                    </form>
                  </div>     
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i>Menu Items</h4>
                      <form class="form-horizontal style-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post">
                          <?php
                           // echo "<ul>";
                            for($x = 0; $x < count($menu_data); $x++)
                            {
                              $column_data = $menu_data[$x];
                              /*
                              echo "<li><img src='uploads/delivery_menu/".$column_data[0].".jpg' width=300 height=240></li>";
                              echo"<li><label class='col-sm-3 col-sm-3 control-label'>ItemID:".$column_data[0]."</li>";
                              echo"<li><label class='col-sm-3 col-sm-3 control-label'>Name:".$column_data[2]."</li>";
                              echo"<li><label class='col-sm-3 col-sm-3 control-label'>Price:".$column_data[1]."</li>";
                              echo"<li><label class='col-sm-3 col-sm-3 control-label'>Description:".$column_data[3]."</li>";
                              */
                              echo "<div class='row'>";
                                echo "<div class='col-sm-4'><img src='uploads/delivery_menu/".$column_data[0].".jpg' width=300 height=240></div>";
                                echo "<div class='col-sm-6'>";
                                  echo"<p>ItemID:".$column_data[0]."</p>";
                                  echo"<p>Name:".$column_data[2]."</p>";
                                  echo"<p>Price:".$column_data[1]."</p>";
                                  echo"<p>Description:".$column_data[3]."</p>";
                                  echo "<p>Category:".$column_data[4]."</p>";
                                  echo "<button type='submit' class='btn btn-round btn-success' name='remove_item' value='".$column_data[0]."'>Remove</button>";

                                  echo "</div>";
                              echo "</div>";
                            }
                            //echo "</ul>";
                          ?>
                              </div>                      
                            </div>
                      </form>
                  </div>            
				</div>
			</div>
        </section>
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
      
              <a href="form_component.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom switch-->
    <script src="assets/js/bootstrap-switch.js"></script>
    
    <!--custom tagsinput-->
    <script src="assets/js/jquery.tagsinput.js"></script>
    
    <!--custom checkbox & radio-->
    
    <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
    
    
    <script src="assets/js/form-component.js"></script>    
    
    
  <script>
      //custom select box

  </script>

  </body>
</html>
