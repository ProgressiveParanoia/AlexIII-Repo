<?php
  header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');
  session_start();
  if(!isset($_SESSION['username']) && empty($_SESSION['username']) === true)
  {
    //echo "<script>location = 'http://presidentialcarmuseum.000webhostapp.com/admin/dashgum/assets/login.php'</script>";
    header("Location: login.php");
  }
  require_once "config.php";

  $description_error = "";
  $header_error = "";

  $header = "";
  $description = "";

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $description = trim($_POST["description"]);
    $header = trim($_POST["header"]);    
    $sql = "UPDATE signature_dish_description SET description=?, header=? WHERE id = 1";
    if(empty($description) || empty($header)){
      $description_error = "Description is empty!";
    }else
    {
      if($statement = mysqli_prepare($link, $sql))
      {
        mysqli_stmt_bind_param($statement, "ss", $param_desc, $param_header);

        $param_desc = $description;
        $param_header = $header;

        if(mysqli_stmt_execute($statement)){
        }
      }
      mysqli_stmt_close($statement);
    }

    $file = $_FILES['signature_dish_image'];

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

          $fileName = "signature_dish_image" . ".jpg";//"." . $fileActualExtensison;
          $fileDestination = 'uploads/' . $fileName;
          move_uploaded_file(($fileTmpName), ($fileDestination));

       #   echo "You successfully uploaded the file!";
        }
      }

      $sql = "SELECT description, header FROM signature_dish_description WHERE id = 1";

      if($statement = mysqli_prepare($link, $sql))
      {
          if(mysqli_stmt_execute($statement))
          {
             # mysqli_stmt_store_result($statement);
             $result_set = ( mysqli_stmt_get_result($statement));
             $rows = mysqli_fetch_array($result_set);
             $description = $rows['description']; //get first description
             $header = $rows['header'];
          }
          mysqli_stmt_close($statement);
      }
  }

  if($_SERVER["REQUEST_METHOD"] == "GET")
  {
      $sql = "SELECT description, header FROM signature_dish_description WHERE id = 1";

      if($statement = mysqli_prepare($link, $sql))
      {
          if(mysqli_stmt_execute($statement))
          {
             # mysqli_stmt_store_result($statement);
             $result_set = ( mysqli_stmt_get_result($statement));
             $rows = mysqli_fetch_array($result_set);
             $description = $rows['description']; //get first description
             $header = $rows['header'];
          }
          mysqli_stmt_close($statement);
      }
  }

  mysqli_close($link);
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
                          <span>Status</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-wrench"></i>
                          <span>Edit Page</span>	<!--Edit Website Stuff-->
                      </a>
                      <ul class="sub">
                          <li><a  href="edit_about.php">Edit About</a></li>	
                          <li><a  href="edit_signature_dish.php">Edit Signature Dish</a></li> 	    
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
            <!-- History of Alex III-->
          	<h3><i class="fa fa-angle-right"></i> Signature Dish of Alex III</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
            <!-- current header -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i>Current History Header</h4>
                      <form class="form-horizontal style-form" method="get">
                          <div class="form-group">
                              <div class="col-sm-12">
							  <span class="help-block"><center><?php echo $header; ?></center></span>
                                </span>
                              </div>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	<!-- end header-->

            <!-- current description -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i>Current Signature Dish Description</h4>
                      <form class="form-horizontal style-form" method="get">
                          <div class="form-group">
                              <div class="col-sm-12">
                                <span class="help-block"><center><?php echo $description; ?></center></span>
                                </span>
                              </div>
                          </div>
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
            <!-- end current description -->

            <!-- Image -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i>Current Signature Dish Image</h4>
                      <form class="form-horizontal style-form" method="get">
                          <div class="form-group">
                              <div class="col-sm-12">
                                <span class="help-block">
                                  <center>
                                  <!--<?php //echo $description; ?>-->

                                    <img src="uploads/signature_dish_image.jpg">
                                  </center></span>
                                </span>
                              </div>
                          </div>
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
            <!-- end current description -->

          	<!-- INLINE FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Edit</h4>
                      <form class="form-horizontal style-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post" enctype="multipart/form-data">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Header</label>
                              <div class="col-sm-10">
                                  <input type="text" name="header" class="form-control">
                                  <span class="help-block">Change Header</span>
                              </div>
                              <label class="col-sm-2 col-sm-2 control-label">Description</label>
                              <div class="col-sm-10">
								<textarea class="form-control" name="description" style="height:170px"></textarea>
                                  <span class="help-block">Change Description.</span>
                              </div>
                          </div>
                              <label class="col-sm-2 col-sm-2 control-label">Image</label>
                              <div class="col-sm-10">
                                  <!--<input type="text" name="header" class="form-control">-->
                                    <input type="file" name="signature_dish_image">
                                  <span class="help-block">Change Image</span>
                              </div>
						<button type="submit" class="btn btn-round btn-success">Submit</button>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	
            <!-- History of Alex III End-->


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
