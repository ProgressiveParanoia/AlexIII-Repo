<?php
  require_once "config.php";
  
  session_start();
  if(!isset($_SESSION['username']) && empty($_SESSION['username']) === true)
  {
    header("Location: login.php");
  }

  $delivery_data = null;
  $header_array = array("ID", "NAME", "EMAIL", "CONTACT NUMBER", "ADDRESS", "CART", "ORDER STATE");

  $sql = "SELECT * FROM deliveries";

  if($statement_get = mysqli_prepare($link, $sql))
  {
    if(mysqli_stmt_execute($statement_get))
    {
      $result_set = mysqli_stmt_get_result($statement_get);
      $delivery_data = mysqli_fetch_all($result_set);
    }
  }  

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(array_key_exists("save_delivery", $_POST))
    {
      $batched_ids = explode(" ",$_POST['save_delivery']);
      $idx = $batched_ids[1];

      $delivery_states = $_POST['delivery_state'];
      $target_entry = $delivery_states[$idx];

      $sql_accept = "UPDATE deliveries SET state = ".$target_entry." WHERE res_id = ". $delivery_data[$idx][0];
      if($statement = mysqli_prepare($link, $sql_accept))
      {
        if(mysqli_stmt_execute($statement)){

        }
      }
      mysqli_stmt_close($statement);

      //print_r($delivery_data[$idx]);
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

    <title>Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
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
                      <a class="active" href="order_tracker.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Order Tracker</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-wrench"></i>
                          <span>Edit Page</span>	<!--Edit Website Stuff-->
                      </a>
                      <ul class="sub">
                          <li><a  href="edit_home.php">Edit Home</a></li>        
                          <li><a  href="edit_gallery.php">Edit Gallery</a></li>
                          <li><a  href="edit_menu.php">Edit Menu</a></li>
                          <li><a  href="edit_delivery.php">Edit Delivery</a></li>   
					           </ul>
                  </li>
                  <!--
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Manage Application</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="app_manager.html">AR App</a></li>	
                      </ul>
                  </li>
                -->
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
            <div class="tab-pane" id="chartjs">
              <!--Pending -->
              <div class="row mt">
                <div class="col-lg-12">
                  <div class="content-panel">
                    <center><h1>Delivery Requests</h1>
                    <?php 
                      echo "<table>";
                        //headers
                        echo "<tr>";
                        echo "<form method='post'>";
                        for($i = 0; $i < count($header_array); $i++)
                        {
                          $current_header = $header_array[$i];
                          echo "<th>".$current_header."</th>";
                        }   
                          //$header_array = array("ID", "NAME", "EMAIL", "CONTACT NUMBER", "ADDRESS", "CART", "ORDER STATE");
                        //0 => ID, 1 => NAME, 2 => EMAIL, 3 => CONTACT #, 4 => ADDRESS, 5 => CART, 6 => ORDER STATE
                        echo "</tr>";
                        $row_size = count($delivery_data);
                        for($x = 0; $x < $row_size; $x++)
                        {
                          echo "<tr>";
                          $current_entry = null;
                          $delivery_entry = $delivery_data[$x];
                          $res_size = count($delivery_entry);
                          //print_r($delivery_entry);//
                          for($y = 0; $y < $res_size; $y++)
                          {
                            $current_entry = $delivery_entry[$y];
                            if($y == 6)
                            {
                              if($delivery_entry[6] == 0)
                              {
                              echo "<td>";
                              echo "<select name='delivery_state[]'>";
                                echo "<option value='0' selected>Order Placed</option>";
                                echo "<option value='1'>Delivery On Its Way</option>";
                                echo "<option value='2'>Order Received</option>";
                              echo "</select>";
                              echo "</td>";
                              }else if($delivery_entry[6] == 1)
                              {
                              echo "<td>";
                              echo "<select name='delivery_state[]'>";
                                echo "<option value='0'>Order Placed</option>";
                                echo "<option value='1' selected>Delivery On Its Way</option>";
                                echo "<option value='2'>Order Received</option>";
                              echo "</select>";
                              echo "</td>";
                              }else if($delivery_entry[6] == 2)
                              {
                              echo "<td>";
                              echo "<select name='delivery_state[]'>";
                                echo "<option value='0'>Order Placed</option>";
                                echo "<option value='1'>Delivery On Its Way</option>";
                                echo "<option value='2'selected>Order Received</option>";
                              echo "</select>";
                              echo "</td>";
                              }
                            }else if($y == 5)
                            {
                              $json_arr = json_decode($current_entry);

                              $method_name= "item_1";
                              $method_idx = 1;
                              echo "<td><ul>";
                              while(empty($json_arr->$method_name) != 1)
                              {
                                $column_data = $json_arr->$method_name;
                                $id = $column_data[0];

                                echo"<li><label name='name' value='".$column_data[2]."'>Name:".$column_data[2]."</li>";
                                echo"<li><label name='price' value='".$column_data[1]."'>Price:".$column_data[1]."</li>";
                                $method_idx++;
                                $method_name = "item_" . $method_idx;
                               }
                               echo "</ul></td>";
                            }
                            else
                            {
                              echo "<td>".$current_entry."</td>";
                            }
                          }
                          echo "<td>";
                              echo "<button type='submit' name='save_delivery' value='".$current_entry[0]." ".$x."'>Save Data</button>";
                          //echo "</form>";
                          echo "</td>";
                        }
                        echo "</form>";
                        echo "</tr>";
                        //entries
                      echo "</table>";
                    ?>
                    </center>
                </div>
            </div>
           </div>
            </div>
              <!-- page end-->
          </section>          
      </section><!-- /MAIN CONTENT -->
      <!--main content end-->

  </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="assets/js/chartjs-conf.js"></script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  </body>
</html>
