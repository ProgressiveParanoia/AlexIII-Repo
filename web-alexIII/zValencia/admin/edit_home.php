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
    
    $slider_dir = 'uploads/home_slider';
    $slider_images = array_diff(scandir($slider_dir), array('..', '.'));

      if($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $post_keys = array_keys($_POST);
        for($i = 2; $i < count($slider_images) + 2; $i++)
        {
            $current_slider_name = $slider_images[$i];
            $current_slider_name = trim($current_slider_name, ".jpg");
            print_r($_POST);
            if(strpos($post_keys[0], $current_slider_name))
            {
                unlink($slider_dir. "/".$current_slider_name . ".jpg");
                header('Location: edit_home.php');
            }    
        }

        if(array_key_exists("add_slider_image", $_POST))
        {
            echo "Exists!";
            $slider_collection_size = count($slider_images) + 1;
            $latest_index = $slider_collection_size ;
            //Put the image at the end of the array
            $file = $_FILES['slider_image'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name']; //address
            $fileSize = $file['size'];
            $fileError = $file['error']; //error message
            $fileType = $file['type']; //file extension

            $fileExtension = explode('.', $fileName);
            $fileActualExtensison = strtolower(end($fileExtension));

            $allowedFileExtensions = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExtensison, $allowedFileExtensions))
            {
                if($fileError === 0)
                {
                  $fileName = "home_slider_" . $latest_index .".jpg";
                  $fileDestination = 'uploads/home_slider/' . $fileName;
                  move_uploaded_file(($fileTmpName), ($fileDestination));
                  header('Location: edit_home.php');
               #   echo "You successfully uploaded the file!";
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
                      <a class="active" href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Reservation</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-wrench"></i>
                          <span>Edit Page</span>    <!--Edit Website Stuff-->
                      </a>
                      <ul class="sub">
                          <li><a  href="edit_home.php">Edit Home</a></li>        
                          
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
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            <!-- Home of Alex III-->
            <h3><i class="fa fa-angle-right"></i> Home Page</h3>
            
            <!-- BASIC FORM ELELEMNTS -->
            <!-- INLINE FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Slider</h4>
                      <form class="form-horizontal style-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post" enctype="multipart/form-data">
                        
                              <label class="col-sm-2 col-sm-2 control-label">Image</label>
                              <div class="col-sm-10">
                                  <!--<input type="text" name="header" class="form-control">-->
                                    <input type="file" name="slider_image">
                                  <span class="help-block">Change Image</span>
                              </div>
                        <button type="submit" class="btn btn-round btn-success" name ="add_slider_image">Submit</button>
                      </form>
                  </div>
                    <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Images in Slider</h4>
                      <form class="form-horizontal style-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post">
                        <?php 
                            if(empty($slider_images)){
                                echo "<label>Slider Folder is Empty </label>";
                            }else{
                                echo "<ul>";
                                //offsetting by 2 since we remove the first two directory elements
                                for($i = 2; $i < count($slider_images) + 2; $i++)
                                {
                                    $offset_normal_idx = ($i-2);
                                    $current_slider_name = $slider_images[$i];
                                    echo "<li><image width=600 height=480 src='uploads/home_slider/".$current_slider_name."'></li>";
                                    echo "<li><label>".$current_slider_name."   </label><button name='remove_".$current_slider_name."'>Remove</button></li>";
                                    //echo "<image></image>";
                                }
                                echo "</ul>";
                            }
                        ?>
                    </form>
                  </div>
                </div><!-- col-lg-12-->         
            </div><!-- /row -->
            <!-- BASIC FORM ELEMENTS END -->

            <!--Home of Alex III End-->


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

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
